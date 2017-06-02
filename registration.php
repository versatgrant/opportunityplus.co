<html>
	<head>
		<title>Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/css/styles-large.css" rel="stylesheet" type="text/css">
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="popup-container" align="center">
		<h1>Register</h1>
			<form id="register" action="registration.php" method="post">
				<label>User Type:</label> 
				<select id="usertype">
					<option value="agency">Agency</option>
  					<option value="talent" selected>Talent</option>
				</select>
				<div class="spacer"></div>

				<input id="private-agency" class="form-agency" type="radio" name="agencyPrivacyState" value="private"/>
				<label class="form-agency" for="private-agency">Private</label>
				<input id="public-agency" class="form-agency" type="radio" name="agencyPrivacyState" value="public" checked />
				<label class="form-agency" for="public-agency">Public</label>
				<div class="spacer"></div>

				<input id="fname" class="form-talent" type="text" name="fname" placeholder="First Name" required/>
				<div class="spacer"></div>

				<input id="lname" class="form-talent" type="text" name="lname" placeholder="Last Name" required/>
				<div class="spacer"></div>

				<input id="corpname" class="form-agency" type="text" name="" placeholder="Company Name" required/>
				<div class="spacer"></div>

				<input id="phone" type="text" name="phone" placeholder="Phone" required/>
				<div class="spacer"></div>

				<input id="email" type="text" name="email" placeholder="email" required/>
				<div class="spacer"></div>

				<input id="password" type="password" name="password" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
				<div class="spacer"></div>

				<input id="street" type="text" name="street" placeholder="Street" required/>
				<div class="spacer"></div>

				<input id="city" type="text" name="city" placeholder="City" required/>
				<div class="spacer"></div>

				<input id="zip" type="text" name="zip" placeholder="Zip/Postal Code" pattern="[0-9]{5}" title="Five digit zip code" required/>
				<div class="spacer"></div>

				<input type="submit" id="submit-reg"/>
			</form>
			<button id="submit-logout">Logout</button>
			<div id="login-err-msg"></div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
		<script src="assets/js/registration.js"></script>
		<script src="assets/js/logout.js"></script>
	</body>
</html>