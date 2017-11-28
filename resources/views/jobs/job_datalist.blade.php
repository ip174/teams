<ul class="jobpostedlist">
	@if(count($jobList) > 0)
		@foreach($jobList as $eachJob)
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
						@php
						$acceptedProposalDet = getProposalDetails('0', $eachJob->job_id, '', 'Y');
						//print_r($acceptedProposalDet); exit;
						
						$proposalId = count($acceptedProposalDet)>0 && isset($acceptedProposalDet[0]->proposal_id) ? $acceptedProposalDet[0]->proposal_id : '0';
						//print_r($proposalId); exit;
						
						$proposalAmount = getProposalAmtByFreelancer($eachJob->job_id, $proposalId);
						//print_r($proposalAmount); exit;
						
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
					@if(!isset($getJobsReview[0]) && $eachJob->posted_by_user==Auth::user()->id && $eachJob->job_status>=4)
					<a href="javascript:void(0);" class="btn btn-success viewbtn" onclick="openJobsReviewModal('{{ $eachJob->job_id }}')">REVIEW</a>
					<p class="gpnct"></p>
					@endif
				</div>
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