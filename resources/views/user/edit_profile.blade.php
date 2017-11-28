@extends('layouts.app')
@section('title')
Job bidding | Edit Profile
@endsection
@section('content')
<div class="mainBody">
	<div class="wrapper">
		<h2 class="catetitle">Edit Profile</h2>
		<div class="dashboardBox">
			<div class="row">
				<form action="{{ url('user/edit-profile') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
					<div class="col-sm-4 col-md-3">
						<div class="sideL">
							<!--<div>
							<img src="{{ asset('assets/frontend/images/ico5.png') }}" height="20px" width="20px" class="left" />
							<a href="{{ url('/user/my-profile') }}" style="margin-left:10px; font-size:16px;">{{ $user_det->first_name.' '.$user_det->last_name }}</a>
							</div>-->
							<div class="dashboardUserPhoto">
								@if(!empty($user_det->profile_picture))
									<div class="profilePic" style="background-image:url('{{ asset('assets/frontend/profile_pictures/'.$user_det->profile_picture) }}');">
								@else
									<div class="profilePic" style="background-image:url('{{ asset('assets/frontend/images/icon-no-image.png') }}')">
								@endif
									<div class="shape"></div>
								</div>
								<div class="picTxt">
									<span class="tl">Profile Picture</span>
									<a href="javascript:void(0);">
										<span onclick="profilePicBoxLoad();" class="uploadPorfilePic">EDIT PHOTO</span>
									</a>
									<!--<small>(200 x 200)</small>-->
								</div>
							</div>
							<div class="userinfoFld">
									@php
									$authUser = isset(Auth::user()->id) ? Auth::user()->id : '0';
									$userDetails = getUserDetails(array($authUser));
									$userDetails = count($userDetails) ? $userDetails[0] : array();
									$isAvailable = isset($userDetails->availability_status) ? $userDetails->availability_status : 'Offline';
									$checboxVal = $isAvailable=='Available' ? 'Offline' : 'Available';
									$isChecked = ($isAvailable=='Available') ? 'checked' : '';
									//echo $isAvailable; exit;
									@endphp
									<div class="availability clearfix" style="margin-left:-6px;">
										<p class="pull-left"><strong>I am <span class="available availabilityText">{{$isAvailable}}</span></strong></p>
										<label class="i-switch i-switch-md bg-info csswitch">
											<input type="checkbox" class="availabilityStatusBar" id="chkprivacy" onchange="setAvailableUnavailable()" value="{{ $checboxVal }}" {{ $isChecked }}>
											<i></i>
										</label>
									</div>
								
								<!---
								<span class="fldTl">I am</span>
								<select class="fld availability_status" name="availability_status" onchange="saveOnAjax('availability_status','{{ url('/user/edit-profile') }}')" >
									<option value="Available" {{ $user_det->availability_status=='Available' ? 'selected' : '' }}>Available</option>
									<option value="Busy" {{ $user_det->availability_status=='Busy' ? 'selected' : '' }}>Busy</option>
									<option value="Offline" {{ $user_det->availability_status=='Offline' ? 'selected' : '' }}>Offline</option>
								</select>
								--->
							</div>
							<div class="userinfoFld">
								<span class="fldTl">Rate per hour <small>(Optional)</small></span>
								<input type="text" name="rate_per_hour" class="fld rate_per_hour" value="{{ old('rate_per_hour') ? old('rate_per_hour') : $user_det->rate_per_hour }}" onblur="saveOnAjax('rate_per_hour','{{ url('/user/edit-profile') }}')" onkeypress="return isNumberKey(event)" onkeyup="numeric_with_dash(this)" />
								<small>( e.g. 100 )</small>
							</div>
							<div class="userinfoFld">
								<span class="fldTl">Location</span>
								<input type="text" name="location" id="location" class="fld location locFld" value="{{ old('location') ? old('location') : $user_det->location }}" onblur="saveOnAjax('location','{{ url('/user/edit-profile') }}')" />
								<input type="hidden" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" />
								<input type="hidden" name="lat" id="lat" value="{{ old('lat') }}"/>
								<input type="hidden" name="lng" id="lng" value="{{ old('lng') }}"/>
							</div>

							<div class="userinfoFld">
								<span class="fldTl">How far will you travel?</span>
								<select class="fld travel_distance" name="travel_distance" onchange="saveOnAjax('travel_distance','{{ url('/user/edit-profile') }}')">
									<option value=""> Select </option>
									@if($all_travelType)
										@foreach($all_travelType as $each_travelType)
										<option value="{{ $each_travelType->travel_id }}" {{ $user_det->travel_distance == $each_travelType->travel_id ? 'selected' : ''}}>{{ $each_travelType->travel_type }}</option>
										@endforeach
									@endif
								</select>
							</div>

							<div class="userinfoFld">
								<span class="fldTl">Job type</span>
								<select class="fld job_type" name="job_type" onchange="saveOnAjax('job_type','{{ url('/user/edit-profile') }}')">
									<option value=""> Select </option>
									@if($all_jobType)
										@foreach($all_jobType as $each_jobType)
										<option value="{{ $each_jobType->job_type_id }}" {{ $user_det->job_type == $each_jobType->job_type_id ? 'selected' : ''}}>{{ $each_jobType->job_title }}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="userinfoFld">
								<span class="fldTl">Website</span>
								<input type="text" name="website" class="fld website" placeholder="" value="{{ old('website') ? old('website') : $user_det->website }}" onblur="saveOnAjax('website','{{ url('/user/edit-profile') }}')" />
							</div>
							<div class="userinfoFld">
								<span class="fldTl">My Network</span>
								<div class="networkList">
									<a href="javascript:void(0);" title="LinkedIn" onclick="openDiv('linkedin')">
										<i class="fa fa-linkedin"></i>
									</a>
									<a href="javascript:void(0);" title="Vimeo" onclick="openDiv('vimeo')">
										<i class="fa fa-vimeo"></i>
									</a>
									<a href="javascript:void(0);" title="Twitter" onclick="openDiv('twitter')">
										<i class="fa fa-twitter"></i>
									</a>
									<a href="javascript:void(0);" title="Behance" onclick="openDiv('behance')">
										<i class="fa fa-behance"></i>
									</a>
									<a href="javascript:void(0);" title="My Profile Link" onclick="openDiv('myProfile')">
										<i class="fa fa-share-alt"></i>
									</a>
								</div>
							</div>
							<div class="userinfoFld userinfoLinks linkedin">
								<span class="fldTl">LinkedIn Link</span>
								<input type="text" name="linkedin_profile" class="fld linkedin_profile" placeholder="Enter Link" value="{{ old('linkedin_profile') ? old('linkedin_profile') : $user_det->linkedin_profile }}" onblur="saveOnAjax('linkedin_profile','{{ url('/user/edit-profile') }}')" />
							</div>
							<div class="userinfoFld userinfoLinks vimeo">
								<span class="fldTl">Vimeo Link</span>
								<input type="text" name="vimeo_profile" class="fld vimeo_profile" placeholder="Enter Link" value="{{ old('vimeo_profile') ? old('vimeo_profile') : $user_det->vimeo_profile }}" onblur="saveOnAjax('vimeo_profile','{{ url('/user/edit-profile') }}')" />
							</div>
							<div class="userinfoFld userinfoLinks twitter">
								<span class="fldTl">Twitter Link</span>
								<input type="text" name="twitter_profile" class="fld twitter_profile" placeholder="Enter Link" value="{{ old('twitter_profile') ? old('twitter_profile') : $user_det->twitter_profile }}" onblur="saveOnAjax('twitter_profile','{{ url('/user/edit-profile') }}')" />
							</div>
							<div class="userinfoFld userinfoLinks behance">
								<span class="fldTl">Behance Link</span>
								<input type="text" name="behance_profile" class="fld behance_profile" placeholder="Enter Link" value="{{ old('behance_profile') ? old(behance_profile) : $user_det->behance_profile }}" onblur="saveOnAjax('behance_profile','{{ url('/user/edit-profile') }}')" />
							</div>
							<div class="userinfoFld userinfoLinks myProfile">
								@if($user_det->profile_link)
									<span class="fldTl">My Profile Link</span>
									<small>{{ $user_det->profile_link }}</small>
								@endif
							</div>
							<!--<div class="userinfoFld">
								<input type="submit" name="left_frm_submit" class="button green right" value="Save"/>
							</div>-->
						</div>
					</div>
				</form>
				<form action="{{ url('user/edit-profile') }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="col-sm-8 col-md-9">
						<div class="sideR">
							<div class="dashboardFld">
								<div class="row">
									<div class="col-md-12">
									@if (count($errors) > 0)
										<div class="alert alert-danger">
											<ul>
												@foreach($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
									@endif
									</div>
									<div class="col-md-6">
										<div class="colm">
											<div class="userinfoFld">
												<span class="fldTl">First Name *</span>
												<input type="text" name="first_name" class="fld" value="{{ old('first_name') ? old('first_name') : $user_det->first_name }}"/>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="colm">
											<div class="userinfoFld">
												<span class="fldTl">Last Name *</span>
												<input type="text" name="last_name" class="fld" value="{{ old('last_name') ? old('last_name') : $user_det->last_name }}"/>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="colm">
											<div class="userinfoFld">
												<span class="fldTl">Focus</span>
												<select class="fld" name="focus">
													<option value=""> Select </option>
													@if($all_focus)
														@foreach($all_focus as $each_focus)
														<option value="{{ $each_focus->focus_type_id }}" {{ old('focus')==$each_focus->focus_type_id || $user_det->focus==$each_focus->focus_type_id ? 'selected' : '' }}>{{ $each_focus->focus_type }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="colm">
											<div class="userinfoFld">
												<span class="fldTl">Field of Work (Category &amp; Sub-category)</span>
												<select class="fld" name="field_of_work">
													<option value=""> Select </option>
													@if($all_workField)
														@foreach($all_workField as $each_workField)
														<option value="{{ $each_workField->type_id }}" {{ old('field_of_work')==$each_workField->type_id || $user_det->field_of_work==$each_workField->type_id ? 'selected' : '' }}>{{ $each_workField->type_title }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="colm">
											<div class="userinfoFld">
												<span class="fldTl">About you</span>
												<textarea class="fld" name="about_me" placeholder="I am expert in...">{{ old('about_me') ? old('about_me') : $user_det->about }}</textarea>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="colm"  style="width:100% !important;">
											<div class="userinfoFld" style="width:100% !important;">
												<span class="fldTl">Tag Skills</span>
												<select class="multipleSelect" multiple name="skills[]"  style="width:100% !important;">
													@if($all_skills)
														@foreach($all_skills as $each_skills)
														<option value="{{ $each_skills->skill_id }}" {{ in_array($each_skills->skill_id, $dataSkills) ? 'selected' : '' }}>{{ $each_skills->skill_name }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="colm">
											<div class="userinfoFld">
												<span class="fldTl">Introduce yourself with an audio or video clip <small>(Optional)</small></span>
												<label class="uploadBox">
													<input type="file" name="introduce_file" id="introduce_file" class="introduce_file" />
													<div class="txtF">
														<i class="fa fa-microphone"></i>
														<i class="fa fa-video-camera"></i>
														<span class="introduce-file-text">Browse or Drop file here<!-- or <span>Record from here--></span>
													</div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="colm">
											<!---
											<label class="checkFld">
												<input type="checkbox" name="profile_available_in_seach_engine" value="1" {{ old('profile_available_in_seach_engine')==1 || $user_det->profile_availability==1 ? 'checked' : '' }}/>
												<i class="fa fa-square-o"></i>
												Make my profile available in search engine
											</label> -->
											<input type="submit" class="button green right" name="form_submit" value="Next - Add Portfolio"/>
											<div class="spacer"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('constants.GM_API_KEY') }}&libraries=places"></script> -->
<script type="text/javascript">
/*function initialize(){
	var input = document.getElementById('location');
	// Create the autocomplete helper, and associate it with
	// an HTML text input box.
	var autocomplete = new google.maps.places.Autocomplete(input);

	// Get the full place details when the user selects a place from the
	// list of suggestions.
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		if (!place.geometry) {
			return;
		}

		if(!place.address_components) {
			return;
		}
		var postal_code;
		place.address_components.forEach(function (item, index) {
			if(item.types[0] === "postal_code")
				postal_code =item.long_name;
		});
		if(postal_code)
			$("#postal_code").val(postal_code);

		if (place.geometry.location) {
			var lat = place.geometry.location.lat();
			var lng = place.geometry.location.lng();
			$("#lat").val(lat);
			$("#lng").val(lng);
		}
	});
	// Stop form submission when enter key pressed.
	google.maps.event.addDomListener(input, 'keydown', function(e) {
		if (e.keyCode == 13) {
			e.preventDefault();
		}
	});
}
google.maps.event.addDomListener(window, 'load', initialize);*/
	
$(function () {
	shwVid($('input[name="user_type"]:checked'));		
});
function shwVid(obj){
	var rtype = obj.val();
	if(rtype==2){
		$('.dealeronly').show();
		$('#plan').show();
	}else{
		$('.dealeronly').hide();
		$('#plan').hide();
	}
}
$('input[name="user_type"]').click(function(){		
	shwVid($('input[name="user_type"]:checked'));
});
</script>

@endsection
@section('customScript')

<!-- Crop Image Start-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/lightbox/fancybox.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/jquery.Jcrop.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/tel_num/intlTelInput.css') }}" />
<!--<script src="{!! asset('assets/frontend/crop_image_js/jquery.cropit.js') !!}" type="text/javascript"></script>-->
<script src="{!! asset('assets/frontend/lightbox/jquery.fancybox.js') !!}" type="text/javascript"></script>
<script src="{!! asset('assets/frontend/js/jquery.Jcrop.js') !!}" type="text/javascript"></script>
<script src="{!! asset('assets/frontend/tel_num/intlTelInput.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('assets/frontend/js/jquery.form.min.js') !!}" type="text/javascript"></script>
<!-- Crop Image End-->

<script>
$(document).ready(function(){
	/*==============Crop your Image Start==============*/
	/*$('.image-editor').cropit({
		exportZoom: 1.00,
		imageBackground: true,
		imageBackgroundBorderWidth: 20
	});

	$('.rotate-cw').click(function() {
		$('.image-editor').cropit('rotateCW');
	});
	$('.rotate-ccw').click(function() {
		$('.image-editor').cropit('rotateCCW');
	});*/

	$('.export').click(function(){
		var imageData = $('.image-editor').cropit('export');
		window.open(imageData);
	});
	/*==============Crop your Image End==============*/
	
	/*==============Save location by Ajax Start==============*/
	$("#location").on('blur', function(){
		setTimeout(function(){
			$("#location").trigger('keyup');
		}, 100);
	});
	/*==============Save location by Ajax Start==============*/
});

function profilePicBoxLoad(){
	$('#imagefancybox').html('<center><img src="{{ asset('assets/frontend/images/loading.gif') }}" alt="Loading..." title="Loading..."></center>');
	$.fancybox.open({ href : '#imagefancybox' });
	var token = $("input[name=_token]").val();;
	$.ajax({
		type:'POST',
		url:'{{ url('user/change-profile-picture') }}',
		data:{
			_token:token
		},
		//beforeSend:function(){},
		success:function(data){
			//var obj = $.parseJSON(data);
			var obj = data;
			$('#imagefancybox').html(obj.html);
			$.fancybox.update();
			profilePicFunctions();
			if(parseInt(obj.has_image) > 0){
				$('#output').show(); 
				$('#crop_form').show();	
				$('#cropbox').load(function() {
				 	profilePicCropInit();
				});	
			}
		},
		error: function(jqXHR, textStatus, errorThrown) 
		{
			alert(''+textStatus+', errorThrown='+errorThrown+'');
		} 
	});
}

function profilePicFunctions(){	
	$(function(){
		$("#profile_pic").change(function(){
			readProilePicURL(this);
			$(".saveBtn").css('display', 'block');
		});
	});
}

function readProilePicURL(input) {	
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$("#output").html('<center><img src="{{ asset('assets/frontend/images/loading.gif') }}" alt="Loading..." title="Loading..."></center>');  
			$('#output').show();
			if( !$('#profile_pic').val()){
				$("#output").html("Are you kidding me?");
				return false
			}
			
			var fsize = input.files[0].size;
			var ftype = input.files[0].type;
			var fname = input.files[0].name;
			switch(ftype){
				case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
					break;
				default:
					$("#output").html("<b>"+ftype+"</b> Unsupported file type!");
					return false
			}
						
			if(fsize>3048576){ //Allowed file size is less than 1 MB (1048576)
				$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
				return false
			}				
			/*$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
			$('#output').show();
			return false;*/
			
			$('#output').html('<div align="center"><img src="'+e.target.result+'" id="cropbox" alt="Preview"></div>');
			$('#image_file').val(e.target.result);
			$('#image_type').val(ftype);	
			$('#image_name').val(fname);
			$('#crop_form').show();
			setTimeout(function(){			
				profilePicCropInit();
			},100);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function newImageProcess(el,del){
	$th = $(el);
	$th.remove();
	
	$('#crop_form').hide();
	$('#upload_propic').show();
	$('#output').hide();
	$('#action').val('insert');
}

function profilePicCropInit(){
	var im = $('#cropbox');
	var imW = im.width();
	var imH = im.height();
	var w = 300;
	var h = 300;			
	var x = imW/2 - w/2;
	var y = imH/2 - h/2
	var x1 = x + w;
	var y1 = y + h;
	$('#nWidth').val(imW);
	$('#nHeight').val(imH);
	$('#cropbox').Jcrop({
		aspectRatio: 1,
		onSelect: updateCoords,
		setSelect:   [ x, y, x1, y1 ],
		/*minSize : [w, h],*/
		allowSelect: false,
	});
	profilePicCropForm();
	//$.fancybox.update();
}

function updateCoords(c)
{
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
}

function addLoader(){
	$(".alertMsg").html('<center><img src="{{ asset('assets/frontend/images/loading.gif') }}"></center>');
	$(".saveBtn").prop('disabled', true);
	$('#crop_form').submit();
}

function profilePicCropForm(){
	jQuery("#crop_form").ajaxForm({
		beforeSubmit : function(formData, jqForm, options){
			//alert('beforeSubmit');
			//jqForm.find('input[type=submit]').attr("disabled","disabled").val("Wait");		 
		},
		success: function(responseText, statusText, xhr, $form){
			//alert('success');
			if(responseText.error == 0){
				alert("Picture successfully uploaded!");
				window.location.reload();
			}
			$(".alertMsg").html('');
			$(".saveBtn").removeAttr('disabled');
		}
	});
}

</script>
<div id="imagefancybox" style="display:none; width:600px; min-height:300px;"></div>
@endsection