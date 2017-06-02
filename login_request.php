<?php
	//connect to database
	require("assets/db/db.php");


	//handle login request
	if(isset($_SESSION["Id"])){
		//redirect to project list page;
		echo "Already Logged In";
	}else{
		if(isset($_POST['done_login'])) {
			//Get input from form
			$email_entry = $conn->real_escape_string($_POST['email']);
			$pass_entry = $conn->real_escape_string($_POST['pass']);
			//Validate email-pass entry; for now, just add to the DB
			//$sql = "SELECT * FROM users (`email`, `password`, `firstname`, `lastname`) 
			//	VALUES ('{$email_entry}','{$pass_entry}', NULL, NULL)";

			$sql = "SELECT userId FROM users WHERE email = '{$email_entry}' AND password = '{$pass_entry}'";
			//$result = array();
			$res = $conn->query($sql);

			if ($res->num_rows > 0){
				//get the first row in results
				$row = $res->fetch_assoc();
				$_SESSION["Id"] = $row["userId"];
				echo $row["userId"];
			}else{
				echo "Incorrect Username/Password";
			}

			$conn->close();
					exit();
		}
	}

	if(isset($_POST['done_logout'])){
		unset($_SESSION["Id"]);
		echo "Successfully Logged Out";
	}

	//pull data from DB
	//if(isset($_POST['display_login'])) {
	/*if(true) {
		$sql = "SELECT * FROM users";
		$result = array();
		$res = $conn->query($sql);
		
		if ($res->num_rows > 0) {
		    // output data of each row
		    while($row = $res->fetch_assoc()) {
		    	array_push($result, array('email' => $row["email"],
		    								'pass' => $row["password"],
		    								'fname' => $row["firstname"],
		    								'lname' => $row["lastname"]));
		    }
		    echo json_encode(array("result" => $result));
		} else {
		    echo "0 results";
		}

		$conn->close();
				exit();
	}*/

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