$(document).ready(function(){

  $('form').on('submit', function(){
      /**Pull values from form*/
      var email = $('#login #email');
      var password = $('#login #email');
      var loginAppl = {email: email.val(), pass: password.val()};

      $.ajax({
        type: 'POST',
        url: '/login',
        data: loginAppl,
        success: function(data){
          //do something with the data via front-end framework
          location.reload();
        }
      });

      return false;

  });

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
