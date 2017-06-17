<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/lumen/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/user.css">
	<link rel="stylesheet" href="assets/css/Navigation-with-Button1.css">
	<link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
	<link rel="stylesheet" href="assets/css/login/loginModal.css">

</head>
<body>
	<!--NAVIGATION BAR-->
	<div>
		<nav class="navbar navbar-default navigation-clean-button">
			<div class="container">
				<div class="navbar-header"><a class="navbar-brand navbar-link" href="index.php" style="color:#4e8ce5;">Opportunity+ </a>
					<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				</div>
				<div class="collapse navbar-collapse" id="navcol-1">
					<ul class="nav navbar-nav">
						<li role="presentation"><a href="index.php">Home</a></li>
						<!--li role="presentation"><a href="about.php">About</a></li-->
					</ul>
					<p class="navbar-text navbar-right actions"><a id="sign-in-nav" class="navbar-link login" data-toggle="modal" href="#loginModal">Sign In</a> <a id="sign-up-nav" class="btn btn-default action-button" data-toggle="modal" role="button" href="#regModal" style="background-color:#d63a39;margin:5px;">Sign Up</a></p>
				</div>
			</div>
		</nav>
	</div>

	<!--LOGIN FORM-->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1>Login to Your Account</h1><br>
				<form id="login" name="login">
					<!--USER TYPE-->
					<div class="btn-group-justified" id="status1" data-toggle="buttons" style="max-width: 70%; margin: 10px auto;">
		              <label class="btn btn-default btn-on active" style="border-radius: 0px; border-width: 0px">
		              <input type="radio" value="talent" name="usertype-login" checked="checked">Talent</label>
		              <label class="btn btn-default btn-off" style="border-radius: 0px; border-width: 0px">
		              <input type="radio" value="agency" name="usertype-login" required/>Agency</label>
		            </div>
					<input id="email-login" type="text" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Must be an email address"/>
					<input id="password-login" type="password" name="pass" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
					<input type="submit" name="login" id="submit-login" class="login loginmodal-submit" value="Login">
				</form>
				<div id="login-err-msg" style="color:red;text-align: center;"></div>
				<div class="login-help">
					<a href="#">Forgot Password?</a>
				</div>
			</div>
		</div>
	</div>

	<!--REGISTRATION FORM-->
	<div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1>Register for a Free Account</h1><br>
				<form id="register" action="index.php" name="register">
					<!--USER TYPE-->
					<div class="btn-group-justified" id="status" data-toggle="buttons" style="max-width: 70%; margin: 10px auto;">
		              <label class="btn btn-default btn-on active" style="border-radius: 0px; border-width: 0px">
		              <input type="radio" value="talent" name="usertype-register" checked="checked">Talent</label>
		              <label class="btn btn-default btn-off" style="border-radius: 0px; border-width: 0px">
		              <input type="radio" value="agency" name="usertype-register">Agency</label>
		            </div>

				<!--AGENCY TYPE-->
				<div class="onoffswitch form-agency" style="margin: auto;">
				    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
				    <label class="onoffswitch-label" for="myonoffswitch">
				        <span class="onoffswitch-inner"></span>
				        <span class="onoffswitch-switch"></span>
				    </label>
				</div>

				<!--USER NAMES-->
				<input id="fname" class="form-talent" type="text" name="fname" placeholder="First Name" required/>
				<input id="lname" class="form-talent" type="text" name="lname" placeholder="Last Name" required/>
				<input id="corpname" class="form-agency" type="text" name="" placeholder="Company Name" required/>

				<input id="phone" type="text" name="phone" placeholder="Phone" pattern="\d{3}[\-]\d{3}[\-]\d{4}" title="123-456-7890" required/>

				<input id="email-register" type="text" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Must be an email address" required/>

				<input id="password-register" type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>

				<input id="street" type="text" name="street" placeholder="Street" required/>			

				<input id="city" type="text" name="city" placeholder="City" required/>

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

				<input id="country" type="text" name="country" placeholder="Country" required/>

				<input type="submit" name="login" id="submit-reg" class="login loginmodal-submit" value="Register">
				</form>
				<div id="reg-err-msg" style="color:red;text-align: center;"></div>
			</div>
		</div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/login.js"></script>
	<script src="assets/js/registration.js"></script>
</body>
</html>