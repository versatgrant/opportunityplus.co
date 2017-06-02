<?php
	//connect to database
	require("assets/db/db.php");

	//check if there's a user already logged in
	if(isset($_SESSION["Id"])){
		echo json_encode(array("loggedin" => true));
	}

	if(isset($_POST['done_reg'])) {
		//Get input from form
		$email_entry = $conn->real_escape_string($_POST['email']);
		$pass_entry = $conn->real_escape_string($_POST['pass']);
		$fname_entry = $conn->real_escape_string($_POST['fname']);
		$lname_entry = $conn->real_escape_string($_POST['lname']);
		$usertype_entry = $conn->real_escape_string($_POST['usertype']);
		$agencytype_entry = $conn->real_escape_string($_POST['agencytype']);
		$corpname_entry = $conn->real_escape_string($_POST['corpname']);
		$phone_entry = $conn->real_escape_string($_POST['phone']);
		$street_entry = $conn->real_escape_string($_POST['street']);
		$city_entry = $conn->real_escape_string($_POST['city']);
		$zip_entry = $conn->real_escape_string($_POST['zip']);

		//check if a user already exists with that email
		$sql = "SELECT * FROM users WHERE `email` = '{$email_entry}'";
		$res = $conn->query($sql);
		//if a user is already registered with this email
		if ($res->num_rows > 0) {
			echo "User Already Exists";
		}else{
			//Insert user into DB
			$sql = "INSERT INTO users (`email`, `password`, `firstname`, `lastname`) 
			VALUES ('{$email_entry}','{$pass_entry}', '{$fname_entry}', '{$lname_entry}')";

			$res = $conn->query($sql);

			if ($res){
				echo TRUE;
			}else{
				echo FALSE;
			}
		}
	}
	
	$conn->close();
		exit();
?>