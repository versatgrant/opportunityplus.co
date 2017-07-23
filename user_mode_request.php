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
					'cost' => $row["ProjectTotalCost"],
					'access' => "true",
					'sent' => "true"));
			}
			echo json_encode(array("success" => $newProject, "projects" => $project));
		}

	}elseif (isset($_POST['del_pa'])) {
		//Get input from form
		$table_entry = $conn->real_escape_string($_POST['table']);
		$id_entry = $conn->real_escape_string($_POST['id']);
		//Delete component from Database
		if($table_entry == 'project'){
			$sql = "DELETE FROM `projectrequest` WHERE (`ProjectRequestProjectId` = '{$id_entry}' AND (`ProjectRequestAcceptedStatus` = 'Sent' OR `ProjectRequestAcceptedStatus` = 'Rejected' OR `ProjectRequestRecindedStatus` = 1))";
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

	}//INITIAL LOGIN; GET ALL PROJECTS FOR THE LOGGED IN USER; ALSO GET THE USER DATA
	elseif(isset($_GET['view_proj'])){
		if($_SESSION["UserType"] == "agency"){
			//pull directly from the project table if they're an Agency
			$p_sql = "SELECT * FROM `project` WHERE `ProjectAgencyId` = '{$_SESSION["Id"]}' LIMIT 50";

			//Get the Corporate Name of that Agency
			$u_sql = "SELECT * FROM `agency` WHERE `UniqueId` = '{$_SESSION["Id"]}' LIMIT 1";

			//Store User Info Returned
			$user = array();

			//Get User Info
			$res = $conn->query($u_sql);
			while($row = $res->fetch_assoc()) {
				array_push($user, array('aname' => $row["AgencyCorporateName"],
					'email' => $row["Email"],
					'password' => $row["Password"],
					'phone' => $row["Phone"],
					'privacy' => $row["AgencyPrivacyState"],
					'desc' => $row["Summary"],
					'street' => $row["LocationStreet"],
					'city' => $row["LocationCity"],
					'state' => $row["LocationState"],
					'zip' => $row["LocationPostalCode"],
					'country' => $row["LocationCountry"],
					'usertype' => "agency"));
			}
			
		}else{
			//if they're a Talent, check the project request table for projects they have access to 
			$p_sql = "SELECT * FROM `project` WHERE `ProjectUniqueId` IN (SELECT `ProjectRequestProjectId` FROM `projectrequest` WHERE (`ProjectRequestTalentId` = '{$_SESSION["Id"]}' AND `ProjectRequestAcceptedStatus` = 'Accepted' AND `ProjectRequestRecindedStatus` = 0)) LIMIT 50";
			//Get the First & Last name of that Talent
			$u_sql = "SELECT * FROM `talent` WHERE `UniqueId` = '{$_SESSION["Id"]}' LIMIT 1";

			//Store User Info Returned
			$user = array();

			//Get User Info
			$res = $conn->query($u_sql);

			while($row = $res->fetch_assoc()) {
				array_push($user, array('fname' => $row["TalentFirstName"],
					'lname' => $row["TalentLastName"],
					'email' => $row["Email"],
					'password' => $row["Password"],
					'phone' => $row["Phone"],
					'desc' => $row["Summary"],
					'street' => $row["LocationStreet"],
					'city' => $row["LocationCity"],
					'state' => $row["LocationState"],
					'zip' => $row["LocationPostalCode"],
					'country' => $row["LocationCountry"],
					'usertype' => "talent"));
			}
		}
		
		//Store Projects Returned
		$projects = array();
		$res = $conn->query($p_sql);
		if ($res->num_rows > 0) {
			//output data of each record
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
					'cost' => $row["ProjectTotalCost"],
					'access' => "true"));
			}
		}
		//Send Response with User & Projects
		echo json_encode(array("user" => $user, "projects" => $projects));
	}//GET ALL ACCOMPLISHMENTS FOR THE LOGGED IN USER
	elseif(isset($_GET['view_acc'])){
		//pull directly from the accomplishments table
		$sql = "SELECT * FROM `accomplishment` WHERE `AccomplishmentTalentId` = '{$_SESSION["Id"]}' LIMIT 50";
		//Store Accomplishments Returned
		$accomplishments = array();
		$res = $conn->query($sql);
		if ($res->num_rows > 0) {
			// output data of each record
			while($row = $res->fetch_assoc()) {
				array_push($accomplishments, array('id' => $row["AccomplishmentUniqueId"],
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
		}
		//Send Response with Accomplishments
		echo json_encode(array("accomplishments" => $accomplishments));
	}//UPDATE USER PROFILE
	elseif(isset($_POST['edit_profile'])){
			$password_entry = $conn->real_escape_string($_POST['password']);
			$phone_entry = $conn->real_escape_string($_POST['phone']);
			$street_entry = $conn->real_escape_string($_POST['street']);
			$city_entry = $conn->real_escape_string($_POST['city']);
			$state_entry = $conn->real_escape_string($_POST['state']);
			$zip_entry = $conn->real_escape_string($_POST['zip']);
			$country_entry = $conn->real_escape_string($_POST['country']);
			$desc_entry = $conn->real_escape_string($_POST['desc']);
			$utype_entry = $conn->real_escape_string($_POST['utype']);

		//Update user profile of logged in user
		if($utype_entry == "talent"){
			//Get input from form
			$fname_entry = $conn->real_escape_string($_POST['fname']);
			$lname_entry = $conn->real_escape_string($_POST['lname']);
			

			$sql = "UPDATE `talent` SET `TalentFirstName` = '{$fname_entry}', 
			`TalentLastName` = '{$lname_entry}', 
			`Password` = '{$password_entry}', 
			`Phone` = '{$phone_entry}', 
			`Summary` = '{$desc_entry}', 
			`LocationStreet` = '{$street_entry}', 
			`LocationCity` = '{$city_entry}', 
			`LocationState` = '{$state_entry}', 
			`LocationPostalCode` = '{$zip_entry}', 
			`LocationCountry` = '{$country_entry}' 
			WHERE `UniqueId` = '{$_SESSION["Id"]}' LIMIT 1";
		}elseif($utype_entry == "agency"){

			$aname_entry = $conn->real_escape_string($_POST['aname']);

			$sql = "UPDATE `agency` SET `AgencyCorporateName` = '{$aname_entry}',
			`Password` = '{$password_entry}', 
			`Phone` = '{$phone_entry}', 
			`Summary` = '{$desc_entry}', 
			`LocationStreet` = '{$street_entry}', 
			`LocationCity` = '{$city_entry}', 
			`LocationState` = '{$state_entry}', 
			`LocationPostalCode` = '{$zip_entry}', 
			`LocationCountry` = '{$country_entry}' 
			WHERE `UniqueId` = '{$_SESSION["Id"]}' LIMIT 1";
		}
		$conn->query($sql);	
	}//GET PROJECT|ACCOMPLISHMENT DATA
	elseif(isset($_GET['editPA'])){
		//Get input from form
		$table_entry = $conn->real_escape_string($_GET['table']);
		$id_entry = $conn->real_escape_string($_GET['row']);

		if($table_entry == "newProjectModal"){
			//Build SQL statement
			$sql = "SELECT * FROM `project` WHERE (`ProjectUniqueId` = '{$id_entry}') ";

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
			//Send Response with Projects
			echo json_encode(array("projects" => $projects));
		}elseif($table_entry == "newAccomplishmentModal"){
			//Build SQL statement
			$sql = "SELECT * FROM `accomplishment` WHERE (`AccomplishmentUniqueId` = '{$id_entry}') ";

			//Store Accomplishments Returned
			$accomplishments = array();
			$res = $conn->query($sql);
			if ($res->num_rows > 0) {
				// output data of each record
				while($row = $res->fetch_assoc()) {
					array_push($accomplishments, array('name' => $row["AccomplishmentName"],
						'type' => $row["AccomplishmentType"],
						'from' => $row["AccomplishmentFromDate"],
						'to' => $row["AccomplishmentToDate"],
						'on' => $row["AccomplishmentOnDate"],
						'url' => $row["AccomplishmentURL"],
						'la' => $row["AccomplishementLicenseAgency"],
						'ln' => $row["AccomplishmentLicenseNumber"],
						'desc' => $row["AccomplishmentDescription"]));
				}
			}
			//Send Response with Accomplishments
			echo json_encode(array("accomplishments" => $accomplishments));
		}
	}//Update Projects
	elseif(isset($_POST['update_project'])){
		//Get input from form
		$id_entry = $conn->real_escape_string($_POST['id']);
		$active_entry = $conn->real_escape_string($_POST['active']);
		$complete_entry = $conn->real_escape_string($_POST['complete']);
		$name_entry = $conn->real_escape_string($_POST['name']);
		$start_entry = $conn->real_escape_string($_POST['start']);
		$end_entry = $conn->real_escape_string($_POST['end']);
		$zone_entry = $conn->real_escape_string($_POST['zone']);
		$street_entry = $conn->real_escape_string($_POST['street']);
		$city_entry = $conn->real_escape_string($_POST['city']);
		$state_entry = $conn->real_escape_string($_POST['state']);
		$zip_entry = $conn->real_escape_string($_POST['zip']);
		$country_entry = $conn->real_escape_string($_POST['country']);
		$desc_entry = $conn->real_escape_string($_POST['desc']);

		$sql = "UPDATE `project` SET `ProjectName` = '{$name_entry}', 
		`ProjectActiveState` = '{$active_entry}', 
		`ProjectCompletionState` = '{$complete_entry}', 
		`ProjectStartDate` = '{$start_entry}', 
		`ProjectEndDate` = '{end_entry}', 
		`ProjectLocationSensitive` = '{$zone_entry}',
		`ProjectDescription` = '{$desc_entry}',
		`ProjectLocationStreet` = '{$street_entry}', 
		`ProjectLocationCity` = '{$city_entry}', 
		`ProjectLocationState` = '{$state_entry}', 
		`ProjectLocationPostalCode` = '{$zip_entry}', 
		`ProjectLocationCountry` = '{$country_entry}' 
		WHERE `ProjectUniqueId` = '{$id_entry}'";

		$conn->query($sql);	
	}//UPDATE ACCOMPLISHMENTS
	elseif(isset($_POST['update_acc'])){
		//Get input from form
		$id_entry = $conn->real_escape_string($_POST['id']);
		$name_entry = $conn->real_escape_string($_POST['name']);
		$from_entry = $conn->real_escape_string($_POST['from']);
		$to_entry = $conn->real_escape_string($_POST['to']);
		$on_entry = $conn->real_escape_string($_POST['on']);
		$la_entry = $conn->real_escape_string($_POST['la']);
		$ln_entry = $conn->real_escape_string($_POST['ln']);
		$url_entry = $conn->real_escape_string($_POST['url']);
		$desc_entry = $conn->real_escape_string($_POST['desc']);

		$sql = "UPDATE `accomplishment` SET `AccomplishmentName` = '{$name_entry}', 
		`AccomplishmentFromDate` = '{$from_entry}', 
		`AccomplishmentToDate` = '{$to_entry}', 
		`AccomplishmentOnDate` = '{$on_entry}', 
		`AccomplishmentURL` = '{$url_entry}', 
		`AccomplishementLicenseAgency` = '{$la_entry}',
		`AccomplishmentLicenseNumber` = '{$ln_entry}',
		`AccomplishmentDescription` = '{$desc_entry}'
		WHERE `AccomplishmentUniqueId` = '{$id_entry}'";

		$conn->query($sql);	
	}//NEW PROJECT REQUEST
	elseif(isset($_POST['proj_req'])){
		/*GET PROJREQ DETAILS*/
		$talent_entry = $conn->real_escape_string($_POST['talent']);
		$sender_entry = $conn->real_escape_string($_POST['sender']);
		$project_entry = $conn->real_escape_string($_POST['project']);

		/*GET AGENCY DETAILS*/
		$praid_sql = "SELECT `ProjectAgencyId` FROM `project` WHERE `ProjectUniqueId` = '{$project_entry}' LIMIT 1";
		$praid_res = $conn->query($praid_sql);
		while($praid_row = $praid_res->fetch_assoc()){

			/*INSERT PROJECT REQUEST*/
			$projreq_sql = "INSERT INTO `projectrequest` (`ProjectRequestProjectId`, `ProjectRequestTalentId`, `ProjectRequestAgencyId`, `ProjectRequestSender`, `ProjectRequestAcceptedStatus`, `ProjectRequestRecindedStatus`) VALUES ('{$project_entry}', '{$talent_entry}', '{$praid_row["ProjectAgencyId"]}', '{$sender_entry}', 'Sent', 0)";

			$projreq_res = $conn->query($projreq_sql);
			if (!$projreq_res) {
			   die($conn->error);
			}else{
				echo $projreq_res;
			}

			$pra_sql = "SELECT `AgencyCorporateName` FROM `agency` WHERE `UniqueId` = '{$praid_row["ProjectAgencyId"]}'";

		}

	}//VIEW PROJECT REQUESTS
	elseif(isset($_GET['view_projReq'])){
		/*Get Request Details*/
		$id_entry = $conn->real_escape_string($_GET['id']);
		$type_entry = $conn->real_escape_string($_GET['type']);

		if($type_entry == "talent"){
			$projreq_sql = "SELECT * FROM `projectrequest` WHERE `ProjectRequestTalentId` = '{$id_entry}'";
		}elseif($type_entry == "agency"){
			$projreq_sql = "SELECT * FROM `projectrequest` WHERE `ProjectRequestAgencyId` = '{$id_entry}'";
		}
		$projreq_res = $conn->query($projreq_sql);
		$projreq = array();

		while ($projreq_row = $projreq_res->fetch_assoc()) {
			$talentname='';
			$agencyname='';
			$projectname='';

			/*GET THE NAMES OF THE TALENT, AGENCY AND PROJECT*/
			$talentname_sql = "SELECT * FROM `talent` WHERE `UniqueId` = '{$projreq_row["ProjectRequestTalentId"]}'";
			$talentname_res = $conn->query($talentname_sql);
			while ($talentname_row = $talentname_res->fetch_assoc()) {
				$talentname = $talentname_row["TalentFirstName"]." ".$talentname_row["TalentLastName"];
			}
			$projectname_sql = "SELECT * FROM `project` WHERE `ProjectUniqueId` = '{$projreq_row["ProjectRequestProjectId"]}'";
			$projectname_res = $conn->query($projectname_sql);
			while ($projectname_row = $projectname_res->fetch_assoc()) {
				$projectname = $projectname_row["ProjectName"];
			}
			$agencyname_sql = "SELECT * FROM `agency` WHERE `UniqueId` = '{$projreq_row["ProjectRequestAgencyId"]}'";
			$agencyname_res = $conn->query($agencyname_sql);
			while ($agencyname_row = $agencyname_res->fetch_assoc()) {
				$agencyname = $agencyname_row["AgencyCorporateName"];
			}


			array_push($projreq, array('id' => $projreq_row["ProjectRequestUniqueId"],
				'status' => $projreq_row["ProjectRequestAcceptedStatus"],
				'projectname' => $projectname,
				'talentname' => $talentname,
				'agencyname' => $agencyname));
		}
		//Send Response with Project Requests
		echo json_encode(array("projreq" => $projreq));

	}//ACCEPT PROJECT REQUESTS
	elseif(isset($_GET['accept_projReq'])){
		//Get input from form
		$id_entry = $conn->real_escape_string($_GET['id']);
		$status_entry = $conn->real_escape_string($_GET['status']);

		$sql = "UPDATE `projectrequest` SET `ProjectRequestAcceptedStatus` = '{$status_entry}'
			WHERE `ProjectRequestUniqueId` = '{$id_entry}'";

		$res = $conn->query($sql);
		echo $res;
	}//REJECT PROJECT REQUESTS
	elseif(isset($_GET['reject_projReq'])){
		//Get input from form
		$id_entry = $conn->real_escape_string($_GET['id']);
		$status_entry = $conn->real_escape_string($_GET['status']);

		$sql = "UPDATE `projectrequest` SET `ProjectRequestAcceptedStatus` = '{$status_entry}'
			WHERE `ProjectRequestUniqueId` = '{$id_entry}'";

		$res = $conn->query($sql);
		echo $res;
	}//GET USER DETAILS
	elseif(isset($_GET['view_prof_details'])){
		//Get input from form
		$id_entry = $conn->real_escape_string($_GET['id']);
		$type_entry = $conn->real_escape_string($_GET['type']);
		if($type_entry == "agency"){
			//Get the Corporate Name of that Agency
			$u_sql = "SELECT * FROM `agency` WHERE `UniqueId` = '{$id_entry}' LIMIT 1";

			//Store User Info Returned
			$user = array();

			//Get User Info
			$res = $conn->query($u_sql);
			while($row = $res->fetch_assoc()) {
				array_push($user, array('aname' => $row["AgencyCorporateName"],
					'email' => $row["Email"],
					'password' => $row["Password"],
					'phone' => $row["Phone"],
					'privacy' => $row["AgencyPrivacyState"],
					'desc' => $row["Summary"],
					'street' => $row["LocationStreet"],
					'city' => $row["LocationCity"],
					'state' => $row["LocationState"],
					'zip' => $row["LocationPostalCode"],
					'country' => $row["LocationCountry"],
					'usertype' => "agency"));
			}
			
		}else{
			//Get the First & Last name of that Talent
			$u_sql = "SELECT * FROM `talent` WHERE `UniqueId` = '{$id_entry}' LIMIT 1";

			//Store User Info Returned
			$user = array();

			//Get User Info
			$res = $conn->query($u_sql);

			while($row = $res->fetch_assoc()) {
				array_push($user, array('fname' => $row["TalentFirstName"],
					'lname' => $row["TalentLastName"],
					'email' => $row["Email"],
					'password' => $row["Password"],
					'phone' => $row["Phone"],
					'desc' => $row["Summary"],
					'street' => $row["LocationStreet"],
					'city' => $row["LocationCity"],
					'state' => $row["LocationState"],
					'zip' => $row["LocationPostalCode"],
					'country' => $row["LocationCountry"],
					'usertype' => "talent"));
			}
		}
		//Send Response with User & Projects
		echo json_encode(array("user" => $user));
	}//VIEW AGENCY PROJECTS
	elseif(isset($_GET['load_agency_projects'])){

		//pull directly from the project table if they're an Agency
		$p_sql = "SELECT * FROM `project` WHERE `ProjectAgencyId` = '{$_GET["id"]}' AND `ProjectPrivacyState` = 'Public' LIMIT 50";

		//Store Projects Returned
		$projects = array();
		$res = $conn->query($p_sql);
		//output data of each record
		while($row = $res->fetch_assoc()) {

			//set default project access as false
			$access = "false";
			$sent = "false";
			$talentAccess_sql = "";
			$talentAccess_res = 0;
			$prSent_sql="";
			$prSent_res=0;

			/*DETERMINE WHETHER OR NOT THIS TALENT OR AGENCY HAS ACCESS TO THIS PROJECT*/
			if($_SESSION["UserType"] == "talent"){
				$talentAccess_sql = "SELECT * FROM `projectrequest` WHERE ((`ProjectRequestTalentId` = '{$_SESSION["Id"]}') AND (`ProjectRequestAcceptedStatus` = 'Accepted') AND (`ProjectRequestRecindedStatus` = 0) AND (`ProjectRequestProjectId` = '{$row["ProjectUniqueId"]}')) LIMIT 1";
				$talentAccess_res = $conn->query($talentAccess_sql);

				$prSent_sql = "SELECT * FROM `projectrequest` WHERE ((`ProjectRequestTalentId` = '{$_SESSION["Id"]}') AND (`ProjectRequestProjectId` = '{$row["ProjectUniqueId"]}')) LIMIT 1";
				$prSent_res = $conn->query($prSent_sql);
			}
			

			if($_SESSION["UserType"] == "agency"){
				if($_SESSION["Id"] == $row["ProjectAgencyId"]){
					$access = "true";
				}
			}else{
				if(count($prSent_res->fetch_assoc()) > 0){
					$sent="true";
					if(count($talentAccess_res->fetch_assoc()) > 0){
						//echo count($talentAccess_res->fetch_assoc());
						$access = "true";
					}
				}
			}


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
				'cost' => $row["ProjectTotalCost"],
				'access' => $access,
				'sent'=>$sent));
		}
		//Send Response with Projects
		echo json_encode(array("projects" => $projects));
	}//VIEW AGENCY PROJECTS
	elseif(isset($_GET['load_talent_projects'])){

		//if they're a Talent, check the project request table for projects they have access to 
		$p_sql = "SELECT * FROM `project` WHERE `ProjectUniqueId` IN (SELECT `ProjectRequestProjectId` FROM `projectrequest` WHERE (`ProjectRequestTalentId` = '{$_GET["id"]}' AND `ProjectRequestAcceptedStatus` = 'Accepted' AND `ProjectRequestRecindedStatus` = 0)) LIMIT 50";

		//Store Projects Returned
		$projects = array();
		$res = $conn->query($p_sql);
		//output data of each record
		while($row = $res->fetch_assoc()) {

			//set default project access as false
			$access = "false";
			$sent = "false";
			$talentAccess_sql = "";
			$talentAccess_res = 0;
			$prSent_sql="";
			$prSent_res=0;

			/*DETERMINE WHETHER OR NOT THIS TALENT OR AGENCY HAS ACCESS TO THIS PROJECT*/
			if($_SESSION["UserType"] == "talent"){
				$talentAccess_sql = "SELECT * FROM `projectrequest` WHERE ((`ProjectRequestTalentId` = '{$_SESSION["Id"]}') AND (`ProjectRequestAcceptedStatus` = 'Accepted') AND (`ProjectRequestRecindedStatus` = 0) AND (`ProjectRequestProjectId` = '{$row["ProjectUniqueId"]}')) LIMIT 1";
				$talentAccess_res = $conn->query($talentAccess_sql);

				$prSent_sql = "SELECT * FROM `projectrequest` WHERE ((`ProjectRequestTalentId` = '{$_SESSION["Id"]}') AND (`ProjectRequestProjectId` = '{$row["ProjectUniqueId"]}')) LIMIT 1";
				$prSent_res = $conn->query($prSent_sql);
			}
			

			if($_SESSION["UserType"] == "agency"){
				if($_SESSION["Id"] == $row["ProjectAgencyId"]){
					$access = "true";
				}
			}else{
				if(count($prSent_res->fetch_assoc()) > 0){
					$sent="true";
					if(count($talentAccess_res->fetch_assoc()) > 0){
						//echo count($talentAccess_res->fetch_assoc());
						$access = "true";
					}
				}
			}


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
				'cost' => $row["ProjectTotalCost"],
				'access' => $access,
				'sent'=>$sent));
		}
		//Send Response with Projects
		echo json_encode(array("projects" => $projects));
	}//GET ALL ACCOMPLISHMENTS FOR THE TALENT
	elseif(isset($_GET['load_talent_acc'])){
		//pull directly from the accomplishments table
		$sql = "SELECT * FROM `accomplishment` WHERE `AccomplishmentTalentId` = '{$_GET["id"]}' LIMIT 50";
		//Store Accomplishments Returned
		$accomplishments = array();
		$res = $conn->query($sql);
		if ($res->num_rows > 0) {
			// output data of each record
			while($row = $res->fetch_assoc()) {
				array_push($accomplishments, array('id' => $row["AccomplishmentUniqueId"],
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
		}
		//Send Response with Accomplishments
		echo json_encode(array("accomplishments" => $accomplishments));
	}


	$conn->close();
	exit();
?>