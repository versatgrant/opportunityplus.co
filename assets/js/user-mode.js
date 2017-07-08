$(document).ready(function(){

	$.getJSON("user_mode_request.php", {'view_proj':1},function(data){
		if(data.user == "No Users Detected"){
			window.location = "index.php";
		}else{

			/*HIDE PROJECT DETAIL BUTTONS*/
			$('#newMilestone').css('display', 'none');
			$('#viewProjDetails').css('display', 'none');

			$('h2#username').empty();
			if(getCookie("UserType") == "agency"){
				$('h2#username').html(data.user[0]["aname"]);
				$('p#user-desc').html(truncate(data.user[0]["desc"], 197));
				$('#newPA').attr('href','#newProjectModal');
				$('#newAccomplishmentModal').empty();
				$('li#menuAcc').remove();
				loadUserForm(data.user);

				/*HANDLE LOCATION SENSITIVITY FOR NEW PROJECTS*/
				$('#location-sensitive').on('change', function(){
					if($('#location-sensitive').val() == 'City'){
						$('#city').attr('required', true);
						$('#state').attr('required', false);
						$('#zip').attr('required', false);
						$('#country').attr('required', false);
					}else if($('#location-sensitive').val() == 'State'){
						$('#city').attr('required', false);
						$('#state').attr('required', true);
						$('#zip').attr('required', false);
						$('#country').attr('required', false);
					}else if($('#location-sensitive').val() == 'ZIP'){
						$('#city').attr('required', false);
						$('#state').attr('required', false);
						$('#zip').attr('required', true);
						$('#country').attr('required', false);
					}else if($('#location-sensitive').val() == 'Country'){
						$('#city').attr('required', false);
						$('#state').attr('required', false);
						$('#zip').attr('required', false);
						$('#country').attr('required', true);
					}else{
						$('#city').attr('required', false);
						$('#state').attr('required', false);
						$('#zip').attr('required', false);
						$('#country').attr('required', false);
					}
				});

					/*START/END DATE VALIDATION*/
					$('#project-startdate').on('change', function(){
						document.getElementById("project-startdate").setAttribute("max", document.getElementById("project-enddate").value);
						document.getElementById("project-enddate").setAttribute("min", document.getElementById("project-startdate").value);
					});
					$('#project-enddate').on('change', function(){
						document.getElementById("project-startdate").setAttribute("max", document.getElementById("project-enddate").value);
						document.getElementById("project-enddate").setAttribute("min", document.getElementById("project-startdate").value);
					});

					/*NEW PROJECT SUBMIT EVENT*/
					$('#newProject').on('submit',function(e){newProject(e)});

				
			}else{
				$('h2#username').html(data.user[0]["fname"] + " " + data.user[0]["lname"]);
				$('p#user-desc').html(truncate(data.user[0]["desc"], 197));
				$('#newPA').attr('href','#newAccomplishmentModal');
				$('#newProjectModal').empty();

				loadUserForm(data.user);

				/**Hide all non-generic Accomplishment fields on load*/
				$('.formOn').toggle();
				$('.formFromTo').toggle();
				$('.formLic').toggle();

				/*Hide "New Accomplishment" Button"*/
				$('#newPA').css('display', 'none');

				/**Hide/Show the necessary Accomplishment fields when the Accomplishment type changes*/
				$('#acc-type').on('change',function(){
					if($('#acc-type').val() == "Certification" || $('#acc-type').val() == "Honor/Award"|| $('#acc-type').val() == "Patent" || $('#acc-type').val() == "Publication"){
						$('.formOn').toggle(true);
						$('.formFromTo').toggle(false);
						if($('#acc-type').val() == "Certification" || $('#acc-type').val() == "Patent"){
							$('.formLic').toggle(true);
						}else{
							$('.formLic').toggle(false);
						}
					}else if($('#acc-type').val() == "Course" || $('#acc-type').val() == "Project"){
						$('.formOn').toggle(false);
						$('.formFromTo').toggle(true);
						$('.formLic').toggle(false);
					}else{
						$('.formOn').toggle(false);
						$('.formFromTo').toggle(false);
						$('.formLic').toggle(false);
					}
				});

				/*NEW ACCOMPLISHMENT SUBMIT EVENT*/
				$('#newAccomplishment').on('submit',function(e){newAccomplishment(e)});
			}

			/*LOAD PROJECTS ONTO PAGE*/
			clearScreen();
			displayProjects(data);
		}
	});

	/*TOGGLE BETWEEN NEW/EDIT FOR ACCOMPLISHMENT & PROJECT FORMS */
	$('#newPA').click(function(){newPAFormLayout();});

	/*NAV-DRAWER FIXES*/
	$('#menu-button').on('click',function(){
		$('#drawerExample').attr('position', 'relative');
		$('#menu-button').attr('aria-expanded', function (_, attr) { return !attr });
		$('#drawerExample').attr('aria-expanded', function (_, attr) { return !attr });
		$('#drawerExample').attr('position', 'fixed');
	});

	/*TOGGLE ACTIVE MENU SELECTION*/
	$('#menuDrawerNav').children().on('click', function(){
		if($(this).attr('id') == "menuProj"){
			$(this).addClass('active');
			$('#menuProjReq').removeClass('active');
			$('#menuAcc').removeClass('active');

			/*HIDE PROJECT DETAIL BUTTONS*/
			$('#newMilestone').css('display', 'none');
			$('#viewProjDetails').css('display', 'none');

			/*Set appropriate styling on result container*/
			$('div#result-list').css('flex-wrap','wrap');

			toggleNewButton($(this).attr('id'));

			closeNavDrawer();

			//display all projects
			$.getJSON("user_mode_request.php", {'view_proj':1},function(data){
				clearScreen();
				displayProjects(data);
			});

		}else if($(this).attr('id') == "menuProjReq"){
			$(this).addClass('active');
			$('#menuProj').removeClass('active');
			$('#menuAcc').removeClass('active');

			/*HIDE PROJECT DETAIL BUTTONS*/
			$('#newMilestone').css('display', 'none');
			$('#viewProjDetails').css('display', 'none');

			/*Set appropriate styling on result container*/
			$('div#result-list').css('flex-wrap','wrap');

			toggleNewButton($(this).attr('id'));

			closeNavDrawer();

		}else if($(this).attr('id') == "menuAcc"){
			//alert("clicked on Accomplishment");
			$(this).addClass('active');
			$('#menuProj').removeClass('active');
			$('#menuProjReq').removeClass('active');

			/*HIDE PROJECT DETAIL BUTTONS*/
			$('#newMilestone').css('display', 'none');
			$('#viewProjDetails').css('display', 'none');

			/*Set appropriate styling on result container*/
			$('div#result-list').css('flex-wrap','wrap');

			toggleNewButton($(this).attr('id'));

			closeNavDrawer();

			//display all accomplishments
			$.getJSON("user_mode_request.php", {'view_acc':1},function(data){
				clearScreen();
				displayAccomplishments(data);
			});
		} 
	});

	/*EDIT USER PROFILE*/
	$('#editProfile').submit(function(e){
		e.preventDefault();
		var fname = $('#fname-edit-prof').val();
		var lname = $('#lname-edit-prof').val();
		var aname = $('#aname-edit-prof').val();
		var password = $('#password-edit-prof').val();
		var phone = $('#phone-edit-prof').val();
		var street = $('#street-edit-prof').val();
		var city = $('#city-edit-prof').val();
		var zip = $('#zip-edit-prof').val();
		var state = $('#state-edit-prof').val();
		var country = $('#country-edit-prof').val();
		var desc = $('#summary-edit-prof').val();
		var utype = getCookie("UserType");

		if(utype == "agency"){
			data = {
				'edit_profile': 1,
				'utype': utype,
				'aname': aname,
				'password': password,
				'phone': phone,
				'street': street,
				'city': city,
				'state': state,
				'zip': zip,
				'country': country,
				'desc': desc
			};
		}else{
			data = {
				'edit_profile': 1,
				'utype': utype,
				'fname': fname,
				'lname': lname,
				'password': password,
				'phone': phone,
				'street': street,
				'city': city,
				'state': state,
				'zip': zip,
				'country': country,
				'desc': desc
			};
		}
		$.ajax({
			type: 'POST',
			url: 'user_mode_request.php',
			data: data,
			success: function(){
				location.reload();
			}
		});
	});

	/*DELETE PROJECT|ACCOMPLISHMENT*/
	$('.container #result-list').on('click', '.delete', function(){
		/**Pull values from form*/
		var table = parseHref($(this).attr('href'));
		var row = $(this).parent().parent().parent().attr('id');
		$.ajax({
			type: 'POST',
			url: 'user_mode_request.php',
			data: {
				'del_pa': 1,
				'table': table,
				'id': row
			},
			success: function(data){
				if(data == "Deleted"){
					if(table == "project"){
						window.location = "user-mode.php";
					}else{
						$.getJSON("user_mode_request.php", {'view_acc':1},function(data){
							clearScreen();
							displayAccomplishments(data);
						});
					}
					
				}else if(data == "Error"){
					alert("Someone has access to this project. You must recind access before this project can be deleted.");
				}
		    }
		});
	});

	/*EDIT PROJECT|ACCOMPLISHMENT*/
	$('.container #result-list').on('click', '.edit', function(){
		newPAFormLayout();
		var table = parseHref($(this).attr('href'));
		var row = $(this).parent().parent().parent().attr('id');
		if($('#newProject').length){
			$('#submit-newproject').val('Update Project');
			$('#submit-newproject').attr('id',row);
			//alert("I'm here - EditPA");
			$('#newProject').off('submit');
			$('#newProject').attr('id','editProject');
			$('#projectLabel').empty();
			$('#projectLabel').html('Edit this Project');
			/*Change the layout of the new project form to be that of the edit project form*/
			$('#editProject .onoffswitch').toggle('false');//Hide Privacy Switch
			$('#editProject').prepend(//Add a readonly field to show the privacy state
					'<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">' + 
						'<label>Privacy State:</label>' + 
						'<input id="project-privacy" type="text" name="" style="background:#F1F3FA;" title="Project Privacy" readonly/>' + 
					'</div>' + 
					'<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">' + 
						'<label>Active State:</label>' + 
						'<select id="project-active-state" name="project-active-state">' + 
							'<option value="Active">Active</option>' + 
							'<option value="Inactive">Inactive</option>' + 
						'</select>' + 
					'</div>' + 
					'<div class="col-md-6 col-xs-12" style="padding-left:5px;padding-right:5px;">' + 
						'<label>Completion State:</label>' + 
						'<select id="project-completed-state" name="project-completed-state">' + 
							'<option value="Completed">'+'Completed'+'</option>' + 
							'<option value="In-Progress">In-Progress</option>' + 
						'</select>' + 
					'</div>');

			$('#editProject').on('submit',function(e){
				e.preventDefault();

				//get data from form
				var id = $('#editProject input[type="submit"]').attr('id');
				//alert(id);
				var complete = $('#project-completed-state').val();
				var active = $('#project-active-state').val();
				var name = $('#project-name').val();
				var start = $('#project-startdate').val();
				var end = $('#project-enddate').val();
				var zone = $('#location-sensitive').val();
				var street = $('#street').val();
				var city = $('#city').val();
				var state = $('#state').val();
				var zip = $('#zip').val();
				var country = $('#country').val();
				var desc = $('#project-desc').val();

				$.ajax({
					type: 'POST',
					url: 'user_mode_request.php',
					data: {
						'update_project': 1,
						'id': id,
						'active':active,
						'complete':complete,
						'name': name,
						'start': start,
						'end': end,
						'zone': zone,
						'street': street,
						'city': city,
						'state': state,
						'zip': zip,
						'country': country,
						'desc': desc
					},
					success: function(data){
						location.reload();
				    }
				});
			});

		}else if($('#newAccomplishment').length){
			newPAFormLayout();
			$('#submit-newacc').val('Update Accomplishment');
			$('#submit-newacc').attr('id',row);
			$('#newAccomplishment').off('submit');
			$('#newAccomplishment').attr('id','editAccomplishment');
			$('#accomplishmentLabel').empty();
			$('#accomplishmentLabel').html('Edit this Accomplishment');

			//Change the layout of the new accomplishment form to be that of the edit accomplishment form*/
			$('#editAccomplishment #acc-type').attr('disabled',true);//disable the accomplishment type picklist
			$('#editAccomplishment #acc-type').css('background', '#F1F3FA');//colour background to notify users of it's disabled state

			/*SUBMIT EVENT LISTENER FOR THE EDIT ACCOMPLISHMENT FORM*/
			$('#editAccomplishment').on('submit',function(e){
				e.preventDefault();

				//get data from form
				var id = $('#editAccomplishment input[type="submit"]').attr('id');
				//alert(id);
				var name = $('#acc-name').val();
				var from = $('#acc-fromdate').val();
				var to = $('#acc-todate').val();
				var on = $('#acc-ondate').val();
				var url = $('#acc-url').val();
				var la = $('#acc-la').val();
				var ln = $('#acc-ln').val();
				var desc = $('#acc-desc').val();

				$.ajax({
					type: 'POST',
					url: 'user_mode_request.php',
					data: {
						'update_acc': 1,
						'id': id,
						'name': name,
						'from': from,
						'to': to,
						'on': on,
						'url': url,
						'la': la,
						'ln': ln,
						'desc': desc,
					},
					success: function(data){
						location.reload();
				    }
				});
			});
		}

		$.getJSON("user_mode_request.php", {'editPA':1, 'table':table, 'row':row},function(data){
			//data = JSON.parse(data);
			loadPAEditForm(data, table);
		});
	});

	/*ADD A SUBMIT EVENT LISTENER TO THE EDIT PROJECT FORM*/
	/*$('#editProject').submit(function(e){
		e.preventDefault();

		//get data from form
		var id = $('#editProject input[type="submit"]').attr('id');
		alert(id);

	});*/
	/*ADD A SUBMIT EVENT LISTENER TO THE EDIT ACCOMPLISHMENT FORM*/

});

