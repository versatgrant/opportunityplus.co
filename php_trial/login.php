<html>
	<head>
		<title>Page Title</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/css/styles-large.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="popup-container" align="center">
		<h1>Login Page</h1>
			<form id="login" action="login.php" method="post">
				<label for="email">Email</label>
				<input id="email" type="text" name="email" placeholder="email" required/>
				<label for="password">Password</label>
				<input id="password" type="password" name="password" placeholder="password" required/>
				<input type="submit" id="submit-login"/>
			</form>
			<button id="submit-logout">Logout</button>
			<div id="login-err-msg"></div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="assets/js/login.js"></script>
		<script src="assets/js/logout.js"></script>
	</body>
</html>