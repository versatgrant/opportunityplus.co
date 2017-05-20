<?php
	//connect to database
	#require("db.php");
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

	//handle login request
	if(isset($_POST['done_login'])) {
		//Get input from form
		$email_entry = $conn->real_escape_string($_POST['email']);
		$pass_entry = $conn->real_escape_string($_POST['pass']);
		//Validate email-pass entry; for now, just add to the DB
		$sql = "INSERT INTO users (`email`, `password`, `firstname`, `lastname`) 
			VALUES ('{$email_entry}','{$pass_entry}', NULL, NULL)";

		//debug if failed
		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
				exit();
	}
?>