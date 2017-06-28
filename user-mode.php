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
	<a id="newPA" href="#" data-toggle="modal"><button type="button" class="btn btn-primary btn-sm btn-circle pull-right" style="z-index: 500;position:fixed;top: 45px;right:10px; display: block;"><i class="glyphicon glyphicon-plus"></i></button></a>

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
				<li id="menuProj" role="presentation"><a href="user-mode.php">My Projects</a></li>
				<li id="menuProjReq" role="presentation"><a href="#">Project Requests</a></li>
				<li id="menuProf" role="presentation"><a href="#">My Profile</a></li>
				<li id="menuAcc" role="presentation"><a href="#">My Accomplishments</a></li>
			</ul>

			<div class="drawer-footer">
				<small>&copy; Opportunity+</small>
			</div>
		</div>
	</div>

	<!--RESULT CONTAINER-->
	<div class="container" style="position:absolute;top:0px;z-index:499;width:100%;padding:10px 15px;">
		<div class="row fix results" id="result-list" style="padding:0px 40px;">
			<div class="col-md-3 col-sm-4 parProject" id="sampleProject">
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
			<div class="col-md-3 col-sm-4 parTalent" id="sampleTalent">
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
			<div class="col-md-3 col-sm-4 parAgency" id="sampleAgency">
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
			<div class="col-md-3 col-sm-4 parAccomp" id="sampleAccomplishment">
				<div class="wrimagecard wrimagecard-topimage">
					<div class="toolbar">
						<a href="#accomplishment" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
					<a href="https://bing.com" target="_blank">
						<div class="wrimagecard-topimage_header" style="background-color:  rgba(250, 188, 9, 0.1)">
							<center><i class="fa fa-trophy" style="color:#fabc09"> </i></center>
						</div>
						<div class="wrimagecard-topimage_title">
							<h4>Accomplishment
							<div class="pull-right badge">Certification</div></h4>
							<h6>Lorem ipsum dolor sit amet, paulo quaeque civibus et his, mea decore philosophia in. Elitr dissentias u...
							<div class="pull-right badge"></div></h6>
							<a href="https://google.com" target="_blank">Edit</a>
							<span>|</span>
							<a href="https://google.com" target="_blank">Link</a>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>


	<!--NEW PROJECT FORM-->
	<div class="modal fade" id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1>Start A New Project</h1>
				<form id="newProject" name="newProject">
					<!--PROJECT PRIVACY STATE-->
					<div class="onoffswitch" style="margin:auto;">
					    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
					    <label class="onoffswitch-label" for="myonoffswitch">
					        <span class="onoffswitch-inner"></span>
					        <span class="onoffswitch-switch"></span>
					    </label>
					</div>

		            <!--PROJECT NAME-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="project-name" type="text" name="projectName" placeholder="Project Name *" title="Project Name" required/>
					</div>

					<!--START/END DATES-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Start Date *</label>
						<input id="project-startdate" type="date" name="projectStartDate" placeholder="MM/DD/YYYY" title="Start Date" required/>
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>End Date</label>
						<input id="project-enddate" type="date" name="projectEndDate" placeholder="MM/DD/YYYY" title="End Date"/>
					</div>

					<!--LOCATION SENSITIVITY-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<select name="location-sensitive" id="location-sensitive">
							<option value="None" selected="selected">Location Sensitive?</option>
							<option value="None">None</option>
							<option value="City">City</option>
							<option value="State">State</option>
							<option value="ZIP">ZIP</option>
							<option value="Country">Country</option>
						</select>
					</div>

					<!--ADDRESS-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="street" type="text" name="street" placeholder="Street" />			
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="city" type="text" name="city" placeholder="City"/>
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
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
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="zip" type="text" name="zip" placeholder="Zip/Postal Code" pattern="[0-9]{5}" title="Five digit zip code" />
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="country" type="text" name="country" placeholder="Country"/>
					</div>

					<!--PROJECT DESCRIPTION-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<textarea id="project-desc" name="projectDescription" placeholder="Project Description" title="Project Description" maxlength="2000"></textarea>
					</div>

					<!--SUBMIT-->
					<input type="submit" name="newProject" id="submit-newproject" class="login loginmodal-submit" value="New Project">
				</form>
				<div id="login-err-msg" style="color:red;text-align: center;"></div>
			</div>
		</div>
	</div>

	<!--NEW ACCOMPLISHMENT FORM-->
	<div class="modal fade" id="newAccomplishmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1>Share A New Accomplishment</h1>
				<form id="newAccomplishment" name="newAccomplishment">

					<!--ACCOMPLISHMENT TYPE-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<select name="acc-type" id="acc-type" required>
							<option value="" selected="selected">Accomplishment Type</option>
							<option value="Certification">Certification</option>
							<option value="Course">Course</option>
							<option value="Honor/Award">Honor/Award</option>
							<option value="Language">Language</option>
							<option value="Patent">Patent</option>
							<option value="Project">Project</option>
							<option value="Publication">Publication</option>
						</select>
					</div>

		            <!--ACCOMPLISHMENT NAME-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="acc-name" type="text" name="accName" placeholder="Accomplishment Title *" title="Accomplishment Title" required/>
					</div>

					<!--FROM DATE-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>From:</label>
						<input id="acc-fromdate" type="date" name="accFromDate" placeholder="MM/DD/YYYY" title="Date (From)"/>
					</div>
					<!--TO DATE-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>To:</label>
						<input id="acc-todate" type="date" name="accToDate" placeholder="MM/DD/YYYY" title="Date (To)"/>
					</div>
					<!--ON DATE-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>On:</label>
						<input id="acc-ondate" type="date" name="accOnDate" placeholder="MM/DD/YYYY" title="Date (On)"/>
					</div>

					<!--URL-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="acc-url" type="url" pattern="https?://.+" title="Must start with either http:// or https://" name="acc-url" placeholder="Accomplishment Web Link/URL" />			
					</div>

					<!--ACCOMPLISHMENT LICENSE AGENCY-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="acc-la" type="text" name="accLA" placeholder="License Agency"/>
					</div>

					<!--ACCOMPLISHMENT LICENSE NUMBER-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="acc-ln" type="text" name="accLN" placeholder="License Number"/>
					</div>

					<!--ACCOMPLISHMENT DESCRIPTION-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<textarea id="acc-desc" name="accDescription" placeholder="Accomplishment Description" title="Accomplishment Description" maxlength="2000"></textarea>
					</div>

					<!--SUBMIT-->
					<input type="submit" name="newAccomplishment" id="submit-newacc" class="login loginmodal-submit" value="New Accomplishment">
				</form>
				<div id="login-err-msg" style="color:red;text-align: center;"></div>
			</div>
		</div>
	</div>

	
</body>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-drawer/1.0.6/js/drawer.min.js"></script>
	<script src="assets/js/user-mode.js"></script>
	<script src="assets/js/search.js"></script>
	<script src="assets/js/logout.js"></script>

</html>