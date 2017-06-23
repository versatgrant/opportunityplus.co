$(document).ready(function(e){
	//Update Filter Value & Param
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).text();
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);
	});

    $('#submit-search').on('click', function(){
    	/**Pull values from form*/
    	var table = $('.input-group #search_param').val();
    	var searchterm = $('#search-value').val();
    	$.ajax({
    		type: 'POST',
    		url: 'search_request.php',
    		data: {
    			'done_search': 1,
    			'table': table,
    			'term': searchterm
    		},
    		dataType:'json',
    		success: function(data){
	        	//do something with the data via front-end framework
		        if(data.error == "No Results"){
		        	$('ul#result-list').empty();
		        	$('ul#result-list').append("<li>" + data.error + "</li>");
		      	}else if(table == "talent"){
		            $('ul#result-list').empty();
		            $.each(data.result, function(){
		            	$('ul#result-list').append("<li>" + this.fname + " " + this.lname + "</li>");
		            });
		        }else if(table == "agency"){
		            $('ul#result-list').empty();
		            $.each(data.result, function(){
		            	$('ul#result-list').append("<li> Agency Name: " + this.name + "</li>");
		            });
		        }else if(table == "project"){
		            displayProjects(data);
		        }
		    }
		});
	    	return false;
	});
});