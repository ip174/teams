@extends('layouts.app')
@section('title')
Job bidding | Search Freelancers
@endsection
@section('content')
<section class="postjobtitlebox">
	<div class="container">
		<h1>Find Collaborators
		<small>Find your project partner and get a free quote</small>
		</h1>
	</div>
</section>

<div class="mainBody">
	<div class="container">
		<form action="" method="post" id="search_freelancer">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<h4 class="catetitle search_title">Field of Work<!--<br>Categories & Sub-Categories--></h4>
				<select class="form-control allcate minimal" name="categories">
					<!--<option value=""> Select </option>-->
					<option>All</option>
					@if($all_workField)
						@foreach($all_workField as $each_workField)
						<option value="{{ $each_workField->type_id }}">{{ $each_workField->type_title }}</option>
						@endforeach
					@endif
				</select>
				<div class="infobox catgoryblock">
					<div class="panel-body">
						<!--<ul class="list-unstyled listcategory">
							@if($all_workField)
								@foreach($all_workField as $each_workField)
								<li><a href="javascript:void(0);" data-id="{{ $each_workField->type_id }}">{{ $each_workField->type_title }}</a></li>
								@endforeach
							@endif
						</ul>-->
						<div class="form-group">
							<label>Job type</label>
							<select class="form-control minimal job_type" id="job_type" name="job_type">
								<option value=""> Select </option>
								@if($all_jobType)
									@foreach($all_jobType as $each_jobType)
									<option value="{{ $each_jobType->job_type_id }}">{{ $each_jobType->job_title }}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="form-group">
							<label>Rate (Per Hour)</label>
							<input class="form-control minimal rate_per_hour" id="rate_per_hour" name="rate_per_hour" placeholder="Rate (Per Hour)">
						</div>
						<div class="form-group">
							<label>How far will you travel</label>
							<select class="form-control minimal travel_distance" id="travel_distance" name="travel_distance">
								<option value=""> Select </option>
								@if($all_travelType)
									@foreach($all_travelType as $each_travelType)
									<option value="{{ $each_travelType->travel_id }}">{{ $each_travelType->travel_type }}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="form-group">
							<label>Location</label>
							<input class="form-control minimal location" placeholder="Location" name="location" id="location">
						</div>
						<input type="button" class="btn btn-success viewbtn btn-block searchBtn" value="SEARCH" onclick="search_freelancers()">
					</div>
				</div>
			</div><!-- left col for category -->
			
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">				
				<div class="clearfix">
					<h2 class="catetitle pull-left">
					<!--All Categories-->Found Freelancers
					<small><span class="countString">{{ $countString }}</span></small>
					</h2>
					<select class="jobfilter pull-right">
						<option>Recent Jobs</option>
						<option>Lorem</option>
					</select>
				</div>
				<div class="form-inline searchfilter">
					<div class="form-group field">
						<input type="text" class="form-control" placeholder="First name / Last name / E-Mail ID" name="search_text">
					</div>
					<button type="button" onclick="search_freelancers()" class="btn btn-success searchBtn">
					<i class="fa fa-search"></i>
					</button>
				</div>
				<div class="ajaxSearchDataList searchDataList">
					@if($users_details)
					<ul class="jobpostedlist infobox">
						
							@foreach($users_details as $user_det)
								<li class="clearfix">
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 full-vxs">
										<div class="freelancerlist">
											@if(!empty($user_det->profile_picture))
												<div class="profilePic" style="background:url({{ asset('assets/frontend/profile_pictures/'.$user_det->profile_picture) }}) no-repeat;">
											@else
												<div class="profilePic" style="background:url({{ asset('assets/frontend/images/icon-no-image.png') }}) no-repeat;">
											@endif
												<div class="shape"></div>
											</div>
											<h3 class="jobtitle avname clearfix">
												<strong><a href="{{ url('freelancers/freelancer-details/'.strtolower($user_det->first_name).'-'.strtolower($user_det->last_name).'/'.@$user_det->id) }}">{{ $user_det->first_name.' '.$user_det->last_name }}</a></strong>
												@if($user_det->availability_status)
												@php
												switch($user_det->availability_status){
													case 'Available':
													$backgroundColor = "#449d44";
													$fontColor = "#000000";
													break;

													case 'Busy':
													$backgroundColor = "#FCC15B";
													$fontColor = "#000000";
													break;

													case 'Offline':
													$backgroundColor = "#ffffff";
													$fontColor = "#000000";
													break;

													default:
													$backgroundColor = "#ffffff";
													$fontColor = "#ffffff";
													break;
												}
												@endphp
												<span class="staus available" style="background-color: {{$backgroundColor}}; font-color: {{$fontColor}};">{{ $user_det->availability_status }}</span>
												@endif
											</h3>
											<ul class="list-inline profiledata">					
												@if($user_det->availability_status)
												<li><p><i class="fa fa-map-marker"></i> {{ $user_det->location }}</p></li>
												@endif
												<li><p><i class="fa fa-align-center"></i> Portfolio(12)</p></li>
												<!-- <li><p><img src="{{ asset('assets/frontend/images/verified.png') }}" class="img-responsive inline-block"> Verified Member</p></li> -->
											</ul>
											<div class="freelancersortdetails">
												<strong>Fields:</strong> {{ $user_det->type_title }}
											</div>
											<div class="tags">
												@if(getSkillsByUserID($user_det->id))
													@foreach(getSkillsByUserID($user_det->id) as $rowSkill)
														<a href="javascript:void(0);" class="btn btn-default">{{ $rowSkill->skill_name }}</a>
													@endforeach
												@endif
											</div>
										</div>
									</div><!-- col left ]] -->
									<div class="col-lg-3 col-md-3 col-sm-3 co-xs-3 full-vxs text-right text-xs-left">
										<div class="projectprice">
											@if($user_det->rate_per_hour)
											£{{ $user_det->rate_per_hour }}  <small class="twelvesize">PER HOUR</small>
											@endif
                                           
										</div>
										<a href="{{ url('freelancers/freelancer-details/'.strtolower($user_det->first_name).'-'.strtolower($user_det->last_name).'/'.@$user_det->id.'?q=contact') }}" class="btn btn-success viewbtn">CONTACT</a>
									</div>
								</li>
								<!-- one jop ]] -->
							@endforeach
						
					</ul>
					<nav aria-label="..." class="paginationew text-right">
					{{ $users_details->render() }}
					</nav>
					@endif
				</div>
			</div>
			<!-- right col for job list -->
		</div>
		</form>
	</div>
