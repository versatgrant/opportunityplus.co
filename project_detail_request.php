<?php
	//connect to database
	require("assets/db/db.php");

	if(!isset($_SESSION["Id"])){
		echo json_encode(array("user" => "No Users Detected"));
	}/*PROJECT DETAIL*/
	elseif(isset($_GET["view_proj_detail"])){
		//get Project Id
		$id_entry = $conn->real_escape_string($_GET['id']);

		//get the Project, its Milestones, and the Tasks of those Milestones
		$p_sql = "SELECT * FROM `project` WHERE `ProjectUniqueId` = '{$id_entry}'";
		$m_sql = "SELECT * FROM `milestone` WHERE `MilestoneProjectId` = '{$id_entry}'";

		//Instantiate Variables to store the data
		$project = array();
		$milestone = array();
		$tasks = array();

		//Get Project Info
		$p_res = $conn->query($p_sql);
		while($row = $p_res->fetch_assoc()) {
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

		$m_sql = "SELECT * FROM `milestone` WHERE `MilestoneProjectId` = '{$id_entry}' ORDER BY `MilestoneOrderPosition`";
		//Get Milestone Info
		$m_res = $conn->query($m_sql);
		while($m_row = $m_res->fetch_assoc()) {

			/*FOR EACH MILESTONE, GET ITS ARRAY OF TASKS*/

			$t_sql = "SELECT * FROM `task` WHERE `TaskMilestoneId` = '{$m_row["MilestoneUniqueId"]}'";
			$t_res = $conn->query($t_sql);
			while($t_row = $t_res->fetch_assoc()) {

				/*GET THE NAME OF THE ASSIGNED TALENT*/
				$tal_sql = "SELECT `TalentFirstName`, `TalentLastName` FROM `talent` WHERE `UniqueId` = '{$t_row["TaskAssignedTalentId"]}'";
				$tal_res = $conn->query($tal_sql);
				while($tal_row = $tal_res->fetch_assoc()){
					$tal_fname = $tal_row["TalentFirstName"];
					$tal_lname = $tal_row["TalentLastName"];
				}

				array_push($tasks, array('id' => $t_row["TaskUniqueId"],
					'milestone' => $t_row["TaskMilestoneId"],
					'talid' => $t_row["TaskAssignedTalentId"],
					'name' => $t_row["TaskName"],
					'desc' => $t_row["TaskDescription"],
					'pay' => $t_row["TaskFinalPayAmount"],
					'completed' => $t_row["TaskCompletionState"],
					'talentfname' => $tal_fname,
					'talentlname' => $tal_lname));
			}

			/**/
			array_push($milestone, array('id' => $m_row["MilestoneUniqueId"],
				'projectid' => $m_row["MilestoneProjectId"],
				'name' => $m_row["MilestoneName"],
				'pos' => $m_row["MilestoneOrderPosition"],
				'start' => $m_row["MilestoneStartDate"],
				'end' => $m_row["MilestoneEndDate"],
				'tasks' => $tasks));
		}
		echo json_encode(array("project" => $project, "milestone" => $milestone));

	}/*NEW MILESTONE*/
	elseif(isset($_POST["new_milestone"])){
		/*Get values from form*/
		$projectid_entry = $conn->real_escape_string($_POST['projectid']);
		$name_entry = $conn->real_escape_string($_POST['name']);
		$start_entry = $conn->real_escape_string($_POST['start']);
		$end_entry = $conn->real_escape_string($_POST['end']);
		$pos_entry = $conn->real_escape_string($_POST['pos']);

		/*Insert that Milestone*/
		$m_sql = "INSERT INTO `milestone` (`MilestoneProjectId`, `MilestoneName`, `MilestoneOrderPosition`, `MilestoneStartDate`, `MilestoneEndDate`) VALUES ('{$projectid_entry}', '{$name_entry}', '{$pos_entry}', '{$start_entry}', '{$end_entry}')";
		$newMilestone = $conn->query($m_sql);
		if($newMilestone){
			/*Get The Milestone You Just Inserted*/
			$id = $conn->insert_id;
			$m_sql = "SELECT * FROM `milestone` WHERE `MilestoneUniqueId` = '{$id}'";
			$milestone = array();
			$m_res = $conn->query($m_sql);
			/*New Milestones Have No Task*/
			$tasks = array();
			while($m_row = $m_res->fetch_assoc()) {
				array_push($milestone, array('id' => $m_row["MilestoneUniqueId"],
					'projectid' => $m_row["MilestoneProjectId"],
					'name' => $m_row["MilestoneName"],
					'pos' => $m_row["MilestoneOrderPosition"],
					'start' => $m_row["MilestoneStartDate"],
					'end' => $m_row["MilestoneEndDate"],
					'tasks' => $tasks));
			}
			echo json_encode(array("milestone" => $milestone));
		}
	}/*GET MILESTONE INFO*/
	elseif(isset($_GET["get_milestone"])){
		/*MILESTONE INFO*/
		$id_entry = $conn->real_escape_string($_GET['id']);

		/*GET MILESTONE*/
		$m_sql = "SELECT * FROM `milestone` WHERE (`MilestoneUniqueId` = '{$id_entry}')";
		$milestone = array();
		$m_res = $conn->query($m_sql);
		while($m_row = $m_res->fetch_assoc()) {
			array_push($milestone, array('id' => $m_row["MilestoneUniqueId"],
				'projectid' => $m_row["MilestoneProjectId"],
				'name' => $m_row["MilestoneName"],
				'pos' => $m_row["MilestoneOrderPosition"],
				'start' => $m_row["MilestoneStartDate"],
				'end' => $m_row["MilestoneEndDate"]));
		}
		echo json_encode(array("milestone" => $milestone));
	}/*UPDATE MILESTONE*/
	elseif(isset($_POST["edit_milestone"])){
		/*Get values from form*/
		$id_entry = $conn->real_escape_string($_POST['id']);
		$name_entry = $conn->real_escape_string($_POST['name']);
		$start_entry = $conn->real_escape_string($_POST['start']);
		$end_entry = $conn->real_escape_string($_POST['end']);
		$pos_entry = $conn->real_escape_string($_POST['pos']);

		$m_sql = "UPDATE `milestone` SET `MilestoneName` = '{$name_entry}', 
			`MilestoneOrderPosition` = '{$pos_entry}', 
			`MilestoneStartDate` = '{$start_entry}', 
			`MilestoneEndDate` = '{$end_entry}'
			WHERE `MilestoneUniqueId` = '{$id_entry}' LIMIT 1";
		$milestone = array();
		$m_res = $conn->query($m_sql);

		echo $m_res;
	}

	$conn->close();
	exit();
?>