@extends('layouts.app')
<!--<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap-tagsinput.css') }}" />-->
@section('title')
Job bidding | My Job Details
@endsection
@section('content')

<div class="tabmenu">
	<div class="container">
		<h2 class="streattiel">My Workstream</h2>
		<ul class="nav nav-tabs clearfix" role="tablist">
			<!----
			<li role="presentation" class="active">
				<a href="#profile" onclick="getJobs('1')" aria-controls="profile" role="tab" data-toggle="tab">All Jobs</a>
			</li>
			--->
			<li role="presentation" class="active">
				<a href="#progress" onclick="getJobs('2')" aria-controls="progress" role="tab" data-toggle="tab">In Progress</a>
			</li>
			<li role="presentation">
				<a href="#pending" onclick="getJobs('3')" aria-controls="pending" role="tab" data-toggle="tab">Pending</a>
			</li>
			<li role="presentation">
				<a href="#completed" onclick="getJobs('4')" aria-controls="completed" role="tab" data-toggle="tab">Completed</a>
			</li>
		</ul>
	</div>
</div>
<section class="postedjob">
	<div class="container">
		<div class="row">
			<!---
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
				<div class="recomndinfo">
					<h2>Activity Summary</h2>
				</div>
				<div class="infobox">
					@php
					$totalReviews = '';
					$totalRating = '';
					$rank = '';
					if(count($totalReviewsDetails)){
						$totalReviews = count($totalReviewsDetails) && count($totalReviewsDetails[0]->totalReviews) ? $totalReviewsDetails[0]->totalReviews : '0';
						$totalRating = count($totalReviewsDetails) && isset($totalReviewsDetails[0]->totalRating) ? $totalReviewsDetails[0]->totalRating : '0';
					}
					if($totalReviews > 0){
						$rank = (($totalRating*100)/($totalReviews*5));
					}
					@endphp
					<div class="halfcircluc clearfix">
						<div class="progressuc">
							<div class="barOverflow center-block">
								<div class="bar"></div>
							</div>
							<div class="showrate">
								<div>
									<span class="ucprorate">
										{{ round($rank) }}
									</span>%
								</div>
								<p class="text-muted">
									<i>Positive Feedback</i>
								</p>
							</div>
						</div>

						<h3 class="text-center proranktitle">
							You are ranked as
							<span class="text-success">
								Expert!
							</span>
						</h3>
					</div>

					<ul class="list-unstyled jobstatuslist">
						<li class="clearfix">
							<p class="pull-left">Job | Posted</p>
							<p class="pull-right">0</p>
						</li>
						<li class="clearfix">
							<p class="pull-left">Job | Awarded</p>
							<p class="pull-right">0</p>
						</li>
						<li class="clearfix">
							<p class="pull-left">Job in Progress</p>
							<p class="pull-right">{{ count($inProgress) }}</p>
						</li>
						<li class="clearfix">
							<p class="pull-left">Pending Proposal</p>
							<p class="pull-right">{{ count($pending) }}</p>
						</li>

					</ul>
				</div>
			</div>
			
			-->
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<div class="clearfix recomndinfo">
					<h2 class="pull-left">Project I am working on</h2>
					<select class="jobfilter pull-right">
						<option>Recent Jobs</option>
						<option>Lorem</option>
					</select>
				</div>
				<div class="jobDetails">
					@if(count($allJobDetails) > 0)
						<ul class="jobpostedlist">
							@foreach($allJobDetails as $eachJob)
								<li class="infobox">
									<div class="row">
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 full-vxs">
											<h3 class="jobtitle">{!! nl2br($eachJob->needs_to_design_job) !!}</h3>
											<div class="jobsortdetails">
											{!! nl2br($eachJob->job_description) !!}
											</div>
											<div class="tags">
												@foreach(getSkillsByJobId($eachJob->job_id) as $each_skills)
												<a href="javascript:void(0)" class="btn btn-default">{{ $each_skills->skill_name }}</a>
												@endforeach
											</div>
										</div><!-- col left ]] -->
										<div class="col-lg-3 col-md-3 col-sm-3 co-xs-3 full-vxs text-right text-xs-left">
											<center>
												<!-- <img src="{{ asset('assets/frontend/images/progressbarwithinfo.png') }}" class="img-responsive"> -->
												@php
												$proposalAmount = getProposalAmtByFreelancer($eachJob->job_id, $eachJob->proposal_id);
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
										<div class="infofdate pull-left">
											<i class="fa fa-clock-o" aria-hidden="true"></i>
											Posted {{ getDateDifference($eachJob->created_at) }}
										</div>
										<div class="infofdate pull-left">
											<i class="fa fa-map" aria-hidden="true"></i>
											{{ isset($eachJob->location) ? $eachJob->location : '' }}
										</div>
										<div class="infofdate pull-left">
											<i class="fa fa-brick" aria-hidden="true"></i>
											{{ getProposalsByJobId($eachJob->job_id, 'count') }} Proposal
										</div>
										@php
										$user_id=0;
										$job_id = $eachJob->job_id;
										$isShortlisted='';
										$isAccepted='Y';
										$acceptedProposal = getProposalDetails($user_id, $job_id, $isShortlisted, $isAccepted);
										//print_r($acceptedProposal[0]->sent_by_user);exit;

										$ratingsCond['job_id'] = $eachJob->job_id;
										$ratingsCond['review_by_user'] = count($acceptedProposal) ? $acceptedProposal[0]->sent_by_user : '0';
										$ratings = $ratingsCond['review_by_user']>0 ? getJobRatings($ratingsCond) : '0';
										@endphp
										<div class="infofdate pull-left">
											<i class="fa fa-star-o" aria-hidden="true"></i>
											{{$ratings}} Itermediat
										</div>
										<div class="urgent pull-left">{!! getTurnAroundTimeById($eachJob->turn_around_time) !!}</div>
										
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
										@if(!isset($getJobsReview[0]) && (isset($getProposalDetails[0]) && $getProposalDetails[0]->sent_by_user==Auth::user()->id) && $eachJob->job_status==4)
										<a href="javascript:void(0);" class="btn btn-success viewbtn" onclick="openJobsReviewModal('{{ $eachJob->job_id }}')">REVIEW</a>
										<p class="gpnct"></p>
										@endif
										<a href="{{ url('/jobs/send-proposal/'.$eachJob->job_id) }}" class="btn btn-success viewbtn pull-right" style="margin-right:10px;">View Job</a>
									</div>
								</li>
							@endforeach
						</ul>
						<!--<nav aria-label="..." class="paginationew text-right">
							
						</nav>-->
					@else
						<p>No data found!</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>

