$(document).ready(function(){
	$.getJSON("user_mode_request.php", function(data){
		if(data.user == "No Users Detected"){
			window.location = "index.php";
		}else{
			$('h2#username').empty();
			if(getCookie("UserType") == "agency"){
				$('h2#username').html(data.user[0]["aname"]);
				$('p#user-desc').html(data.user[0]["desc"]);
			}else{
				$('h2#username').html(data.user[0]["fname"] + " " + data.user[0]["lname"]);
				$('p#user-desc').html(truncate(data.user[0]["desc"], 197));
			}

			/*LOAD PROJECTS ONTO PAGE*/
			//clearScreen();
			displayProjects(data);
		}
	});

	/*HANDLE LOCATION SENSITIVITY*/
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


	/*NEW PROJECT*/
	$('#newProject').submit(function(){
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
				if(data.success){
					displayProjects(data);
					//window.location = "user-mode.php";
				}
		      }
		  });
		//return false;
	});

	/*NAV-DRAWER FIXES*/
	$('#menu-button').on('click',function(){
		$('#drawerExample').attr('position', 'relative');
		$('#menu-button').attr('aria-expanded', function (_, attr) { return !attr });
		$('#drawerExample').attr('aria-expanded', function (_, attr) { return !attr });
		$('#drawerExample').attr('position', 'fixed');
	});

	/*DELETE PROJECT|ACCOMPLISHMENT*/
	$('.container #result-list').on('click', '.delete', function(){
		/**Pull values from form*/
		alert($(this).attr('href'));
	});

});

function clearScreen(){
	$('div#result-list').empty();
}

function displayProjects(dataArr){
	$.each(dataArr.projects, function(){
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4 parProject" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
				'<div class="toolbar">' + 
					'<a href="#project" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a>' + 
				'</div>' + 
					'<a href="#project" class="view">' + 
						'<div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">' + 
							'<center><i class="fa fa-tasks" style="color:#16A085"></i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.name + 
							'<div class="pull-right badge ' + this.privacy + '">' + this.privacy + '</div></h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
							'<a href="#project" class="edit" style="text-decoration:underline;">Edit</a>' + 
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
				'<div class="toolbar">' + 
					'<a href="#talent" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a>' + 
				'</div>' + 
					'<a href="#talent" class="view">' + 
						'<div class="wrimagecard-topimage_header" style="background-color: rgba(51, 105, 232, 0.1)">' + 
							'<center><i class = "fa fa-user" style="color:#3369e8"></i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.fname + ' ' + this.lname + '</h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
							'<a href="#talent" class="edit" style="text-decoration:underline;">Edit</a>' + 
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
				'<div class="toolbar">' + 
					'<a href="#agency" class="pull-right tool delete" style="padding-right: 10px;"><span class="glyphicon glyphicon-remove"></span></a>' + 
				'</div>' + 
					'<a href="#agency" class="view">' +
						'<div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1)">' + 
							'<center><i class="fa fa-building" style="color:#d50f25"> </i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.aname + 
							'<div class="pull-right badge ' + this.privacy + '">' + this.privacy + '</div></h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
							'<a href="#agency" class="edit" style="text-decoration:underline;">Edit</a>' + 
						'</div>' + 
					'</a>' + 
				'</div>' + 
			'</div>'
		);
	});
}

function truncate(string, num){
	if(string == null){
		return "No Description :(";
	}else if (string.length > num){
		return string.substring(0,num)+'...';
	}
	else{
		return string;
	}
};


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
