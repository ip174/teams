@extends('layouts.app')
@section('title')
Job bidding | Dashboard
@endsection
@section('content')
@php
$currentMonthViews = 0;
$lastMonthViews = 0;
$profileViewIncrese = 0;
@endphp
<script type="text/javascript">
//var profileViews = [50, 77, 18, 33, 10, 21, 67];
var profileViews = [0,0,0,0,0,0,0];
var lastMonthprofileViews = [0,0,0,0,0,0,0];
@if(count($dayWiseProfileViews) > 0)
	@foreach($dayWiseProfileViews as $eachDay)
		profileViews[{{$eachDay->weekdays}}] = {{ $eachDay->total_view }};
		@php
		$currentMonthViews = $currentMonthViews + $eachDay->total_view;
		@endphp
	@endforeach
@endif

@if(count($lastMonthProfileViews) > 0)
	@foreach($lastMonthProfileViews as $eachDay)
		lastMonthprofileViews[{{$eachDay->weekdays}}] = {{ $eachDay->total_view }};
		@php
		$lastMonthViews = $lastMonthViews + $eachDay->total_view;
		@endphp
	@endforeach
@endif
</script>

@php
if($currentMonthViews > $lastMonthViews && $lastMonthViews > 0){
	$profileViewIncrese = ((($currentMonthViews-$lastMonthViews)*100)/$lastMonthViews);
}
@endphp
<div class="mainBody">
	<div class="wrapper">
		<h1 class="clearfix"><!--Good morning-->Welcome, {{ $user_det->first_name }} <!--<a href="{{ url('user/my-profile') }}"></a>--> <span class="lastlogin pull-right">Last login: {{ date('dS M, Y | h:i A', strtotime($last_login->loginDtTime)) }}</span></h1>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="infobox">
					<div class="infotitle">
					Job Invitations
					</div>
					<ul class="list-unstyled infolist">
						@if(count($invitationJobsList) > 0)
							@foreach($invitationJobsList as $eachjob)
							<li>
								<p>{{ isset($eachjob->needs_to_design_job) ? $eachjob->needs_to_design_job : '' }}</p>
								<div class="infocontent">{{ makeDotMoreTxt($eachjob->job_description, 80) }}</div>
								<div class="infodate pull-left clearfix">
									<i class="fa fa-clock-o" aria-hidden="true"></i>
									Posted {{ getDateDifference($eachjob->created_at) }} <span class="urgent pull-right">URGENT</span>
								</div>
								<a href="{{ url('/jobs/send-proposal/'.$eachjob->job_id) }}" class="btn btn-success viewbtn pull-right">VIEW JOB</a>
								<div class="clearfix"></div>
							</li>
							@endforeach
							<li>
								<div class="text-right"><a href="{{ url('/jobs/my-workstream') }}">More...</a></div>
							</li>
						@else
							<li>
								<p>Not available !</p>
							</li>
						@endif
					</ul>
				</div><!-- infobox ]] -->
			</div><!-- col ]] -->	
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="infobox">
					<div class="infotitle clearfix">
						Work in progress
						<!-- <select class="jobfilter pull-right">
							<option>All Jobs </option>
							<option>Lorem ipsum</option>
						</select> -->
					</div>

					<ul class="list-unstyled infolist">
						@if(count($inProgressJobsList) > 0)
							@foreach($inProgressJobsList as $eachjob)
							<li>
								<p>{{ isset($eachjob->needs_to_design_job) ? $eachjob->needs_to_design_job : '' }}</p>
								<div class="infocontent">{{ makeDotMoreTxt($eachjob->job_description, 80) }}</div>
								<div class="infodate pull-left clearfix">
									<i class="fa fa-clock-o" aria-hidden="true"></i>
									Posted {{ getDateDifference($eachjob->created_at) }} <span class="urgent pull-right">URGENT</span>
								</div>
								<a href="{{ url('/jobs/send-proposal/'.$eachjob->job_id) }}" class="btn btn-success viewbtn pull-right">VIEW JOB</a>
								<div class="clearfix"></div>
							</li>
							@endforeach
							<li>
								<div class="text-right"><a href="{{ url('/jobs/my-workstream') }}">More...</a></div>
							</li>
						@else
							<li>
								<p>Not available !</p>
							</li>
						@endif
					</ul>
				</div><!-- infobox ]] -->
			</div><!-- col ]] -->
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
						  	<div><span class="ucprorate">{{ round($rank) }}</span>%</div>
						  	<p class="text-muted"><i>Positive Feedback</i></p>
						  </div>
						</div>

						<h3 class="text-center proranktitle">You are ranked as <span class="text-success">Expert!</span></h3>
					</div>

					<div id="bar-chart"></div>
					<div class="clearfix padd25">	
						<div class="pull-left">
							<h3 class="prview">Profile view</h3>
							<a class="increaseview" href="{{ url('/increse-your-views') }}">Increase your views</a>
						</div>
						<h3 class="compareinfo pull-right">
						+{{ $profileViewIncrese }}% <small>Compared to last month</small>
						</h3>
					</div>
					<ul class="jobstatus list-inline">
						<li class="completejob">
							<span class="stnm">{{ count($myCompletedJobs) }}</span>
							<p>JOBS</p>
							<h6>COMPLETED</h6>
						</li><!-- ]] -->
						<li class="inprogressjob">
							<span class="stnm">{{ count($inProgressJobsCount) }}</span>
							<p>JOBS</p>
							<h6>IN-PROGRESS</h6>
						</li><!-- ]] -->
						<li class="postedjob">
							<span class="stnm">{{ count($postedJobs) }}</span>
							<p>JOBS</p>
							<h6>POSTED</h6>
						</li><!-- ]] -->
					</ul><!--  job status info ]] -->	
					<ul class="list-inline bidnprojectstaus clearfix">
						<li class="bidleft clearfix">
							<span>15</span>
							Bidding credits left
						</li>
						<li class="projectleft clearfix">
						<span>2</span>
						Uninvoiced project
						</li>
					</ul>				
				</div><!-- infobox ]] -->
			</div><!-- col ]] -->
		</div><!-- row ]] -->
			
		<div class="clearfix recomndinfo">
			<h2 class="pull-left">Recommended Jobs
				<small>
					{{ $recomendJobs->count() }}, {{ $recomendJobs->total() }} found
				</small>
			</h2>
			<!-- <select class="jobfilter pull-right">
				<option>Recent Jobs</option>
				<option>Lorem</option>
			</select> -->
		</div>
		<ul class="jobpostedlist infobox">
			@if(count($recomendJobs) > 0)
				@foreach($recomendJobs as $eachJob)
				<li class="clearfix">
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 full-vxs">
						@if($eachJob->posted_by_user != Auth::user()->id)
							<h3 class="jobtitle" href="{{ url('/jobs/send-proposal/'.$eachJob->job_id) }}">{{ $eachJob->needs_to_design_job }}</h3>
						@else
							<h3 class="jobtitle" href="{{ url('/jobs/view-project/'.$eachJob->job_id) }}">{{ $eachJob->needs_to_design_job }}</h3>
						@endif
						<div class="jobsortdetails">{!! nl2br($eachJob->job_description) !!}</div>
						<div class="tags">
							@foreach(getSkillsByJobId($eachJob->job_id) as $each_skills)
							<a href="javascript:void(0);" class="btn btn-default">{{ $each_skills->skill_name }}</a>
							@endforeach
						</div>
						<div class="infofdate pull-left">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							Posted {{ getDateDifference($eachJob->created_at) }}
						</div>
						<div class="infofdate pull-left">
							<i class="fa fa-map" aria-hidden="true"></i>
							Remote
						</div>
						<div class="infofdate pull-left">
							<i class="fa fa-brick" aria-hidden="true"></i>
							{{ getProposalsByJobId($eachJob->job_id, 'count') }} Proposal
						</div>
						<div class="infofdate pull-left">
							<i class="fa fa-star-o" aria-hidden="true"></i>
							2 Itermediat
						</div>
						@php
						$TurnedAroundTimeId = isset($eachJob->turn_around_time) ? $eachJob->turn_around_time : '0';
						$turnedAroundTime = getTurnAroundTimeById($TurnedAroundTimeId);
						@endphp
						<div class="urgent pull-left">{!! isset($turnedAroundTime) ? $turnedAroundTime : '' !!}</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 co-xs-3 full-vxs text-right text-xs-left">
						<div class="projectprice">
							£ {{ $eachJob->budget_amount }} <small>FIXED PRICE</small>
						</div>
						@if($eachJob->posted_by_user != Auth::user()->id)
							<a href="{{ url('/jobs/send-proposal/'.$eachJob->job_id) }}" class="btn btn-success viewbtn">BID ON THIS JOB</a>
						@else
							<a href="{{ url('/jobs/view-project/'.$eachJob->job_id) }}" class="btn btn-success viewbtn">VIEW PROPOSAL</a>
						@endif
					</div>
				</li>
				@endforeach
			@endif
		</ul>
		<div class="text-right">
			<nav aria-label="..." class="paginationstyl">
				{{$recomendJobs->render()}}
			</nav>
		</div>
	</div>
</div>
@endsection
@section('customScript')
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script src="{!! asset('assets/frontend/js/chartuc.js') !!}"></script>


<script type="text/javascript">
//var profileViews = [5, 7, 8, 3, 10, 0, 6];

	// half circle progressbarr

$(".progressuc").each(function(){
  
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
@endsection





