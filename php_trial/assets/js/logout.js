$(document).ready(function(){
  //location.reload();
  $('button#submit-logout').on('click', function(){
      $.ajax({
        type: 'POST',
        url: 'login_request.php',
        data: {
          'done_logout': 1,
        },
        success: function(data){
          //do something with the data via front-end framework
          alert(data);
          window.location = "login.php";
          
          //location.reload();
        }
      });
      return false;
  });

});
