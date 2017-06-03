$(document).ready(function(){

  $.getJSON("login_request.php", function(data){
    if(data.loggedin){
      alert("Already Logged In.");
      window.location = "project_list.php";
    }
});

  $('#submit-login').on('click', function(){
      /**Pull values from form*/
      var email = $('#login #email').val();
      var password = $('#login #password').val();
      var usertype = $('#login select#usertype').val();
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
            window.location = "project_list.php";
          }
        }
      });
      return false;
  });
});
