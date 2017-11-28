@extends('layouts.app')

@section('title')
Job bidding | Edit Profile
@endsection
@section('content')


@include('layouts.jobs_common_header')

<div class="container">
	 <div class="task_title_wrap clearfix">
		<div class="task_titel pull-left">			
			Received Proposals
		</div>
		<div class="line_gp"></div>	
		<div class="addtaskbtn clearfix pull-right">
			<!--<button id="opentask" class="pull-right">
				<center><i class="fa fa-filter" aria-hidden="true"></i></center>
			</button>
			<p class="pull-right text-uppercase">Filter Result</p>-->
		</div>	
	</div>
</div>
<section class="proposalsdesk">
	<div class="container proposal_area">
		<div class="row">
			<div class="col-xs-12">
				@if(session('success'))
					<div class="alert alert-success">
						{!! session('success') !!}
					</div>
				@endif

				@foreach($errors->all(':message') as $message)
					<div id="form-messages" class="alert alert-danger" role="alert">
						{{ $message }}
					</div>
				@endforeach()
			</div>
		</div>
		<div class="row">
		    <div class="col-xs-6 coloutcol">
		    	<div class="bs-callout bs-callout-info white-bg">
		    		<div class="clearfix">
		    			<h2 class="pull-left">All Proposals ({{ $allProposals->total() }})
							<a href="javascript:void(0)" data-placement="top" data-toggle="tooltip" title="" data-original-title="Lorem ipsum!"><span class="badge o">?</span></a>
						</h2>
		    			<button class="actionbtn pull-right">
							<!--<i class="fa fa-ellipsis-h" aria-hidden="true"></i>-->
						</button>
		    		</div>
		    		
					<form action="" method="post" id="">
						<div class="all_proposal">
							@if(count($allProposals) > 0)
								<ul class="propsallist">
									@foreach($allProposals as $eachProposal)
										<li class="clearfix {{ $eachProposal->is_highlight_bid=='Y' ? 'highlight-bid' : '' }}">
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
											</div><!-- col left ]] -->
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
													<!--<small>FIXED PRICE</small>-->
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
						</div>
					</form>
		    	</div>
		    </div>

			<div class="col-xs-6 coloutcol">
		    	<div class="bs-callout bs-callout-primary white-bg">
		    		<div class="clearfix">
		    			<h2 class="pull-left"><!--In Progress (4)-->Shortlisted ({{ $shortlistedProposals->total() }})</h2>
		    			<button class="actionbtn pull-right"><!--<i class="fa fa-ellipsis-h" aria-hidden="true"></i>--></button>
		    		</div>
		    		<form action="" method="post">
						<div class="shortlisted_proposal">
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
												</div><!-- col left ]] -->
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
														<!--<small>FIXED PRICE</small>-->
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
						</div>
					</form>
		    	</div>
		    </div><!-- col ]] --> 
    	</div>
	</div>
</section>

<!-- job proposal modal here -->
<div class="proposalModalBox">
	
</div>
<!-- end proposal job modal -->


<!-- job accept modal here -->
<div class="proposalAcceptModalBox">
	
</div>
<!-- end accept job modal -->


@endsection

@section('customScript')

<script type="text/javascript">
$(window).on('hashchange', function(){
	if (window.location.hash){
		var page = window.location.hash.replace('#', '');
		if (page == Number.NaN || page <= 0) {
			return false;
		}else{
			getData(page, '');
		}
	}
});

$(document).ready(function(){
	var count = 0;
	$(document).on('click', '.pagination a', function(event){
		//alert('1');
		if(count == 0){
			$('.active').html('<a href="?page=1">1</a>');
			count++;
		}
		$('li').removeClass('active');
		$(this).parent('li').addClass('active');
		event.preventDefault();
		var myurl = $(this).attr('href');
		var page=$(this).attr('href').split('page=')[1];
		var searchfor=$(this).attr('href').split('searchfor=')[1];
		searchfor=searchfor.split('&')[0];
		//alert(searchfor);
		getData(page, '1', searchfor);
	});
});

