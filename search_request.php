<?php
	//connect to database
	require("assets/db/db.php");

	if(isset($_POST['done_search'])){
		$table_entry = $conn->real_escape_string($_POST['table']);
		$term_entry = $conn->real_escape_string($_POST['term']);

		//echo json_encode(array("result" => "No Users Detected"));
	}

	if($table_entry == "agency"){
		$sql = "SELECT * FROM `agency` WHERE (`AgencyCorporateName` LIKE '%{$term_entry}%' AND `AgencyPrivacyState` = FALSE)";
	}elseif ($table_entry== "talent") {
		$sql = "SELECT * FROM `talent` WHERE (`TalentFirstName` LIKE '%{$term_entry}%' OR `TalentLastName` LIKE '%{$term_entry}%')";
	}else{
		$sql = "SELECT * FROM `project` WHERE (((`ProjectName` LIKE '%{$term_entry}%') OR (`ProjectDescription` LIKE '%{$term_entry}%')) AND `ProjectPrivacyState` = 'Public' AND `ProjectActiveState` = 'Active')";
	}

	$res = $conn->query($sql);

	if ($res->num_rows > 0) {
		// output data of each record
		if($table_entry == "agency"){
			$agencies = array();
			while($row = $res->fetch_assoc()) {
				array_push($agencies, array('name' => $row["AgencyCorporateName"]));
			}
			echo json_encode(array("agencies" => $agencies));
		}elseif ($table_entry== "talent") {
			$talents = array();
			while($row = $res->fetch_assoc()) {
				array_push($talents, array('fname' => $row["TalentFirstName"],
					'lname' => $row["TalentLastName"]));
			}
			echo json_encode(array("talents" => $talents));
		}else{
			$projects = array();
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
			echo json_encode(array("projects" => $projects));
		}
	}else{
		echo json_encode(array("error" => "No Results"));
	}
	/*else{
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
	}*/

	$conn->close();
	exit();
?>