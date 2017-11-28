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
<section class="myfundpage">
	<div class="container">	
		<div class="row">
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
			<h2 class="funt_title">Statement</h2>	
			<div class="infobox white-bg">
				<form action="" id="statementForm">
					{{ csrf_field() }}
					<div class="panel-body">
						<div class="filter_form clearfix">
							<div class="form-group pull-left ml_0">
								<select class="form-control minimal" name="transaction_type">
									<option value="">All transactions</option>
									@foreach($invoice_status as $eachStatusKey=>$eachStatusValue)
									<option value="{{ $eachStatusKey }}" {{ $transaction_type == $eachStatusKey ? 'selected' : '' }}>{{ $eachStatusValue }} transactions</option>
									@endforeach
								</select>
							</div>
							<div class="form-group pull-left">
								<input name="invoicedaterange" class="form-control minimal invoicedaterange" value="{{ $invoicedaterange }}" type="text">
							</div>
							<button type="submit" class="btn btn-default" onclick="setFormAction('{{ url('/payments/statements') }}')"><i class="fa fa-search"></i></button>
							<button class="btn btn-success btn-lg editbtn pull-right" onclick="setFormAction('{{ url('/payments/download-statements') }}')"><i class="fa fa-download"></i> DOWNLOAD</button>
						</div><!-- filter ]]-->
						<div class="table-responsive table_style">
						    <table class="table">
						        <caption class="statement_caption"><h2>Your statement for {{ $invoicedaterange }}</h2></caption>
						        <thead>
						            <tr>
						                <th>&nbsp;</th>
						                <th>NET</th>
						                <th>VAT</th>
						                <th>TOTAL</th>
						            </tr>
						        </thead>
						        <tbody>
						            @php
						            $netIncome = 0;
						            $grossIncome = 0;
						            $netVat = 0;
						            $NetMovementGross = 0;
						            $NetMovementVat = 0;
						            $NetMovementProfit = 0;
						            if(isset($income[0]->total_amt)){
						            	$grossIncome = $income[0]->total_amt;
						            	$netIncome = $grossIncome;
						        	}
						        	if(isset($income[0]->total_vat)){
						            	$netVat = $income[0]->total_vat;
						            	$netIncome = $netIncome - $netVat;
						        	}
						        	$NetMovementGross = $NetMovementGross + $grossIncome;
						        	$NetMovementVat = $NetMovementVat + $netVat;
						        	$NetMovementProfit = $NetMovementProfit + $netIncome;
						            @endphp
						            <tr>
						                <td>Income</td>
						                <td>£ {{ $grossIncome }}</td>
						                <td>£ {{ $netVat }}</td>
						                <td>£ {{ $netIncome }}</td>
						            </tr>
						            <!-- <tr>
						                <td>Team Network Service Fees <br><small class="text-muted">Service fees as % of income</small></td>
						                <td>-52.68 <br><small class="text-muted">5.7%</small></td>
						                <td>-10.53 <br><small class="text-muted">-</small></td>
						                <td>-63.21 <br><small class="text-muted">6.8%</small></td>
						            </tr> -->
						            @php
						            $netPayment = 0;
						            $grossPayment = 0;
						            $netVat = 0;
						            if(isset($expense[0]->total_amt)){
						            	$grossPayment = $expense[0]->total_amt;
						            	$netPayment = $grossPayment;
						        	}
						        	if(isset($expense[0]->total_vat)){
						            	$netVat = $expense[0]->total_vat;
						            	$netPayment = $netPayment + $netVat;
						        	}
						        	$NetMovementGross = $NetMovementGross - $grossPayment;
						        	$NetMovementVat = $NetMovementVat + $netVat;
						        	$NetMovementProfit = $NetMovementProfit - $netPayment;
						            @endphp
						            <tr>
						                <td>Payments</td>
						                <td>£ {{ $grossPayment }}</td>
						                <td>£ {{ $netVat }}</td>
						                <td>£ {{ $netPayment }}</td>
						            </tr>
						            <!-- <tr>
						                <td>Other Fees</td>
						                <td>£0.00</td>
						                <td>£0.00</td>
						                <td>£0.00</td>
						            </tr> -->
						            <tr class="nettotal">
						                <td><strong>Net movement</strong></td>
						                <td><strong>£ {{ abs($NetMovementGross) }}</strong></td>
						                <td><strong>£ {{ abs($NetMovementVat) }}</strong></td>
						                <td><strong>£ {{ abs($NetMovementProfit) }}</strong></td>
						            </tr>
						        </tbody>
						    </table>
						</div>
					</div>
				</form>
			</div>
		</div><!-- col ]] -->

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h2 class="funt_title">Statement Summary</h2>	
			<div class="infobox">
				<div class="panel-body">
					<center>
						<h2 class="staustitle">{{$prevYear}} - {{$currentYear}}</h2>
						<ul class="jobstatus2 list-inline clearfix">
							<li class="completejob">
								<span class="stnm">{{ count($myCompletedJobs) }}</span>
								<p>PROJECTS</p>
								<h6>COMPLETED</h6>
							</li><!-- ]] -->


							<li class="postedjob">
								<span class="stnm">{{ count($postedJobs) }}</span>
								<p>PROJECTS</p>
								<h6>POSTED</h6>
							</li><!-- ]] -->
						</ul>
					</center>
					<div class="border_line">
					<ul class="list-unstyled jobstatuslist">
						<li class="clearfix">
							<p class="pull-left">Paid this month</p>
							<p class="pull-right">£ {{ $paidMonthly }}</p>
						</li>


						<li class="clearfix">
							<p class="pull-left">Paid to date</p>
							<p class="pull-right">£ {{ $paidToday }}</p>
						</li>


						<li class="clearfix">
							<p class="pull-left">Earned this month</p>
							<p class="pull-right">£ {{ $earnedMonthly }}</p>
						</li>

						<li class="clearfix">
							<p class="pull-left">Earned to date</p>
							<p class="pull-right">£ {{ $earnedToday }}</p>
						</li>

						<li class="clearfix">
							<p class="pull-left">Member since</p>
							<p class="pull-right">{{ date('d F, Y', strtotime(Auth::user()->created_at)) }}</p>
						</li>
					</ul>
				</div>
			</div>
		</div><!-- col ]] -->
	</div><!-- container ]] -->
	</div>
	</div>
</section>
</div>

@endsection


@section('customScript')

<script>
function setFormAction(redirectUrl){
	$("#statementForm").attr('action', redirectUrl);
	$("#statementForm").submit();
}
$(document).ready(function(){
    $("#opentask").click(function(){
        $(".taskcontent").toggleClass("open");
    });    
});

$( function() {
    $( "#accordianbutton" ).on( "click", function() {
    	$( "#main-tr,#sub-tr" ).toggleClass( "open", 1000 );
    });
});

$( function() {
    $( "#accordianbutton2" ).on( "click", function() {
    	$( "#main-tr2,#sub-tr2" ).toggleClass( "open", 1000 );
    });
});

$( function() {
    $( "#accordianbutton3" ).on( "click", function() {
    	$( "#main-tr3,#sub-tr3" ).toggleClass( "open", 1000 );
    });
});


// accordian ]] 
$( function() {
    $( "#oepnportfolio" ).on( "click", function() {
    	$( ".uploadportfolio" ).toggleClass( "open", 1000 );
    });
});


$( function() {
    $( ".nav-tabs" ).on( "click", function() {
    	$( ".uploadportfolio" ).removeClass( "open", 1000 );
    });
  } );
</script>
@endsection