<div class="jobReviewModalArea">
	@include('/jobs/modal_job_review')
</div>

@endsection


@section('customScript')
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

function getJobs(type_id)
{
	process.on();
	//var token = $("input[name=_token]").val();
	$.ajax({
		type:'post',
		url:base_url + 'jobs/my-workstream/'+type_id,
		data:{
			isAjax:true,
			type:type_id
		},
		success:function(response)
		{
			if(response.response_status == 1)
			{
				$(".jobDetails").html(response.response_data);
			}
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
			process.off();
		}, error: function()
		{
			alert("Oops! Something went wrong, try again later.");
			process.off();
		}
	});
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

	if(modal_job_id=='')
	{
		status = 0;
		errorMsg += errorMsg ? "<br>Something went wrong!" : "Something went wrong!";
	}
	if(ratingVal=='')
	{
		status = 0;
		errorMsg += errorMsg ? "<br>Please check any rating!" : "Please check any rating!";
	}
	if(reviewComment=='')
	{
		status = 0;
		errorMsg += errorMsg ? "<br>Please enter your review feedback!" : "Please enter your review feedback!";
	}

	if(status == 0)
	{
		$(".validationMsg").css('color', '#FF0000');
		$(".validationMsg").html(errorMsg);
		return false;
	}
	else
	{
		//process.on();
		$.ajax({
			type:'post',
			url:'{{ url('/jobs/add-jobs-review') }}',
			data:{
				modal_job_id:modal_job_id,
				ratingVal:ratingVal,
				reviewComment:reviewComment,
				userType:'F'
			},
			success:function(response)
			{
				if(response.return_status == 0)
				{
					$(".validationMsg").css('color', '#FF0000');
				}
				else
				{
					$(".validationMsg").css('color', '#0099ff');
				}
				$('.validationMsg').html(response.return_msg);
				window.location.reload(true);
			}, error: function()
			{
				$(".validationMsg").css('color', '#FF0000');
				$('.validationMsg').html('No response from server');
				//process.off();
			}
		});
	}
}


$(".progressuc").each(function()
{
	var $bar = $(this).find(".bar");
	var $val = $(this).find(".ucprorate");
	var perc = parseInt( $val.text(), 10);
	$({p:0}).animate({p:perc}, {
		duration: 1500,
		easing: "swing",
		step: function(p) {
			$bar.css({
			transform: "rotate("+ (45+(p*1.8)) +"deg)", // 100%=180° so: ° = % * 1.8
			// 45 is to add the needed rotation to have the green borders at the bottom
			});
			$val.text(p|0);
		}
	});
});
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