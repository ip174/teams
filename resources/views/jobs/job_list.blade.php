@extends('layouts.app')
<!--<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap-tagsinput.css') }}" />-->
@section('title')
Job bidding | My Posted Jobs
@endsection
@section('content')
<div class="tabmenu">
	<div class="container">
		 <!-- Nav tabs -->
		  <form action="" method="post">
		  {{ csrf_field() }}
		  <h2 class="streattiel">My Posted Jobs</h2>
		  <ul class="nav nav-tabs clearfix" role="tablist">
			<li role="presentation" class="active" onclick="showPostedJobs('1')"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">All Jobs</a></li>
			<li role="presentation" onclick="showPostedJobs('2')"><a href="#progress" aria-controls="review" role="tab" data-toggle="tab">In Progress</a></li>
			<li role="presentation" onclick="showPostedJobs('3')"><a href="#pending" aria-controls="review" role="tab" data-toggle="tab">Pending</a></li>
			<li role="presentation" onclick="showPostedJobs('4')"><a href="#completed" aria-controls="review" role="tab" data-toggle="tab">Completed</a></li>
			<a href="{{ url('/jobs/post-jobs') }}" class="btn btn-success btn-lg pull-right postjobbtn">+ POST A JOB</a>
		  </ul>
		  </form>
	</div><!-- container ]] -->
</div><!-- tab menu wrap ]] -->

