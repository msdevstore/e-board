<?php

    $con=mysqli_connect("localhost","root","","eboard");
    $result = mysqli_query($con, "SELECT * FROM ebs WHERE id='".$_POST['id']."'");
    if ($result->num_rows > 0) {
        // output data of each row
        //while($row = $result->fetch_assoc()) {
        $data= mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo $data[0]['description'];
        //}
    } else {
        echo "error";
    }

?>