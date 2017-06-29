<?php
	//connect to database
	require("assets/db/db.php");

	if(!isset($_SESSION["Id"])){
		echo json_encode(array("user" => "No Users Detected"));
	}/***NEW ACCOMPLISHMENT***/
	elseif(isset($_POST['new_acc'])){
		//Get input from form
		$acctype_entry = $conn->real_escape_string($_POST['acctype']);
		$acctitle_entry = $conn->real_escape_string($_POST['acctitle']);
		$from_entry = $conn->real_escape_string($_POST['from']);
		$to_entry = $conn->real_escape_string($_POST['to']);
		$on_entry = $conn->real_escape_string($_POST['on']);
		$url_entry = $conn->real_escape_string($_POST['url']);
		$licagency_entry = $conn->real_escape_string($_POST['licagency']);
		$licnum_entry = $conn->real_escape_string($_POST['licnum']);
		$accdesc_entry = $conn->real_escape_string($_POST['accdesc']);
		$acc_talent_entry = $conn->real_escape_string($_POST['acc_talent']);

		//Post accomplishment to Database
		$sql = "INSERT INTO `accomplishment` (`AccomplishmentTalentId`, `AccomplishmentName`, `AccomplishmentType`, `AccomplishmentFromDate`, `AccomplishmentToDate`, `AccomplishmentOnDate`, `AccomplishmentURL`, `AccomplishementLicenseAgency`, `AccomplishmentLicenseNumber`, `AccomplishmentDescription`) VALUES ('{$acc_talent_entry}', '{$acctitle_entry}', '{$acctype_entry}', '{$from_entry}', '{$to_entry}', '{$on_entry}', '{$url_entry}', '{$licagency_entry}', '{$licnum_entry}', '{$accdesc_entry}')";
		$newAcc = $conn->query($sql);
		if($newAcc){

			$id = $conn->insert_id;
			$sql = "SELECT * FROM `accomplishment` WHERE `AccomplishmentUniqueId` = '{$id}'";

			$accomplishment = array();
			$res = $conn->query($sql);
			while($row = $res->fetch_assoc()) {
				array_push($accomplishment, array('id' => $row["AccomplishmentUniqueId"],
					'atid' => $row["AccomplishmentTalentId"], 
					'name' => $row["AccomplishmentName"],
					'type' => $row["AccomplishmentType"],
					'from' => $row["AccomplishmentFromDate"],
					'to' => $row["AccomplishmentToDate"],
					'on' => $row["AccomplishmentOnDate"],
					'url' => $row["AccomplishmentURL"],
					'la' => $row["AccomplishementLicenseAgency"],
					'ln' => $row["AccomplishmentLicenseNumber"],
					'desc' => $row["AccomplishmentDescription"]));
			}
			echo json_encode(array("success" => $newAcc, "accomplishments" => $accomplishment));
		}

	}/***NEW PROJECT***/
	elseif(isset($_POST['new_project'])){
		//Get input from form
		$pname_entry = $conn->real_escape_string($_POST['pname']);
		$pagency_entry = $conn->real_escape_string($_POST['pagency']);
		$pdesc_entry = $conn->real_escape_string($_POST['pdesc']);
		$privacy_entry = $conn->real_escape_string($_POST['privacy']);
		$sdate_entry = $conn->real_escape_string($_POST['sdate']);
		$edate_entry = $conn->real_escape_string($_POST['edate']);
		$loc_sensitivity_entry = $conn->real_escape_string($_POST['location_sensitive']);
		$street_entry = $conn->real_escape_string($_POST['street']);
		$city_entry = $conn->real_escape_string($_POST['city']);
		$state_entry = $conn->real_escape_string($_POST['state']);
		$zip_entry = $conn->real_escape_string($_POST['zip']);
		$country_entry = $conn->real_escape_string($_POST['country']);

		//Post project to Database
		$sql = "INSERT INTO `project` (`ProjectName`, `ProjectAgencyId`, `ProjectActiveState`, `ProjectCompletionState`, `ProjectPrivacyState`, `ProjectLocationSensitive`, `ProjectDescription`, `ProjectStartDate`, `ProjectEndDate`, `ProjectLocationStreet`, `ProjectLocationCity`, `ProjectLocationState`, `ProjectLocationPostalCode`, `ProjectLocationCountry`) VALUES ('{$pname_entry}', '{$pagency_entry}', 'Active', 'In-Progress', '{$privacy_entry}', '{$loc_sensitivity_entry}', '{$pdesc_entry}', '{$sdate_entry}', '{$edate_entry}', '{$street_entry}', '{$city_entry}', '{$state_entry}', '{$zip_entry}', '{$country_entry}')";
		$newProject = $conn->query($sql);
		if($newProject){

			$id = $conn->insert_id;
			$sql = "SELECT * FROM `project` WHERE `ProjectUniqueId` = '{$id}'";

			$project = array();
			$res = $conn->query($sql);
			while($row = $res->fetch_assoc()) {
				array_push($project, array('id' => $row["ProjectUniqueId"],
					'paid' => $row["ProjectAgencyId"], 
					'name' => $row["ProjectName"],
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
			echo json_encode(array("success" => $newProject, "projects" => $project));
		}

	}elseif (isset($_POST['del_pa'])) {
		//Get input from form
		$table_entry = $conn->real_escape_string($_POST['table']);
		$id_entry = $conn->real_escape_string($_POST['id']);
		//Delete component from Database
		if($table_entry == 'project'){
			$sql = "DELETE FROM `projectrequest` WHERE (`ProjectRequestProjectId` = '{$id_entry}' AND (`ProjectRequestAcceptedStatus` = 0 OR `ProjectRequestRecindedStatus` = 1))";
			$conn->query($sql);
			$sql = "DELETE FROM `project` WHERE `ProjectUniqueId` = '{$id_entry}'";
		}else{
			$sql = "DELETE FROM `accomplishment` WHERE `AccomplishmentUniqueId` = '{$id_entry}'";
		}

		if ($conn->query($sql) === TRUE) {
		    echo "Deleted";
		} else {
		    echo "Error";
		}

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
				array_push($projects, array('id' => $row["ProjectUniqueId"],
					'paid' => $row["ProjectAgencyId"], 
					'name' => $row["ProjectName"],
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