<section class="postedjob">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
				<div class="recomndinfo">
					<h2>Activity Summary</h2>
				</div>
				<div class="infobox">
					<!--<center><img class="img-responsive" src="{{ asset('assets/frontend/images/jobpostright.png') }}"></center>-->
					<ul class="list-unstyled jobstatuslist">
						<li class="clearfix">
							<p class="pull-left">Job I Posted</p>
							<p class="pull-right allJobList">{{ count($allJobList) }}</p>
						</li>
						<li class="clearfix">
							<p class="pull-left">Job I In Progress</p>
							<p class="pull-right inprogressJobList">{{ $inprogressJobList }}</p>
						</li>
						<li class="clearfix">
							<p class="pull-left">Job I Pending</p>
							<p class="pull-right pendingJobList">{{ $pendingJobList }}</p>
						</li>
						<li class="clearfix">
							<p class="pull-left">Job I Completed</p>
							<p class="pull-right completedJobList">{{ $completedJobList }}</p>
						</li>
						<li class="clearfix">
							<p class="pull-left">Paid Out</p>
							<p class="pull-right">£ 987</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<div class="clearfix recomndinfo">
					<h2 class="pull-left">Jobs | Posted</h2>
					<select class="jobfilter pull-right">
						<option>Recent Jobs</option>
						<option>Lorem</option>
					</select>
				</div>
				<ul class="jobpostedlist">
					@if(count($allJobList) > 0)
						@foreach($allJobList as $eachJob)
						<li class="infobox">
							<div class="row">
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 full-vxs">
									<h3 class="jobtitle">{!! nl2br($eachJob->needs_to_design_job) !!}</h3>
									<div class="jobsortdetails">
									{!! nl2br($eachJob->job_description) !!}
									</div>
									<div class="tags">
										@foreach(getSkillsByJobId($eachJob->job_id) as $each_skills)
										<a href="#" class="btn btn-default">{{ $each_skills->skill_name }}</a>
										@endforeach
									</div>
								</div><!-- col left ]] -->
								<div class="col-lg-3 col-md-3 col-sm-3 co-xs-3 full-vxs text-right text-xs-left">
									<center>
										<!-- <img src="{{ asset('assets/frontend/images/progressbarwithinfo.png') }}" class="img-responsive"> -->
										@php
										$acceptedProposalDet = getProposalDetails('0', $eachJob->job_id, '', 'Y');
										//dd($acceptedProposalDet);
										$proposalId = count($acceptedProposalDet)>0 && isset($acceptedProposalDet[0]->proposal_id) ? $acceptedProposalDet[0]->proposal_id : '0';
										$proposalAmount = getProposalAmtByFreelancer($eachJob->job_id, $proposalId);
										//dd($proposalAmount);
										$totalMileStone = count($proposalAmount);
										$CompletedMileStone = 0;
										$completePercentage = 0;
										if($totalMileStone > 0)
										{
											foreach($proposalAmount as $eachMIlestoneAmount)
											{
												if($eachMIlestoneAmount->is_paid == '1')
												{
													$CompletedMileStone++;
												}
											}
											if($CompletedMileStone>'0')
											{
												$completePercentage = (($CompletedMileStone*100)/$totalMileStone);
											}
										}
										//echo $totalMileStone.'=';
										//echo $CompletedMileStone.'=';
										//echo $completePercentage.'=';
										@endphp
										<div class="workCompleted" data-percent="{{ round($completePercentage) }}"></div>
									</center>
								</div>
							</div>
							<div class="clearfix postjbbottom">
								<div class="col-lg-12 col-md-12 col-sm-12 co-xs-12 full-vxs text-right text-xs-left">
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
										{{ getProposalsByJobId($eachJob->job_id, 'count') }} Proposal
									</div>
									@php
									$user_id=0;
									$job_id = $eachJob->job_id;
									$isShortlisted='';
									$isAccepted='Y';
									$acceptedProposal = getProposalDetails($user_id, $job_id, $isShortlisted, $isAccepted);

									$ratingsCond['job_id'] = $eachJob->job_id;
									$ratingsCond['review_by_user'] = count($acceptedProposal) ? $acceptedProposal[0]->sent_by_user : '0';
									$ratings = $ratingsCond['review_by_user'] > 0 ? getJobRatings($ratingsCond) : '0';
									@endphp
									<div class="infofdate pull-left">
										<i class="fa fa-star-o" aria-hidden="true"></i>
										{{$ratings}} Itermediate
									</div>
									<div class="urgent pull-left">{!! $eachJob->turnaroundtime->around_time_type !!}</div>
							</div>
						</div>
						<div class="clearfix postjbbottom">
							<div class="col-lg-7 col-md-7 col-sm-7 co-xs-7"></div>
							<div class="col-lg-3 col-md-3 col-sm-3 co-xs-3 pull-right">
								<a href="{{ url('/jobs/view-project/'.$eachJob->job_id) }}" class="btn btn-success viewbtn" style="margin-right:10px;">View Project</a>
								@if($eachJob->job_status==1 || $eachJob->job_status==3)
								<a href="{{ url('/jobs/edit-posted-jobs/'.$eachJob->job_id) }}" class="btn btn-success viewbtn" style="margin-right:10px;">Edit</a>
								@endif
								<!--<a href="javascript:void(0)" class="btn btn-success viewbtn pull-right">Edit</a>-->
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 co-xs-2">
								@php
								$getReviewWhere['job_id'] = $eachJob->job_id;
								$getReviewWhere['review_by_user'] = Auth::user()->id;
								$getJobsReview = getJobsReview($getReviewWhere);
								$user_id = 0;
								$job_id = $eachJob->job_id;
								$isShortlisted = '';
								$isAccepted = '';
								$getProposalDetails = getProposalDetails($user_id, $job_id, $isShortlisted, $isAccepted);
								@endphp
								@if(!isset($getJobsReview[0]) && $eachJob->posted_by_user==Auth::user()->id && $eachJob->job_status==4)
								<a href="javascript:void(0);" class="btn btn-success viewbtn" onclick="openJobsReviewModal('{{ $eachJob->job_id }}')">REVIEW</a>
								<p class="gpnct"></p>
								@endif
							</div>
						</li>
						@endforeach
					@else
						<li class="infobox">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-vxs">
								No posted jobs Available
								</div>
							</div>
						</li>
					@endif
				</ul>
			</div>
		</div>
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

<div class="jobReviewModalArea">
@include('/jobs/modal_job_review')
</div>

@endsection
@section('customScript')
<!--<script src="{!! asset('assets/frontend/js/bootstrap-tagsinput.min.js') !!}" type="text/javascript"></script>-->

