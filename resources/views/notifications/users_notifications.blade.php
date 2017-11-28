@extends('layouts.app')
@section('title')
Job bidding | Job Chats
@endsection



@section('content')
<section class="myfundpage">
	<div class="container">
		<h2 class="funt_title">All Notification</h2>	
		<div class="infobox white-bg">
			<div class="panel-body allnotification">
				<div class="clearfix">
					<div class="pull-left clearfix form-group">
						<div class="checkbxndrop clearfix pull-left">								
							<label class="imgchek pull-left">                                
								<input type="checkbox" class="hidden checkAll" name="tochekk">
								<div class="imgchekico">
									<img src="{{asset('assets/frontend/images/unchecked_new.png')}}" class="img-reponsive unchekt">
									<img src="{{asset('assets/frontend/images/checked_new.png')}}" class="img-reponsive chekedt">
								</div>
                            </label>
                            <div class="dropdown pull-left">						  
                            	<a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:void(0);">
                            		<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                            	</a>
                            	<ul class="dropdown-menu" aria-labelledby="dLabel">
                            		<li><a href="javascript:void(0);">Lorem</a></li>
                            	</ul>
                            </div>
						</div>
						<button class="trashmebtn pull-left" onclick="deleteBulkNotification()">
							<img src="{{asset('assets/frontend/images/trashme.png')}}" class="img-reponsive">
						</button>
					</div>
					<div class="form-group pull-right fornotifilter">
						<select class="form-control minimal">
							<option>All Notifications</option>
						</select>
					</div>
				</div>
				<div class="table-responsive style2 allnotitable">
				    <div class="notificationMsg"></div>
				    <table class="table">					       
				        <tbody>
						    @if(count($UserNotifications) > 0)
							    @foreach($UserNotifications as $eachNotification)
								    <tr class="eachNotification eachNotification{{$eachNotification->id}}">
									    <th scope="row">
											<label class="imgchek">                                
												<input type="checkbox" class="hidden notificationCheck notificationCheck{{$eachNotification->id}}" name="notificationCheck[]" value="{{$eachNotification->id}}">
												<div class="imgchekico">
													<img src="{{asset('assets/frontend/images/unchecked_new.png')}}" class="img-reponsive unchekt">
													<img src="{{asset('assets/frontend/images/checked_new.png')}}" class="img-reponsive chekedt">
												</div>
				                            </label>
				                            <label class="imgchek gplrmr20">                                
												@php
												if($eachNotification->is_starred=='N')
													$isChecked='';
												elseif($eachNotification->is_starred=='Y')
													$isChecked='checked';
												@endphp
												<input type="checkbox" class="hidden notificationStarred notificationStarred{{$eachNotification->id}}" name="tostarred" onchange="starredNotification('{{ $eachNotification->id }}')" {{ $isChecked }}>
												<div class="imgchekico starredMsgArea">
													<img src="{{asset('assets/frontend/images/starred_uncheck.png')}}" class="img-reponsive unchekt">
													<img src="{{asset('assets/frontend/images/starred_checked.png')}}" class="img-reponsive chekedt">
												</div>
				                            </label>
											<label class="imgchek">                                
												<input type="radio" class="hidden notificationRadio notificationRadio{{$eachNotification->id}}" name="radiofrnotiall">
												<div class="imgchekico">
													<i class="fa fa-circle-thin unchekt" aria-hidden="true"></i>
													<i class="fa fa-circle chekedt" aria-hidden="true"></i>				
												</div>
				                            </label>   
		                   				</th>
						                <!-- <td><span class="txtnotititle">Job Invitation</span></td> -->
						                <td>{{$eachNotification->full_description}}</td>
						                <td>{{date('dS M, Y', strtotime($eachNotification->created_at))}}</td>
						                <td>
						                	<a class="totrashit" href="javascript:void(0);" onclick="deleteNotification('{{ $eachNotification->id }}')">
						                		<img src="{{asset('assets/frontend/images/totrach.png')}}" class="img-reponsive">
						                	</a>
						                </td>
									</tr>
								@endforeach
							@endif
				     	</tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection



@section('customScript')
<script type="text/javascript">
$(document).ready(function(){
    $('.checkAll').change(function(){
    	if($('.checkAll').is(':checked')){
    		$('.notificationCheck').prop('checked', true);
    	}else{
    		$('.notificationCheck').prop('checked', false);
    	}
    })
});

function deleteNotification(notificationId){
	//alert(notificationId);
	r = confirm('Are you sure to delete this notification?');
	if(r){
		process.on();
		$.ajax({
			type:'post',
			url:'{{url('/delete-notification')}}',
			data:{
				isAjax:true,
				notificationId:notificationId
			},
			success:function(response){
				//var res = $.parseJSON(response);
				process.off();
				if(response.response_status == 1){
					$(".eachNotification"+notificationId).html(response.response_msg);
					setTimeout(function(){
						$(".eachNotification"+notificationId).remove();
					}, 2000);
				}else{
					$(".notificationMsg").html(response.response_msg);
				}
			}, error: function(){
				//alert("Oops! Something went wrong, try again later.");
				process.off();
			}
		});
	}
}

function deleteBulkNotification(){
	//alert(notificationId);
	r = confirm('Are you sure to delete this notification?');
	if(r){
		process.on();
		var notificationIds = []
		$("input[name='notificationCheck[]']:checked").each(function ()
		{
		    notificationIds.push(parseInt($(this).val()));
		});
		//alert(notificationIds);
		$.ajax({
			type:'post',
			url:'{{url('/delete-bulk-notification')}}',
			data:{
				isAjax:true,
				notificationIds:notificationIds
			},
			success:function(response){
				window.location.reload();
			}, error: function(){
				//alert("Oops! Something went wrong, try again later.");
				process.off();
			}
		});
	}
}

function starredNotification(notificationId){
	//alert(notificationId);
	process.on();
	$.ajax({
		type:'post',
		url:'{{url('/check-starred-notification')}}',
		data:{
			isAjax:true,
			notificationId:notificationId
		},
		success:function(response){
			//var res = $.parseJSON(response);
			process.off();
		}, error: function(){
			$(".notificationMsg").html(response.response_msg);
			process.off();
		}
	});
}
</script>
@endsection