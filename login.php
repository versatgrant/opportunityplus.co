<html>
	<head>
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/css/styles-large.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php
			require("nav.php");
		?>
		<div class="popup-container" align="center">
		<h1>Sign In</h1>
			<form id="login" action="login.php" method="post">
				<select id="usertype">
					<option value="agency">Agency</option>
  					<option value="talent" selected>Talent</option>
				</select>
				<div class="spacer"></div>
				<input id="email" type="text" name="email" placeholder="Email" required/>
				<input id="password" type="password" name="password" placeholder="Password" required/>
				<input type="submit" id="submit-login"/>
			</form>
			<div id="login-err-msg"></div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="assets/js/login.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>