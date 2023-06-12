<?php

    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $parts = $_POST['parts'];
    $description = $_POST['description'];
    $package = $_POST['package'];
    $productor = $_POST['productor'];
    $mpn = $_POST['mpn'];
    $spn = $_POST['spn'];
    $remark = $_POST['remark'];

    $con=mysqli_connect("localhost","root","","eboard");
    $result = mysqli_query($con, "UPDATE boms SET qty = '".$qty."', parts = '".$parts."', description = '".$description."', package = '".$package."', productor = '".$productor."', mpn = '".$mpn."', spn = '".$spn."', remark = '".$remark."' WHERE id = '".$id."'");
    if($result) {
        echo $id;
    }else {
        echo 'error';
    }    

?>
