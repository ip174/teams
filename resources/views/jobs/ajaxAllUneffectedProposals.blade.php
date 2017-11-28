@if(count($allProposals) > 0)
	<ul class="propsallist">
		@foreach($allProposals as $eachProposal)
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
					<div class="jobsortdetails">{{ isset($eachProposal->userDet->jobType->job_title) ? $eachProposal->userDet->jobType->job_title : '' }}</div>
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
				<a type="button" onclick="viewProposalDetails('{{ $eachProposal->proposal_id }}')" class="btn btn-success viewbtn tooltips" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
				<a type="button" onclick="shortlistProposal('{{ $eachProposal->proposal_id }}', '{{ $eachProposal->job_id }}')" class="btn btn-success viewbtn tooltips" title="Shortlist"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>
			</div>
		</li>
		@endforeach
	</ul>
	<nav aria-label="..." class="paginationew text-right">
		{{ $allProposals->appends(['searchfor' => 'all' ])->render() }}
	</nav>
@endif