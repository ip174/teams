@extends('layouts.app')
@section('title')
Job bidding | Job Chats
@endsection


@section('content')

<!--<div class="mainBody dashboard-container">-->
<div class="mainSite innerpage">
@include('layouts.jobs_common_header')

<section class="container">
	<div class="task_title_wrap clearfix">
		<div class="task_titel pull-left">
			Payments
		</div>
		<div class="line_gp"></div>	
		@if($proposalByUser == $authUser)
		<div class="addtaskbtn clearfix pull-right raiseInvoiceModalOpen">
	    	<button id="opentask" class="pull-right">
	    		<center><img src="{{ asset('assets/frontend/images/gbp_file.png') }}" class="img-responsive"></center>
	    	</button>
	    	<p class="pull-right">RAISE INVOICE</p>
	    </div>
	    @endif
    </div>
    <div class="infobox clearfix settingtab white-bg">
    	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
    		<div class="panel-body">
    			<!-- Nav tabs -->
			    <ul class="nav nav-tabs" role="tablist">
			      <li role="presentation" class="active">
			      	<a href="#general" aria-controls="general" role="tab" data-toggle="tab">
			      		<span>&nbsp;</span>Money in escrow
			      	</a>
			      </li>
			      <li role="presentation">
			      	<a href="{{ url('/payments/payments-overview') }}" aria-controls="notification">
			      		<span>&nbsp;</span>Withdraw Money
			      	</a>
			      </li>
			      <li role="presentation">
			      	<a href="{{url('/invoice/view-invoice')}}" aria-controls="privacy">
			      		<span>&nbsp;</span>Invoices
			      		<p class="badge bg-success">{{ count($getInvoices) }}</p>
			      	</a>
			      </li>
			      <li role="presentation">
			      	<a href="{{url('/payments/payments-overview')}}" aria-controls="NDSA">
			      		<span>&nbsp;</span>Balance Manager
			      		<small class="block">Add funds, Issue a refund, Manager automated payments.</small>
			      	</a>
			      </li>
			    </ul>
    		</div>
    	</div><!-- col ]] -->
    	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
    		<div class="tab-content">
    			@if(count($getFreelancer) > 0)
			    <div role="tabpanel" class="tab-pane active" id="general">
			    	<div class="panel-body">
			    	@if($authUser == $getFreelancer->sent_by_user || $authUser == $jobDetails->posted_by_user)
			    	<div class="clearfix">
    					<h2 class="catetitle pull-left">Available funds <small>(estimated GBP value)</small></h2>
    					<div class="pprice text-success pull-right">
    						@php
    						$freelancerJobId = isset($getFreelancer->job_id) ? $getFreelancer->job_id : '';
    						$freelancerProposalId = isset($getFreelancer->proposal_id) ? $getFreelancer->proposal_id : '';
							$estimatedAmount = getProposalAmtByFreelancer($freelancerJobId, $freelancerProposalId);
							$totalEstimatedAmount=0;
							if(count($estimatedAmount) > 0){
								foreach($estimatedAmount as $eachAmount){
									$totalEstimatedAmount += $eachAmount->amount;
								}
							}
							@endphp
							£ {{ $totalEstimatedAmount }}
    					</div>
    				</div>
    				<div class="table-responsive payboxtable">
    					<table class="table">
    						<thead>
    							<tr>
    								<th>Collaboration with</th>
    								<th>Price Per Hour</th>
    								<th>Agreed amount</th>
    								<th>Status</th>
    							</tr>
    						</thead>
    						<tbody>
    							@if(count($getFreelancer) > 0 && count($estimatedAmount)>0 )
	    							@foreach($estimatedAmount as $eachAmount)
		    							<tr>
		    								<td>
			    								<div class="avtartask">
										    		@php
										    		$profilePic = isset($getFreelancer->user->profile_picture) ? $getFreelancer->user->profile_picture : '';
										    		@endphp
										    		<div class="profilePic small" style="background:url({{ profilePicPath($profilePic) }}) no-repeat center center / 100% auto;">
														<div class="shape"></div>
													</div>
													<h4>
														{{ isset($getFreelancer->user->first_name) ? $getFreelancer->user->first_name : '' }}
														{{ isset($getFreelancer->user->last_name) ? $getFreelancer->user->last_name : '' }}
														<small>{{ isset($getFreelancer->userDet->jobType->job_title) ? $getFreelancer->userDet->jobType->job_title : '' }}</small>
													</h4>
												</div>
											</td>
											<td>
												<span class="etxt">£ {{ isset($getFreelancer->userDet->rate_per_hour) ? $getFreelancer->userDet->rate_per_hour : '0.00' }}</span>
												<small class="block">PER HOUR</small>
											</td>
											<td><p class="amountbrder btn btn-default">
												£ {{ $eachAmount->amount }}
											</p></td>
											<td>
												@php
												$isPaidForMilestone = checkIsPaidRespectMilestone($eachAmount->id);
												//print_r($isPaidForMilestone); exit;
												@endphp

												@if($authUser == $getFreelancer->sent_by_user || $authUser == $jobDetails->posted_by_user)
													@if($eachAmount->is_paid == 0 && $authUser == $jobDetails->posted_by_user)
														<form action="{{url('/payments/release-payments')}}" method="post" accept-charset="utf-8" onsubmit="return confirm_response()">
															{{csrf_field()}}
															<input type="hidden" name="job_id" value="{{$job_id}}">
															<input type="hidden" name="proposal_id" value="{{ isset($proposal_id) ? $proposal_id : '' }}">
															<input type="hidden" name="milestone_id" value="{{$eachAmount->id}}">
															<input type="hidden" name="invoice_for_user" value="{{$proposalByUser}}">
															<input type="hidden" name="gross_amt" value="{{$eachAmount->amount}}">

															<button type="submit" class="btn btn-warning release_amount">Release</button>
														</form>
													@else
														@if($eachAmount->is_paid == 1)
															<p class="text-success"><strong>Released</strong></p>
															<p class="text-success"><strong>Transaction ID:</strong> {{ isset($isPaidForMilestone[0]->transaction_id) ? $isPaidForMilestone[0]->transaction_id : '' }}</p>
															<p class="text-success"><strong>Date & Time:</strong> {{ isset($isPaidForMilestone[0]->transaction_id) ? date('d/m/Y H:i:s', strtotime($isPaidForMilestone[0]->updated_at)) : '' }}</p>
														@else
															<p class="text-success">On Hold</p>
														@endif
													@endif
												@endif
											</td>
		    							</tr>
	    							@endforeach
	    						@endif

	    					</tbody>
	    				</table>
	    			</div>
    				<div class="total_paybox text-right">
						TOTAL: £ 00.00<br>
						REMAINING: £ 00.00
					</div>
					@else
						<div class="clearfix">
	    					<h2 class="catetitle pull-left">No Data Available</h2>
	    				</div>
					@endif
    			</div>
			    </div><!-- end tab one ]] -->
			    @else
			    	<div class="clearfix">
    					<h2 class="catetitle pull-left">No Data Available</h2>
    				</div>
			    @endif
		  </div>
    	</div><!--  col ]] -->
    </div>
