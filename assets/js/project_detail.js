$(document).ready(function(){

	$.getJSON("user_mode_request.php", {'view_proj':1},function(data){
		if(data.user == "No Users Detected"){
			window.location = "index.php";
		}else{
			$('.container #result-list').on('click', '.parProject .view', function(){

				showProjectDetailButtons();
				$('div#result-list').css('flex-wrap','nowrap');

				var project = $(this);
				if(project.data('project-access') == true){//should be true
					//alert("You do have access to this project");
					/*get Project Id to be used to build the project detail page*/
					var id = $(this).parent().parent().attr('id');
					$.ajax({
						type:"GET",
						url:"project_detail_request.php",
						dataType: "json",
						async: false,
						data:{
							'view_proj_detail':1, 
							'id':id
						},
						success:function(data){
							setCookie("ProjectId", data.project[0].id, 10);
							clearScreen();
							/*BUILD MILESTONES*/
							buildMilestones(data.milestone);
							//buildProjViewModal();
						}
					});
				}else{
					alert('You don\'t have access to this project. Send a project request to gain access.');
				}
				/*load kanban.js*/
				$.getScript("assets/js/kanban.js");
			});
		}
	});

	/*NEW MILESTONE ONSUBMIT LISTENER*/
	$('#newMilestoneForm').on('submit', function(e){
		e.preventDefault();
		//get data from form
		var name = $('#new-milestone-name').val();
		var start = $('#new-milestone-startdate').val();
		var end = $('#new-milestone-enddate').val();
		var pos = $('#new-milestone-pos').val();
		var projectid = getCookie("ProjectId");

		$.ajax({
			type:"POST",
			url:"project_detail_request.php",
			dataType: "json",
			data:{
				'new_milestone':1, 
				'projectid':projectid,
				'name':name,
				'start':start,
				'end':end,
				'pos':pos
			},
			success:function(data){
				/*CLOSE MODAL*/
				$('#newMilestoneModal').removeClass('in');
				$('.modal-backdrop').removeClass('in');
				$('#newMilestoneModal').css('display','none');
				$('.modal-backdrop').css('display','none');
				/*ADD MILESTONE TO SCREEN*/
				buildMilestones(data.milestone);
				/*load kanban.js*/
				$.getScript("assets/js/kanban.js");
				//buildProjViewModal();
			}
		});
	});

	/*VIEW PROJECT ONCLICK LISTENER*/
	//send a get json to load the form fields

	/*VIEW MILESTONE ONSUBMIT LISTENER*/
	//UPDATE MILESTONE ONSUBMIT LISTENER

});

function buildMilestones(milestone){
	$.each(milestone, function(){
		//alert("Got a Milestone: "+this.name);
		$('div#result-list').append(
			'<div class="panel panel-primary kanban-col" data-project-id="'+ this.projectid +'">' + 
				'<div class="panel-heading">' + 
					this.name + 
					'<i class="fa fa-lg fa-pencil pull-right"></i>' + 
				'</div>' + 
				' <div class="panel-body" style="height:auto;">' + 
					'<div id="' + this.id + '" class="kanban-centered">' + 
						buildTasks(this.id, this.tasks) +
					'</div>' + 
				'</div>' + 
				'<div class="panel-footer">' + 
					'<a href="#">Add a task...</a>' + 
				'</div>' + 
			'</div>'
		);
	});
}

function buildTasks(milestoneId, tasks){
	var taskCode = "";
	$.each(tasks, function(){
		if(this.milestone == milestoneId){
			taskCode += 
			'<article class="kanban-entry" id="'+ this.id + '">' + 
				'<div class="kanban-entry-inner">' + 
					'<div class="kanban-label">' + 
						'<h2><span style="color:black;">' + this.name + '</span></h2>' + 
						'<p>' + 
							truncate(this.desc, 197) + 
							'<br>' + 
								'<a href="#" style="text-decoration:underline;color:black;">Edit</a>' + 
								'<span class="pull-right badge Public">' + this.completed + '</span>' +
							'<br>' + 
						'</p>' + 
					'</div>' + 
				'</div>' + 
			'</article>';
		}		
	});
	return taskCode;
}

function showProjectDetailButtons(){
	/*Hide Project Detail View Button*/
	$('#viewProjDetails').css('display', 'block');
	$('#newMilestone').css('display', 'block');
	$('#newPA').css('display', 'none');
	if(getCookie("UserType") == "talent"){
		$('#newMilestone').css('display', 'none');
		//$('#viewProjDetails').css('position', 'relative');
		$('#viewProjDetails').offset({ top: -35});
		//$('#viewProjDetails').css('position', 'absolute');
	}
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}