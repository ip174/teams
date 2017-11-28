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
					<a href="{{ url('/jobs/send-proposal/'.$eachJob->job_id) }}" class="btn btn-warning viewbtn pull-right" style="margin-right:10px;">View Job</a>
				</div>
			</li>
		@endforeach
	</ul>
	<!--<nav aria-label="..." class="paginationew text-right">
		
	</nav>-->
@else
	<p>No data found!</p>
@endif