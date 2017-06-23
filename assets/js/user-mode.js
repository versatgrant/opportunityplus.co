$(document).ready(function(){
	$.getJSON("user_mode_request.php", function(data){
		if(data.user == "No Users Detected"){
			window.location = "index.php";
		}else{
			$('h2#username').empty();
			if(getCookie("UserType") == "agency"){
				alert("made it to agency");
				$('h2#username').html(data.user[0]["aname"]);
			}else{
				$('h2#username').html(data.user[0]["fname"] + " " + data.user[0]["lname"]);
			}


			/*LOAD PROJECTS ONTO PAGE*/
			displayProjects(data);
		}
	});

});

function displayProjects(dataArr){
	$('div#result-list').empty();
	$.each(dataArr.projects, function(){
		$('div#result-list').append(
			'<div class="col-md-3 col-sm-4">' + 
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

function truncate(string, num){
   if (string.length > num)
      return string.substring(0,num)+'...';
   else
      return string;
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
