<?php
	//connect to database
	require("assets/db/db.php");

	//handle login request; check if there's a user already logged in
	if(isset($_SESSION["Id"]) && !isset($_POST['done_logout'])){
		//redirect to project list page;
		echo json_encode(array("loggedin" => true));
	}else{
		if(isset($_POST['done_login'])) {
			//Get input from form
			$email_entry = $conn->real_escape_string($_POST['email']);
			$pass_entry = $conn->real_escape_string($_POST['pass']);
			$usertype_entry = $conn->real_escape_string($_POST['usertype']);

			//check if that user exists
			if($usertype_entry == "agency"){
				$sql = "SELECT `UniqueId` FROM `agency` WHERE `Email` = '{$email_entry}' AND `Password` = '{$pass_entry}'";
			}else{
				$sql = "SELECT `UniqueId` FROM `talent` WHERE `Email` = '{$email_entry}' AND `Password` = '{$pass_entry}'";
			}

			$res = $conn->query($sql);

			if ($res->num_rows > 0){
				//get the first row in results
				$row = $res->fetch_assoc();
				//store their Id and Type in session variables
				$_SESSION["Id"] = $row["UniqueId"];
				$_SESSION["UserType"] = $usertype_entry;
				echo 1;
			}else{
				echo "Incorrect Username/Password";
			}

			
		}
	}

	if(isset($_POST['done_logout'])){
		unset($_SESSION["Id"]);
		echo "Successfully Logged Out";
	}

	$conn->close();
	exit();
?>