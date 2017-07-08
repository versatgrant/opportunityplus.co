$(document).ready(function(e){
	//Update Filter Value & Param
	$('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).text();
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);
	});

	$('#search-value').keypress(function (e){
		var key = e.which;
		 if(key == 13)  // the enter key code
		 {
		 	$('#submit-search').trigger('click');
		 	closeNavDrawer(); 
		 }
	});   

	$('#submit-search').on('click', function(){
		/*Set appropriate styling on result container*/
		$('div#result-list').css('flex-wrap','wrap');

		/**Pull values from form*/
		var table = $('.input-group #search_param').val();
		var searchterm = $('#search-value').val();
		closeNavDrawer();
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
		        		clearScreen();
		        		displayTalents(data);
		        	}else if(table == "agency"){
		        		clearScreen();
		        		displayAgencies(data);
		        	}else if(table == "project"){
		        		clearScreen();
		        		displayProjects(data);
		        	}
		        }
		    });
		return false;
	});
});