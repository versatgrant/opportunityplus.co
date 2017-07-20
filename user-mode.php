<!DOCTYPE html>
<html>
<head>
	<title>Opportunity+ - User View</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/lumen/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-drawer/1.0.6/css/bootstrap-drawer.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/user-mode.css">
	<link rel="stylesheet" href="assets/css/login/loginModal.css">
	<link href="assets/css/kanbanstyle.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
</head>
<body class="has-drawer">
	<!-- FLOATING BUTTONS -->
	<button id="submit-logout" type="button" class="btn btn-primary btn-sm btn-circle pull-right" style="z-index: 500;position:fixed;top: 10px;right:10px; display: block;"><i class="glyphicon glyphicon-log-out"></i></button>
	<a id="newPA" href="#" data-toggle="modal"><button type="button" class="btn btn-primary btn-sm btn-circle pull-right" style="z-index: 500;position:fixed;top: 45px;right:10px; display: block;"><i class="glyphicon glyphicon-plus"></i></button></a>
	</button>
	<a id="newMilestone" href="#newMilestoneModal" data-toggle="modal"><button type="button" class="btn btn-primary btn-sm btn-circle pull-right" style="z-index: 500;position:fixed;top: 45px;right:10px; display: block;"><i class="glyphicon glyphicon-plus"></i></button></a>
	</button>
	<a id="viewProjDetails" href="#projectDetailModal" data-toggle="modal"><button type="button" class="btn btn-primary btn-sm btn-circle pull-right" style="z-index: 500;position:absolute;top: 80px;right:10px; display: block;"><i class="glyphicon glyphicon-eye-open"></i></button></a>

	<!-- MENU DRAWER -->
	<div id="drawerExample" class="dw-xs-10 dw-sm-6 dw-md-4 fold" aria-labelledby="drawerExample" style="position:fixed;z-index: 500;height: 100%">
		<div class="drawer-controls">
			<a href="#drawerExample" id="menu-button" data-toggle="drawer" aria-foldedopen="false" aria-controls="drawerExample" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-menu-hamburger"></span></a>
		</div>
		<div class="drawer-contents" style="z-index: 1000">
			<div class="drawer-heading">
				<h2 id="username" class="drawer-title">User Name</h2>
				<a id="editProf" href="#editProfileModal" data-toggle="modal" style="color:black">Edit Profile <span class="glyphicon glyphicon-pencil"></span></a>
			</div>
			<div class="drawer-body">
				<p id="user-desc">
					This is a properly padded container for content in the
					drawer that isn't a navigation.
				</p>
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
			<ul id="menuDrawerNav" class="drawer-nav">
				<li id="menuProj" role="presentation" class="active"><a href="#project">My Projects</a></li>
				<li id="menuProjReq" role="presentation"><a href="#projectrequest">Project Requests</a></li>
				<li id="menuAcc" role="presentation"><a href="#accomplishment">My Accomplishments</a></li>
			</ul>

			<div class="drawer-footer">
				<small>&copy; Opportunity+</small>
			</div>
		</div>
	</div>

	<!--RESULT CONTAINER-->
	<div class="container" style="position:absolute;top:0px;z-index:499;width:100%;padding:10px 15px;height: inherit;">
		<div class="row fix results" id="result-list" style="padding:0px 40px;height: inherit;overflow-y: auto">
			<!--div class="col-md-3 col-sm-4 parProject" id="sampleProject">
				<div class="wrimagecard wrimagecard-topimage">
					<div class="toolbar">
						<a href="#accomplishment" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
					<a href="#">
						<div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">
							<center><i class="fa fa-tasks" style="color:#16A085"></i></center>
						</div>
						<div class="wrimagecard-topimage_title">
							<h4>Project
							<div class="pull-right badge Public">Public</div></h4>
							<h6>City, State, Zip, Country</h6>
							<h6>Lorem ipsum dolor sit amet, paulo quaeque civibus et his, mea decore philosophia in. Elitr dissentias u...</h6>
							<a href="https://google.com" target="_blank" style="text-decoration: underline;">Edit</a>
							<span>|</span>
							<a href="https://google.com" target="_blank" style="text-decoration: underline;">Project Request</a>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-4 parTalent" id="sampleTalent">
				<div class="wrimagecard wrimagecard-topimage">
					<div class="toolbar">
						<a href="#accomplishment" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
					<a href="#">
						<div class="wrimagecard-topimage_header" style="background-color: rgba(51, 105, 232, 0.1)">
							<center><i class = "fa fa-user" style="color:#3369e8"></i></center>
						</div>
						<div class="wrimagecard-topimage_title">
							<h4>Talent Name</h4>
							<h6>City, State, Zip, Country</h6>
							<h6>Lorem ipsum dolor sit amet, paulo quaeque civibus et his, mea decore philosophia in. Elitr dissentias u...</h6>
							<a href="https://google.com" target="_blank" style="text-decoration: underline;">Edit</a>
							<span>|</span>
							<a href="https://google.com" target="_blank" style="text-decoration: underline;">Projects</a>
							<span>|</span>
							<a href="https://google.com" target="_blank" style="text-decoration: underline;">Accomplishments</a>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-4 parAgency" id="sampleAgency">
				<div class="wrimagecard wrimagecard-topimage">
					<div class="toolbar">
						<a href="#accomplishment" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
					<a href="#">
						<div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1)">
							<center><i class="fa fa-building" style="color:#d50f25"> </i></center>
						</div>
						<div class="wrimagecard-topimage_title" >
							<h4>Agency Name
							<div class="pull-right badge private">Private</div></h4>
							<h6>City, State, Zip, Country</h6>
							<h6>Lorem ipsum dolor sit amet, paulo quaeque civibus et his, mea decore philosophia in. Elitr dissentias u...</h6>
							<a href="https://google.com" target="_blank" style="text-decoration: underline;">Edit</a>
							<span>|</span>
							<a href="https://google.com" target="_blank" style="text-decoration: underline;">Projects</a>
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
							<a href="https://google.com" target="_blank" style="text-decoration: underline;">Edit</a>
							<span>|</span>
							<a href="https://google.com" target="_blank" style="text-decoration: underline;">Link</a>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div-->


	
		</div>
	</div>


	<!--NEW PROJECT FORM-->
	<div class="modal fade" id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1 id="projectLabel">Start A New Project</h1>
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
						<label>Project Name: *</label>
						<input id="project-name" type="text" name="projectName" placeholder="Project Name" title="Project Name" required/>
					</div>

					<!--START/END DATES-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Start Date: *</label>
						<input id="project-startdate" type="date" name="projectStartDate" placeholder="MM/DD/YYYY" title="Start Date" required/>
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>End Date:</label>
						<input id="project-enddate" type="date" name="projectEndDate" placeholder="MM/DD/YYYY" title="End Date"/>
					</div>

					<!--LOCATION SENSITIVITY-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Location Sensitivty:</label>
						<select name="location-sensitive" id="location-sensitive">
							<option value="None" selected="selected">None</option>
							<option value="City">City</option>
							<option value="State">State</option>
							<option value="ZIP">ZIP</option>
							<option value="Country">Country</option>
						</select>
					</div>

					<!--ADDRESS-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
					<label>Street:</label>
						<input id="street" type="text" name="street" placeholder="Street" />			
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>City:</label>
						<input id="city" type="text" name="city" placeholder="City"/>
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>State:</label>
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
						<label>Zip/Postal Code:</label>
						<input id="zip" type="text" name="zip" placeholder="Zip/Postal Code" pattern="[0-9]{5}" title="Five digit zip code" />
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Country:</label>
						<input id="country" type="text" name="country" placeholder="Country"/>
					</div>

					<!--PROJECT DESCRIPTION-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Project Description:</label>
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
				<h1 id="accomplishmentLabel">Share A New Accomplishment</h1>
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
					<div class="col-md-6 col-xs-12 formFromTo" style="padding-left:5px;padding-right:5px;">
						<label>Date (From):</label>
						<input id="acc-fromdate" type="date" name="accFromDate" placeholder="MM/DD/YYYY" title="Date (From)"/>
					</div>
					<!--TO DATE-->
					<div class="col-md-6 col-xs-12 formFromTo" style="padding-left:5px;padding-right:5px;">
						<label>Date (To):</label>
						<input id="acc-todate" type="date" name="accToDate" placeholder="MM/DD/YYYY" title="Date (To)"/>
					</div>
					<!--ON DATE-->
					<div class="col-md-6 col-xs-12 formOn" style="padding-left:5px;padding-right:5px;">
						<label>Date (On):</label>
						<input id="acc-ondate" type="date" name="accOnDate" placeholder="MM/DD/YYYY" title="Date (On)"/>
					</div>

					<!--URL-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<input id="acc-url" type="url" pattern="https?://.+"  name="acc-url" placeholder="Accomplishment Web Link/URL" title="Must start with either http:// or https://" />			
					</div>

					<!--ACCOMPLISHMENT LICENSE AGENCY-->
					<div class="col-md-6 col-xs-12 formLic" style="padding-left:5px;padding-right:5px;">
						<input id="acc-la" type="text" name="accLA" placeholder="License Agency"/>
					</div>

					<!--ACCOMPLISHMENT LICENSE NUMBER-->
					<div class="col-md-6 col-xs-12 formLic" style="padding-left:5px;padding-right:5px;">
						<input id="acc-ln" type="text" name="accLN" placeholder="License Number"/>
					</div>

					<!--ACCOMPLISHMENT DESCRIPTION-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<textarea id="acc-desc" name="accDescription" placeholder="Accomplishment Description" title="Accomplishment Description" maxlength="2000"></textarea>
					</div>

					<!--SUBMIT-->
					<input type="submit" name="newAccomplishment-submit" id="submit-newacc" class="login loginmodal-submit" value="New Accomplishment">
				</form>
				<div id="login-err-msg" style="color:red;text-align: center;"></div>
			</div>
		</div>
	</div>

	<!--EDIT PROFILE FORM-->
	<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container row">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1>Edit Your User Profile</h1><br>
				<div>
					<form id="editProfile" name="editProfile">
						<!--USER TYPE-->
						<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>User Type:</label>
							<input id="utype-edit-prof" type="text" name="utype" style="background: #F1F3FA;"  readonly/>
						</div>

						<!--AGENCY TYPE-->
						<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>Agency Type:</label>
							<input id="atype-edit-prof" type="text" name="atype" class="form-agency" style="background: #F1F3FA;" readonly/>
						</div>

						<!--USER NAMES-->
						<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>First Name:</label>
							<input id="fname-edit-prof" class="form-talent" type="text" name="fname" required/>
						</div>

						<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>Last Name:</label>
							<input id="lname-edit-prof" class="form-talent"  type="text" name="lname" required/>
						</div>

						<div class="col-md-12" style="padding-left:5px;padding-right:5px;">
							<label>Company Name:</label>
							<input id="aname-edit-prof" class="form-agency" type="text" name="cname"required/>
						</div>

						<!--EMAIL/PASSWORD-->
						<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>Email:</label>
							<input id="email-edit-prof" type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Must be an email address" style="background: #F1F3FA;"  readonly/>
						</div>

						<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>Password:</label>
							<input id="password-edit-prof" type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
						</div>

						<!--PHONE-->
						<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>Phone:</label>
							<input id="phone-edit-prof" type="text" name="phone" pattern="\d{3}[\-]\d{3}[\-]\d{4}" title="XXX-XXX-XXXX"/>
						</div>

						<!--ADDRESS-->
						<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>Street:</label>
							<input id="street-edit-prof" type="text" name="street"/>			
						</div>

						<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>City:</label>
							<input id="city-edit-prof" type="text" name="city"/>
						</div>

						<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>State:</label>
							<select name="state" id="state-edit-prof">
							  <option value="">Select a State</option>
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
							<label>Zip/Postal Code:</label>
							<input id="zip-edit-prof" type="text" name="zip" pattern="[0-9]{5}" title="Five digit zip code" />
						</div>

						<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>Country:</label>
							<input id="country-edit-prof" type="text" name="country"/>
						</div>

						<!--ACCOMPLISHMENT DESCRIPTION-->
						<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
							<label>Summary:</label>
							<textarea id="summary-edit-prof" name="Summary" title="Summary" maxlength="2000"></textarea>
						</div>

						<!--SUBMIT-->
						<input type="submit" name="login" id="submit-edit-prof" class="login loginmodal-submit" value="Update">
					</form>
				</div>
				<div id="reg-err-msg" style="color:red;text-align: center;"></div>
			</div>
		</div>
	</div>

	<!--NEW MILESTONE FORM-->
	<div class="modal fade" id="newMilestoneModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1 id="editMilestoneLabel">Add A New Milestone</h1>
				<form id="newMilestoneForm" name="newMilestone">

		            <!--MILESTONE NAME-->
					<div class="col-md-8 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Milestone Title</label>
						<input id="new-milestone-name" type="text" name="milestoneName" placeholder="Milestone Title *" title="Milestone Title" required/>
					</div>

					<!--MILESTONE POSITION-->
					<div class="col-md-4 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Milestone #:</label>
						<input id="new-milestone-pos" type="text" name="milestonePos" placeholder="Milestone # *" title="Milestone #" required/>
					</div>

					<!--START DATE-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Milestone (Start):</label>
						<input id="new-milestone-startdate" type="date" name="milestoneStartDate" placeholder="MM/DD/YYYY" title="Start Date"/>
					</div>
					<!--END DATE-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Milestone (End):</label>
						<input id="new-milestone-enddate" type="date" name="milestoneEndDate" placeholder="MM/DD/YYYY" title="End Date"/>
					</div>

					<!--SUBMIT-->
					<input type="submit" name="newMilestone-submit" id="submit-newmilestone" class="login loginmodal-submit" value="New Milestone"/>
				</form>
				<div id="login-err-msg" style="color:red;text-align: center;"></div>
			</div>
		</div>
	</div>
	
	<!--NEW TASK FORM-->
	<div class="modal fade" id="newTaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1 id="newTaskLabel">Add A New Task</h1>
				<form id="newTaskForm" name="newTask">

					<!--PARENT MILESTONE ID FOR THIS TASK-->
					<input id="task-milestone-id" type="hidden" name="milestoneId"/>

		            <!--TASK NAME-->
					<div class="col-md-7 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Task Name *</label>
						<input id="new-task-name" type="text" name="taskName" placeholder="Task Name *" title="Task name" required/>
					</div>

					<!--TASK COMPLETION STATE -->
					<div class="col-md-5 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Completion State *</label>
						<select name="task-completion-state" id="new-task-completion" required>
							<option value=0>In-Progress</option>
							<option value=1>Completed</option>
						</select>
					</div>

					<!--TASK ASSIGNED TALENT-->
					<div class="col-md-8 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Assigned Talent *:</label>
						<select name="task-talent" id="new-task-talent" required></select>
					</div>

					<!--TASK PAYMENT AMOUNT-->
					<div class="col-md-4 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Payment Amount *:</label>
						<input id="new-task-amount" type="text" name="taskAmount" placeholder="$$$ *" title="Payment Amount" required/>
					</div>

					<!--TASK DESCRIPTION-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Description:</label>
						<textarea id="new-task-desc" name="Description" title="Task Description" maxlength="2000"></textarea>
					</div>

					<!--SUBMIT-->
					<input type="submit" name="newTask-submit" id="submit-newtask" class="login loginmodal-submit" value="New Task"/>
				</form>
				<div id="login-err-msg" style="color:red;text-align: center;"></div>
			</div>
		</div>
	</div>

	<!--EDIT MILESTONE FORM-->
	<div class="modal fade" id="editMilestoneModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1 id="editMilestoneLabel">Edit This Milestone</h1>
				<form id="editMilestoneForm" name="editMilestone">

					<!--MILESTONE ID-->
					<input id="edit-milestone-id" type="hidden" name="milestoneId"/>

		            <!--MILESTONE NAME-->
					<div class="col-md-8 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Milestone Title</label>
						<input id="edit-milestone-name" type="text" name="milestoneName" title="Milestone Title" required/>
					</div>

					<!--MILESTONE POSITION-->
					<div class="col-md-4 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Milestone #:</label>
						<input id="edit-milestone-pos" type="text" name="milestonePos" required/>
					</div>

					<!--START DATE-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Milestone (Start):</label>
						<input id="edit-milestone-startdate" type="date" name="milestoneStartDate" placeholder="MM/DD/YYYY"/>
					</div>
					<!--END DATE-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Milestone (End):</label>
						<input id="edit-milestone-enddate" type="date" name="milestoneEndDate" placeholder="MM/DD/YYYY"/>
					</div>

					<!--SUBMIT-->
					<input type="submit" name="editMilestone-submit" id="submit-editmilestone" class="login loginmodal-submit" value="Edit Milestone"/>
				</form>
				<div class="login-help pull-right">
					<a href="#">Delete This Milestone?</a>
				</div>
			</div>
		</div>
	</div>

	<!--EDIT TASK FORM-->
	<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1 id="editTaskLabel">Edit This Task</h1>
				<form id="editTaskForm" name="editTask">

					<!--THIS TASK'S ID-->
					<input id="edit-task-id" type="hidden" name="taskId"/>

					<!--PARENT MILESTONE ID FOR THIS TASK-->
					<input id="edit-task-milestone-id" type="hidden" name="milestoneId"/>

		            <!--TASK NAME-->
					<div class="col-md-7 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Task Name *</label>
						<input id="edit-task-name" type="text" name="taskName" placeholder="Task Name *" title="Task name" required/>
					</div>

					<!--TASK COMPLETION STATE -->
					<div class="col-md-5 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Completion State *</label>
						<select name="task-completion-state" id="edit-task-completion" required>
							<option value=0>In-Progress</option>
							<option value=1>Completed</option>
						</select>
					</div>

					<!--TASK ASSIGNED TALENT-->
					<div class="col-md-8 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Assigned Talent *:</label>
						<select name="task-talent" id="edit-task-talent" required></select>
					</div>

					<!--TASK PAYMENT AMOUNT-->
					<div class="col-md-4 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Payment Amount *:</label>
						<input id="edit-task-amount" type="text" name="taskAmount" placeholder="$$$ *" title="Payment Amount" required/>
					</div>

					<!--TASK DESCRIPTION-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Description:</label>
						<textarea id="edit-task-desc" name="Description" title="Task Description" maxlength="2000"></textarea>
					</div>

					<!--SUBMIT-->
					<input type="submit" name="newTask-submit" id="submit-newtask" class="login loginmodal-submit" value="Edit Task"/>
				</form>
				<div id="login-err-msg" style="color:red;text-align: center;"></div>
			</div>
		</div>
	</div>

	<!--PROJECT DETAILS FORM-->
	<div class="modal fade" id="projectDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1 id="projectDetailLabel">Project Details</h1>
				<form id="viewProjectDetail" name="viewProjectDetail">
					<!--PROJECT PRIVACY STATE-->
					<div class="onoffswitch" style="margin:auto;">
					    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="view-project-myonoffswitch" readonly="">
					    <label class="onoffswitch-label" for="myonoffswitch">
					        <span class="onoffswitch-inner"></span>
					        <span class="onoffswitch-switch"></span>
					    </label>
					</div>

		            <!--PROJECT NAME-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Project Name: *</label>
						<input id="view-project-name" type="text" style="background:#F1F3FA;" name="projectName" title="Project Name" readonly/>
					</div>

					<!--START/END DATES-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Start Date: *</label>
						<input id="view-project-startdate" type="date" style="background:#F1F3FA;" name="projectStartDate" placeholder="MM/DD/YYYY" title="Start Date" readonly/>
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>End Date:</label>
						<input id="view-project-enddate" type="date" style="background:#F1F3FA;" name="projectEndDate" placeholder="MM/DD/YYYY" title="End Date" readonly/>
					</div>

					<!--LOCATION SENSITIVITY-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Location Sensitivty:</label>
						<select name="location-sensitive" style="background:#F1F3FA;" id="view-project-location-sensitive" disabled>
							<option value="None" selected="selected">None</option>
						</select>
					</div>

					<!--ADDRESS-->
					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
					<label>Street:</label>
						<input id="view-project-street" type="text" style="background:#F1F3FA;" name="street" readonly/>			
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>City:</label>
						<input id="view-project-city" type="text" style="background:#F1F3FA;" name="city" readonly/>
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>State:</label>
						<select name="state" id="view-project-state" style="background:#F1F3FA;" disabled>
						  <option value="" selected="selected">Select a State</option>
						</select>
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Zip/Postal Code:</label>
						<input id="view-project-zip" type="text" style="background:#F1F3FA;" name="zip" pattern="[0-9]{5}" title="Five digit zip code" readonly/>
					</div>

					<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Country:</label>
						<input id="view-project-country" type="text" style="background:#F1F3FA;" name="country" readonly/>
					</div>

					<!--PROJECT DESCRIPTION-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Project Description:</label>
						<textarea id="view-project-desc" style="background:#F1F3FA;" name="projectDescription" title="Project Description" maxlength="2000" readonly></textarea>
					</div>

					<!--PROJECT DESCRIPTION-->
					<div class="col-md-12 col-xs-12" style="padding-left:5px;padding-right:5px;">
						<label>Total Cost:</label>
						<input id="view-project-cost" type="text" style="background:#F1F3FA;" name="cost" readonly/>
					</div>

				</form>
				<div id="login-err-msg" style="color:red;text-align: center;"></div>
			</div>
		</div>
	</div>

	<!--NO CONTENT DIV-->
	<div align="center" id="noContent" style="text-align: center;position: absolute;width:100%;margin: auto;">
		<h1 id="noContentHeader" style="font-size: 100px;font-weight: bold;color: #FFFFFF; text-shadow: 2px 2px #333333;">No Projects</h1>
	</div>
	
</body>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-drawer/1.0.6/js/drawer.min.js"></script>
	<script src="assets/js/user-mode.js"></script>
	<script src="assets/js/project_detail.js"></script>
	<!--script src="assets/js/kanban.js"></script-->
	<script src="assets/js/search.js"></script>
	<script src="assets/js/logout.js"></script>

</html>