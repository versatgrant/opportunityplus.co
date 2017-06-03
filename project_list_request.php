<?php
	//connect to database
	require("assets/db/db.php");

	if(!isset($_SESSION["Id"])){
		echo json_encode(array("result" => "No Users Detected"));
	}else{
		//get all projects for the logged in user
		if($_SESSION["UserType"] == "agency"){
			//pull directly from the project table if they're an Agency
			$sql = "SELECT * FROM `project` WHERE `ProjectAgencyId` = '{$_SESSION["Id"]}'";
		}else{
			//if they're a Talent, check the project request table for projects they have access to 
			$sql = "SELECT * FROM `project` WHERE `ProjectUniqueId` IN (SELECT `ProjectRequestProjectId` FROM `projectrequest` WHERE (`ProjectRequestTalentId` = '{$_SESSION["Id"]}' AND `ProjectRequestAcceptedStatus` = TRUE AND `ProjectRequestRecindedStatus` = FALSE))";
		}
		
		$result = array();
		$res = $conn->query($sql);

		if ($res->num_rows > 0) {
			// output data of each record
			while($row = $res->fetch_assoc()) {
				array_push($result, array('name' => $row["ProjectName"],
					'active' => $row["ProjectActiveState"],
					'complete' => $row["ProjectCompletionState"]));
			}
			echo json_encode(array("result" => $result));
		}
	}

	$conn->close();
	exit();

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