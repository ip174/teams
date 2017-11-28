@extends('layouts.app')
<!--<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap-tagsinput.css') }}" />-->
@section('title')
Job bidding | Edit Profile
@endsection
@section('content')
<section class="postjobtitlebox">
	<div class="container clearfix">
		<h1 class="pull-left">Find a job
		<small>Browse through jobs or add new job to the board</small>
		</h1>
		<a href="{{ url('/jobs/post-jobs') }}" class="btn btn-success btn-lg pull-right postjobbtn">+ POST A JOB</a>
	</div>
</section>
<section class="mainBody">
	<div class="container">
		<form action="" method="post" id="jobSearchForm">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<h2 class="catetitle">Search Jobs</h2>
				<!--<h2 class="catetitle">Job Categories</h2>
				<select class="form-control allcate minimal" name="category" style="color:#000000;">
					<option value=""> All Categories </option>
					@if($all_category)
						@foreach($all_category as $eachCategory)
							<option value="{{ $eachCategory->category_id }}"> {{ $eachCategory->category_name }} </option>
						@endforeach
					@endif
				</select>-->
				<div class="infobox catgoryblock">
					<div class="panel-body">
						<ul class="panelCategory">
							@if($all_category)
								@foreach($all_category as $eachCategory)
									<li>
										<span class="catTl"><i class="fa fa-plus"></i>{{ $eachCategory->category_name }}</span>
										<ul>
											@foreach(getCategorySubcategory(['parent_category_id'=>$eachCategory->category_id], 1) as $eachSubCat)
											<li>
												<label>
													<input type="checkbox" name="subCategory[]" value="{{ $eachSubCat->category_id }}"/>
													<span class="ico"></span>
													{{ $eachSubCat->category_name }}
												</label>
											</li>
											@endforeach
										</ul>
									</li>
								@endforeach
							@endif
						</ul>
						
						<div class="form-group" style="margin-top:10px;">
							<label>Project Cost</label>
							<select class="form-control minimal project_cost" name="project_cost" id="project_cost">
								<option value=""> Select </option>
								@if($budget)
									@foreach($budget as $eachBudget)
										<option value="{{ $eachBudget->id }}"> {{ $eachBudget->budget_type }} </option>
									@endforeach
								@endif
							</select>
						</div>
						
						<div class="form-group">
							<label>Project length</label>
							<select class="form-control minimal" name="project_length">
								<option value=""> Select </option>
								@if($projectLength)
									@foreach($projectLength as $eachLength)
										<option value="{{ $eachLength->id }}"> {{ $eachLength->length_type }} </option>
									@endforeach
								@endif
							</select>
						</div>
						
						<div class="form-group" style="margin-top:10px;">
							<label>Job Type</label>
							<select class="form-control minimal job_type" name="job_type" id="job_type">
								<option value=""> Select </option>
								@if(count($JobType) > 0)
									@foreach($JobType as $eachtype)
										<option value="{{ $eachtype->job_type_id }}">{{ $eachtype->job_title }}</option>
									@endforeach
								@endif
							</select>
						</div>

						<div class="form-group">
							<label>Location</label>
							<!-- <input name="location" id="location" class="form-control minimal location" onblur="showHideDiv()"> -->
							<!-- <select class="form-control minimal location_surrounding" name="location_surrounding" style="display:none; margin:8px 0 0 0;">
								<option value=""> No Preference </option>
								@if($locationSearchSurroundings)
									@foreach($locationSearchSurroundings as $eachOptionK=>$eachOptionV)
										<option value="{{ $eachOptionK }}"> {{ $eachOptionV }} </option>
									@endforeach
								@endif
							</select> -->
							<select class="form-control minimal" name="location" id="location" >
								<option value=""> Select </option>
								<option value="Remotely (anywhere)">Remotely (anywhere)</option>
								<option value="On-site (preferred location)">On-site (preferred location)</option>
							</select>
						</div>

						<input onclick="showPostedJobs()" class="btn btn-success viewbtn btn-block searchBtn" value="SEARCH" name="" type="button">
					</div>
				</div>
			</div><!-- left col for category -->
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">				
				<div class="clearfix">
					<h2 class="catetitle pull-left">All Categories<small class="countString"> <!--Search result 1 to 6 of 346 found-->{{ $countString }}</small></h2>
					<select class="jobfilter pull-right">
						<option>Recent Jobs</option>
						<option>Lorem</option>
					</select>
				</div>
				<div class="form-inline searchfilter">
				  <div class="form-group field">
					<input class="form-control" placeholder="Search Jobs..." type="text" name="searchText">
				  </div>
				  <button onclick="showPostedJobs()" type="button" class="btn btn-success searchBtn"><i class="fa fa-search"></i></button>
				</div>
				<div class="ajaxSearchDataList searchDataList">
					<ul class="jobpostedlist srjblist infobox">
						@if(count($jobs) > 0)
							@foreach($jobs as $eachJob)
							@php
							$eachJobId = isset($eachJob->job_id) ? $eachJob->job_id : '';
							@endphp
						<li>
							<div class="row">
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 full-vxs" >
									<h3 class="jobtitle" style="height:25px;overflow:hidden;">
										@if($eachJob->posted_by_user != Auth::user()->id)
											<a href="{{ url('/jobs/send-proposal/'.$eachJobId) }}">{{ isset($eachJob->needs_to_design_job) ? $eachJob->needs_to_design_job : '' }}</a>
										@else
											<a href="{{ url('/jobs/view-project/'.$eachJobId) }}">{{ isset($eachJob->needs_to_design_job) ? $eachJob->needs_to_design_job : '' }}</a>
										@endif
									</h3>
									<div class="jobsortdetails">
										@php
										$desc = isset($eachJob->job_description) ? $eachJob->job_description : '';
										@endphp
										{!! nl2br($desc) !!}
									</div>
									<div class="tags">
										@if(count(getSkillsByJobId($eachJobId)) > 0)
											@foreach(getSkillsByJobId($eachJobId) as $each_skills)
												<a href="javascript:void(0);" class="btn btn-default">{{ $each_skills->skill_name }}</a>
											@endforeach
										@endif
									</div>
									<div class="infofdate pull-left">
										<i class="fa fa-clock-o" aria-hidden="true"></i>
										Posted {{ getDateDifference($eachJob->created_at) }}
									</div>
									<div class="infofdate pull-left">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
										{{ isset($eachJob->location) ? $eachJob->location : '' }}
									</div>
									<div class="infofdate pull-left">
										<i class="fa fa-briefcase" aria-hidden="true"></i>
										{{ getProposalsByJobId($eachJobId, 'count') }} Proposal
									</div>
									@php
									$user_id=0;
									$job_id = $eachJobId;
									$isShortlisted='';
									$isAccepted='Y';
									$acceptedProposal = getProposalDetails($user_id, $job_id, $isShortlisted, $isAccepted);
									//debug($acceptedProposal);exit;

									$ratingsCond['job_id'] = $eachJobId;
									$ratingsCond['review_by_user'] = count($acceptedProposal) ? $acceptedProposal[0]->sent_by_user : '0';
									$ratings = $ratingsCond['review_by_user'] > 0 ? getJobRatings($ratingsCond) : '0';
									@endphp
									<div class="infofdate pull-left">
										<i class="fa fa-star-o" aria-hidden="true"></i>
										{{ $ratings }} Itermediate
									</div>
									<div class="urgent pull-left">{!! isset($eachJob->turnaroundtime->around_time_type) ? $eachJob->turnaroundtime->around_time_type : '' !!}</div>
								</div><!-- col left ]] -->
								<div class="col-lg-3 col-md-3 col-sm-3 co-xs-3 full-vxs text-right text-xs-left">
									<div class="projectprice">
										£ {{ isset($eachJob->budget_amount) ? $eachJob->budget_amount : '' }} <small>FIXED PRICE</small>
									</div>
									<!-- <a href="javascript:void(0);" class="btn btn-success viewbtn" onclick="openJobsReviewModal('{{ $eachJobId }}')">REVIEW</a>
									<p class="gpnct"></p> -->
									@if($eachJob->posted_by_user != Auth::user()->id)
										@if(in_array($eachJobId, $jobIdsArray))
											<a href="{{ url('/jobs/send-proposal/'.$eachJobId) }}" class="btn btn-success viewbtn">VIEW SENT PROPOSAL</a>
										@else
											<a href="javascript:void(0)" class="btn btn-success viewbtn" onclick="checkAvailableBidCredit('{{ url('/jobs/send-proposal/'.$eachJobId) }}')">BID ON THIS JOB</a>
										@endif
									@else
										<a href="{{ url('/jobs/view-project/'.$eachJobId) }}" class="btn btn-success viewbtn">VIEW PROPOSAL</a>
									@endif
								</div>
							</div>
						</li>
						@endforeach
						
						@else
							<li style="text-align:center;">No data found</li>
						@endif
					</ul>
					<nav aria-label="..." class="paginationew text-right">
						{{ $jobs->render() }}
					</nav>
				</div>
			</div><!-- right col for job list -->
		</div>
		</form>
	</div>
