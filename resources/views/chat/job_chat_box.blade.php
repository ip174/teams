@extends('layouts.app')
@section('title')
Job bidding | Job Chats
@endsection


@section('content')
<style>
.class_active>a>h4{
	color: #ff6666 !important;
}
.class_active>a>h4>small{
	color: #ff6666 !important;
}
</style>
<!--<div class="mainBody dashboard-container">-->
<div class="mainSite innerpage">

@include('layouts.jobs_common_header')

<section class="container taskcontent msg_page">
	<div class="task_title_wrap clearfix">
		<div class="task_titel pull-left">
			Messages
		</div>
		<div class="line_gp"></div>
		<div class="addtaskbtn clearfix pull-right">
	    	<button id="opentask" class="pull-right" title="New Massage">
	    		<i class="material-icons offltr">mode_edit</i>
	    		<i class="material-icons hidden">clear</i>
	    	</button>
	    	<!--<p class="pull-right">NEW MASSAGE</p>-->
	    </div>
    </div>

    <div class="row">
	    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 coloutcol">
	    	<div class="infobox panel-body">
	    		<div class="availability_people">
		    		<ul class="list-unstyled">
			    		@if($isJobProviderLoggedIn)
				    		@if(count($all_proposals) > 0)
					    		@foreach($all_proposals as $eachProposal)
					    		<li class="active_chat active_chat{{ $eachProposal->sent_by_user}}{{ $to_user_id == $eachProposal->sent_by_user ? ' class_active' : ''}}" data-id='{{ $eachProposal->sent_by_user}}' onclick="getChatDetails('{{ $job_id }}', '{{ $eachProposal->sent_by_user}}')">
					    			@php
					    			$profilePath = isset($eachProposal->user->profile_picture) ? $eachProposal->user->profile_picture : '';
					    			@endphp
					    			<a href="javascript:void(0);" class="avtartask">
							    		<div class="profilePic small" style="background-image:url({{ profilePicPath($profilePath) }}) center center / 100% auto;">
											<div class="shape"></div>
										</div>
										<h4>
											{{ $eachProposal->user->first_name }} {{ $eachProposal->user->last_name }}
											<small>{{ isset($eachProposal->userDet->jobType->job_title) ? $eachProposal->userDet->jobType->job_title : '' }}</small>
										</h4>
										<!--<div style="background-color:#61C46E;" class="status_msg"></div>-->
										<!-- add the color as inline css for busy or online -->
									</a>
								</li>
								@endforeach
							@endif
						@else
							<li class="active_chat active_chat{{ $jobProviderDetails->id}}" data-id='{{ $jobProviderDetails->id}}' onclick="getChatDetails('{{ $job_id }}', '{{ $jobProviderDetails->id}}')">
				    			<a href="javascript:void(0);" class="avtartask">
						    		<div class="profilePic small" style="background-image:url({{ profilePicPath($jobProviderDetails->profile_picture) }}) center center / 100% auto;">
										<div class="shape"></div>
									</div>
									<h4>
										{{ $jobProviderDetails->first_name }} {{ $jobProviderDetails->last_name }}
										<small>Job Provider</small>
									</h4>
									<!--<div style="background-color:#61C46E;" class="status_msg"></div>-->
									<!-- add the color as inline css for busy or online -->
								</a>
							</li>
						@endif
					</ul>
	    		</div><!-- people who busy or online -->

	    		@include('chat.chat_left_menu')
	    	</div>
	    </div><!-- col ]] -->
	    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 msg_list">
	   		<div class="panel-group infobox accordin_list" id="accordion" role="tablist" aria-multiselectable="true">
	   			<form action="{{ url('/chat/send-chat-email') }}" method="post" enctype="multipart/form-data" id="mailform" onsubmit="return validate_form();">
			    {{ csrf_field() }}
			    <input type="hidden" name="job_id" value="{{ $job_id }}">
			    <div class="infobox panel-body off fadeIn">
			    	<div class="form-group">
			    		<label>Hirer*</label><div class="clearfix"></div>
			    		<!--<input class="form-control" placeholder="To" name="email_to" id="email_to" type="text">-->
			    		@php
			    		$usersDetails = getUserEmailById($emailForUsers);
			    		//print_r($usersDetails); exit;
			    		$emailsArray = array();
			    		@endphp
			    		<select class="multipleSelect form-control" multiple name="email_to[]" id="email_to" required>
							@if(count($usersDetails) > 0)
								@foreach($usersDetails as $eachDetails)
								@php
								$emailsArray[] = $eachDetails->id;
								@endphp
								<option value="{{ $eachDetails->id }}">{{ $eachDetails->username }}</option>
								@endforeach
							@endif
						</select>

						@php
						$emailIds = implode(",", $emailsArray);
						@endphp
						<input name="toEmails" type="hidden" value="{{ $emailIds }}">
			    	</div>
			    	<div class="form-group">
			    		<label>Subject</label>
			    		<input class="form-control" placeholder="" name="" type="text">
			    	</div>
			    	<div class="form-group">
			    		<textarea class="form-control" rows="10" cols="" placeholder="Type you message here" name="message" required>{{ old('message') }}</textarea>
					</div>
			    	<div class="form-group">
			    		<label>Attachements</label><div class="clearfix"></div>
			    		<label class="btn btn-success btntheme text-white">Drop file here or Browse<input class="hidden" name="attachedFile" type="file"></label><div class="clearfix"></div>
			    	</div>					
					<div class="text-right"><input value="Send" class="btn btn-success btntheme btn-lg" name="" type="submit"></div>
			    </div>
			    </form>
		   		<div class="chat_message_area on">
			   		@php
		   			$all_chats = $latest_chats;
		   			@endphp
		   			@include('chat.chat_content')
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
	
	setInterval(function(){
		$('.fstQueryInput').removeAttr('placeholder');
		$('.fstQueryInput').attr('onpaste', 'return false');
		$('.fstQueryInput').attr('ondrop', 'return false');
	}, 1);
	$('.fstNoneSelected').css('width', '100% !important');

    $("#opentask").click(function(){
        $(".taskcontent").toggleClass("open");
        $("#opentask").toggleClass("openn");
    });

    $(".tomarkstar").click(function(){
    	//alert($(this).attr('data-id'));
    	var currentSlNo = $(this).attr('data-id');
        $("#iclass"+currentSlNo).toggleClass("fa-star");
    });

    $("#chatform").validate({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});

    $("#mailform").validate({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});
});

