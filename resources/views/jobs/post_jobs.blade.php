@extends('layouts.app')
<!--<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap-tagsinput.css') }}" />-->
@section('title')
Job bidding | Post a Job
@endsection
@section('content')

@php
$jobsSettings = getJobSettings();
@endphp
<section class="postjobtitlebox">
	<div class="container">
		<h1>Post a job
		<small>Post a job for free - Start receiving proposals within minutes</small>
		</h1>
	</div>
</section>
<div class="mainBody">
	<div class="inputjobdescription">
		<div class="container jobContainer">
			
			<div class="row">
				@if(!empty($successMsg))
					<div class="alert alert-success" style="margin-left:15px;">
						<ul>
							<li>{{ $successMsg }}</li>
						</ul>
					</div>
				@endif
				@if (count($errors) > 0)
					<div class="alert alert-danger" style="margin-left:15px;">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<form action="{{ url('jobs/post-jobs') }}" method="post" id="jobPostForm" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="infobox catgoryblock  whitebg">
							<div class="panel-body">
								<div class="form-group">
									<label>Seniority </label>
									<select class="form-control minimal experience_level" name="experience_level" id="experience_level" >
										<option value=""> All </option>
										@if(isset($experiencelevel))
											@foreach($experiencelevel as $eachLevel)
												<option value="{{ $eachLevel->level_id }}" {{ old('experience_level')==$eachLevel->level_id ? 'selected' : '' }}>{{ $eachLevel->experience_type }}</option>
											@endforeach
										@endif
									</select>
								</div>

								<div class="form-group">
									<label>Project length</label>
									<select class="form-control minimal project_length" name="project_length" id="project_length">
										<option value=""> All </option>
										@if(isset($projectLength))
											@foreach($projectLength as $eachProjectLength)
												<option value="{{ $eachProjectLength->id }}" {{ old('project_length')==$eachProjectLength->id ? 'selected' : '' }}>{{ $eachProjectLength->length_type }}</option>
											@endforeach
										@endif
									</select>
								</div>
								
								<div class="form-group">
									<label>Location</label>
									<!-- <input class="form-control minimal location" name="location" id="location" value="{{ old('location') }}"> -->
									<select class="form-control minimal" name="location" id="location" >
										<option value="Both" {{ old('location')=='Both' ? 'selected' : '' }}>Both</option>
										
										<option value="Remote" {{ old('location')=='Remote' ? 'selected' : '' }}>Remote</option>

										<option value="Onsite" {{ old('location')=='Onsite' ? 'selected' : '' }}>Onsite</option>
									</select>
								</div>

								<div class="form-group">
									<label>Turn around</label>
									<select class="form-control minimal turn_around_time" id="turn_around_time" name="turn_around_time">
										<option value=""> All </option>
										@if(isset($turn_around_time))
											@foreach($turn_around_time as $eachTime)
												<option value="{{ $eachTime->id }}" {{ old('turn_around_time')==$eachTime->id ? 'selected' : '' }}>{{ $eachTime->around_time_type }}</option>
											@endforeach
										@endif
									</select>
								</div>

								<div class="form-group">
									<label>Job Type</label>
									<select class="form-control minimal job_type" name="job_type" id="job_type">
										<option value=""> All </option>
										@if(count($JobType) > 0)
											@foreach($JobType as $eachtype)
												<option value="{{ $eachtype->job_type_id }}" {{ $eachtype->job_type_id == old('job_type') ? 'selected' : '' }}>{{ $eachtype->job_title }}</option>
											@endforeach
										@endif
									</select>
								</div>

								<div class="form-group">
									<label>Budget</label>
									<select class="form-control minimal budget_type" name="budget_type" id="budget_type">
										@if(count($budget) > 0)
											@foreach($budget as $eachBudget)
												<option value="{{ $eachBudget->id }}" {{ old('budget_type')==$eachBudget->id ? 'selected' : '' }}>{{ $eachBudget->budget_type }}</option>
											@endforeach
										@endif
									</select>
								</div>

								<div class="form-group">
									<label>Budget Amount</label>
									<input type="text" class="form-control minimal budget_amount" name="budget_amount" id="budget_amount" value="{{ old('budget_amount') }}">
								</div>

								<!-- <div class="form-group">
									<label>Job Type</label>
									<select class="form-control minimal">
										<option>Full-Time</option>
									</select>
								</div> -->

								<div class="form-group">
									<label>Payment Type</label>
									<select class="form-control minimal" name="paymentType" id="paymentType">
										<option value="Fixed" {{ old('paymentType')=='Fixed' ? 'selected' : '' }}>Fixed</option>
										<option value="Hourly" {{ old('paymentType')=='Hourly' ? 'selected' : '' }}>Hourly</option>
									</select>
								</div>
								<div class="form-group">
									<label>Rounds of revisions</label>
									<input class="form-control" type="text" name="roundsOfRevisions" id="roundsOfRevisions" value="{{ old('roundsOfRevisions') }}">
								</div>
								
							</div>
						</div>
					</div><!-- left col for category -->

					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 panel-body whitebg">
						<div class="form-group">
							<label>What do you need to get done? *</label>
							<input placeholder="Motion Graphic Design Job" class="form-control" name="needs_to_design_job" type="text" value="{{ old('needs_to_design_job') }}" id="needs_to_design_job" required>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
								<label>Category *</label>
								<select class="form-control minimal category" name="category" id="category" required onchange="fetchSubCategory('category')">
									<option value=""> Select </option>
									@if(count($all_category) > 0)
										@foreach($all_category as $eachCategory)
											<option value="{{ $eachCategory->category_id }}" {{ old('category')==$eachCategory->category_id ? 'selected' : '' }}>{{ $eachCategory->category_name }}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
								<label>Sub-category</label>
								<select class="form-control minimal subcategory" name="subcategory" id="subcategory">
									
								</select>
							</div>
						</div>

						<div class="form-group">
							<label>Job description *</label>
							<textarea class="form-control job_description" name="job_description" rows="7" placeholder="Type here job description" id="job_description" required>{{ old('job_description') }}</textarea>
						</div>

						<div class="form-group row">
							<label class="col-xs-12">Tags skills for this job</label>
							<div class="col-xs-12">
								<div class="colm">
									<div class="userinfoFld" style="width:100% !important;">
										<select class="multipleSelect" style="width:100% !important;" multiple name="skills[]" id="skills">
											@if(count($all_skills) > 0)
												@foreach($all_skills as $each_skills)
												<option value="{{ $each_skills->skill_id }}">{{ $each_skills->skill_name }}</option>
												@endforeach
											@endif
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Attachments</label>
							<!-- <ul class="list-inline attachmenticon">
								<li><i class="fa fa-file-word-o"></i></li>
								<li><i class="fa fa-file-pdf-o"></i></li>
								<li><i class="fa fa-file-video-o"></i></li>
								<li><i class="fa fa-file-code-o"></i></li>
								<li><i class="fa fa-file-word-o"></i></li>
							</ul> -->
						</div>

						<div class="form-group">
							<label class="uploadBox">
								<input type="file" name="attached_file" class="attached_file introduce_file" id="attached_file">
								<div class="txtF">
									<!--<i class="fa fa-microphone"></i>
									<i class="fa fa-video-camera"></i>-->
									<div class="introduce-file-text">Drop file here or <span>Browse</span></div>
								</div>
							</label>
						</div>

						<div id="theassessment" class="interviewquestion">
							<label>Assessment - Interview Question</label>
							<div id="assessmentbox">
								<div class="form-group relative clearfix" id="theassessment">
									<a href="javascript:void(0)" class="todelte2 pull-right" id="deleteassessment">
										<i class="fa fa-times" aria-hidden="true"></i>
									</a>
									<input class="form-control" placeholder="What challenges do you see doing this job?" name="freelancer_assessment[]" id="freelancer_assessment1" type="text">
								</div>	
							</div>
							<a href="javaScript:void(0);" id="newassessment" class="adnew">+ Add new assessment</a>
						</div>

						<div class="clearfix">
							<label class="needToPay" style="margin-left:10px;"></label>
							<br /><br />
						</div>

						<div class="clearfix">
							<!-- <label class="checkFld pull-left">
								<input type="checkbox" name="agree_terms_conditions" value="1" {{ old('agree_terms_conditions')==1 ? 'checked' : '' }} required>
								<i class="fa fa-square-o"></i>
								By clicking Post Job, You agree with terms &amp; conditions
							</label> -->
							<input type="hidden" name="agree_terms_conditions" value="1">
							<input class="button green pull-right postJob" value="POST JOB" type="submit">
							<a href="javascript:void(0);" class="preview button text-uppercase pull-right previewJob" onclick="preview_job()">Preview</a>
						</div>
					</div><!-- right col for job list -->
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Add Portfolio View Modal -->
<div class="modal fade previewJob" id="previewJob" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modal-title">View Job</h2>
			</div>
			<div class="modal-body" style="min-height:285px !important;">
				<div class="modal-preview"></div>
			</div>
			<div class="modal-footer" style="border-top:none !important;">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Add Portfolio View Modal End -->

