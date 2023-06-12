<?php 

    listFolderFiles('../../public/'.$_POST['code'], 0);
    
    function listFolderFiles($dir, $ttId)
    {
        $unit = array('Byte', 'KB', 'MB', 'GB');
        foreach (new DirectoryIterator($dir) as $fileInfo) {
            if (!$fileInfo->isDot()) {
                $tempArr = explode('-', $ttId);
                $len = count($tempArr);
                $ttId = $tempArr[0];

                if($len > 1) {
                    for($i = 1; $i < $len; $i++) {
                        if($i == $len - 1) {
                            ++$tempArr[$i];
                        }
                        $ttId = $ttId.'-'.$tempArr[$i];
                    }
                } else {
                    ++$ttId;
                }
                if($len > 1){
                    $ttParentId = $tempArr[0];
                    for($i = 1; $i < $len - 1; $i++) {
                        $ttParentId = $ttParentId.'-'.$tempArr[$i];
                    }
                    
                    if ($fileInfo->isDir()) {    
                        echo '<tr data-tt-id="'.$ttId.'" data-tt-parent-id="'.$ttParentId.'"><td><span class="folder">' . $fileInfo->getFilename() . '</span></td><td>..</td><td>' . date("Y-m-d h-m-s", $fileInfo->getATime()). '</td><td>' .date("Y-m-d h-m-s", $fileInfo->getCTime()). '</td></tr>';
                        listFolderFiles($fileInfo->getPathname(), $ttId.'-0');
                    } else {
                        $size = $fileInfo->getSize();
                        $cnt = 0;
                        while($size > 1024) {
                            $size /= 1024;
                            $size = round($size, 2);
                            $cnt++;
                        }
                        echo '<tr data-tt-id="'.$ttId.'" data-tt-parent-id="'.$ttParentId.'"><td><a href="'.$fileInfo->getPathname().'"><span class="file">' . $fileInfo->getFilename() . '</span></a></td><td>' .$size." ".$unit[$cnt]. '</td><td>' . date("Y-m-d h-m-s", $fileInfo->getATime()). '</td><td>' .date("Y-m-d h-m-s", $fileInfo->getCTime()). '</td></tr>';
                    }
                } else {
                    if ($fileInfo->isDir()) {    
                        echo '<tr data-tt-id="'.$ttId.'"><td><span class="folder">' . $fileInfo->getFilename() . '</span></td><td>..</td><td>' . date("Y-m-d h-m-s", $fileInfo->getATime()). '</td><td>' .date("Y-m-d h-m-s", $fileInfo->getCTime()). '</td></tr>';
                        listFolderFiles($fileInfo->getPathname(), $ttId.'-0');
                    } else {
                        $size = $fileInfo->getSize();
                        $cnt = 0;
                        while($size > 1024) {
                            $size /= 1024;
                            $size = round($size, 2);
                            $cnt++;
                        }
                        echo '<tr data-tt-id="'.$ttId.'"><td><a href="'.$fileInfo->getPathname().'"><span class="file">' . $fileInfo->getFilename() . '</span></a></td><td>' .$size." ".$unit[$cnt]. '</td><td>' . date("Y-m-d h-m-s", $fileInfo->getATime()). '</td><td>' .date("Y-m-d h-m-s", $fileInfo->getCTime()). '</td></tr>';
                    }
                }
               
            }
        }
    }