</section>
</div>

@include('payments.modal_raise_invoice')
@endsection


@section('customScript')
<script>
$(document).ready(function(){
    $("#opentask").click(function(){
        $(".taskcontent").toggleClass("open");
    });

    $(".raiseInvoiceModalOpen").click('on', function(){
        $(".raiseInvoiceModal").modal("show");
    });
});

function confirm_response(){
	r = confirm("Are you sure to relese this amount?");
	if(r){
		return true;
	}else{
		return false;
	}
}
</script>


<script type="text/javascript">
function remove_html(rowCount){
	$(".showcloneditemform"+rowCount).remove();
	index = rowCounters.indexOf(rowCount);
	if (index > -1) {
	    rowCounters.splice(index, 1);
	}
	calculateTotalAmount();
}

function calculateAmount(rowCounter){
	qtyVal = $(".quantity"+rowCounter).val();
	unitCostVal = $(".unit_cost"+rowCounter).val();
	fixedRowAmount = parseFloat(qtyVal) * parseFloat(unitCostVal);
	if(!isNaN(fixedRowAmount)){
		$(".amount_fixed_cost"+rowCounter).val(fixedRowAmount);
	}else{
		$(".amount_fixed_cost"+rowCounter).val(0);
	}
	calculateTotalAmount();
}

