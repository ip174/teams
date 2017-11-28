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

@include('layouts.jobs_common_header')

<section class="jobproposal">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="infobox panel-body">
					<h6 class="catetitle">Job Description:</h6>
					<div class="detailsbox">
						{!! nl2br($jobDetails->job_description) !!}
					</div>
					<div class="form-group clearfix">
						<label class="pull-left">Skills required for this job:</label>
						<div class="tags pull-left">
							@if(count($requiredSkillNames) > 0)
								@foreach($requiredSkillNames as $eachSkill)
									<a href="javascript:void(0)" class="btn btn-default">{{ $eachSkill->skill_name }}</a>
								@endforeach
							@endif
						</div>
					</div>
					<label>Attachment:</label>
					<ul class="list-unstyled attachmenticon ver2">
						<li><a href="{{ asset('assets/upload/post_job_files'.'/'.$jobDetails->attached_file) }}" download>Download attached file</a></li>
					</ul>
					<br /><br />
				
					<div class="sendProposalformcont">
				
						@if(($jobDetails->posted_by_user != Auth::user()->id) && $jobDetails->job_status < 4)
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

							@if(in_array($jobDetails->job_status, array('1', '3', '5')))
							<form action="{{ url('/jobs/edit-proposal/'.$job_id) }}" id="send_proposal_form" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="proposal_id" value="{{ $proposalSentByUser->proposal_id }}">
								
								<label>Apply for this job with your proposal
									<a type="button" data-toggle="tooltip" data-placement="right" title="" class="badge" data-original-title="Apply for this job with your proposal">?</a>
								</label>
								
								<div class="form-group">
									<textarea name="proposal_description" class="form-control" cols="" rows="6" placeholder="I am very interested to apply for..." required>{!! old('proposal_description') ? old('proposal_description') : nl2br($proposalSentByUser->description) !!}</textarea>
								</div>
								
								<div class="form-group">
									<label>Interview question: <span>What challenges do you see doing this job?</span></label>
									<textarea name="interview_question_challanges" class="form-control" cols="" rows="3" placeholder="Answer..." required>{!! old('interview_question_challanges') ? old('interview_question_challanges') : nl2br($proposalSentByUser->interview_question_challanges) !!}</textarea>
								</div>
								
								<div class="form-group">
									<label>Attachment</label>
									<label class="uploadBox">
										<input name="attached_file" class="attached_file introduce_file" id="attached_file" type="file">
										<div class="txtF">
											<div class="introduce-file-text">Drop file here or <span>Browse</span></div>
										</div>
									</label>
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
												<div class="col-xs-12"><a href="javascript:void(0)" class="todelte pull-right" id="deletamont"></a></div>
												<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 form-group">
													<input class="form-control" placeholder="Item description..." name="item_description[]" type="text" value="{{ $eachAmount->item_description }}" required>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
													<div class="input-group">
														<div class="input-group-addon">£</div>
														<input class="form-control" id="exampleInputAmount" placeholder="Amount" name="amount[]" value="{{ $eachAmount->amount }}" required>
													</div>
												</div>
											</div>
										@endforeach
									@endif
								</div>
								
								<a href="javascript:void(0)" id="addnewaount" class="adnew">+ Add another item</a>
								
								@if($proposalSentByUser->is_highlight_bid=='N')
								<div class="clearfix highlight-bid">
									<hr />
									<br />
									@php
									$getJobSettings = getJobSettings();
									@endphp
									<label class="checkFld pull-left">
										<input type="checkbox" name="highlight_bid" value="1">
										<i class="fa fa-square-o"></i>
										Highlight bid
										<span class="highlightBidMsg" style="display:none; padding-left: 20px;">You should need to pay {{ $getJobSettings->highlight_bid_fee }} credit for this bid.</span>
									</label>
								</div>
								@endif

								<div class="clearfix agreebox">
									<label class="checkFld pull-left">
										<input type="checkbox" name="terms_conditions" value="1" required checked>
										<i class="fa fa-square-o"></i>
										Agree with <a href="javascript:void(0)">terms &amp; conditions</a>
									</label>
									<input class="button green pull-right submitbtn" value="UPDATE PROPOSAL" type="submit">
								</div>
							</form>
							@endif
						
						@endif
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="infobox panel-body white-bg">
					<h2 class="staustitle">
					Project Overall Progress
					</h2>
					<center>
						<img src="{{ asset('assets/frontend/images/progress_src.png') }}" class="img-responsive">
					</center>
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