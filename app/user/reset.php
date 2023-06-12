<?php 

    $id = $_POST['id'];

    $con=mysqli_connect("localhost","root","","eboard");
    $result = mysqli_query($con, "UPDATE users SET password = '".md5('000')."' WHERE id = '".$id."'");
    if(!$result) echo 'failed';
    else echo 'ok';
?>