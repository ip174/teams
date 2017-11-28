@extends('layouts.app')
@section('title')
Job bidding | Edit Profile


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

@include('layouts.jobs_common_header');

<section class="jobproposal">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="infobox panel-body">
					<h2 class="catetitle">Job Description:</h2>
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
						<li><a href="{{ asset('assets/upload/post_job_files'.'/'.$jobDetails->attached_file) }}">Download attached file</a></li>
					</ul>
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

				<div class="infobox panel-body white-bg mtop_20">
					<h2 class="staustitle border-bottom">
					Progress
					</h2>
					<div style="min-height:440px;"></div>
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
})
</script>

@endsection