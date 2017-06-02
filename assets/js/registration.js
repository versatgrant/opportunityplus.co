$(document).ready(function(){

$.getJSON("reg_request.php", function(data){
    if(data.loggedin){
      alert("Already Logged In.");
      window.location = "project_list.php";
    }
});

/**Hide the fields not related to the user's type on load*/
  if($('select#usertype').val() == 'talent'){
    $('.form-agency').toggle();
  }else{
    $('.form-talent').toggle();
  }
  
/**Hide the fields not related to the user's type on change*/
  $('select#usertype').on('change',function(){
    $('.form-agency').toggle();
    $('.form-talent').toggle();
  });

/**Whenever the submit button is clicked*/
  $('#submit-reg').on('click', function(){
      /**Pull values from form*/
      var fname = $('#register #fname').val();
      var lname = $('#register #lname').val();
      var email = $('#register #email').val();
      var password = $('#register #password').val();
      var usertype = $('#register select#usertype').val();
      var agencytype = $("input:radio[name ='agencyPrivacyState']:checked").val();
      var corpname = $('#register #corpname').val();
      var phone = $('#register #phone').val();
      var street = $('#register #street').val();
      var city = $('#register #city').val();
      var zip = $('#register #zip').val();

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
          'zip': zip
        },
        success: function(data){
          //do something with the data via front-end framework
          if (data == "User Already Exists"){
            $('div#login-err-msg').html(data);
          }else{
            window.location = "login.php";
          }
        }
      });
      return false;
  });


});
