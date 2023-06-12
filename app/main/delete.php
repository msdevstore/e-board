<?php

    $id = $_POST['id'];
    $con = mysqli_connect("localhost","root","","eboard");

    $sql = "SELECT * FROM ebs WHERE id = '".$id."'";
    $result = mysqli_query($con, $sql);
    $arr= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $mainName = $arr[0]['item_code'].'_'.$arr[0]['version'];
    $delDir = "../../public/".$mainName;

    deleteDirectory ($delDir);

    $sql="DELETE FROM ebs WHERE id = '".$id."'";
    $result = mysqli_query($con, $sql);
    if($result) {
        $sql="DELETE FROM boms WHERE ebId = '".$id."'";
        $result = mysqli_query($con,$sql);
    }

    function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
    
            if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
    
        }
    
        return rmdir($dir);
    }

    echo ($delDir);

?>