$(document).ready(function(){


	

	//$("input").prop('required',true);

	/**Hide the fields not related to the user's type on load*/
	if($('input[name="usertype-register"]:checked').val() == 'talent'){
		$('.form-agency').toggle();
		$('.form-agency').toggleAttr('required');
	}else{
		$('.form-talent').toggle();
		$('.form-talent').toggleAttr('required');
	}

	/**Hide the fields not related to the user's type on change*/
	$('input[name="usertype-register"]').on('change',function(){
		$('.form-agency').toggle();
		$('.form-agency').toggleAttr('required');
		$('.form-talent').toggle();
		$('.form-talent').toggleAttr('required');
	});

	$('#sign-up-nav').on('click',function(){
		$.getJSON("reg_request.php", function(data){
			if(data.loggedin){
				alert("Already Logged In.");
				window.location = "user-mode.php";
			}
		});
	});

	/**Whenever the submit button is clicked*/
	$('#register').submit(function(e){
		e.preventDefault();
		/**Pull values from form*/
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var email = $('#email-register').val();
		var password = $('#password-register').val();
		var usertype = $('input[name="usertype-register"]:checked').val();
		if("#myonoffswitch").is(':checked') == true){
			var agencytype = "Public";
		}else{
			var agencytype = "Private";
		}
		var corpname = $('#corpname').val();
		var phone = $('#phone').val();
		phone = phone.replace(/\D/g, '');
		var street = $('#street').val();
		var city = $('#city').val();
		var state = $('#state').val();
		var zip = $('#zip').val();
		var country = $('#country').val();

		/**send a post request to server with the form values*/
		$.ajax({
			type: 'POST',
			url: 'reg_request.php',
			data: {
				'done_reg': 1,
				'email': email, 
				'pass': password,
				'fname': fname,
				'lname': lname,
				'usertype': usertype,
				'agencytype': agencytype,
				'corpname': corpname,
				'phone': phone,
				'street': street,
				'city': city,
				'state': state,
				'zip': zip,
				'country': country
			},
			success: function(data){
		          //do something with the data via front-end framework
		          if (data == "User Already Exists"){
		          	$('div#reg-err-msg').html(data);
		          }else{
		          	alert("Successfully Registered");
		          	window.location = "index.php";
		          }
		      }
		  });
		return false;
	});

});

jQuery.fn.toggleAttr = function(attr) {
		return this.each(function() {
			var $this = $(this);
			if ($this.attr(attr)) {
				$this.removeAttr(attr);
			} else {
				$this.attr(attr, true);
			}
		});
	}