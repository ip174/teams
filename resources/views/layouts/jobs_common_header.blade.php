<style>
.active>a{
	cursor: pointer !important;
}
</style>

<section class="projectsortinfo jobdetails">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 pull-right text-right">
				<div class="projectprice text-white">
					<!--£150 <small>FIXED PRICE</small>-->
				</div>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-9">
				<h1><strong>Job ID: #{{ isset($jobDetails->job_reference_id) ? $jobDetails->job_reference_id : '' }}</strong>
				{{ isset($jobDetails->needs_to_design_job) ? $jobDetails->needs_to_design_job : '' }}
				</h1>

				<ul class="list-inline posterinfo">
					<li>
						@php
						$postedByUser = "";
						$postedByUser = isset($jobDetails->user->first_name) ? $jobDetails->user->first_name : '';
						$postedByUser .= isset($jobDetails->user->last_name) ? ' '.$jobDetails->user->last_name : '';
						$profilePic = isset($jobDetails->user->profile_picture) ? $jobDetails->user->profile_picture : '';
						$createdAt = isset($jobDetails->created_at) ? $jobDetails->created_at : '';
						$job_idHeader = isset($jobDetails->job_id) ? $jobDetails->job_id : '0';
						@endphp
						<div class="profilePic" style="background-image:url('{{ profilePicPath($profilePic) }}');">
							<div class="shape"></div>
						</div>
					</li>
					<li>By: {{ $postedByUser }}</li>
					<li><i class="fa fa-clock-o"></i>{{ getDateDifference($createdAt) }}</li>
					<li><i class="fa fa-map-marker"></i> {{ isset($jobDetails->location) ? $jobDetails->location : '' }}</li>
					<li><i class="fa fa-briefcase"></i> {{ getProposalsByJobId($job_idHeader, 'count') }} proposals</li>

					@php
					$user_id=0;
					$job_id = $job_id;
					$isShortlisted='';
					$isAccepted='Y';
					$acceptedProposal = getProposalDetails($user_id, $job_id, $isShortlisted, $isAccepted);
					//print_r($acceptedProposal[0]->sent_by_user);exit;

					$ratingsCond['job_id'] = $job_id;
					$ratingsCond['review_by_user'] = count($acceptedProposal) ? $acceptedProposal[0]->sent_by_user : '0';
					$ratings = $ratingsCond['review_by_user']>0 ? getJobRatings($ratingsCond) : '0';
					@endphp
					<li><i class="fa fa-star-o"></i> {{ $ratings }}</li>
					<li><span class="urgent">URGENT</span></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<div class="tabmenu">
	<div class="container">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs pull-left">
			<!--<li class="{{ $activeMenu == 'Overview' ? 'active' : '' }}"><a href="{{ url('/jobs/preview-job/'.$job_id) }}">Overview</a></li>-->
			<li class="{{ $activeMenu == 'Overview' ? 'active' : '' }}"><a href="{{ url('/jobs/send-proposal/'.$job_id) }}">Overview</a></li>


			
			@if(getWorkflowAccess($job_id, Auth::user()->id))
			<li class="{{ $activeMenu == 'Workflow' ? 'active' : '' }}">
				<a href="{{ url('/workflow/view-workflow/'.$job_id) }}">Workflow
					<span class="badge badge-danger workflow_count">0</span>
				</a>
			</li>
			@endif


			
			<li class="{{ $activeMenu == 'Assets' ? 'active' : '' }}"><a href="{{ url('/jobs/job-assets/'.$job_id) }}">Assets</a></li>


			
			@if(getMessageAccess($job_id, Auth::user()->id))
			<li class="{{ $activeMenu == 'Messages' ? 'active' : '' }}"><a href="{{ url('/chat/job-chat-box/'.$job_id) }}">Messages</a></li>
			@endif


			
			@if(getWorkflowAccess($job_id, Auth::user()->id))
			<li class="{{ $activeMenu == 'Payments' ? 'active' : '' }}"><a href="{{ url('/payments/view-payments/'.$job_id) }}">Payment</a></li>
			@endif


			
			@if(getProposalAccess($job_id, Auth::user()->id))
			<li class="{{ $activeMenu == 'Settings' ? 'active' : '' }}"><a href="{{ url('/settings/view-project-settings/'.$job_id) }}">Settings</a></li>

			<li class="{{ $activeMenu == 'Proposals' ? 'active' : '' }}"><a href="{{ url('/jobs/view-project/'.$job_id) }}">Proposals</a></li>
			@endif
			
		</ul>
	</div><!-- container ]] -->
</div>