function getData(page, loader, searchfor){
	if(loader){
		process.on();
	}
	//var formData = $("#search_freelancer").serialize();
	$.ajax({
		//url: '?page='+page+'&'+formData + '&pagination=1',
		url: '?page='+page+'&pagination=1&searchfor='+searchfor,
		type: "get",
		datatype: "html",
	}).done(function(response){
		//console.log(response);
		$("#product_container").empty().html(response);
		location.hash = page;
		//$('.countString').html(response.countString);
		if(searchfor == 'all'){
			$('.all_proposal').html(response.html);
		}else{
			$('.shortlisted_proposal').html(response.html);
		}
		
		process.off();
	}).fail(function(jqXHR, ajaxOptions, thrownError){
		//$('.ajaxSearchDataList').html('No response from server');
	});
}


// payment radio box
$('#r11').on('click', function(){
	$(this).parent().find('a').trigger('click')
})

$('#r12').on('click', function(){
	$(this).parent().find('a').trigger('click')
})

$('#r13').on('click', function(){
	$(this).parent().find('a').trigger('click')
})

$('#accordion .default ').click(function(){
	$(this).addClass('visible').siblings().removeClass('visible');       
});


$(window).load(function(){
	$("body").on("click",".languageFld",function(){
		if(!$(this).children("ul").is(":visible")){
			$(this).children("ul").slideDown(400);
		}else{
			$(this).children("ul").slideUp(400);
		}
	});
	$("body").on("click",".languageFld ul li",function(){
		var newLanguage = $(this).children().html();
		$(".languageFld").children(".txt").html(newLanguage);
	});
});


$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	
	$("body").on("click", ".catTl", function(){
		
	});

	$("#reply_form").validate({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
});

function viewProposalDetails(proposalId)
{
	$('.proposalModalBox').html('');
	if(proposalId!='' && proposalId!=undefined)
	{
		process.on();
		$.ajax({
			type:'post',
			url:'{{ url("/") }}/jobs/view-proposal',
			data:{
				isAjax:true,
				proposal_id:proposalId
			},
			success:function(response){
				if(response.response_status==1){
					$('.proposalModalBox').html(response.response_data);
					$('#jobviewModal').modal('show');
				}
				process.off();
			}, error: function(){
				alert("Oops! Something went wrong, try again later.");
			}
		});
	}
}

function shortlistProposal(proposalId, jobId){
	//$('.proposalModalBox').html('');
	if(proposalId!='' && proposalId!=undefined){
		process.on();
		$.ajax({
			type:'post',
			url:'{{ url("/") }}/jobs/shortlist-proposal',
			data:{
				isAjax:true,
				proposal_id:proposalId,
				job_id:jobId
			},
			success:function(response){
				//if(response.response_status==1){
					$('.proposal_area').html(response.response_data);
					$('#jobviewModal').modal('hide');
				//}
				process.off();
			}, error: function(){
				alert("Oops! Something went wrong, try again later.");
			}
		});
	}
}

function acceptProposal(proposalId, jobId, accept_type){
	//$('.proposalModalBox').html('');
	if(proposalId!='' && proposalId!=undefined){
		process.on();
		$.ajax({
			type:'post',
			url:'{{ url("/") }}/jobs/accept-proposal',
			data:{
				isAjax:true,
				proposal_id:proposalId,
				job_id:jobId,
				accept_type:accept_type
			},
			success:function(response)
			{
				if(accept_type=='N')
				{
					$('.proposal_area').html(response.response_data);
				}
				else if(accept_type=='Y')
				{
					$('#jobviewModal').modal('hide');
					$('.proposalAcceptModalBox').html(response.response_data_payment);
					
					$('#acceptModal').modal('show');
					
					$('#r11').on('click', function(){
						$(this).parent().find('a').trigger('click')
					})

					$('#r12').on('click', function(){
						$(this).parent().find('a').trigger('click')
					})

					$('#r13').on('click', function(){
						$(this).parent().find('a').trigger('click')
					})

					$('#accordion .default ').click(function(){
						$(this).addClass('visible').siblings().removeClass('visible');       
					});
				}
				process.off();
			}, error: function()
			{
				alert("Oops! Something went wrong, try again later.");
			}
		});
	}
}
</script>

@endsection


