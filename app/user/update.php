<?php 

    $id = $_POST['id'];
    $name = $_POST['name'];
    $code = $_POST['code'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $con=mysqli_connect("localhost","root","","eboard");
    $result = mysqli_query($con, "SELECT * FROM users WHERE username='".$username."' AND id<>'".$id."'");
    if ($result->num_rows > 1) {
        echo 'error1';
    } else {
        $result = mysqli_query($con, "UPDATE users SET name = '".$name."', code = '".$code."', username = '".$username."', role = '".$role."' WHERE id = '".$id."'");
        if(!$result) echo 'error2';
        else {
            $last_id = $con->insert_id;
            echo $last_id;
        }
    }

?>