function calculateTotalAmount(){
	totalValue = 0;
	for(var i=0; i<rowCounters.length; i++){
		var currentTotal = $(".amount_fixed_cost"+rowCounters[i]).val();
		if(currentTotal){
			totalValue = parseFloat(totalValue) + parseFloat(currentTotal);
		}
	}
	if(!isNaN(totalValue)){
		vatPercent = parseFloat($(".vat_percent").val());
		if(!vatPercent){
			vatPercent = 0;
		}
		calculateAmtWithVat = (((100+vatPercent)/100)*totalValue);
		calculateAmtWithVat = Math.round(calculateAmtWithVat);
		$(".total_invoice_amount").val(calculateAmtWithVat);
	}
}

function isNumberKey(event){
	var charCode = (event.which) ? event.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 39 && charCode != 37 && charCode != 46 && charCode != 9 && charCode != 16 && charCode != 45 && charCode != 36 && charCode != 35)
	return false;
	return true;
}

function numeric_with_dot(txt){
	txt.value = txt.value.replace(/[^ 0-9\n\r.]+/g, '');
}
function numeric_only(txt){
	txt.value = txt.value.replace(/[^ 0-9\n\r]+/g, '');
}

$(document).ready(function(){
    $('.showother').click(function(){
	    if ($(this).is(':checked'))
	    {
	    	$(this).parent().parent().children('.showmeother').slideDown('fast');
	    }
		/* else{
			$(this).parent().parent().children('.showmeother').slideUp('fast');
		}*/
	});
    $('.noother').click(function(){
	    if ($(this).is(':checked'))
	    {
	    	
	     $(this).parent().parent().children('.showmeother').slideUp('fast');
	    }
	});


	$("input").focus(function(){
        $(this).parent().children(".input-group-addon").addClass("open");
    });
    $("input").focusout(function(){
	    $(this).parent().children(".input-group-addon").removeClass("open");
	});


	counter=1;
	rowCounters = [1];
	$(".clonetheform").on("click", function(){
		/*var clonediv = $(".itemformclone").html();
		var new_clone = '<div class="new_clone_div row">'+clonediv+'<a href="javascript:void(0)" class="todelte toclose pull-right"></a></div>' 
		$(".showcloneditemform").append(new_clone);
		$("body").on("click", ".new_clone_div .toclose", function() {
			$(this).parent().remove(); 
		});*/
		counter++;
		rowCounters.push(counter);
		var addMoreInvoiceHtml = '<div class="showcloneditemform'+counter+'"><div class="new_clone_div row"><div class="col-sm-3"><label>Description</label><input class="form-control" placeholder="Item description..." name="invoice_description[]" type="text" required></div><div class="col-sm-1"><label>Quantity</label><input class="form-control quantity'+counter+'" name="quantity[]" type="text" onkeyup="calculateAmount('+counter+'); numeric_only(this)" min="1" required></div><div class="col-sm-2"><label>Type</label><select class="form-control minimal" name="invoice_type[]" required><option value="Fixed">Fixed</option><option value="Hourly">Hourly</option></select></div><div class="col-sm-2"><label>Unit Cost</label><div class="form-group"><div class="input-group"><div class="input-group-addon">£</div><input class="form-control unit_cost'+counter+'" name="unit_cost[]" type="text" onkeyup="calculateAmount('+counter+'); numeric_with_dot(this)" min="0" required></div></div></div><div class="col-sm-2"><label>Time Period</label><div class="form-group"><div class="input-group"><input class="form-control time_period" placeholder="6/10 - 6/11" name="time_period[]" id="time_period" type="text" required></div></div></div><div class="col-sm-2"><label>Amount(Fixed Fee)</label><div class="form-group"><div class="input-group"><div class="input-group-addon">£</div><input class="form-control amount_fixed_cost'+counter+'" name="amount_fixed_cost[]" type="text" keyup="calculateTotalAmount()" readonly required></div></div></div><a href="javascript:void(0)" class="todelte toclose pull-right" onclick="remove_html('+counter+')"></a></div></div>';
		$(".moreInvoiceArea").append(addMoreInvoiceHtml);
		$(".form-control").attr('required', true);
	});
});

</script>
@endsection