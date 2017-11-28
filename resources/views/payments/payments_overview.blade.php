@extends('layouts.app')
@section('title')
Job bidding | Job Chats
@endsection


@section('content')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

@php
$invoice_status = config("constants.INVOICE_STATUS");
@endphp

<div class="mainSite innerpage">

<!-- <div class="tabmenu" style="margin-top:50px;"> -->
<div class="tabmenu">
	<div class="container">
		<h2 class="streattiel">My Funds</h2>
		<ul class="nav nav-tabs clearfix" role="tablist">
			<li class="{{ isset($activeMenu) && $activeMenu == 'Funds' ? 'active' : '' }}"><a href="{{ url('/payments/payments-overview') }}">Funds</a></li>
			<li class="{{ isset($activeMenu) && $activeMenu == 'Statements' ? 'active' : '' }}"><a href="{{ url('/payments/statements') }}">Statements</a></li>
			<li class="{{ isset($activeMenu) && $activeMenu == 'Invoice' ? 'active' : '' }}"><a href="{{ url('/invoice/view-invoice') }}">Invoice</a></li>
			<li class="{{ isset($activeMenu) && $activeMenu == 'Transaction' ? 'active' : '' }}"><a href="{{ url('/payments/transaction-history') }}">Transaction</a></li>
		</ul>
	</div>