</section>

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
$(document).ready(function(){
	$("body").on("click",".catTl", function(){
		if(!$(this).next("ul").is(":visible")){
			$(this).addClass("open");
			$(this).next("ul").slideDown(400);
		}else{
			$(this).removeClass("open");
			$(this).next("ul").slideUp(400);
		}
	});
});


function showHideDiv(){
	if($(".location").val() != ''){
		$(".location_surrounding").css('display', 'block');
	}else{
		$(".location_surrounding").css('display', 'none');
	}
}

var assessmentCount=2;
$("#newassessment").on("click",function(){
	assessmentCount = assessmentCount++;
	var appendHTML = '<div id="theassessment" class="form-group relative clearfix"><a href="javascript:void(0)" class="todelte2 pull-right" id="deleteassessment"><i class="fa fa-times" aria-hidden="true"></i></a><input type="text" class="form-control"  placeholder="What challenges do you see doing this job?" name="freelancer_assessment[]" id="freelancer_assessment'+assessmentCount+'"></div>';
	$("#assessmentbox").append(appendHTML);
});

$("body").on("click", "#assessmentbox #deleteassessment",function(){
	assessmentCount = assessmentCount--;
	$(this).parent().remove();
});

function showPostedJobs(){
	$(".jobpostedlist").html('<center><img src="{{ asset('assets/frontend/images/loading.gif') }}" alt="Loading..." title="Loading..."></center>');  
	$('.searchDataList').show();
	
	post_data = $("#jobSearchForm").serialize();
	$.ajax({
		type:'get',
		url:base_url+'jobs/search-jobs?isAjax=true&' + post_data,
		success:function(response){
			//var res = $.parseJSON(response);
			$(".resultBox").remove();
			$(".ajaxSearchDataList").html(response.response_data);
			$(".countString").html(response.countString);
			$('.active').html('<a href="?page=1">1</a>');
		}, error: function(){
			$(".searchBtn").removeAttr('disabled', true);
			$('.ajaxSearchDataList').html('No response from server');
		}
	});
}

