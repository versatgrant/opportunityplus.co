$(document).ready(function(){

	$.getJSON("user_mode_request.php", {'view_proj':1},function(data){
		if(data.user == "No Users Detected"){
			window.location = "index.php";
		}else{
			$('.container #result-list').on('click', '.parProject .view', function(){

				var project = $(this);
				if(project.data('project-access') == true){
					showProjectDetailButtons();
					$('div#result-list').css('flex-wrap','nowrap');
					//alert("You do have access to this project");
					/*get Project Id to be used to build the project detail page*/
					var id = project.parent().parent().attr('id');
					//alert(id);
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

	/*NEW TASK ONCLICK LISTENER*/
	$('.container #result-list').on('click', 'a.newTask', function(){
		//alert('new task button clicked');
		/*GET TALENTS THAT HAVE ACCESS TO THIS PROJECT*/
		/*PASS THIS TO A FUNCTION*/
		getTaskTalent_new($(this));
	});

	/*NEW TASK ONSUBMIT LISTENER*/
	$('#newTaskForm').on('submit', function(e){
		//alert("");
		e.preventDefault();
		/*GET VALUES FROM FORM*/
		var milestoneId = $('#task-milestone-id').val();
		var taskName = $('#new-task-name').val();
		var assignedTalent = $('#new-task-talent').val();
		var taskAmount = $('#new-task-amount').val();
		var taskDescription = $('#new-task-desc').val();
		var taskCompletionState = $('#new-task-completion').val();

		$.ajax({
			type:"POST",
			url:"project_detail_request.php",
			dataType: "json",
			data:{
				'new_task':1,
				'milestoneId':milestoneId,
				'name':taskName,
				'talentId':assignedTalent,
				'amount':assignedTalent,
				'desc':taskDescription,
				'completed':taskCompletionState
			},
			success:function(data){
				/*CLOSE MODAL*/
				$('#newTaskModal').removeClass('in');
				$('.modal-backdrop').removeClass('in');
				$('#newTaskModal').css('display','none');
				$('.modal-backdrop').css('display','none');
				/*RESET MILESTONES ON SCREEN*/
				reloadProjectDetails(getCookie("ProjectId"));
				/*LOAD kanban.js*/
				$.getScript("assets/js/kanban.js");
				//buildProjViewModal();
			}
		});
	});

	/*EDIT TASK ONCLICK LISTENER*/
	$('.container #result-list').on('click', '.editTask', function(){
		//alert("task edit button clicked");

		getTaskTalent_edit($(this));

		/*GET TASK ID*/
		var id = $(this).parent().parent().parent().parent().data('task-id');
		$('#edit-task-id').val(id);

		/*GET VALUES FROM DATABASE*/
		$.getJSON("project_detail_request.php", {'edit_task':1, 'id': id},function(data){
			/*PUSH VALUES INTO FORM*/
			$('#edit-task-milestone-id').val(data.task[0].milestone);
			$('#edit-task-name').val(data.task[0].name);
			$('#edit-task-completion').val(data.task[0].completed);
			$('#edit-task-talent').val(data.task[0].talent);
			$('#edit-task-amount').val(data.task[0].amount);
			$('#edit-task-desc').val(data.task[0].desc);
		});

	});

	/*UPDATE TASK ONSUBMIT LISTENER*/
	$('#editTaskForm').on('submit', function(e){
		e.preventDefault();
		/*GET FORM VALUES*/
		var id = $('#edit-task-id').val();
		var name = $('#edit-task-name').val();
		var completed = $('#edit-task-completion').val();
		var talent = $('#edit-task-talent').val();
		var amount = $('#edit-task-amount').val();
		var desc = $('#edit-task-desc').val();

		$.ajax({
			type:"POST",
			url:"project_detail_request.php",
			dataType: "json",
			data:{
				'update_task':1,
				'id':id,
				'name':name,
				'completed':completed,
				'talent':talent,
				'amount':amount,
				'desc':desc
			},
			success:function(data){
				/*CLOSE MODAL*/
				$('#editTaskModal').removeClass('in');
				$('.modal-backdrop').removeClass('in');
				$('#editTaskModal').css('display','none');
				$('.modal-backdrop').css('display','none');
				/*RESET MILESTONES ON SCREEN*/
				reloadProjectDetails(getCookie("ProjectId"));
				/*LOAD kanban.js*/
				$.getScript("assets/js/kanban.js");
				//buildProjViewModal();
			}
		});
	});

	/*VIEW PROJECT DETAILS ONCLICK LISTENER*/
	$('#viewProjDetails').on('click', function(){
		//send a get json to load the form fields
		var id = getCookie("ProjectId");
		$.getJSON("project_detail_request.php", {'get_proj_details':1, 'id': id},function(data){
			/*POPULATE PROJECT VIEW FORM WITH RETURNED VALUES*/
			if(data.project[0].privacy == "Private"){
				$('#view-project-myonoffswitch').prop('checked', false);
			}else if(data.project[0].privacy == "Public"){
				$('#view-project-myonoffswitch').prop('checked', true);
			}
			$('#view-project-name').val(data.project[0].name);
			$('#view-project-startdate').val(data.project[0].start);
			$('#view-project-enddate').val(data.project[0].end);

			$('#view-project-location-sensitive').empty();
			$('#view-project-location-sensitive').append('<option value="'+ data.project[0].zone +'">' + data.project[0].zone + '</option>');
			$('#view-project-location-sensitive').val(data.project[0].zone);
			$('#view-project-street').val(data.project[0].street);
			$('#view-project-city').val(data.project[0].city);

			$('#view-project-state').empty();
			$('#view-project-state').append('<option value="'+ data.project[0].state +'">' + data.project[0].state + '</option>');
			$('#view-project-state').val(data.project[0].state);

			$('#view-project-zip').val(data.project[0].zip);
			$('#view-project-country').val(data.project[0].country);
			$('#view-project-desc').val(data.project[0].desc);
			$('#view-project-cost').val(data.project[0].cost);


		});
	});
	

	/*EDIT MILESTONE ONCLICK LISTENER*/
	$('.container #result-list').on('click', '.editMilestone', function(){
		/*GET THE ID OF THE MILESTONE*/
		var id = $(this).parent().parent().data('milestone-id');
		//alert(id);
		/*SEND A GETJSON REQUEST TO GET ALL THE DETAILS OF THE MILESTONE*/
		$.getJSON("project_detail_request.php", {'get_milestone':1, 'id': id},function(data){
			/*POPULATE MILESTONE EDIT FORM WITH RETURNED VALUES*/
			$('#edit-milestone-id').val(data.milestone[0].id);
			$('#edit-milestone-name').val(data.milestone[0].name);
			$('#edit-milestone-pos').val(data.milestone[0].pos);
			$('#edit-milestone-startdate').val(data.milestone[0].start);
			$('#edit-milestone-enddate').val(data.milestone[0].start);
		});
	});

	//UPDATE MILESTONE ONSUBMIT LISTENER
	$('#editMilestoneForm').on('submit', function(e){
		e.preventDefault();
		//alert("edit milestone form submitted");
		/*GET VALUES FROM FORM FIELDS*/
		var id = $('#edit-milestone-id').val();
		var name = $('#edit-milestone-name').val();
		var pos = $('#edit-milestone-pos').val();
		var start = $('#edit-milestone-startdate').val();
		var end = $('#edit-milestone-enddate').val();

		/*SEND THOSE VALUES TO THE SERVER*/
		$.ajax({
			type:"POST",
			url:"project_detail_request.php",
			dataType: "json",
			data:{
				'edit_milestone':1,
				'id':id,
				'name':name,
				'pos':pos,
				'start':start,
				'end':end
			},
			success:function(data){
				/*CLOSE MODAL*/
				$('#editMilestoneModal').removeClass('in');
				$('.modal-backdrop').removeClass('in');
				$('#editMilestoneModal').css('display','none');
				$('.modal-backdrop').css('display','none');
				/*RESET MILESTONES ON SCREEN*/
				reloadProjectDetails(getCookie("ProjectId"));
				/*LOAD kanban.js*/
				$.getScript("assets/js/kanban.js");
				//buildProjViewModal();
			}
		});
	});

});

function buildMilestones(milestone){
	$.each(milestone, function(){
		//alert("Got a Milestone: "+this.name);
		$('div#result-list').append(
			'<div class="panel panel-primary kanban-col" data-project-id="'+ this.projectid +'" data-milestone-id="' + this.id + '">' + 
				'<div class="panel-heading">' + 
					this.name + 
					'<a href="#editMilestoneModal" class="editMilestone pull-right" data-toggle="modal"> ' + 
						'<i class="fa fa-lg fa-pencil" style="color:#FFFFFF;"></i>' + 
					'</a>' + 
				'</div>' + 
				'<div class="panel-body" style="height:auto;">' + 
					'<div class="kanban-centered">' + 
						buildTasks(this.id, this.tasks) + 
					'</div>' + 
				'</div>' + 
				'<div class="panel-footer">' + 
					'<a href="#newTaskModal" class="newTask" data-toggle="modal">Add a task...</a>' + 
				'</div>' + 
			'</div>'
			);
	});
}

function buildTasks(milestoneId, tasks){
	var taskCode = "";
	$.each(tasks, function(){
		if(this.milestone == milestoneId){

			if(this.completed == 1){
				var completed = "Completed";
			}else{
				var completed = "In-Progress";
			}


			taskCode += 
			'<article class="kanban-entry" data-task-id="'+ this.id + '" data-milestone-id="' + this.milestone + '">' + 
				'<div class="kanban-entry-inner">' + 
					'<div class="kanban-label">' + 
						'<div class="toolbar">' + 
							'<a href="#task" class="pull-right tool delete" style="color: black;">' + 
								'<span class="glyphicon glyphicon-remove"></span>' + 
							'</a>' + 
						'</div>' + 
						'<h2><span style="color:black;">' + this.name + '</span></h2>' + 
						'<p>' + 
							truncate(this.desc, 197) + 
							'<br>' + 
								'<a href="#editTaskModal" class="editTask" data-toggle="modal" style="text-decoration:underline;color:black;">Edit</a>' + 
								'<span class="pull-right badge ' + completed + '">' + completed + '</span>' +
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

function reloadProjectDetails(id){
	showProjectDetailButtons();
	$('div#result-list').css('flex-wrap','nowrap');
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
}

function getTaskTalent_edit(thisOBJ){
	var id = getCookie("ProjectId");
	$('#edit-task-milestone-id').val(thisOBJ.parent().parent().parent().parent().parent().parent().parent().data('milestone-id'));
	//alert(id);
	$.getJSON("project_detail_request.php", {'get_task_talents':1, 'id': id},function(data){
		$('#edit-task-talent').empty();
		$.each(data.taskTalents, function(){
			$('#edit-task-talent').append('<option value="'+this.id+'">'+this.fname+' '+this.lname+'</option>');
		});

		//FINISH EDITING THIS FUNCTION; IT SHOULD PULL ALL THE TALENTS THAT HAVE ACCESS TO thIS PROJECT AND SET THE TALENT THAT HAS ACCESS TO THIS TASK AS THE SELECTED TALENTS
	});
}

function getTaskTalent_new(thisOBJ){
	var id = getCookie("ProjectId");
	$('#task-milestone-id').val(thisOBJ.parent().parent().data('milestone-id'));
	//alert(id);
	$.getJSON("project_detail_request.php", {'get_task_talents':1, 'id': id},function(data){
		$('#new-task-talent').empty();
		$.each(data.taskTalents, function(){
			$('#new-task-talent').append('<option value="'+this.id+'">'+this.fname+' '+this.lname+'</option>');
		});
	});
}