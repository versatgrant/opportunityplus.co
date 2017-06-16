<?php
	//connect to database
	require("assets/db/db.php");

	//check if there's a user already logged in
	if(isset($_SESSION["Id"])){
		echo json_encode(array("loggedin" => true));
	}

	if(isset($_POST['done_reg'])) {
		//Get input from form
		$email_entry = $conn->real_escape_string($_POST['email']);
		$pass_entry = $conn->real_escape_string($_POST['pass']);
		$fname_entry = $conn->real_escape_string($_POST['fname']);
		$lname_entry = $conn->real_escape_string($_POST['lname']);
		$usertype_entry = $conn->real_escape_string($_POST['usertype']);
		$agencytype_entry = $conn->real_escape_string($_POST['agencytype']);
		$corpname_entry = $conn->real_escape_string($_POST['corpname']);
		$phone_entry = $conn->real_escape_string($_POST['phone']);
		$street_entry = $conn->real_escape_string($_POST['street']);
		$city_entry = $conn->real_escape_string($_POST['city']);
		$state_entry = $conn->real_escape_string($_POST['state']);
		$zip_entry = $conn->real_escape_string($_POST['zip']);
		$country_entry = $conn->real_escape_string($_POST['country']);

		//check if a user already exists with that email
		if($usertype_entry == "agency"){
			$sql = "SELECT * FROM `agency` WHERE `Email` = '{$email_entry}'";
		}else{
			$sql = "SELECT * FROM `talent` WHERE `Email` = '{$email_entry}'";
		}
		
		$res = $conn->query($sql);
		//if a user is already registered with this email
		if ($res->num_rows > 0) {
			echo "User Already Exists";
		}else{
			//Insert user into DB in their appropriate table
			if($usertype_entry == "agency"){
				$sql = "INSERT INTO `agency` (`AgencyCorporateName`, `Email`, `Password`, `Phone`, `AgencyPrivacyState`, `LocationStreet`, `LocationCity`, `LocationState`, `LocationPostalCode`, `LocationCountry`) 
							VALUES ('{$corpname_entry}', '{$email_entry}', '{$pass_entry}', '{$phone_entry}', '{$agencytype_entry}', '{$street_entry}', '{$city_entry}', '{$state_entry}', '{$zip_entry}', '{$country_entry}')";
			}else{
				$sql = "INSERT INTO `talent` (`TalentFirstName`, `TalentLastName`, `Email`, `Password`, `Phone`, `LocationStreet`, `LocationCity`, `LocationState`, `LocationPostalCode`, `LocationCountry`) 
							VALUES ('{$fname_entry}', '{$lname_entry}', '{$email_entry}', '{$pass_entry}', '{$phone_entry}', '{$street_entry}', '{$city_entry}', '{$state_entry}', '{$zip_entry}', '{$country_entry}')";
			}
			

			$res = $conn->query($sql);

			if ($res){
				echo TRUE;
			}else{
				echo FALSE;
			}
		}
	}
	
	$conn->close();
		exit();
?>