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

@php
$invoice_status = config("constants.INVOICE_STATUS");
@endphp
<section class="myfundpage">
		<div class="container">
			
			<h2 class="funt_title">My Transaction History</h2>	
			<div class="infobox white-bg">
				<div class="panel-body">

					<form action="" id="transactionInvoiceForm">
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
						<button type="submit" class="btn btn-default" onclick="setFormAction('{{ url('/payments/transaction-history') }}')"><i class="fa fa-search"></i></button>
						<button class="btn btn-success btn-lg editbtn pull-right" onclick="setFormAction('{{ url('/payments/download-transaction-details') }}')"><i class="fa fa-download"></i> DOWNLOAD</button>
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

@endsection


@section('customScript')

<script>
function setFormAction(redirectUrl){
	$("#transactionInvoiceForm").attr('action', redirectUrl);
	$("#transactionInvoiceForm").submit();
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