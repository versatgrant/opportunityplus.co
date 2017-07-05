$(document).ready(function(){

	$.getJSON("user_mode_request.php", {'view_proj':1},function(data){
		if(data.user == "No Users Detected"){
			window.location = "index.php";
		}else{
			$('.container #result-list').on('click', '.parProject .view', function(){
				var project = $(this);
				if(project.data('project-access') == false){//should be true
					//alert("You do have access to this project");
					/*get Project Id to be used to build the project detail page*/
					var id = project.parent().parent().attr('id');
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
							clearScreen();
							/*BUILD MILESTONES*/
							buildMilestones(data.milestone);
							//buildProjViewModal();
						}
					});
				}else{
					//alert('You don\'t have access to this project. Send a project request to gain access.');
				}
				/*load kanban.js*/
				$.getScript("assets/js/kanban.js");
			});
		}
	});
});

function buildMilestones(milestone){
	$.each(milestone, function(){
		//alert("Got a Milestone: "+this.name);
		$('div#result-list').append(
			'<div class="panel panel-primary kanban-col">' + 
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