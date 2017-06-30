$(document).ready(function(){

	$.getJSON("user_mode_request.php", {'view_proj':1},function(data){
		if(data.user == "No Users Detected"){
			window.location = "index.php";
		}else{
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

					/*START/END DATE VALIDATION*/
					$('#project-startdate').on('change', function(){
						document.getElementById("project-startdate").setAttribute("max", document.getElementById("project-enddate").value);
						document.getElementById("project-enddate").setAttribute("min", document.getElementById("project-startdate").value);
					});
					$('#project-enddate').on('change', function(){
						document.getElementById("project-startdate").setAttribute("max", document.getElementById("project-enddate").value);
						document.getElementById("project-enddate").setAttribute("min", document.getElementById("project-startdate").value);
					});

				});
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

			}

			/*LOAD PROJECTS ONTO PAGE*/
			//clearScreen();
			displayProjects(data);
		}
	});

	/*NEW ACCOMPLISHMENT*/
	$('#newAccomplishment').submit(function(e){
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
	});

	/*NEW PROJECT*/
	$('#newProject').submit(function(e){
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
	});

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

			toggleNewButton($(this).attr('id'));

			//display all projects
			$.getJSON("user_mode_request.php", {'view_proj':1},function(data){
				clearScreen();
				displayProjects(data);
			});

		}else if($(this).attr('id') == "menuProjReq"){
			$(this).addClass('active');
			$('#menuProj').removeClass('active');
			$('#menuAcc').removeClass('active');

			toggleNewButton($(this).attr('id'));

		}else if($(this).attr('id') == "menuAcc"){
			//alert("clicked on Accomplishment");
			$(this).addClass('active');
			$('#menuProj').removeClass('active');
			$('#menuProjReq').removeClass('active');

			toggleNewButton($(this).attr('id'));

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
		if(this.paid == getCookie("UserId")){
			ableToDelete = '<div class="toolbar"><a href="#project" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a></div>';
			ableToEdit = '<a href="#project" class="edit" style="text-decoration:underline;">Edit</a>';
		}else{
			ableToDelete = '';
			ableToEdit = '';
		}
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4 parProject" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
				ableToDelete + 
					'<a href="#project" class="view">' + 
						'<div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">' + 
							'<center><i class="fa fa-tasks" style="color:#16A085"></i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.name + 
							'<div class="pull-right badge ' + this.privacy + '">' + this.privacy + '</div></h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
							ableToEdit + 
						'</div>' + 
					'</a>' + 
				'</div>' + 
			'</div>'
		);
	});
}

function displayAccomplishments(dataArr){
	$.each(dataArr.accomplishments, function(){
		if(this.atid == getCookie("UserId")){
			ableToDelete = '<div class="toolbar"><a href="#accomplishment" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a></div>';
			ableToEdit = '<a href="' + this.url + '" class="edit" style="text-decoration:underline;">Edit</a>';
		}else{
			ableToDelete = '';
			ableToEdit = '';
		}
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4 parAccompishment" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
					ableToDelete + 
					'<a href="#accomplishment" class="view">' + 
						'<div class="wrimagecard-topimage_header" style="background-color:  rgba(250, 188, 9, 0.1)">' + 
							'<center><i class="fa fa-trophy" style="color:#fabc09"> </i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.name + 
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
					'<a href="#talent" class="view">' + 
						'<div class="wrimagecard-topimage_header" style="background-color: rgba(51, 105, 232, 0.1)">' + 
							'<center><i class = "fa fa-user" style="color:#3369e8"></i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.fname + ' ' + this.lname + '</h4>' + 
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
					'<a href="#agency" class="view">' +
						'<div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1)">' + 
							'<center><i class="fa fa-building" style="color:#d50f25"> </i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.aname + 
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
