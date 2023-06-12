<?php

    $files = glob('../../public/download/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file)) {
            unlink($file); // delete file
            echo "zip file deleted!";
        }
    }

?>