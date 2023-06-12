<?php

    $id = $_POST['id'];

    $con=mysqli_connect("localhost","root","","eboard");
    $result = mysqli_query($con,"DELETE FROM users WHERE id='".$id."'");
    if($result) {
        echo $id;
    } else {
        echo 'error';
    }

?>
