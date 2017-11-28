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

@if($is_ajax || count($all_chats) > 0)
<form action="{{ url('/chat/send-chat-messages') }}" method="post" enctype="multipart/form-data" id="chatform" onsubmit="return validate_form();">
{{ csrf_field() }}
<input type="hidden" name="job_id" value="{{ $job_id }}">
<input type="hidden" name="to_user_id" value="{{ $to_user_id }}">

<div class="panel-body">
  	<div class="form-group">
  		<textarea class="form-control message" rows="3" cols="" placeholder="Reply here" name="message" required></textarea>
  	</div>
  	<div class="text-right">
  		<input class="btn btn-success btntheme" value="SEND" name="frm_submit" type="submit">
  	</div>
</div>
</form>
@endif

@if(count($all_chats) > 0)
   	@php
   	$counter = 0;
   	@endphp
   	@foreach($all_chats as $each_chat)
   		@php
   		$counter = $counter +1;
   		@endphp

   		@if(($each_chat->user_id==$authUser && $each_chat->deleted_by_sender == 0) || ($each_chat->to_user_id==$authUser && $each_chat->deleted_by_receiver == 0))
		<li class="messageLi{{$each_chat->id}}" style="margin-left:15px;">
   			<div class="panel-heading clearfix" role="tab" id="headingOne">
   				<label class="i-checks pull-left">
					<input name="remember" type="checkbox">
					<i></i>
				</label><!-- checkbox -->

	   			<div class="pull-left left_msg" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$counter}}" aria-expanded="true" aria-controls="collapseOne{{$counter}}">
	   				<div href="javascript:void(0);" class="avtartask" style="{{$each_chat->user_id==$authUser ? 'background-color:#e6ecff;' : '' }}">
			    		<div class="profilePic small" style="background:url({{ profilePicPath('') }}) no-repeat center center / 100% auto;">
							<div class="shape"></div>
						</div>
						<h6 class="clearfix">
							<span class="">{{ $each_chat->message_subject }}</span>
						</h6>
					</div>			   				
        		</div><!-- avatar photo and name -->
				<ul class="right_msg list-inline pull-right">
					<li>
						<button id="tomarkstar" class="tomarkstar star_mark star_mark{{$each_chat->id}}" onclick="setStarredMsg('{{$each_chat->id}}')" data-id="{{ $counter }}">
							<i id="iclass{{ $counter }}" class="fa fa-star-o{{ (($each_chat->user_id==$authUser && $each_chat->is_starred_for_sender == 1) || ($each_chat->to_user_id==$authUser && $each_chat->is_starred_for_receiver == 1)) ? ' fa-star' : '' }}"></i>
						</button>
					</li>
					<li class="msg_date">27 Jun</li>
					<li class="dropdown">
						<button class="msg_button dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
						<ul class="dropdown-menu">
							<!--<li><a href="javascript:void(0);">Reply</a></li>
							<li><a href="javascript:void(0);">Forward</a></li>
							<li><a href="javascript:void(0);">Print</a></li>-->
							<li onclick="deleteMsg('{{$each_chat->id}}')"><a href="javascript:void(0);">Delete this message</a></li>
						</ul>
					</li>
				</ul>
   			</div>

   			<div id="collapseOne{{$counter}}" class="panel-collapse collapse infobox" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body">
		      	<div class="msg_content">
		      	{!! nl2br($each_chat->message_content) !!}
		      	</div>

		      	@php
		      	$attachedFiles = chatFiles($each_chat->id);
		      	//print_r($attachedFiles);
		      	@endphp
		      	@if(count($attachedFiles) > 0)
			      	<div class="form-group">
			      	<h4>Attached Files</h4><br />
			      	@foreach($attachedFiles as $eachFiles)
			      		<p><a href="{{ asset('assets/upload/chat_files/'.$eachFiles->file_name) }}" download>{{ $eachFiles->file_name }}</a></p>
			      	@endforeach
			      	</div>
		      	@endif
		      </div>
		    </div>
		</li><!-- end one message -->
		@endif
	@endforeach
@else
	<li>
		<div class="panel-heading clearfix" role="tab" id="headingOne">
			No message available
		</div>
	</li>
@endif