<script type="text/javascript">
var assessmentCount=2;
$("#newassessment").on("click",function()
{
	assessmentCount = assessmentCount++;
	var appendHTML = '<div id="theassessment" class="form-group relative clearfix"><a href="javascript:void(0)" class="todelte2 pull-right" id="deleteassessment"><i class="fa fa-times" aria-hidden="true"></i></a><input type="text" class="form-control"  placeholder="What challenges do you see doing this job?" name="freelancer_assessment[]" id="freelancer_assessment'+assessmentCount+'"></div>';
	$("#assessmentbox").append(appendHTML);
});

$("body").on("click", "#assessmentbox #deleteassessment",function()
{
	assessmentCount = assessmentCount--;
	$(this).parent().remove();
});

function showPostedJobs(type_id)
{
	$(".jobpostedlist").html('<center><img src="{{ asset('assets/frontend/images/loading.gif') }}" alt="Loading..." title="Loading..."></center>');  
	$('.jobpostedlist').show();
	var token = $("input[name=_token]").val();
	$.ajax({
		type:'post',
		url:base_url + 'jobs/my-jobs-list/'+type_id,
		data:{
			isAjax:true,
			type:type_id,
			_token:token
		},
		success:function(response)
		{
			//var res = $.parseJSON(response);
			$(".jobpostedlist").html(response.response_data);
			$(".allJobList").html(response.allJobList);
			$(".inprogressJobList").html(response.inprogressJobList);
			$(".pendingJobList").html(response.pendingJobList);
			$(".completedJobList").html(response.completedJobList);
			$('.workCompleted').percentcircle({
				animate : true,
				diameter : 100,
				guage: 10,
				coverBg: '#fff',
				bgColor: '#efefef',
				fillColor: '#D870A9',
				percentSize: '18px',
				percentWeight: 'normal'
			});
		}, error: function()
		{
			alert("Oops! Something went wrong, try again later.");
		}
	});
}

function preview_job()
{
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

function openJobsReviewModal(job_id)
{
	$(".modal_job_id").val(job_id);
	$("#reviewfeedModal").modal('show');
}

function saveReview()
{
	var modal_job_id = $(".modal_job_id").val().trim();
	var ratingVal = $(".modal_review_val").val().trim();
	var reviewComment = $(".reviewComment").val().trim();
	status = 1;
	errorMsg = "";

	if(modal_job_id==''){
		status = 0;
		errorMsg += errorMsg ? "<br>Something went wrong!" : "Something went wrong!";
	}
	if(ratingVal==''){
		status = 0;
		errorMsg += errorMsg ? "<br>Please check any rating!" : "Please check any rating!";
	}
	if(reviewComment==''){
		status = 0;
		errorMsg += errorMsg ? "<br>Please enter your review feedback!" : "Please enter your review feedback!";
	}

	if(status == 0){
		$(".validationMsg").css('color', '#FF0000');
		$(".validationMsg").html(errorMsg);
		return false;
	}else{
		//process.on();
		$.ajax({
			type:'post',
			url:'{{ url('/jobs/add-jobs-review') }}',
			data:{
				modal_job_id:modal_job_id,
				ratingVal:ratingVal,
				reviewComment:reviewComment,
				userType:'JP'
			},
			success:function(response){
				if(response.return_status == 0){
					$(".validationMsg").css('color', '#FF0000');
				}else{
					$(".validationMsg").css('color', '#0099ff');
				}
				$('.validationMsg').html(response.return_msg);
				window.location.reload(true);
			}, error: function(){
				$(".validationMsg").css('color', '#FF0000');
				$('.validationMsg').html('No response from server');
				//process.off();
			}
		});
	}
}
</script>


<script src="{{ asset('assets/frontend/plugin/circle_chart/js/jquery.circlechart.js') }}"></script>
<script>
$('.workCompleted').percentcircle({
	animate : true,
	diameter : 100,
	guage: 10,
	coverBg: '#fff',
	bgColor: '#efefef',
	fillColor: '#D870A9',
	percentSize: '18px',
	percentWeight: 'normal'
});
</script>
@endsection