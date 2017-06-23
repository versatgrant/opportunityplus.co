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
          window.location = "index.php";
          removeCookie("UserType");
        }
      });
      return false;
  });

});

function removeCookie(cname) {
    document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}