function clearScreen(){
	$('div#result-list').empty();
}

function toggleNewButton(id){
	if(id == "menuAcc"){
		/*Show "New Accomplishment" Button"*/
		$('#newPA').css('display', 'block');
	}else if(id == "menuProj"){
		if(getCookie("UserType") == "agency"){
			/*Show "New Project" Button"*/
			$('#newPA').css('display', 'block');
		}else{
			/*Hide "New Project" Button"*/
			$('#newPA').css('display', 'none');
		}
	}else{
		/*Hide "New Accomplishment/Project" Button"*/
		$('#newPA').css('display', 'none');
	}
}

function loadPAEditForm(PAData, PA){
	//pull in data from either the project or the accomplishment table
	//use that data to populate the field values of the newly edited form
	if(PA == "newProjectModal"){
		$('#project-privacy').val(PAData.projects[0]["privacy"]);
		$('#project-name').val(PAData.projects[0]["name"]);
		$('#project-active-state').val(PAData.projects[0]["active"]);
		$('#project-completed-state').val(PAData.projects[0]["complete"]);
		$('#project-startdate').val(PAData.projects[0]["start"]);
		$('#project-enddate').val(PAData.projects[0]["end"]);
		$('#location-sensitive').val(PAData.projects[0]["zone"]);
		$('#street').val(PAData.projects[0]["street"]);
		$('#city').val(PAData.projects[0]["city"]);
		$('#state').val(PAData.projects[0]["state"]);
		$('#zip').val(PAData.projects[0]["zip"]);
		$('#country').val(PAData.projects[0]["country"]);
		$('#project-desc').val(PAData.projects[0]["desc"]);

	}else if(PA == "newAccomplishmentModal"){
		$('#acc-type').val(PAData.accomplishments[0]["type"]).trigger("change");
		$('#acc-name').val(PAData.accomplishments[0]["name"]);
		$('#acc-fromdate').val(PAData.accomplishments[0]["from"]);
		$('#acc-todate').val(PAData.accomplishments[0]["to"]);
		$('#acc-ondate').val(PAData.accomplishments[0]["on"]);
		$('#acc-url').val(PAData.accomplishments[0]["url"]);
		$('#acc-la').val(PAData.accomplishments[0]["la"]);
		$('#acc-ln').val(PAData.accomplishments[0]["ln"]);
		$('#acc-desc').val(PAData.accomplishments[0]["desc"]);
	}
}

