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
          removeCookie("UserType");
          removeCookie("UserId");
          removeCookie("ProjectId");
          window.location = "index.php";
        }
      });
      return false;
  });

});

function removeCookie(cname) {
    document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}