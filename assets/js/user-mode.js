$(document).ready(function(){
	$.getJSON("user_mode_request.php", function(data){
		if(data.user == "No Users Detected"){
			window.location = "index.php";
		}else{
			$('h2#username').empty();
			if(getCookie("UserType") == "agency"){
				alert("made it to agency");
				$('h2#username').html(data.user[0]["aname"]);
				$('p#user-desc').html(data.user[0]["desc"]);
			}else{
				$('h2#username').html(data.user[0]["fname"] + " " + data.user[0]["lname"]);
				$('p#user-desc').html(truncate(data.user[0]["desc"], 197));
			}


			/*LOAD PROJECTS ONTO PAGE*/
			displayProjects(data);
		}
	});

	$('#menu-button').on('click',function(){
		$('#drawerExample').attr('position', 'relative');
		$('#menu-button').toggleAttr('aria-expanded');
		$('#drawerExample').toggleAttr('aria-expanded');
		$('#drawerExample').attr('position', 'fixed');
	});
});

function displayProjects(dataArr){
	$('div#result-list').empty();
	$.each(dataArr.projects, function(){
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
					'<a href="#">' + 
						'<div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">' + 
							'<center><i class="fa fa-tasks" style="color:#16A085"></i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.name + 
							'<div class="pull-right badge ' + this.privacy + '">' + this.privacy + '</div></h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
						'</div>' + 
					'</a>' + 
				'</div>' + 
			'</div>'
		);
	});
}

function displayTalents(dataArr){
	$('div#result-list').empty();
	$.each(dataArr.talents, function(){
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
					'<a href="#">' + 
						'<div class="wrimagecard-topimage_header" style="background-color: rgba(51, 105, 232, 0.1)">' + 
							'<center><i class = "fa fa-user" style="color:#3369e8"></i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.fname + ' ' + this.lname + '</h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
						'</div>' + 
					'</a>' + 
				'</div>' + 
			'</div>'
		);
	});
}

function displayAgencies(dataArr){
	$('div#result-list').empty();
	$.each(dataArr.agencies, function(){
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4" id="' + this.id +'">' + 
				'<div class="wrimagecard wrimagecard-topimage">' + 
					'<a href="#">' + 
						'<div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1)">' + 
							'<center><i class="fa fa-building" style="color:#d50f25"> </i></center>' + 
						'</div>' + 
						'<div class="wrimagecard-topimage_title">' + 
							'<h4>' + this.aname + 
							'<div class="pull-right badge ' + this.privacy + '">' + this.privacy + '</div></h4>' + 
							'<h6>' + this.city + ', ' + this.state + ' ' + this.zip + ', ' + this.country + '</h6>' + 
							'<h6>' + truncate(this.desc, 97) + '</h6>' + 
						'</div>' + 
					'</a>' + 
				'</div>' + 
			'</div>'
		);
	});
}

function truncate(string, num){
   if (string.length > num)
      return string.substring(0,num)+'...';
   else
      return string;
};

jQuery.fn.toggleAttr = function(attr) {
 return this.each(function() {
  var $this = $(this);
  $this.attr(attr) ? $this.removeAttr(attr) : $this.attr(attr, attr);
 });
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