function newProject(e){
	e.preventDefault();
	/**Pull values from form*/
	var pname = $('#project-name').val();
	var pdesc = $('#project-desc').val();
	if($("#myonoffswitch").is(':checked') == true){
		var privacystate = "Public";
	}else{
		var privacystate = "Private";
	}
	var project_agency = getCookie("UserId");
	var sdate = document.getElementById("project-startdate").value;
	var edate = document.getElementById("project-enddate").value;
	var location_sensitive = $("#location-sensitive").val();
	var street = $('#street').val();
	var city = $('#city').val();
	var state = $('#state').val();
	var zip = $('#zip').val();
	var country = $('#country').val();

	/**send a post request to server with the form values*/
	$.ajax({
		type: 'POST',
		url: 'user_mode_request.php',
		data: {
			'new_project': 1,
			'pname': pname,
			'pdesc': pdesc,
			'pagency': project_agency,
			'privacy': privacystate,
			'sdate': sdate,
			'edate': edate,
			'location_sensitive': location_sensitive,
			'street': street,
			'city': city,
			'state': state,
			'zip': zip,
			'country': country
		},
		success: function(data){
			data = JSON.parse(data);
			if(data.success){
				$('#newProjectModal').removeClass('in');
				$('.modal-backdrop').removeClass('in');
				$('#newProjectModal').css('display','none');
				$('.modal-backdrop').css('display','none');
				displayProjects(data);
			}
	      }
	  });
	return false;
}