</div>
<section class="myfundpage" style="">
	<div class="container">
		<div class="row mb_30">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="infobox">
					<div class="fundtitle">
					Money in my account <small>Available Funds</small>
						<span class="badge">?</span>
						
					</div>
					<div class="fundprice text-success">
						<sup>£</sup><span class="myWalletBalanceSection">{{ $myWalletBalance }}</span>
					</div>

					<div class="border_line"></div>
					<div class="panel-body">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#depositfundModal" class="btn btn-success btn-lg btn-block fundtype">
							<span class="ico">
								<img src="{{ asset('assets/frontend/images/fundtype_icon.png') }}" class="img-responsive">
							</span>
							<span class="text">DEPOSIT / ADD FUNDS</span>
						</a>
						

						<a href="javascript:void(0)" class="btn btn-success btn-lg btn-block fundtype withdrawFunds">
							<span class="ico">
								<img src="{{ asset('assets/frontend/images/fundtype_icon.png') }}" class="img-responsive">
							</span>
							<span class="text">WITHDRAW FUNDS</span>
						</a>
						

						<!-- <a href="javascript:void(0)" class="btn btn-success btn-lg btn-block fundtype">
							<span class="ico">
								<img src="{{ asset('assets/frontend/images/fundtype_icon.png') }}" class="img-responsive">
							</span>
							<span class="text">TRANSFER FUNDS</span>
						</a> -->
						<a href="{{ url('/settings/user-general-settings#payments') }}" class="btn btn-success btn-lg btn-block fundtype">
							<span class="ico">
								<img src="{{ asset('assets/frontend/images/fundtype_icon.png') }}" class="img-responsive">
							</span>
							<span class="text">PAYMENT SETTINGS</span>
						</a>
						

						<a href="javascript:void(0)" class="btn btn-success btn-lg btn-block fundtype">
							<span class="ico">
								<img src="{{ asset('assets/frontend/images/fundtype_icon.png') }}" class="img-responsive">
							</span>
							<span class="text">CONVERT FUNDS</span>
						</a>
						

						<a href="javascript:void(0)" class="btn btn-success btn-lg btn-block fundtype earningCalculator" data-toggle="modal">
							<span class="ico">
								<img src="{{ asset('assets/frontend/images/fundtype_icon.png') }}" class="img-responsive">
							</span>
							<span class="text">EARNINGS CALCULATOR</span>
						</a>
					</div>
				</div>
			</div><!-- COL ]] -->


			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="infobox">
					<div class="fundtitle">
					Posted jobs escrow account <small>Work others are doing for you</small>
						<span class="badge">?</span>
						
					</div>
					<div class="fundprice text-muted">
						<sup>£</sup>{{ $myJobsEscrowAmount }}
					</div>

					<ul class="list-unstyled jobinfolist">
						@if(count($myJobsInprogress) > 0)
							@foreach($myJobsInprogress as $eachrow)
							<li>
								<h3 class="clearfix">
									{{ isset($eachrow->needs_to_design_job) ? $eachrow->needs_to_design_job : '' }}
									<span class="pull-right">£ {{ getJobAwardedAmount($eachrow->job_id) }}</span>
								</h3>
								<p class="inline-block">#{{ isset($eachrow->job_reference_id) ? $eachrow->job_reference_id : '' }}</p>
								<p class="inline-block fund_job_date"><i class="fa fa-clock-o"></i>Posted {{ isset($eachrow->created_at) ? getDateDifference($eachrow->created_at) : '' }}</p>
							</li>
							@endforeach
						@else
							<li>No Data Available</li>
						@endif
						<!--<li>
							<h3 class="clearfix">Vice artist for commercia..<span class="pull-right">£40.00</span></h3>
							<p class="inline-block">#45454545</p>
							<p class="inline-block fund_job_date"><i class="fa fa-clock-o"></i>Posted 3 days ago</p>
						</li>
						<li>
							<h3 class="clearfix">Digital designer needed..<span class="pull-right">£60.00</span></h3>
							<p class="inline-block">#45454545</p>
							<p class="inline-block fund_job_date"><i class="fa fa-clock-o"></i>Posted 3 days ago</p>
						</li>-->
					</ul>

				</div>
			</div><!--  -->



			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="infobox">
					<div class="fundtitle">
					Workstream escrow account <small>Work I am doing for others</small>
						<span class="badge">?</span>
						
					</div>
					<div class="fundprice text-muted">
						<sup>£</sup>{{ $myWorkstreamEscrowAmount }}
					</div>

					<ul class="list-unstyled jobinfolist">
						@if(count($myWorkstream) > 0)
							@foreach($myWorkstream as $eachrow)
							<li>
								<h3 class="clearfix">
									{{ isset($eachrow->needs_to_design_job) ? $eachrow->needs_to_design_job : '' }}
									<span class="pull-right">£ {{ getJobAwardedAmount($eachrow->job_id) }}</span>
								</h3>
								<p class="inline-block">#{{ isset($eachrow->job_reference_id) ? $eachrow->job_reference_id : '' }}</p>
								<p class="inline-block fund_job_date"><i class="fa fa-clock-o"></i>Posted {{ isset($eachrow->created_at) ? getDateDifference($eachrow->created_at) : '' }}</p>
							</li>
							@endforeach
						@else
							<li>No Data Available</li>
						@endif
						<!--<li>
							<h3 class="clearfix">Storyboard design for TV...<span class="pull-right">£200.00</span></h3>
							<p class="inline-block">#45454545</p>
							<p class="inline-block fund_job_date"><i class="fa fa-clock-o"></i>Posted 3 days ago</p>
						</li>
						
						<li>
							<h3 class="clearfix">Script writer for explainer...<span class="pull-right">£60.00</span></h3>
							<p class="inline-block">#45454545</p>
							<p class="inline-block fund_job_date"><i class="fa fa-clock-o"></i>Posted 3 days ago</p>
						</li>
						
						<li>
							<h3 class="clearfix">Script writer for explainer...<span class="pull-right">£60.00</span></h3>
							<p class="inline-block">#45454545</p>
							<p class="inline-block fund_job_date"><i class="fa fa-clock-o"></i>Posted 3 days ago</p>
						</li>-->
					</ul>


				</div>
			</div><!--  -->

		</div> <!-- row ]] 3 item -->	

		<h2 class="funt_title">Payment activities</h2>	
		<div class="infobox white-bg">
			<div class="panel-body">

				<form action="" id="paymentInvoiceForm">
				<div class="filter_form clearfix">
					<div class="form-group pull-left ml_0">
						<select class="form-control minimal" name="transaction_type">
							<option value="">All transactions</option>
							@foreach($invoice_status as $eachStatusKey=>$eachStatusValue)
							<option value="{{ $eachStatusKey }}" {{ $eachStatusKey == $transaction_type ? 'selected' : '' }}>{{ $eachStatusValue }} transactions</option>
							@endforeach
						</select>
					</div>
					<div class="form-group pull-left">
						<!--<select class="form-control minimal" name="transaction_days">
							<option>Past 30 days</option>
						</select>-->
						<input type="text" name="invoicedaterange" class="form-control minimal invoicedaterange" value="{{ $invoicedaterange }}" />
					</div>
					<div class="form-group searchinput pull-left">
						<input name="search_text" class="form-control" placeholder="Invoice No." type="text" value="{{ $search_text }}">
					</div>
					<button type="submit" class="btn btn-default" onclick="setFormAction('{{ url('/payments/payments-overview') }}')"><i class="fa fa-search"></i></button>
					<button class="btn btn-success btn-lg editbtn pull-right" onclick="setFormAction('{{ url('/payments/download-invoice') }}')"><i class="fa fa-download"></i> DOWNLOAD</button>
				</div>
				</form>

				<div class="table-responsive fundtable">
				    <table class="table">
				        <thead>
				            <tr>
				                <th>
				                	<div class="checkbox pull-left">
										<label class="i-checks">                                
										<input name="remember" type="checkbox"><i></i>
			                            </label>
			                        </div>
                    			</th>
				                <th>DATE</th>
				                <th>INVOICE NO</th>
				                <th>DESCRIPTION</th>
				                <th>STATUS</th>
				                <th>GROSS</th>
				                <th>FEE</th>
				                <th>NET</th>
				                <!--<th>ACTIONS</th>-->
				            </tr>
				        </thead>
				        <tbody>
						    
						    @if(count($allInvoice) > 0)
						    @foreach($allInvoice as $eachInvoice)
							    <tr>
								     <th scope="row">
					                	<div class="checkbox pull-left">
											<label class="i-checks">                                
											<input name="remember" type="checkbox" value="{{ $eachInvoice->id }}"><i></i>
				                            </label>
				                        </div>
	                   				</th>
					                <td>{{ date('j F, Y', strtotime($eachInvoice->invoice_date)) }}</td>
					                <td><a href="javascript:void(0);" class="text-success">#{{ $eachInvoice->invoice_no }}</a></td>
					                <td>{{ $eachInvoice->description }}</td>
					                <td>
						                @php
						                $statusText = $invoice_status[$eachInvoice->status];
						                switch($eachInvoice->status){
						                	case 1:
						                	$statusClass = 'fa fa-check-circle text-success icon_big';
						                	break;

						                	case 2:
						                	$statusClass = 'fa fa-ban text-warning icon_big';
						                	break;

						                	case 3:
						                	$statusClass = 'fa fa-times-circle text-danger icon_big';
						                	break;

						                	default:
						                	$statusClass = '';
						                }
						                @endphp
						                <i class="{{ $statusClass }}"></i>
						                &nbsp;&nbsp;{{ $statusText }}
					                </td>
					                <td>£{{ $eachInvoice->gross_amt }}</td>
					                <td>£{{ $eachInvoice->fee_amt }}</td>
					                <td>
					                	@php
					                	$netFee = $eachInvoice->gross_amt - $eachInvoice->fee_amt;
					                	@endphp
					                	<strong>£{{ $netFee }}</strong>
					                </td>
					                <!--<td><a class="text-success viewinfo" href="javascript:void(0);"><strong>CANCEL</strong></a></td>-->
								</tr>
							@endforeach
							@endif
						    
				        </tbody>
				    </table>
				</div>

				<div class="text-right">
				    <!-- pagination [[ -->
				    <nav aria-label="..." class="paginationstyl">
				        <!--<ul class="pagination">
				            <li class="disabled"><a href="#" aria-label="Previous"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
				            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
				            <li><a href="#">2</a></li>
				            <li><a href="#">3</a></li>
				            <li><a href="#" aria-label="Next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
				        </ul>-->
				        {{ $allInvoice->appends($pagination_params)->render() }}
				    </nav>
				    <!-- ]] -->
				</div>
			</div>
		</div>
	</div>
