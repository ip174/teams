@extends('admin.layouts.app')

@section('pageTitle', 'Edit Users')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Users </h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0);"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="{!! admin_url('') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Users</li>
		</ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Users</h3>
					</div>
					
					
					@if($errors->any())
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							@foreach($errors->all() as $error)
								<p>{!! $error !!}</p>
							@endforeach
						</div>
					@endif
					@if(session('success'))
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{!! session('success') !!}
					</div>
					@endif
					<!-- form start -->
					<form class="form-horizontal" name="settings_form" action="{!! admin_url('update-users-profile').'/'.$id !!}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="box-body">
							<h4><strong>Basic Info</strong></h4>
							<div class="row">
								<div class="col-md-12">
									<div class="col-sm-5">
										<div class="form-group">
											<label for="first_name" class="control-label">First Name</label>
											<div class="">
												<input type="text" class="form-control" id="first_name" name="first_name" value="{{ $isSessionSet==1 ? $session_data['first_name'] : $users_details->first_name }}" />
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
									<div class="col-sm-5">
										<div class="form-group">
											<label for="last_name" class="control-label">last Name</label>
											<div class="">
												<input type="text" class="form-control" id="last_name" name="last_name" value="{{ $isSessionSet==1 ? $session_data['last_name'] : $users_details->last_name }}" />
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
								<div class="col-md-12">
									<div class="col-sm-5">
										<div class="form-group">
											<label for="" class="control-label">Email</label>
											<div class="">
												{{ $users_details->email }}
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
									<div class="col-sm-5">
										<div class="form-group">
											<label for="" class="control-label">User Type</label>
											<div class="">
											{{ $userTypes[$users_details->type] }}
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
							</div>
							<hr>
							<h4><strong>Detaild Info</strong></h4>
							<div class="row">
								<div class="col-md-12">
									<div class="col-sm-5">
										<div class="form-group">
											<label for="rate_per_hour" class="control-label">Rate per hour (Optional)</label>
											<div class="">
												<input type="text" class="form-control" id="rate_per_hour" name="rate_per_hour" value="{{ $isSessionSet==1 ? $session_data['rate_per_hour'] : $users_details->rate_per_hour }}" />
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
									<div class="col-sm-5">
										<div class="form-group">
											<label for="location" class="control-label">Location</label>
											<div class="">
												<input type="text" class="form-control location" id="location" name="location" value="{{ $isSessionSet==1 ? $session_data['location'] : $users_details->location }}" />
												<input type="hidden" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" />
												<input type="hidden" name="lat" id="lat" value="{{ old('lat') }}"/>
												<input type="hidden" name="lng" id="lng" value="{{ old('lng') }}"/>
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
								<div class="col-md-12">
									<div class="col-sm-5">
										<div class="form-group">
											<label for="travel_distance" class="control-label">How far will travel?</label>
											<div class="">
												<select class="form-control travel_distance" id="travel_distance" name="travel_distance">
													<option value=""> Select </option>
													@if($all_travelType)
														@foreach($all_travelType as $each_travelType)
														<option value="{{ $each_travelType->travel_id }}" {{ $users_details->travel_distance == $each_travelType->travel_id ? 'selected' : ''}}>{{ $each_travelType->travel_type }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
									<div class="col-sm-5">
										<div class="form-group">
											<label for="skills" class="control-label">Tag Skills</label>
											<div class="">
												<select class="form-control multipleSelect" id="skills" multiple name="skills[]">
													@if($all_skills)
														@foreach($all_skills as $each_skills)
														
														<option value="{{ $each_skills->skill_id }}" {{ in_array($each_skills->skill_id, $dataSkills) ? 'selected' : '' }}>{{ $each_skills->skill_name }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
								<div class="col-md-12">
									<div class="col-sm-5">
										<div class="form-group">
											<label for="website" class="control-label">Website</label>
											<div class="">
												<input type="text" name="website" id="website" class="form-control website" placeholder="" value="{{ $isSessionSet==1 ? $session_data['website'] : $users_details->website }}" />
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
									<div class="col-sm-5">
										<div class="form-group">
											<label for="focus" class="control-label">Focus</label>
											<div class="">
												<select class="form-control focus" id="focus" name="focus">
													<option value=""> Select </option>
													@if($all_focus)
														@foreach($all_focus as $each_focus)
														{{ $focus = $isSessionSet==1 ? $session_data['focus'] : $users_details->focus }}
														<option value="{{ $each_focus->focus_type_id }}" {{ $focus==$each_focus->focus_type_id ? 'selected' : '' }}>{{ $each_focus->focus_type }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
								<div class="col-md-12">
									<div class="col-sm-5">
										<div class="form-group">
											<label for="field_of_work" class="control-label">Field of Work (Category & Sub-category)</label>
											<div class="">
												<select class="form-control field_of_work" id="field_of_work" name="field_of_work">
													<option value=""> Select </option>
													@if($all_workField)
														@foreach($all_workField as $each_workField)
														{{ $fieldOfWork = $isSessionSet==1 ? $session_data['field_of_work'] : $users_details->field_of_work }}
														<option value="{{ $each_workField->type_id }}" {{ $fieldOfWork==$each_workField->type_id ? 'selected' : '' }}>{{ $each_workField->type_title }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
									<div class="col-sm-5">
										<div class="form-group">
											<label for="about_me" class="control-label">About</label>
											<div class="">
												<textarea class="form-control about_me" id="about_me" name="about_me" placeholder="I am expert in...">{{ $isSessionSet==1 ? $session_data['about_me'] : $users_details->about }}</textarea>
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
								
								<div class="col-md-12">
									<div class="col-sm-5">
										<div class="form-group">
											<label for="job_type" class="control-label">Job type</label>
											<div class="">
												<select class="form-control job_type" id="job_type" name="job_type">
													<option value=""> Select </option>
													@if($all_jobType)
														@foreach($all_jobType as $each_jobType)
														{{ $jType = $isSessionSet==1 ? $session_data['job_type'] : $users_details->job_type }}
														<option value="{{ $each_jobType->job_type_id }}" {{ $jType == $each_jobType->job_type_id ? 'selected' : ''}}>{{ $each_jobType->job_title }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
									<div class="col-sm-5">
										<div class="form-group">
											<label for="" class="control-label">&nbsp;</label>
											<div class="">&nbsp;</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-info pull-right">Save</button>
						</div><!-- /.box-footer -->
					</form>
					
					
					
				</div><!-- /.box -->
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('constants.GM_API_KEY') }}&libraries=places"></script>
<script type="text/javascript">
function initialize(){
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
google.maps.event.addDomListener(window, 'load', initialize);
	
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
</script>-->

@endsection