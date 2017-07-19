<?php
	//connect to database
	require("assets/db/db.php");

	if(isset($_POST['done_search'])){
		$table_entry = $conn->real_escape_string($_POST['table']);
		$term_entry = $conn->real_escape_string($_POST['term']);

		//echo json_encode(array("result" => "No Users Detected"));
	}

	if($table_entry == "agency"){
		$sql = "SELECT * FROM `agency` WHERE (`AgencyCorporateName` LIKE '%{$term_entry}%' AND `AgencyPrivacyState` = 'Public')";
	}elseif ($table_entry== "talent") {
		$sql = "SELECT * FROM `talent` WHERE ((`TalentFirstName` LIKE '%{$term_entry}%') OR (`TalentLastName` LIKE '%{$term_entry}%'))";
	}else{
		$sql = "SELECT * FROM `project` WHERE (((`ProjectName` LIKE '%{$term_entry}%') OR (`ProjectDescription` LIKE '%{$term_entry}%')) AND `ProjectPrivacyState` = 'Public' AND `ProjectActiveState` = 'Active')";
	}

	$res = $conn->query($sql);

	if ($res->num_rows > 0) {
		// output data of each record
		if($table_entry == "agency"){
			$agencies = array();
			while($row = $res->fetch_assoc()) {
				array_push($agencies, array('id' => $row["UniqueId"], 
					'aname' => $row["AgencyCorporateName"],
					'email' => $row["Email"],
					'pass' => $row["Password"],
					'phone' => $row["Phone"],
					'privacy' => $row["AgencyPrivacyState"],
					'desc' => $row["Summary"],
					'street' => $row["LocationStreet"],
					'city' => $row["LocationCity"],
					'state' => $row["LocationState"],
					'zip' => $row["LocationPostalCode"],
					'country' => $row["LocationCountry"]));
			}
			echo json_encode(array("agencies" => $agencies));
		}elseif ($table_entry== "talent") {
			$talents = array();
			while($row = $res->fetch_assoc()) {
				array_push($talents, array('id' => $row["UniqueId"], 
					'fname' => $row["TalentFirstName"],
					'lname' => $row["TalentLastName"],
					'email' => $row["Email"],
					'pass' => $row["Password"],
					'phone' => $row["Phone"],
					'desc' => $row["Summary"],
					'street' => $row["LocationStreet"],
					'city' => $row["LocationCity"],
					'state' => $row["LocationState"],
					'zip' => $row["LocationPostalCode"],
					'country' => $row["LocationCountry"]));
			}
			echo json_encode(array("talents" => $talents));
		}else{
			$projects = array();
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
					'pagency' => $row["ProjectAgencyId"],
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
			echo json_encode(array("projects" => $projects));
		}
	}else{
		echo json_encode(array("error" => "No Results"));
	}

	$conn->close();
	exit();
?>