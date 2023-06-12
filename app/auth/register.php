<?php
    include '../../utils/route.php';
	if(isset($_POST['name']))
		$name = $_POST['name'];

	if(isset($_POST['username']))
		$username = $_POST['username'];
	
	if(isset($_POST['password']))
		$password = $_POST['password'];

    if(!isset($username) | !isset($password))
    {
        print ('<script>history.go(-1)</script>');
        return;
    }

	$con = mysqli_connect("localhost","root","","eboard");
	mysqli_set_charset($con, 'utf8');
	// Check connection
	if (mysqli_connect_errno())
	{
	    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br />";
        return;
	}

	$result = mysqli_query($con, "SELECT * FROM users WHERE username='".$username."'");
    if ($result->num_rows > 0) {
        echo 'Username is already taken!';
        print ('<script>history.go(-1)</script>');
    } else {
		$result = mysqli_query($con, "INSERT INTO users (name, username, password, role) VALUES ('".$name."', '".$username."','".md5($password)."', '2')");
	
		if ($result) {
			$_SESSION['authToken'] = md5($username.''.$password.''.time());
		}
    
    	route('../../view/home');
	}
	?>