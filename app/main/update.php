<?php

    $con=mysqli_connect("localhost","root","","eboard");
    $result = mysqli_query($con, "UPDATE ebs SET description = '".$_POST['description']."' WHERE id = '".$_POST['id']."'");
    if($result) {
        echo $_POST['description'];
    }else {
        echo 'error';
    }    

?>