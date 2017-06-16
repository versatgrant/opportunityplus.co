$(document).ready(function(){
  $.getJSON("project_list_request.php", function(data){
    if(data.result == "No Users Detected"){
      window.location = "index.php";
    }else{
      $('ul#project-list').empty();
      $.each(data.result, function(){
        $('ul#project-list').append("<li> Project Name: " + this.name + ", Active?: " + this.active + ", Completed?: " + this.complete + "</li>");
      });
    }
  });

});
