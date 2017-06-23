<?php
	//connect to database
	require("assets/db/db.php");

	if(!isset($_SESSION["Id"])){
		echo json_encode(array("user" => "No Users Detected"));
	}else{
		//get all projects for the logged in user
		if($_SESSION["UserType"] == "agency"){
			//pull directly from the project table if they're an Agency
			$sql = "SELECT * FROM `project` WHERE `ProjectAgencyId` = '{$_SESSION["Id"]}' LIMIT 50";

			//Get the Corporate Name of that Agency
			$sql1 = "SELECT * FROM `agency` WHERE `UniqueId` = '{$_SESSION["Id"]}' LIMIT 1";

			//Store User Info Returned
			$user = array();

			//Get User Info
			$res = $conn->query($sql1);
			while($row = $res->fetch_assoc()) {
				array_push($user, array('aname' => $row["AgencyCorporateName"],
				'desc' => $row["Summary"],
				'usertype' => "agency"));
			}
			
		}else{
			//if they're a Talent, check the project request table for projects they have access to 
			$sql = "SELECT * FROM `project` WHERE `ProjectUniqueId` IN (SELECT `ProjectRequestProjectId` FROM `projectrequest` WHERE (`ProjectRequestTalentId` = '{$_SESSION["Id"]}' AND `ProjectRequestAcceptedStatus` = TRUE AND `ProjectRequestRecindedStatus` = FALSE)) LIMIT 50";
			//Get the First & Last name of that Talent
			$sql1 = "SELECT * FROM `talent` WHERE `UniqueId` = '{$_SESSION["Id"]}' LIMIT 1";

			//Store User Info Returned
			$user = array();

			//Get User Info
			$res = $conn->query($sql1);

			while($row = $res->fetch_assoc()) {
				array_push($user, array('fname' => $row["TalentFirstName"],
				'lname' => $row["TalentLastName"],
				'desc' => $row["Summary"],
				'usertype' => "talent"));
			}
		}
		
		//Store Projects Returned
		$projects = array();
		$res = $conn->query($sql);
		if ($res->num_rows > 0) {
			// output data of each record
			while($row = $res->fetch_assoc()) {
				array_push($projects, array('name' => $row["ProjectName"],
					'active' => $row["ProjectActiveState"],
					'complete' => $row["ProjectCompletionState"],
					'privacy' => $row["ProjectPrivacyState"],
					'zone' => $row["ProjectLocationSensitive"],
					'desc' => $row["ProjectDescription"],
					'start' => $row["ProjectStartDate"],
					'end' => $row["ProjectEndDate"],
					'street' => $row["ProjectLocationStreet"],
					'city' => $row["ProjectLocationCity"],
					'state' => $row["ProjectLocationState"],
					'zip' => $row["ProjectLocationPostalCode"],
					'country' => $row["ProjectLocationCountry"],
					'cost' => $row["ProjectTotalCost"]));
			}
		}
		//Send Response with User & Projects
		echo json_encode(array("user" => $user, "projects" => $projects));
	}

	$conn->close();
	exit();
?>