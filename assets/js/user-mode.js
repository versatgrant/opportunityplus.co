$(document).ready(function(){
  $.getJSON("user_mode_request.php", function(data){
    if(data.result1 == "No Users Detected"){
      window.location = "index.php";
    }else{
      $('h2#username').empty();
      if(data.result1.usertype == "agency"){
        $('h2#username').html(data.result1[0]["aname"]);
      }else{
        $('h2#username').html(data.result1[0]["fname"] + " " + data.result1[0]["lname"]);
      }
      

      /*LOAD PROJECTS ONTO PAGE*/
      $('ul#result-list').empty();
      $.each(data.result, function(){
        $('ul#result-list').append("<li> Project Name: " + this.name + ", Active?: " + this.active + ", Completed?: " + this.complete + "</li>");
      });
    }
  });

});
