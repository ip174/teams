@extends('layouts.app')
@section('title')
Job bidding | Workflow - View Task
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
			<span class="on">View Task</span>
		</div>
		<div class="line_gp"></div>
    </div>
    <div class="infobox panel-body on fadeIn">
    	
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    		<div class="row">
    			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">
    				<label>Task Title*</label>
    				<div class="input-group">{{ $taskDetails->title }}</div>
    			</div>
		    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 form-group">
    				<label>Select Category*</label>
    				@php
					$tasks = config('constants.TASKS');
					$taskType = $tasks[$taskDetails->type];
					@endphp
					<div class="input-group">{{ $taskType }}</div>
		    	</div>
    		</div>

    		<div class="form-group">
    			<label>Description*</label>
    			<div class="input-group">{!! nl2br($taskDetails->description) !!}</div>
    		</div>

    		<div class="form-group">
				<label>Attachment</label>
				@if(count($taskAttachments) > 0)
				@foreach($taskAttachments as $eachAttachment)
				<div class="input-group">
				<a href="{{ asset('/assets/upload/job_tasks/'.$eachAttachment->file_name) }}" download>Download</a>
				</div>
				@endforeach
				@endif
			</div>
    	</div><!--  col ]] -->

    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    	<div class="panel-body">
    		<div class="form-group">
	    		<label>Assign to*</label>
	    		<div class="avtartask">
		    		<div class="profilePic small" style="background:url({{ profilePicPath($taskAssignedMembers->user_assignedTo->profile_picture) }}) no-repeat center center / 100% auto;">
						<div class="shape"></div>
					</div>
					<h4>
						{{ isset($taskAssignedMembers->user_assignedTo->first_name) ? $taskAssignedMembers->user_assignedTo->first_name : '' }}
						{{ isset($taskAssignedMembers->user_assignedTo->last_name) ? $taskAssignedMembers->user_assignedTo->last_name : '' }}
					</h4>
				</div>
    		</div>

    		<div class="form-group">
	    		<label>Due Date*</label>
	    		<div class="input-group due_date_area">			     
			    	@php
			    	$dueDate = isset($taskAssignedMembers->due_date) ? date('d/m/Y', strtotime($taskAssignedMembers->due_date)) : '';
			    	@endphp
			    	{{ $dueDate }}
			    </div>
    		</div>

    		<div class="form-group">
	    		<label>Priority*</label>
	    		<div class="input-group priority">
			      {{$taskAssignedMembers->priority}}
			    </div>
    		</div>

    		<div class="form-group">
	    		<label>Approved by</label>
	    		<div class="avtartask">
		    		<div class="profilePic small" style="background:url({{ profilePicPath($taskAssignedMembers->user_assignedBy->profile_picture) }}) no-repeat center center / 100% auto;">
						<div class="shape"></div>
					</div>
					<h4>
						{{ isset($taskAssignedMembers->user_assignedBy->first_name) ? $taskAssignedMembers->user_assignedBy->first_name : '' }}
						{{ isset($taskAssignedMembers->user_assignedBy->last_name) ? $taskAssignedMembers->user_assignedBy->last_name : '' }}
					</h4>
				</div>
    		</div>
    		</div>
    	</div>
    	
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
</script>


@endsection