function newAccomplishment(e){
	e.preventDefault();
	/**Pull values from form*/
	var acctype = $('#acc-type').val();
	var acctitle = $('#acc-name').val();
	var from = $('#acc-fromdate').val();
	var to = $('#acc-todate').val();
	var on = $('#acc-ondate').val();
	var url = $('#acc-url').val();
	var licagency = $('#acc-la').val();
	var licnum = $('#acc-ln').val();
	var accdesc = $('#acc-desc').val();
	var acc_talent = getCookie("UserId");
	/**send a post request to server with the form values*/
	$.ajax({
		type: 'POST',
		url: 'user_mode_request.php',
		data: {
			'new_acc': 1,
			'acctype': acctype,
			'acctitle': acctitle,
			'from': from,
			'to': to,
			'on': on,
			'url': url,
			'licagency': licagency,
			'licnum': licnum,
			'accdesc': accdesc,
			'acc_talent': acc_talent
		},
		success: function(data){
			data = JSON.parse(data);
			if(data.success){
				$('#newAccomplishmentModal').removeClass('in');
				$('.modal-backdrop').removeClass('in');
				$('#newAccomplishmentModal').css('display','none');
				$('.modal-backdrop').css('display','none');
				displayAccomplishments(data);
			}
	      }
	  });
	return false;
}

