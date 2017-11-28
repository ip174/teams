<?php /* ?>@if($pagination != 1)<?php */ ?>
	<ul class="jobpostedlist infobox searchDataList">
<?php /* ?>@endif<?php */ ?>

@if(count($jobs) > 0)
	@foreach($jobs as $eachJob)
		<li class="">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 full-vxs">
					<h3 class="jobtitle">
						@if($eachJob->posted_by_user != Auth::user()->id)
							<a href="{{ url('/jobs/send-proposal/'.$eachJob->job_id) }}">{{ $eachJob->needs_to_design_job }}</a>
						@else
							<a href="{{ url('/jobs/view-project/'.$eachJob->job_id) }}">{{ $eachJob->needs_to_design_job }}</a>
						@endif
					</h3>
					<div class="jobsortdetails">
					{!! nl2br($eachJob->job_description) !!}
					</div>
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
					<div class="urgent pull-left">{!! $eachJob->turnaroundtime->around_time_type !!}</div>
				</div><!-- col left ]] -->
				<div class="col-lg-3 col-md-3 col-sm-3 co-xs-3 full-vxs text-right text-xs-left">
					<!--<div class="projectprice">
						£150 <small>FIXED PRICE</small>
					</div>-->
					@if($eachJob->posted_by_user != Auth::user()->id)
						@if(in_array($eachJob->job_id, $jobIdsArray))
							<a href="{{ url('/jobs/send-proposal/'.$eachJob->job_id) }}" class="btn btn-success viewbtn">VIEW SENT PROPOSAL</a>
						@else
							<a href="javascript:void(0)" class="btn btn-success viewbtn" onclick="checkAvailableBidCredit('{{ url('/jobs/send-proposal/'.$eachJob->job_id) }}')">BID ON THIS JOB</a>
						@endif
					@else
						<a href="{{ url('/jobs/view-project/'.$eachJob->job_id) }}" class="btn btn-success viewbtn">VIEW PROPOSAL</a>
					@endif
				</div>
			</div>
		</li>
	@endforeach
	
	<?php /* ?>@if($pagination != 1)<?php */ ?>
		</ul>
	<nav aria-label="..." class="paginationew text-right">
		{{ $jobs->render() }}
	</nav>
	<?php /* ?>@endif<?php */ ?>

@else
	<li style="text-align:center;">No data found</li>
@endif