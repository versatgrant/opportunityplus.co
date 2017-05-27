$(document).ready(function(){
  //location.reload();
  $('#submit-login').on('click', function(){
      /**Pull values from form*/
      var email = $('#login #email').val();
      var password = $('#login #password').val();
      $.ajax({
        type: 'POST',
        url: 'login_request.php',
        data: {
          'done_login': 1,
          'email': email, 
          'pass': password
        },
        success: function(data){
          //do something with the data via front-end framework
          if(data == "Incorrect Username/Password"){
            $('div#login-err-msg').html(data);
          }else{
            //alert(data);
            window.location = "project_list.php";
          }
          
          //location.reload();
        }
      });
      return false;
  });

  /*var displayProjectPage = function(){
    alert("Project Page Function Running");
    //nothing yet
  }*/

  /*$('li').on('click', function(){
      var item = $(this).text().replace(/ /g, "-");
      $.ajax({
        type: 'DELETE',
        url: '/todo/' + item,
        success: function(data){
          //do something with the data via front-end framework
          location.reload();
        }
      });
  });*/
});