function newPAFormLayout(){
	if($('#editProject').length){
		//alert("I'm Here - NewPA");
		//change the edit project form back to its normal layout, i.e. the new project form
		$('#editProject input[type="submit"]').attr('id','submit-newproject');
		$('#editProject').off('submit');
		$('#editProject').attr('id','newProject');
		$('#newProject').trigger('reset');

		$('#projectLabel').empty();
		$('#projectLabel').html('Start A New Project');

		$('#newProject .onoffswitch').toggle('true');//Show Privacy Switch
		$('#newProject #project-privacy').parent().remove();//Remove the readonly field that showed the privacy state
		$('#newProject #project-completed-state').parent().remove();//Remove the readonly field that showed the active state
		$('#newProject #project-active-state').parent().remove();//Remove the readonly field that showed the completion state

		/*NEW PROJECT SUBMIT EVENT*/
		$('#newProject').on('submit',function(e){newProject(e)});

	}else if($('#editAccomplishment').length){
		//change the edit accomplishment form back to its normal layout, i.e. the new accomplishment form
		$('#editAccomplishment input[type="submit"]').attr('id','submit-newacc');
		$('#editAccomplishment').off('submit');
		$('#editAccomplishment').attr('id','newAccomplishment');
		$('#newAccomplishment').trigger('reset');

		$('#accomplishmentLabel').empty();
		$('#accomplishmentLabel').html('Share A New Accomplishment');

		$('#newAccomplishment #acc-type').attr('disabled',false);//enable the accomplishment type picklist
		$('#newAccomplishment #acc-type').css('background', '#FFFFFF');//remove the colour from the background

		/*NEW ACCOMPLISHMENT SUBMIT EVENT*/
		$('#newAccomplishment').on('submit',function(e){newAccomplishment(e)});
	}
}

function loadUserForm(UserData){
	//get all input fields from the form and set their values to be that of the current user's
	$('#utype-edit-prof').attr('value', UserData[0]["usertype"]);
	$('#email-edit-prof').attr('value', UserData[0]["email"]);
	$('#password-edit-prof').attr('value', UserData[0]["password"]);
	$('#phone-edit-prof').attr('value', UserData[0]["phone"]);
	$('#street-edit-prof').attr('value', UserData[0]["street"]);
	$('#city-edit-prof').attr('value', UserData[0]["city"]);
	$('#state-edit-prof').val(UserData[0]["state"]);
	$('#zip-edit-prof').attr('value', UserData[0]["zip"]);
	$('#country-edit-prof').attr('value', UserData[0]["country"]);
	$('#summary-edit-prof').val(UserData[0]["desc"]);

	if(getCookie("UserType") == "talent"){
		$('#utype-edit-prof').parent().removeClass('col-md-6');
		$('#utype-edit-prof').parent().addClass('col-md-12');

		$('#atype-edit-prof').parent().remove();
		$('#aname-edit-prof').parent().remove();
		$('#fname-edit-prof').attr('value', UserData[0]["fname"]);
		$('#lname-edit-prof').attr('value', UserData[0]["lname"]);
	}else{
		$('#fname-edit-prof').parent().remove();
		$('#lname-edit-prof').parent().remove();
		$('#atype-edit-prof').attr('value', UserData[0]["privacy"]);
		$('#aname-edit-prof').attr('value', UserData[0]["aname"]);
	}
}

