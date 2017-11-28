@if(count($shortlistedProposals) > 0)
<ul class="propsallist">
	@foreach($shortlistedProposals as $eachProposal)
	@if($eachProposal->is_shortlisted == 'Y')
	<li class="clearfix">
		<div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 full-vxs">
			<div class="freelancerlist">
				<div class="profilePic" style="background-image:url({{ asset('assets/frontend/profile_pictures'.'/'.$eachProposal->user->profile_picture) }});">
					<div class="shape"></div>
				</div>
				@php
				$frelancerName = $eachProposal->user->first_name.' '.$eachProposal->user->last_name;
				$frelancerNameSlug = str_replace(' ', '-', trim(strtolower($frelancerName)));
				@endphp
				<h3 class="freelancername clearfix"><a href="{{ url('/freelancers/freelancer-details/'.$frelancerNameSlug.'/'.$eachProposal->sent_by_user) }}" target="_blank">{{ $frelancerName }}</a></h3>
				<div class="jobsortdetails">{{ isset($eachProposal->userDet->jobType->job_title) ? $eachProposal->userDet->jobType->job_title : 'Not Available' }}</div>
			</div>
			<ul class="list-inline clearfix profiledata">					
				<li class="pull-left"><p><i class="fa fa-map-marker"></i> {{ isset($eachProposal->userDet->location) ? $eachProposal->userDet->location : '' }}</p></li>
				<li class="pull-left"><p><i class="fa fa-align-center"></i> Portfolio({{ count(getPortfolioByUserID($eachProposal->sent_by_user)) }})</p></li>
				<li class="pull-left"><p><i class="fa fa-clock-o"></i> Posted {{ getDateDifference($eachProposal->created_at) }}</p></li>
			</ul>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-3 co-xs-3 full-vxs text-right text-xs-left priceprosal">
			<div class="projectprice">
				@php
				$estimatedAmount = getProposalAmtByFreelancer($eachProposal->job_id, $eachProposal->proposal_id);
				$totalEstimatedAmount=0;
				if(count($estimatedAmount) > 0){
					foreach($estimatedAmount as $eachAmount){
						$totalEstimatedAmount += $eachAmount->amount;
					}
				}
				@endphp
				£ {{ $totalEstimatedAmount }}
			</div>
			@if($eachProposal->is_accepted == 'Y')
				<a type="button" class="btn btn-success" title="Accepted">
					<i class="fa fa-check-square-o" aria-hidden="true"></i>
				</a>
			@else
				@if(count($getAcceptedProposal) == 0)
				<a type="button" onclick="acceptProposal('{{ $eachProposal->proposal_id }}', '{{ $eachProposal->job_id }}', 'Y')" class="btn btn-success viewbtn acceptbtn">ACCEPT <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
				@endif

				<a type="button" onclick="acceptProposal('{{ $eachProposal->proposal_id }}', '{{ $eachProposal->job_id }}', 'N')" class="btn btn-dander" style="border:1px solid #9b0f0b;" title="Remove">
					<i class="fa fa-times" aria-hidden="true"></i>
				</a>
			@endif
		</div>
	</li>
	@endif
	@endforeach
</ul>
<nav aria-label="..." class="paginationew text-right">
	{{ $shortlistedProposals->appends(['searchfor' => 'shortlisted' ])->render() }}
</nav>
@endif