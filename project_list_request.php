<?php
	//connect to database
	require("assets/db/db.php");

	//pull data from DB
	//if(isset($_POST['display_login'])) {
	if(true) {
		$sql = "SELECT * FROM projects WHERE userId = '{$_SESSION['Id']}'";
		$result = array();
		$res = $conn->query($sql);
		
		if ($res->num_rows > 0) {
		    // output data of each row
		    while($row = $res->fetch_assoc()) {
		    	array_push($result, array('userId' => $row["userId"],
		    								'Id' => $row["id"],
		    								'Name' => $row["Name"]));
		    }
		    echo json_encode(array("result" => $result));
		} else {
		    echo "0 results";
		}

		$conn->close();
				exit();
	}

	/*if(true) {
		//Get input from form
		//$email_entry = $conn->real_escape_string($_POST['email']);
		//$pass_entry = $conn->real_escape_string($_POST['pass']);
		$email_entry = "email";
		$pass_entry = "pass";
		//Validate email-pass entry; for now, just add to the DB
		$sql = "INSERT INTO users (`email`, `password`, `firstname`, `lastname`) 
			VALUES ('{$email_entry}','{$pass_entry}', NULL, NULL)";

		$sql = "SELECT * FROM users WHERE email = '{$email_entry}' AND password = '{$pass_entry}'";
		$user = mysqli_query($conn, $sql);
		$validate = mysqli_num_rows($user);

		if($validate > 0){
			header("location:project_list.php");
		}else{
			echo "Wrong Username/Password";
		}


		//debug if failed
		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
				exit();
	}*/
?>