<!-- Google Map Code start -->
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
</script>-->
<!-- Google Map Code end -->

@endsection
@section('customScript')
<!--<script src="{!! asset('assets/frontend/js/bootstrap-tagsinput.min.js') !!}" type="text/javascript"></script>-->

<script type="text/javascript">
var assessmentCount=1;
$("#newassessment").on("click",function(){
	assessmentCount = assessmentCount +1;
	var appendHTML = '<div id="theassessment" class="form-group relative clearfix"><a href="javascript:void(0)" class="todelte2 pull-right" id="deleteassessment"><i class="fa fa-times" aria-hidden="true"></i></a><input type="text" class="form-control"  placeholder="What challenges do you see doing this job?" name="freelancer_assessment[]" id="freelancer_assessment'+assessmentCount+'"></div>';
	$("#assessmentbox").append(appendHTML);
});

$("body").on("click", "#assessmentbox #deleteassessment",function(){
	//assessmentCount = assessmentCount--;
	$(this).parent().remove();
});

function preview_job(){
	var previewHTML = $(".jobContainer").html();
	//alert(previewHTML);
	$(".modal-preview").html(previewHTML);
	//alert($(".modal-body .fstResults .fstSelected").text);
	$('.modal-body .form-control').replaceWith(function(){
		var id = $(this).attr('id');
		if($(this).is('select') == true){
			var val = $('#'+id+' option:selected').text();
		}else{
			if($('#'+id).attr('class') == 'form_radio'){
				//console.log(id);
				var val = $('#'+id).val();
			}else var val = $('#'+id).val();
		}
		return '<span>'+val+'</span>'
	});
	$('.form_type').val('1');
	$('.modal-body .uploadBox').remove();
	$('.modal-body .postJob').remove();
	$('.modal-body .previewJob').remove();
	$('.modal-body .previewJob').remove();
	$('.modal-body #deleteassessment').remove();
	$('.modal-body .fstQueryInput').remove();
	$('.modal-body .fstMultipleMode').css('border', 'none');
	$('.modal-body .error').remove();
	/*$('.modal-body .form_radio').replaceWith(function(){
		var id = $(this).attr('id');
		if($('#'+id).is(':checked') == true){
			//console.log($('#'+id).attr('class'));
			var radio_cl = $('#'+id).attr('class');
			console.log(radio_cl);
			if($('#'+id).hasClass( "subject_panel" )){
				return '<span><i class="fa fa-check" aria-hidden="true"></i></span>'; 
			} else return '<span>'+$('#'+id).val()+'</span>'; 
		} 
	})*/
	//$('.modal-body .label_radio').html('');
	$("#previewJob").modal('show');
}

$(function () {
	$("input[name=agree_terms_conditions]").on('change', function(){
		$("#agree_terms_conditions-error").remove();
		$("input[name=agree_terms_conditions]").attr('chacked', true);
	});

	$(".turn_around_time").on('change', function(){
		turn_around_time = $(".turn_around_time").val();
		process.on();
		$.ajax({
			type:'post',
			url:'{{ url('/jobs/check-is-need-payment') }}',
			data:{
				isAjax:true,
				id:turn_around_time
			},
			success:function(response){
				if(response.return_status == 1){
					$(".needToPay").html(response.return_msg);
				}else{
					$(".needToPay").html('');
				}
				process.off();
			}, error: function(){
				process.off();
			}
		});
	})
});

function fetchSubCategory(category_id){
	var category_id = $("."+category_id).val();
	process.on();
	$.ajax({
		type:'post',
		url:'{{ url('/fetch-sub-category') }}',
		data:{
			isAjax:true,
			category_id:category_id
		},
		success:function(response){
			//if(response.return_status == 1){
				$(".subcategory").html(response.data);
			// }else{
			// 	$(".needToPay").html('');
			// }
			process.off();
		}, error: function(){
			process.off();
		}
	});
}
</script>

@endsection