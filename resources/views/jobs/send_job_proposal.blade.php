@extends('layouts.app')
@section('title')
Job bidding | Send Proposal


@endsection
@section('content')
<style>
.todelte {
    width: 25px;
    height: 25px;
    display: block;
    background: transparent url({{ asset('assets/frontend/images/delete-icon.png') }}) no-repeat center center / cover !important;
    margin: 0 0 9px;
}
.todelte:hover {
    background-image:url("{{ asset('assets/frontend/images/delete-icon-hover.png') }}") !important;
}
</style>

<section class="jobproposal">
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="/jobs/search-jobs">Jobs</a></li>
		  <!--- <li><a href="#">{!! nl2br($jobDetails->category) !!}</a></li> -->
		  <li class="active"><u>Job ID: #{!! nl2br($jobDetails->job_id) !!}</u></li>
		</ol>
		<div class="row">
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 leftjbcol">
				<div class="infobox panel-body">
					<div class="row">
						@php
						$postedByUser = "";
						$postedByUser = isset($jobDetails->user->first_name) ? $jobDetails->user->first_name : '';
						$postedByUser .= isset($jobDetails->user->last_name) ? ' '.$jobDetails->user->last_name : '';
						$profilePic = isset($jobDetails->user->profile_picture) ? $jobDetails->user->profile_picture : '';
						$createdAt = isset($jobDetails->created_at) ? $jobDetails->created_at : '';
						$job_idHeader = isset($jobDetails->job_id) ? $jobDetails->job_id : '0';
						@endphp						
						
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<div class="catetitle">{!! nl2br($jobDetails->needs_to_design_job) !!}</div>
						</div>	
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
							{!! ($jobDetails->is_urgent_assignment == 'N') ? '<span class="urgent" style="font-size:13px; margin-top:5px;">URGENT</span>' : '' !!}
						</div>	
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="text-align:right;">
							<div class="catetitle" style="font-size:34px;">	&#163;{!! nl2br($jobDetails->budget_amount) !!}</div>
							<!--- <span>{!! nl2br($jobDetails->paymentType) !!}</span> -->
						</div>	
					</div>
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<ul class="detailsbox">
								<li style="display:inline-block;">Posted {{ getDateDifference($createdAt) }} </li>
								<li style="display:inline-block;"> | {{ getProposalsByJobId($job_idHeader, 'count') }} Proposal</li>
							</ul>
						</div>	
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						</div>	
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="text-align:right;">
							<div class="detailsbox" style="">{!! strtoupper(nl2br($jobDetails->paymentType)) !!} PRICE</div>
							<!--- <span>{!! nl2br($jobDetails->paymentType) !!}</span> -->
						</div>	
					</div>					
					
					<label>Job Description:</label>
					<div class="detailsbox">
						{!! nl2br($jobDetails->job_description) !!}
					</div>
					<div class="form-group clearfix" style="margin:30px 0px 30px 0px;">
						<label class="pull-left">Skills required for this job:</label>
						<div class="tags pull-left">
							@if(count($requiredSkillNames) > 0)
								@foreach($requiredSkillNames as $eachSkill)
									<a href="javascript:void(0)" class="btn btn-default">{{ $eachSkill->skill_name }}</a>
								@endforeach
							@endif
						</div>
					</div>
					<div style="margin:30px 0px 30px 0px;">
						<label>Attachment:</label>
						<ul class="list-unstyled attachmenticon ver2">
							<li><a href="{{ asset('assets/upload/post_job_files'.'/'.$jobDetails->attached_file) }}" download>Download attached file</a></li>
						</ul>
					</div>
				
					<div class="sendProposalformcont">
				
						@if(($jobDetails->posted_by_user != Auth::user()->id) && in_array($jobDetails->job_status, array('1', '2', '3', '5')))
						@if(trim($successMsg) != '')
							<div class="alert alert-success" style="margin-left:15px;">
								<ul>
									<li>{{ trim($successMsg) }}</li>
								</ul>
							</div>
						@endif
						@if (count($errors) > 0)
							<div class="alert alert-danger" style="margin-left:15px;">
								<ul>
									@foreach($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						@if(count($proposalSentByUser) == 0)
							<form action="{{ url('/jobs/send-proposal/'.$job_id) }}" id="send_proposal_form" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								
								<label>Apply for this job with your proposal
									<a type="button" data-toggle="tooltip" data-placement="right" title="" class="badge" data-original-title="Apply for this job with your proposal">?</a>
								</label>
								
								<div class="form-group">
									<textarea name="proposal_description" class="form-control" style="border:1px solid #61C46E;border-radius:3px;" cols="" rows="8" placeholder="I am very interested to apply for..." required>{{ old('proposal_description') }}</textarea>
								</div>
								
								<div class="form-group">
									<label>Interview question: <span>What challenges do you see doing this job?</span></label>
									<textarea name="interview_question_challanges" class="form-control" cols="" rows="2" placeholder="Answer..." >{{ old('interview_question_challanges') }}</textarea>
								</div>
								
								<div class="form-group">
									<label>Attachment</label>
									<label class="uploadBox">
										<input name="attached_file" class="attached_file introduce_file" id="attached_file" type="file">
										<div class="txtF">
											<div class="introduce-file-text"><i class="material-icons" style="vertical-align: -7px;">&#xE2BC;</i> Drop file here or <span>Browse</span></div>
										</div>
									</label>
								</div>

								<div class="row" style="margin-top:20px;">
									<label class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										Cost Breakdown
									</label>
									<label class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Amount (Per Hour)</label>
								</div>
								
								<div id="amount-deskcriptionbox">
									<div class="row" id="amount-sek-box">
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">
											<input class="form-control" placeholder="Item description..." name="item_description[]" type="text" required>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
											<div class="input-group">
												<div class="input-group-addon">£</div>
												<input class="form-control" id="exampleInputAmount" placeholder="Amount" name="amount[]" required>
											</div>
										</div>
									</div>
								</div>
								
								<a href="javascript:void(0)" id="addnewaount" class="adnew">+ Add another item</a>
							
								@php
								$jobSettings = getJobSettings();

								$usersAvailableBids = getBidCreditsDebits(Auth::user()->id, date('m-Y'));
								$freeBidCredit = isset($usersAvailableBids->freeBidCredit) ? $usersAvailableBids->freeBidCredit : '0';
								$freeBidDebit = isset($usersAvailableBids->freeBidDebit) ? $usersAvailableBids->freeBidDebit : '0';
								$paidBidCredit = isset($usersAvailableBids->paidBidCredit) ? $usersAvailableBids->paidBidCredit : '0';
								$paidBidDebit = isset($usersAvailableBids->paidBidDebit) ? $usersAvailableBids->paidBidDebit : '0';
								$availableFreeBid = ($freeBidCredit-$freeBidDebit);
								$availablePaidBid = ($paidBidCredit-$paidBidDebit);
								$isBidAvailable = 0;
								if($availableFreeBid >= $jobSettings->normal_fee_per_bid || $availablePaidBid >= $jobSettings->normal_fee_per_bid){
									$isBidAvailable = 1;
								}
								@endphp
								
								<div class="clearfix agreebox">
									@if($isBidAvailable)
										<label class="checkFld pull-left">

								<div class="clearfix highlight-bid">
									<hr />
									<br />
									@php
									$getJobSettings = getJobSettings();
									@endphp
									<div class="checkFld pull-left">
										<input type="checkbox" name="highlight_bid" value="1" checked>
										<i class="fa fa-square-o"></i>
										<span style="color:#61C46E;text-decoration:underline;">Highlight your bid</span> to be ahead of your competitors
										<span class="highlightBidMsg" style="display:none;">
										<br/>You need to pay {{ $getJobSettings->highlight_bid_fee }} credit for this bid</span>
									</div>
								</div>
										</label>
										<input class="button green pull-right submitbtn" value="SEND PROPOSAL" type="submit">
									@else
										<label class="pull-left">
											<a href="{{ url('/settings/user-general-settings?q=bid-purchase') }}">You don't have available bid to send proposal respect this job. Please buy new bid.</a>
										</label>
									@endif
								</div>
							</form>
						@else
							@if(in_array($jobDetails->job_status, array('1', '3', '5')))
								<div class="row">
									<label class="col-lg-10 col-md-10 col-sm-10 col-xs-12"></label>
									<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<a href="{{ url('/jobs/edit-proposal/'.$job_id) }}" type="button" title="" class="btn btn-success">Edit</a>
									</label>
								</div>
							@endif
							
							<label>Apply for this job with your proposal
								<a type="button" data-toggle="tooltip" data-placement="right" title="" class="badge" data-original-title="Apply for this job with your proposal">?</a>
							</label>
							<div class="form-group">{!! nl2br($proposalSentByUser->description) !!}</div>
							
							<div class="form-group">
								<label>Assesment - Interview questions</span></label>
							</div>
							<div class="form-group">{!! nl2br($proposalSentByUser->interview_question_challanges) !!}</div>
							
							<div class="form-group">
								<label>Attachment</label>
							</div>
							<div class="form-group">
							@php
							$fileName = isset($proposalSentByUser->attached_file) ? $proposalSentByUser->attached_file : '';
							@endphp

							@if(!empty($fileName))
							<a href="{{ asset('assets/upload/job_proposal_files/'.$fileName) }}" download>Download</a>
							@endif
							</div>

							<div class="row">
								<label class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
									Cost Breakdown
									<a type="button" data-toggle="tooltip" data-placement="top" title="" class="badge" data-original-title="Cost Breakdown">?</a>
								</label>
								<label class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Amount (Per Hour)</label>
							</div>
							
							<div id="amount-deskcriptionbox">
								@if(count($proposalEstimatedAmount) > 0)
									@foreach($proposalEstimatedAmount as $eachAmount)
										<div class="row" id="amount-sek-box">
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">
												{{ $eachAmount->item_description }}
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
												<div class="input-group">
													<div class="input-group-addon">
													£ {{ $eachAmount->amount }}
													</div>
												</div>
											</div>
										</div>
									@endforeach
								@endif
							</div>

							@if($proposalSentByUser->is_highlight_bid=='Y')
							<div class="row">
								<label class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
									Highlight bid
								</label>
							</div>
							@endif
						@endif
						@endif
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 rightjbcol">
				<div class="infobox panel-body rightnewpanl white-bg">
					<a href="#amount-deskcriptionbox" class="btn btn-success btnsm">APPLY NOW</a>
					<a href="#" class="btn btn-success btnsm onlyborder mrgl9"><i class="material-icons">star_border</i> SAVE JOB</a>
					
					<!--- <p class="text-center parajbn">or <a href="#">Decline Invitation</a></p> --->
					
					<div class="clearfix withsmavatar panel-body">
						<div class="avatarsm" style="background-image:url('{{ profilePicPath($profilePic) }}');">
							<div class="shape"></div>
						</div>
						<p>Hirer: {{ $postedByUser }}</p>
						<a class="quwstn">
							<span class="btn-block"><img src="{{ asset('assets/frontend/images/que_ico.png') }}" class="img-responsive center-block"></span>
							Question
						</a>

					</div>

					<ul class="list-unstyled listsjbinfo">
						<li>
							<div class="row">
								<span class="ljbico">
									<i class="material-icons">done_all</i>
								</span>
								<div class="col-xs-6 txtleftjb">
								Seniority</div>
								
								<div class="col-xs-6 txtrightjb">
								<!-- {{ $jobDetails->experience_level }} --> All </div>
							</div>

						</li>
						<li>
							<div class="row">
								<span class="ljbico">
									<i class="material-icons">access_time</i>
								</span>
								<div class="col-xs-6 txtleftjb">
								Project lenth</div>
								
								<div class="col-xs-6 txtrightjb">
								{{ $jobDetails->project_length }} Weeks</div>
							</div>

						</li>
						<li>
							<div class="row">
								<span class="ljbico">
									<i class="material-icons">location_on</i>
								</span>
								<div class="col-xs-6 txtleftjb">
								Location</div>
								
								<div class="col-xs-6 txtrightjb">
								{{ $jobDetails->location }}</div>
							</div>

						</li>
						<li>
							<div class="row">
								<span class="ljbico">
									<i class="material-icons">work</i>
								</span>
								<div class="col-xs-6 txtleftjb">
								Job Type</div>
								
								<div class="col-xs-6 txtrightjb">
									@if ($jobDetails->job_type === 1)
									    Full Time
									@elseif ($jobDetails->job_type === 2)
									    Part Time
									@else
									    Freelance
									@endif
								</div>
						</li>
						<li>
							<div class="row">
								<span class="ljbico">
									<i class="material-icons">account_balance_wallet</i>
								</span>
								<div class="col-xs-6 txtleftjb">
								Payment type</div>
								
								<div class="col-xs-6 txtrightjb">
								{!! nl2br($jobDetails->paymentType) !!} price</div>
							</div>

						</li>
						<li>
							<div class="row">
								<span class="ljbico">
									<i class="fa fa-gbp" aria-hidden="true"></i>
								</span>
								<div class="col-xs-6 txtleftjb">
								Budget</div>
								
								<div class="col-xs-6 txtrightjb">
								£{!! nl2br($jobDetails->budget_amount) !!}</div>
							</div>

						</li>
						<li>
							<div class="row">
								<span class="ljbico">
									<i class="material-icons">history</i>
								</span>
								<div class="col-xs-6 txtleftjb">
								Turn arround</div>
								
								<div class="col-xs-6 txtrightjb">
								{!! ($jobDetails->is_urgent_assignment == 'N') ? '<span style="font-size:14px; margin-top:5px;color:red;">Urgent</span>' : 'Normal' !!}
							</div>

						</li>
						<li>
							<div class="row">
								<span class="ljbico">
									<i class="material-icons">settings_backup_restore</i>
								</span>
								<div class="col-xs-6 txtleftjb">
								No. Revisions</div>
								
								<div class="col-xs-6 txtrightjb">
								{!! nl2br($jobDetails->roundsOfRevisions) !!}</div>
							</div>

						</li>
					</ul>
				</div>
			</div>
			
		</div>
	</div>
</section>


@endsection
@section('customScript')

<script type="text/javascript">
$("#addnewaount").on("click", function(){
	//var estimation_count = 1;
	$("#amount-deskcriptionbox").append('<div class="row" id="amount-sek-box"><div class="col-xs-12"><a href="javascript:void(0)" class="todelte pull-right" id="deletamont"></a></div><div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group"><input type="text" class="form-control cost_estimation" placeholder="Item description..." name="item_description[]"></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group"><div class="input-group"><div class="input-group-addon">£</div><input class="form-control cost_estimation" id="exampleInputAmount" placeholder="Amount" name="amount[]"></div></div></div>');
	$(".cost_estimation").prop('required', true);
	//estimation_count++;
});


$("body").on("click", "#amount-sek-box #deletamont", function() {
	$(this).parent().parent().remove();
	//estimation_count--;
});

$(function () {
	$('[data-toggle="tooltip"]').tooltip();
	
	$("#send_proposal_form").validate({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});

	$("input[name=terms_conditions]").on('change', function(){
		$("#terms_conditions-error").remove();
		$("input[name=terms_conditions]").attr('chacked', true);
	});

	$("input[name=highlight_bid]").on('change', function(){
		if($("input[name=highlight_bid]").is(':checked')){
			$(".highlightBidMsg").show();
		}else{
			$(".highlightBidMsg").hide();
		}
	});
})
</script>

@endsection