<?php

    $name = $_POST['name'];
    $code = $_POST['code'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $con=mysqli_connect("localhost","root","","eboard");
    $result = mysqli_query($con, "SELECT * FROM users WHERE username='".$username."'");
    if ($result->num_rows > 0) {
        echo 'error1';
    } else {
        $result = mysqli_query($con,"INSERT INTO users (name, code, username, password, role) value ('".$name."','".$code."','".$username."', '".md5('000')."', '".$role."')");
        if(!$result) echo 'error2';
        else {
            $last_id = $con->insert_id;
            echo $last_id;
        }
    }

?>