</section>
</div>




@include('payments.modal_earning_calculator')
@include('payments.modal_deposite_funds')
@endsection


@section('customScript')
<script>
function setFormAction(redirectUrl){
	$("#paymentInvoiceForm").attr('action', redirectUrl);
	$("#paymentInvoiceForm").submit();
}
$(document).ready(function(){
    $("#opentask").click(function(){
        $(".taskcontent").toggleClass("open");
    });

    $(".release_amount").on('click', function(){
    	
    });

   

	$(".earningCalculator").on('click', function(){
		//$("#earningCalculatorModal").modal('show');
		process.on();
		$.ajax({
			type:'post',
			url:'{{url("/payments/calculate-my-earnings")}}',
			data:{
				isAjax:true
			},
			success:function(response){
				//var res = $.parseJSON(response);
				$(".perProjectCommission").val(response.perProjectCommission);
				$(".siteCommission").html(response.perProjectCommission);
				$("#earningCalculatorModal").modal('show');
				process.off();
			}, error: function(){
				process.off();
			}
		});
    });

    $(".calculateBtn").on('click', function(){
    	biddingAmount = $(".biddingAmount").val();
    	perProjectCommission = $(".perProjectCommission").val();

    	myEarnings = (biddingAmount - ((perProjectCommission/100)*biddingAmount));
    	siteEarnings = ((perProjectCommission/100)*biddingAmount);
    	myNetEarnings = (biddingAmount - ((perProjectCommission/100)*biddingAmount));

    	$(".myEarnings").html(myEarnings);
    	$(".siteEarnings").html(siteEarnings);
    	$(".myNetEarnings").html(myNetEarnings);
    });

    $(".withdrawFunds").on('click', function(){
    	r = confirm("Are you sure to withdraw your wallet balance?");
    	if(r){
    		//alert("1");
    		$.ajax({
				type:'post',
				url:'{{url("/payments/money-withdraw-request")}}',
				data:{
					isAjax:true
				},
				success:function(response){
					alert(response.msg);
					$(".myWalletBalanceSection").html('0');
					process.off();
				}, error: function(){
					process.off();
				}
			});
    	}
    })
});

$( function() {
    $( "#accordianbutton" ).on( "click", function() {
      $( "#main-tr,#sub-tr" ).toggleClass( "open", 1000 );
  
    });
  } );

$( function() {
    $( "#accordianbutton2" ).on( "click", function() {
      $( "#main-tr2,#sub-tr2" ).toggleClass( "open", 1000 );
  
    });
  } );



$( function() {
    $( "#accordianbutton3" ).on( "click", function() {
      $( "#main-tr3,#sub-tr3" ).toggleClass( "open", 1000 );
  
    });
  } );


// accordian ]] 
$( function() {
    $( "#oepnportfolio" ).on( "click", function() {
      $( ".uploadportfolio" ).toggleClass( "open", 1000 );

  
    });
  } );


$( function() {
    $( ".nav-tabs" ).on( "click", function() {
      $( ".uploadportfolio" ).removeClass( "open", 1000 );
    });
  } );
</script>
@endsection