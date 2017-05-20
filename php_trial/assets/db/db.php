<?php
	$dbname = 'test';
	$dbuser = 'opportunity+';
	$dbpass = '1234';
	$dbhost = 'localhost';

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if ($conn->connect_error) {
	    die("Database connection failed: " . mysqli_connect_error());
	    echo (mysqli_connect_error());
	}else{
		echo "connected to Database";
	}
?>