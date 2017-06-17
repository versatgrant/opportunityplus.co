<?php
	//connect to database
	require("assets/db/db.php");

	if(!isset($_SESSION["Id"])){
		echo json_encode(array("result1" => "No Users Detected"));
	}else{
		//get all projects for the logged in user
		if($_SESSION["UserType"] == "agency"){
			//pull directly from the project table if they're an Agency
			$sql = "SELECT * FROM `project` WHERE `ProjectAgencyId` = '{$_SESSION["Id"]}' LIMIT 50";

			//Get the Corporate Name of that Agency
			$sql1 = "SELECT * FROM `agency` WHERE `UniqueId` = '{$_SESSION["Id"]}' LIMIT 1";

			//Store User Info Returned
			$result1 = array();

			//Get User Info
			$res = $conn->query($sql1);
			while($row = $res->fetch_assoc()) {
				array_push($result1, array('aname' => $row["AgencyCorporateName"],
				'usertype' => "agency"));
			}
			
		}else{
			//if they're a Talent, check the project request table for projects they have access to 
			$sql = "SELECT * FROM `project` WHERE `ProjectUniqueId` IN (SELECT `ProjectRequestProjectId` FROM `projectrequest` WHERE (`ProjectRequestTalentId` = '{$_SESSION["Id"]}' AND `ProjectRequestAcceptedStatus` = TRUE AND `ProjectRequestRecindedStatus` = FALSE)) LIMIT 50";
			//Get the First & Last name of that Talent
			$sql1 = "SELECT * FROM `talent` WHERE `UniqueId` = '{$_SESSION["Id"]}' LIMIT 1";

			//Store User Info Returned
			$result1 = array();

			//Get User Info
			$res = $conn->query($sql1);

			while($row = $res->fetch_assoc()) {
				array_push($result1, array('fname' => $row["TalentFirstName"],
				'lname' => $row["TalentLastName"],
				'usertype' => "talent"));
			}
		}
		
		//Store Projects Returned
		$result = array();
		$res = $conn->query($sql);
		if ($res->num_rows > 0) {
			// output data of each record
			while($row = $res->fetch_assoc()) {
				array_push($result, array('name' => $row["ProjectName"],
					'active' => $row["ProjectActiveState"],
					'complete' => $row["ProjectCompletionState"]));
			}
			//Send Response with Projects
			echo json_encode(array("result" => $result));
		}
		//Send Response with User
		echo json_encode(array("result1" => $result1));
	}

	$conn->close();
	exit();
?>