<html>
<head>
	<title>Opportunity+ - User View</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/lumen/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-drawer/1.0.6/css/bootstrap-drawer.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/user-mode.css">
	<link rel="stylesheet" href="assets/css/login/loginModal.css">
</head>
<body class="has-drawer">
	<!-- FLOATING BUTTONS -->
	<button id="submit-logout" type="button" class="btn btn-primary btn-sm btn-circle pull-right" style="z-index: 500;position:fixed;top: 10px;right:10px; display: block;"><i class="glyphicon glyphicon-log-out"></i></button>
	<a href="#createProjectModal" data-toggle="modal"><button type="button" class="btn btn-primary btn-sm btn-circle pull-right" style="z-index: 500;position:fixed;top: 45px;right:10px; display: block;"><i class="glyphicon glyphicon-plus"></i></button></a>

	<!-- MENU DRAWER -->
	<div id="drawerExample" class="dw-xs-10 dw-sm-6 dw-md-4 fold" aria-labelledby="drawerExample" style="position:fixed;z-index: 500;height: 100%">
		<div class="drawer-controls">
			<a href="#drawerExample" id="menu-button" data-toggle="drawer" aria-foldedopen="false" aria-controls="drawerExample" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-menu-hamburger"></span></a>
		</div>
		<div class="drawer-contents" style="z-index: 1000">
			<div class="drawer-heading">
				<h2 id="username" class="drawer-title">User Name</h2>
			</div>
			<div class="drawer-body">
				<p id="user-desc">
					This is a properly padded container for content in the
					drawer that isn't a navigation.
				</p>
				<!--a href="#">A Regular Link</a-->
			</div>
			<!--SEARCH BAR-->
			<div class="fluid-container" style="margin:0px auto;">
				<div class="row" style="margin:0px auto;">    
					<div class="col-xs-12">
						<div class="input-group">
							<div class="input-group-btn search-panel">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search_concept">Agency</span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#agency">Agency</a></li>
									<li><a href="#talent">Talent</a></li>
									<li><a href="#project">Project</a></li>
								</ul>
							</div>
							<input type="hidden" name="search_param" value="agency" id="search_param">         
							<input id="search-value" type="text" class="form-control" name="x" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" id="submit-search" type="button"><span class="glyphicon glyphicon-search"></span></button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!--MENU OPTIONS-->
			<ul class="drawer-nav">
				<li role="presentation"><a href="user-mode.php">My Projects</a></li>
				<li role="presentation"><a href="#">Project Requests</a></li>
				<li role="presentation"><a href="#">My Profile</a></li>
				<li role="presentation"><a href="#">My Accomplishments</a></li>
			</ul>

			<div class="drawer-footer">
				<small>&copy; Opportunity+</small>
			</div>
		</div>
	</div>

	<!--RESULT CONTAINER-->
	<div class="container" style="position:absolute;top:0px;z-index:499;width:100%;padding:10px 15px;">
		<div class="row fix results" id="result-list" style="padding:0px 40px;">
			<div class="col-md-3 col-sm-4">
				<div class="wrimagecard wrimagecard-topimage">
					<a href="#">
						<div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">
							<center><i class="fa fa-tasks" style="color:#16A085"></i></center>
						</div>
						<div class="wrimagecard-topimage_title">
							<h4>Project
							<div class="pull-right badge Public">Public</div></h4>
							<h6>City, State, Zip, Country</h6>
							<h6>Lorem ipsum dolor sit amet, paulo quaeque civibus et his, mea decore philosophia in. Elitr dissentias u...</h6>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-4">
				<div class="wrimagecard wrimagecard-topimage">
					<a href="#">
						<div class="wrimagecard-topimage_header" style="background-color: rgba(51, 105, 232, 0.1)">
							<center><i class = "fa fa-user" style="color:#3369e8"></i></center>
						</div>
						<div class="wrimagecard-topimage_title">
							<h4>Talent Name</h4>
							<h6>City, State, Zip, Country</h6>
							<h6>Lorem ipsum dolor sit amet, paulo quaeque civibus et his, mea decore philosophia in. Elitr dissentias u...</h6>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-4">
				<div class="wrimagecard wrimagecard-topimage">
					<a href="#">
						<div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1)">
							<center><i class="fa fa-building" style="color:#d50f25"> </i></center>
						</div>
						<div class="wrimagecard-topimage_title" >
							<h4>Agency Name
							<div class="pull-right badge private">Private</div></h4>
							<h6>City, State, Zip, Country</h6>
							<h6>Lorem ipsum dolor sit amet, paulo quaeque civibus et his, mea decore philosophia in. Elitr dissentias u...</h6>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-4">
				<div class="wrimagecard wrimagecard-topimage">
					<a href="https://google.com">
						<div class="wrimagecard-topimage_header" style="background-color:  rgba(250, 188, 9, 0.1)">
							<center><i class="fa fa-trophy" style="color:#fabc09"> </i></center>
						</div>
						<div class="wrimagecard-topimage_title">
							<h4>Accomplishment
							<div class="pull-right badge">Certification</div></h4>
							<h6>Lorem ipsum dolor sit amet, paulo quaeque civibus et his, mea decore philosophia in. Elitr dissentias u...
							<div class="pull-right badge"></div></h6>
							<a href="https://google.com" target="_blank">Link</a>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>


	<!--NEW PROJECT FORM-->
	<div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1>New Project</h1><br>
				<form id="createProject" name="createProject">
					<!--USER TYPE-->
					<div class="btn-group-justified" id="status1" data-toggle="buttons" style="max-width: 70%; margin: 10px auto;">
		              <label class="btn btn-default btn-on active" style="border-radius: 0px; border-width: 0px">
		              <input type="radio" value="talent" name="usertype-login" checked="checked">Talent</label>
		              <label class="btn btn-default btn-off" style="border-radius: 0px; border-width: 0px">
		              <input type="radio" value="agency" name="usertype-login" required/>Agency</label>
		            </div>
					<input id="email-login" type="text" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Must be an email address" required/>
					<input id="password-login" type="password" name="pass" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
					<input type="submit" name="login" id="submit-login" class="login loginmodal-submit" value="Login">
				</form>
				<div id="login-err-msg" style="color:red;text-align: center;"></div>
				<div class="login-help">
					<a href="#">Forgot Password?</a>
				</div>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-drawer/1.0.6/js/drawer.min.js"></script>
	<script src="assets/js/user-mode.js"></script>
	<script src="assets/js/search.js"></script>
	<script src="assets/js/logout.js"></script>
</body>
</html>