$(window).on('hashchange', function(){
	if (window.location.hash){
		var page = window.location.hash.replace('#', '');
		if (page == Number.NaN || page <= 0) {
			return false;
		}else{
			getData(page,'');
		}
	}
});

$(document).ready(function(){
	var count = 0;
	$(document).on('click', '.pagination a', function(event){
		if(count == 0){
			$('.active').html('<a href="?page=1">1</a>');
			count++;
		}
		$('li').removeClass('active');
		$(this).parent('li').addClass('active');
		event.preventDefault();
		var myurl = $(this).attr('href');
		var page=$(this).attr('href').split('page=')[1];
		getData(page,'1');
	});
});

function getData(page,loader){
	if(loader == 1){
		$(".searchBtn").attr('disabled', true);
		$(".searchDataList").html('<div class="resultBox"><center><img src="{{ asset('assets/frontend/images/loading.gif') }}" alt="Loading..." title="Loading..."></center></div>');
	}
	var formData = $("#jobSearchForm").serialize();
	$.ajax({
		url: '?isAjax=true&page='+page+'&'+formData + '&pagination=1',
		type: "get",
		datatype: "html",
	}).done(function(response){
		$(".searchBtn").removeAttr('disabled', true);
		//console.log(response);
		$("#product_container").empty().html(response);
		location.hash = page;
		$(".searchDataList").html(response.response_data);
		$(".countString").html(response.countString);
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		$(".searchBtn").removeAttr('disabled', true);
		$('.ajaxSearchDataList').html('No response from server');
	});
}

function checkAvailableBidCredit(redirectTo){
	process.on();
	$.ajax({
		type:'post',
		url:'{{ url('/settings/check-available-bid-credit') }}',
		data:{
			isAjax:true
		},
		success:function(response){
			if(response.status == 1){
				alert(response.status_msg);
				window.location.href="{{ url('/settings/user-general-settings?q=bid-purchase') }}";
			}else{
				window.location.href=redirectTo;
			}
			process.off();
		}, error: function(){
			alert("No response, try again later.");
			process.off();
		}
	});
}
</script>

@endsection