<html>
	<head>
		<title>Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/css/styles-large.css" rel="stylesheet" type="text/css">
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	</head>
	<body>
		<?php
			require("nav.php");
		?>
		<div class="popup-container" align="center">
			<h1>Sign Up</h1>
			<form id="register" action="registration.php" method="post"> 
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

				<input id="email" type="text" name="email" placeholder="Email" required/>
				<div class="spacer"></div>

				<input id="password" type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
				<div class="spacer"></div>

				<input id="street" type="text" name="street" placeholder="Street" required/>
				<div class="spacer"></div>				

				<input id="city" type="text" name="city" placeholder="City" required/>
				<div class="spacer"></div>

				<select name="state" id="state">
				  <option value="" selected="selected">Select a State</option>
				  <option value="AL">Alabama</option>
				  <option value="AK">Alaska</option>
				  <option value="AZ">Arizona</option>
				  <option value="AR">Arkansas</option>
				  <option value="CA">California</option>
				  <option value="CO">Colorado</option>
				  <option value="CT">Connecticut</option>
				  <option value="DE">Delaware</option>
				  <option value="DC">District Of Columbia</option>
				  <option value="FL">Florida</option>
				  <option value="GA">Georgia</option>
				  <option value="HI">Hawaii</option>
				  <option value="ID">Idaho</option>
				  <option value="IL">Illinois</option>
				  <option value="IN">Indiana</option>
				  <option value="IA">Iowa</option>
				  <option value="KS">Kansas</option>
				  <option value="KY">Kentucky</option>
				  <option value="LA">Louisiana</option>
				  <option value="ME">Maine</option>
				  <option value="MD">Maryland</option>
				  <option value="MA">Massachusetts</option>
				  <option value="MI">Michigan</option>
				  <option value="MN">Minnesota</option>
				  <option value="MS">Mississippi</option>
				  <option value="MO">Missouri</option>
				  <option value="MT">Montana</option>
				  <option value="NE">Nebraska</option>
				  <option value="NV">Nevada</option>
				  <option value="NH">New Hampshire</option>
				  <option value="NJ">New Jersey</option>
				  <option value="NM">New Mexico</option>
				  <option value="NY">New York</option>
				  <option value="NC">North Carolina</option>
				  <option value="ND">North Dakota</option>
				  <option value="OH">Ohio</option>
				  <option value="OK">Oklahoma</option>
				  <option value="OR">Oregon</option>
				  <option value="PA">Pennsylvania</option>
				  <option value="RI">Rhode Island</option>
				  <option value="SC">South Carolina</option>
				  <option value="SD">South Dakota</option>
				  <option value="TN">Tennessee</option>
				  <option value="TX">Texas</option>
				  <option value="UT">Utah</option>
				  <option value="VT">Vermont</option>
				  <option value="VA">Virginia</option>
				  <option value="WA">Washington</option>
				  <option value="WV">West Virginia</option>
				  <option value="WI">Wisconsin</option>
				  <option value="WY">Wyoming</option>
				</select>

				<input id="zip" type="text" name="zip" placeholder="Zip/Postal Code" pattern="[0-9]{5}" title="Five digit zip code" required/>
				<div class="spacer"></div>

				<input id="country" type="text" name="country" placeholder="Country" required/>
				<div class="spacer"></div>

				<input type="submit" id="submit-reg"/>
			</form>
			<div id="login-err-msg"></div>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="assets/js/registration.js"></script>
	</body>
</html>