function getChatDetails(job_id, to_user_id){
	//alert(job_id);
	//alert(to_user_id);
	var request_url = '{{ url('chat/get-chat-messages') }}';
	$(".active_chat").removeClass('class_active');
	$(".active_chat"+to_user_id).addClass('class_active');
	process.on();
	$.ajax({
		type:'post',
		url:request_url,
		data:{
			is_ajax:true,
			job_id:job_id,
			to_user_id:to_user_id
		},
		success:function(response){
			//var res = $.parseJSON(response);
			$(".chat_message_area").html(response.html);
			$('.message').prop('required', true);
			validate_form();
			process.off();
		}, error: function(){
			alert("Oops! Something went wrong, try again later.");
		}
	});
}

function validate_form(){
	$("#chatform").validate({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});
}

function setStarredMsg(msgId){
	//e.preventDefault();
	var request_url = '{{ url('chat/set-as-starred-messages') }}';
	$.ajax({
		type:'post',
		url:request_url,
		data:{
			is_ajax:true,
			msgId:msgId
		},
		success:function(response){
			//var res = $.parseJSON(response);
			
			process.off();
		}, error: function(){
			alert("Oops! Something went wrong, try again later.");
		}
	});
}

function deleteMsg(msgId){
	var request_url = '{{ url('chat/chatdelete-messages') }}';
	$.ajax({
		type:'post',
		url:request_url,
		data:{
			is_ajax:true,
			msgId:msgId
		},
		success:function(response){
			//var res = $.parseJSON(response);
			$(".messageLi"+msgId).html('<div class="panel-heading clearfix" role="tab" id="headingOne"><label class="i-checks pull-left"></label><div class="pull-left left_msg" role="button" data-toggle="collapse"><div href="javascript:void(0);" class="avtartask"><div class=""><div class="shape"></div></div><h6 class="clearfix"><span style="color:#61c46e">Deleted successfully!</span></h6></div></div><ul class="right_msg list-inline pull-right"><li><button id="tomarkstar" class="star_mark"><i id="iclass" class="fa fa-star-o"></i></button></li><li class="msg_date">27 Jun</li><li class="dropdown"><button class="msg_button dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button></li></ul></div>');
			setTimeout(function(){
				$(".messageLi"+msgId).remove();
			}, 1500);
			
			process.off();
		}, error: function(){
			alert("Oops! Something went wrong, try again later.");
		}
	});
}
</script>


@endsection