</div>


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
	
/*$(function () {
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
});*/
</script>-->

@endsection
@section('customScript')
<script>
function search_freelancers(){
	$(".searchBtn").attr('disabled', true);
	$(".searchDataList").html('<div class="resultBox"><center><img src="{{ asset('assets/frontend/images/loading.gif') }}" alt="Loading..." title="Loading..."></center></div>');  
	//$('.infobox').show();
	var formData = $("#search_freelancer").serialize();
	$.ajax({
		type:'get',
		url:base_url+'freelancers/search-freelancers'+'?'+formData,
		success:function(response){
			var count = 0;
			//var res = $.parseJSON(response);
			$(".searchBtn").removeAttr('disabled', true);
			$(".resultBox").remove();
			$('.countString').html(response.countString);
			$('.ajaxSearchDataList').html(response.html);
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
		/*if(count == 0){
			$('.active').html('<a href="?page=1">1</a>');
			count++;
		}*/
		$('li').removeClass('active');
		$(this).parent('li').addClass('active');
		event.preventDefault();
		var myurl = $(this).attr('href');
		var page=$(this).attr('href').split('page=')[1];
		getData(page, '1');
	});
});

function getData(page,loader){
	if(loader == 1){
		$(".searchBtn").attr('disabled', true);
		$(".searchDataList").html('<div class="resultBox"><center><img src="{{ asset('assets/frontend/images/loading.gif') }}" alt="Loading..." title="Loading..."></center></div>');
	}
	var formData = $("#search_freelancer").serialize();
	$.ajax({
		url: '?page='+page+'&'+formData + '&pagination=1',
		type: "get",
		datatype: "html",
	}).done(function(response){
		$(".searchBtn").removeAttr('disabled', true);
		//console.log(response);
		$("#product_container").empty().html(response);
		location.hash = page;
		$('.countString').html(response.countString);
		$('.searchDataList').html(response.html);
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		$(".searchBtn").removeAttr('disabled', true);
		$('.ajaxSearchDataList').html('No response from server');
	});
}
</script>

@endsection