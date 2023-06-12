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
    $result = mysqli_query($con,"INSERT INTO boms (qty, parts, description, package, productor, mpn, spn, remark, ebId) value ('".$qty."','".$parts."','".$description."', '".$package."', '".$productor."','".$mpn."','".$spn."','".$remark."','".$id."')");
    if(!$result) {
        echo 'error';
    } else {
        $last_id = $con->insert_id;
        echo $last_id;
    }

?>
