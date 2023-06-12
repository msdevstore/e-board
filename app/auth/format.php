<?php 

    $con=mysqli_connect("localhost","root","","eboard");
    $result = mysqli_query($con, "SELECT * FROM users WHERE username='admin'");
    if (!$result->num_rows) {
        $result = mysqli_query($con, "INSERT INTO users (username, password, role) VALUES ('admin','".md5('avensys')."', '0')");
        if($result) echo 'Admin created!';
        else echo 'Failed!';
    }

?>