function displayProjects(dataArr){
	$.each(dataArr.projects, function(){
		if(this.paid == getCookie("UserId") && getCookie("UserType")  == "agency"){
			ableToDelete = '<div class="toolbar"><a href="#project" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a></div>';
			ableToEdit = '<a href="#newProjectModal" data-toggle="modal" class="edit" style="text-decoration:underline;">Edit</a>';
		}else{
			ableToDelete = '';
			ableToEdit = '';
		}

		if(this.access == "false"){
			//alert("You do not have access to: "+this.name);
		}

		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4 parProject" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
				ableToDelete + 
					'<a href="#project" class="view"  data-project-access="' + this.access + '" style="height:inherit;">' + 
						'<div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">' + 
							'<center><i class="fa fa-tasks" style="color:#16A085"></i></center>' + 
						'</div>' +  
					'</a>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + truncate(this.name, 22) + 
							'<div class="pull-right badge ' + this.privacy + '">' + this.privacy + '</div></h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
							ableToEdit + 
						'</div>' +
				'</div>' + 
			'</div>'
		);
	});
}

function displayAccomplishments(dataArr){
	$.each(dataArr.accomplishments, function(){
		if(this.atid == getCookie("UserId") && getCookie("UserType") == "talent"){
			ableToDelete = '<div class="toolbar"><a href="#accomplishment" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a></div>';
			//ableToEdit = '<a href="' + this.url + '" class="edit" style="text-decoration:underline;">Edit</a>';
			ableToEdit = '<a href="#newAccomplishmentModal" data-toggle="modal" class="edit" style="text-decoration:underline;">Edit</a>';
		}else{
			ableToDelete = '';
			ableToEdit = '';
		}
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4 parAccomplishment" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
					ableToDelete + 
					'<a href="#accomplishment" class="view" style="height:inherit;">' + 
						'<div class="wrimagecard-topimage_header" style="background-color:  rgba(250, 188, 9, 0.1)">' + 
							'<center><i class="fa fa-trophy" style="color:#fabc09"> </i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + truncate(this.name, 22) + 
							'<div class="pull-right badge">' + this.type + '</div></h4>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
							ableToEdit + 
						'</div>' + 
					'</a>' + 
				'</div>' + 
			'</div>'
		);
	});
}

function displayTalents(dataArr){
	$.each(dataArr.talents, function(){
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4 parTalent" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
					'<a href="#talent" class="view" style="height:inherit;">' + 
						'<div class="wrimagecard-topimage_header" style="background-color: rgba(51, 105, 232, 0.1)">' + 
							'<center><i class = "fa fa-user" style="color:#3369e8"></i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + truncate(this.fname+" "+this.lname, 22) +'</h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
							'<a href="#talent" class="projects" style="text-decoration:underline;">Projects</a>' + 
							'<span> | </span>' + 
							'<a href="#talent" class="accomplishments" style="text-decoration:underline;">Accomplishments</a>' + 
						'</div>' + 
					'</a>' + 
				'</div>' + 
			'</div>'
		);
	});
}

function displayAgencies(dataArr){
	$.each(dataArr.agencies, function(){
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4 parAgency" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
					'<a href="#agency" class="view" style="height:inherit;">' +
						'<div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1);height:inherit;">' + 
							'<center><i class="fa fa-building" style="color:#d50f25"> </i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + truncate(this.aname, 22) + 
							'<div class="pull-right badge ' + this.privacy + '">' + this.privacy + '</div></h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
							'<a href="#agency" class="projects" style="text-decoration:underline;">Projects</a>' + 
						'</div>' + 
					'</a>' + 
				'</div>' + 
			'</div>'
		);
	});
}

function truncate(string, num){
	if(string == null || string == ""){
		return "No Description :(";
	}else if (string.length > num){
		return string.substring(0,num)+'...';
	}
	else{
		return string;
	}
};

function parseHref(string){
	return string.substring(1,string.length);
}


function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function closeNavDrawer(){
	$('#menu-button').trigger('click');
}
