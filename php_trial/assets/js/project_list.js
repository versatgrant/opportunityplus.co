$(document).ready(function(){
  /*$.ajax({
      type: 'POST',
      url: 'project_list_request.php',
      data: {
        'project_load': 1,
      },
      success: function(data){
       //do something with the data via front-end framework
        alert("Ajax Request Sent successfully:"+data);
        //$.each();
        //location.reload();
      }
  });*/

  $.getJSON("project_list_request.php", function(data){
    if(data){
      $('ul#project-list').empty();
      $.each(data.result, function(){
        $('ul#project-list').append("<li> Id: "+this.Id+", Name: "+this.Name+"</li>");
      });
    }
  });

});
