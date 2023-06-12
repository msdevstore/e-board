<?php 
    $code = $_POST['code'];
    $rootPath = '../../public/'.$code.'/';
    
    $zip = new ZipArchive();
    if(!is_dir('../../public/download')) {
        mkdir('../../public/download');
    }

    
    $archive_name = '../../public/download/'.$code.'_ALLFILES.zip'; // name of zip file

    $zip = new ZipArchive;

    if ($zip->open($archive_name, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
        addFolderToZip($rootPath, $zip);
    }

    function addFolderToZip($dir, $zipArchive){
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
    
                //Add the directory
                $zipArchive->addEmptyDir($dir);
               
                // Loop through all the files
                while (($file = readdir($dh)) !== false) {
               
                    //If it's a folder, run the function again!
                    if(!is_file($dir . $file)){
                        // Skip parent and root directories
                        if( ($file !== ".") && ($file !== "..")){
                            addFolderToZip($dir . $file . "/", $zipArchive);
                        }
                       
                    }else{
                        // Add the files
                        $zipArchive->addFile($dir . $file);
                       
                    }
                }
            }
        }
    }

    // show directories having files

    // if($zip->open('../../public/download/'.$code.'_ALLFILES.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
    //     listFolderFiles($rootPath, $rootPath, $zip);
    // } else {
    //     echo "failed";
    // }

    // function listFolderFiles($dir, $rootPath, $zipArchive)
    // {
    //     foreach (new DirectoryIterator($dir) as $fileInfo) {
    //         if (!$fileInfo->isDot()) {
    //             if ($fileInfo->isDir()) {    
    //                 listFolderFiles($fileInfo->getPathname(), $rootPath, $zipArchive);
    //             } else {
    //                 $filePath = $fileInfo->getPathname();
    //                 $relativePath = substr($filePath, strlen($rootPath) + 1);

    //                 // Add current file to archive
    //                 $zipArchive->addFile($filePath, $relativePath);
    //             }
    //         }
    //     }
    // }

    $zip->close();
    echo $code;

?>