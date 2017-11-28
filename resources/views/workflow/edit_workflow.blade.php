@extends('layouts.app')
@section('title')
Job bidding | Workflow - Edit task
@endsection


@section('content')
<style>
.class_active>a>h4{
	color: #ff6666 !important;
}
.class_active>a>h4>small{
	color: #ff6666 !important;
}
.assigned_by_me{
	background-color:#e8fdf5
}
</style>
<!--<div class="mainBody dashboard-container">-->
<div class="mainSite innerpage">
@include('layouts.jobs_common_header');

<section class="container taskcontent">
	<div class="task_title_wrap clearfix">
		<div class="task_titel pull-left">
			<span class="on">Milestones &amp; Task</span>
		</div>
		<div class="line_gp"></div>
		<div class="addtaskbtn clearfix pull-right">
	    	<p class="pull-right"></p>
	    </div>
    </div>
    <div class="infobox panel-body on fadeIn">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    	@if(session()->has('message'))
				<div class="alert alert-success" style="margin-left:15px;">
					<ul>
						<li>{{ session()->get('message') }}</li>
					</ul>
				</div>
			@endif
			@if(session()->has('error_message'))
				<div class="alert alert-danger" style="margin-left:15px;">
					<ul>
						<li>{{ session()->get('error_message') }}</li>
					</ul>
				</div>
			@endif
		</div>
    	<form action="{{ url('/workflow/update-task') }}" method="post" enctype="multipart/form-data" id="task_assign_form">
    		{{ csrf_field() }}
    		<input type="hidden" name="job_id" value="{{ $job_id }}">
    		<input type="hidden" name="assigned_by_user" value="{{ isset($assignedBy->id) ? $assignedBy->id : '' }}">
    		<input type="hidden" name="assigned_to_user" value="{{ isset($assignedTo->id) ? $assignedTo->id : '' }}">
    		<input type="hidden" name="task_id" value="{{ isset($task_id) ? $task_id : '' }}">
	    	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	    		<div class="row">
	    			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">
	    				<label>Task Title*</label>
	    				<input class="form-control" placeholder="Type the title here" name="title" type="text" value="{{ $taskDetails->title }}" required>
	    			</div>
			    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 form-group">
	    				<label>Select Category*</label>
	    				<select class="form-control minimal" name="type" required>
	    					<option value=""> -Select- </option>
	    					@php
	    					$tasks = config('constants.TASKS');
	    					//print_r($tasks);
	    					@endphp
	    					@foreach($tasks as $eachTasksKey=>$eachTasksValue)
	    						<option value="{{ $eachTasksKey }}"> {{ $eachTasksValue }} </option>
	    					@endforeach
	    				</select>
			    	</div>
	    		</div>

	    		<div class="form-group">
	    			<label>Description*</label>
	    			<textarea class="form-control" placeholder="Type here the description" cols="" rows="6" name="description" required>{{ $taskDetails->description }}</textarea>
	    		</div>

	    		<div class="form-group">
					<label>Attachment</label>
					@if(count($taskAttachments) > 0)
						@foreach($taskAttachments as $eachAttachment)
							<div class="input-group existFile{{ $eachAttachment->id }}">
								<a href="{{ asset('/assets/upload/job_tasks/'.$eachAttachment->file_name) }}" download>{{$eachAttachment->file_name}}</a>
								&nbsp;&nbsp;
								<span class="pull-right">
									<a href="javascript:void(0)" onclick="delete_attachment('{{ $eachAttachment->id }}')" title="Remove" class="danger tooltips">
										<i class="fa fa-trash-o fa-2"></i>
									</a>
								</span>
							</div>
						@endforeach
						<br />
					@endif
					<label class="uploadBox">
						<input type="file" name="attachments" class="attachments" onchange="show_fileName('attachments')">
						<div class="txtF fileDrugDrop">
							<i class="fa fa-microphone"></i>
							<i class="fa fa-video-camera"></i>
							Drop file here or <span>Brows</span>
						</div>
					</label>
				</div>
	    	</div><!--  col ]] -->

	    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
	    	<div class="panel-body">
	    		<div class="form-group">
		    		<label>Assign to*</label>
		    		<div class="avtartask">
			    		<div class="profilePic small" style="background:url({{ profilePicPath($assignedTo->profile_picture) }}) no-repeat center center / 100% auto;">
							<div class="shape"></div>
						</div>
						<h4>
							{{ isset($assignedTo->first_name) ? $assignedTo->first_name : '' }}
							{{ isset($assignedTo->last_name) ? $assignedTo->last_name : '' }}
							<small>{{ isset($assignedTo->userdet->jobType->job_title) ? $assignedTo->userdet->jobType->job_title : '' }}</small>
						</h4>
					</div>
	    		</div>

	    		<div class="form-group">
		    		<label>Due Date*</label>
		    		<div class="input-group due_date_area">			     
				    	<input class="form-control" id="" placeholder="Due Date" type="text" name="due_date" value="{{ date('d/m/Y', strtotime($taskAssignedMembers->due_date)) }}" required>
					    <div class="input-group-addon">
					    	<i class="fa fa-calendar" aria-hidden="true"></i>
					    </div>
				    </div>
	    		</div>

	    		<div class="form-group">
		    		<label>Priority*</label>
		    		<div class="input-group priority">
				      <div class="input-group-addon"><img src="{{ asset('assets/frontend/images/arrow-up.png') }}" class="img-responsive"></div>
				      <input class="form-control" id="" placeholder="Priority" type="text" name="priority" value="{{ $taskAssignedMembers->priority }}" required>
				      <div class="input-group-addon"><img src="{{ asset('assets/frontend/images/priority-right-icon.png') }}" class="img-responsive"></div>
				    </div>
	    		</div>

	    		<div class="form-group">
		    		<label>Approved by</label>
		    		<div class="avtartask">
			    		<div class="profilePic small" style="background:url({{ profilePicPath($assignedBy->profile_picture) }}) no-repeat center center / 100% auto;">
							<div class="shape"></div>
						</div>
						<h4>
							{{ isset($assignedBy->first_name) ? $assignedBy->first_name : '' }}
							{{ isset($assignedBy->last_name) ? $assignedBy->last_name : '' }}
							<small>{{ isset($assignedBy->userdet->jobType->job_title) ? $assignedBy->userdet->jobType->job_title : '' }}</small>
						</h4>
					</div>
	    		</div>
	    		</div>
	    	</div><!-- col ]] -->
	    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right">
	    		@if(count($assignedBy) > 0 && count($assignedTo) > 0)
	    			<button type="submit" name="assign_task" class="btn btn-success pull-right">Assign task</button>
	    		@endif
	    	</div>
    	</form>
    </div>

    
</section>
</div>
@endsection


@section('customScript')


<script>
$(document).ready(function(){
    $("#opentask").click(function(){
        $(".taskcontent").toggleClass("open");
    });

    $.validator.addMethod(
	    "customFormatDate",
	    function(value, element) {
	        // put your own logic here, this is just a (crappy) example
	        return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
	    },
	    "Please enter a date in the format dd/mm/yyyy."
	);

    $("#task_assign_form").validate({
		rules: {
			'priority': {
				required: true,
				number: true
			},
			'due_date': {
				required: true,
				customFormatDate: true
			}
		},
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});

function delete_attachment(attachment_id){
	var r = confirm("Are you sure to delete?");
	if(r){
		$.ajax({
			type:'post',
			url:'{{ url("/workflow/delete-attachment") }}',
			data:{
				isAjax:true,
				attachment_id:attachment_id
			},
			success:function(response){
				//var res = $.parseJSON(response);
				if(response.status==1){
					$(".existFile"+attachment_id).html('Successfully removed!');
					setTimeout(function(){
						$(".existFile"+attachment_id).remove();
					}, 2000);
				}
			}, error: function(){
				alert("Oops! Something went wrong, try again later.");
			}
		});
	}
}
</script>


@endsection