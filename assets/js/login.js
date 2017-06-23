$(document).ready(function(){


	//$('input').attr('required',true);


	$('#sign-in-nav').on('click',function(){
		$.getJSON("login_request.php", function(data){
			if(data.loggedin){
				alert("Already Logged In.");
				window.location = "user-mode.php";
			}
		});
	});

	$('#login').submit(function(e){
		e.preventDefault();
		/**Pull values from form*/
		var email = $('#email-login').val();
		var password = $('#password-login').val();
		var usertype =  $('input[name="usertype-login"]:checked').val();
		$.ajax({
			type: 'POST',
			url: 'login_request.php',
			data: {
				'done_login': 1,
				'usertype': usertype,
				'email': email, 
				'pass': password
			},
			success: function(data){
	          //do something with the data via front-end framework
		        if(data == "Incorrect Username/Password"){
		        	$('div#login-err-msg').html(data);
		        }else if(data == 1){
		            //alert(data);
		            setCookie("UserType", usertype, 10);
		            window.location = "user-mode.php";
		        }
		    }
		});
		return false;
	});
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
