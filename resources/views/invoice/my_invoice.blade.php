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
	<div class="container taskcontent">
		<h2 class="funt_title">Invoice</h2>	
		<div class="infobox white-bg">
			<div class="panel-body">
				<form action="" id="invoice_form">
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
					<button type="button" class="btn btn-default" onclick="setFormAction('{{ url('/invoice/view-invoice') }}')"><i class="fa fa-search"></i></button>
					<button class="btn btn-success btn-lg editbtn pull-right" onclick="setFormAction('{{ url('/invoice/download-invoice') }}')"><i class="fa fa-download"></i> DOWNLOAD</button>
				</div>
				</form>

				<div class="">
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
				<div class="table-responsive style2">
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
						                &nbsp;&nbsp;
						                @if($eachInvoice->status == 2 && $eachInvoice->invoice_by_user == $authUser)
						                	<button type="button" class="btn btn-warning" onclick="pay_respect_invoice('{{ $eachInvoice->id }}', '{{ $eachInvoice->gross_amt }}')">Pay Now</button>
						                @else
						                	<i class="{{ $statusClass }}"></i>
						                	{{ $statusText }}
						                @endif

					                </td>
					                <td>£{{ $eachInvoice->gross_amt }}</td>
					                <td>£{{ $eachInvoice->fee_amt }}</td>
					                <td>
					                	@php
					                	$netPayableAmnt = $eachInvoice->gross_amt - $eachInvoice->fee_amt;
					                	$netPayableAmnt = ($netPayableAmnt-(($eachInvoice->vat_percent/100)*$netPayableAmnt));
					                	@endphp
					                	<strong>£{{ $netPayableAmnt }}</strong>
					                </td>
					                <!--<td><a class="text-success viewinfo" href="javascript:void(0);"><strong>CANCEL</strong></a></td>-->
								</tr>
							@endforeach
							@endif
						    
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</section>


</div>

@include('invoice.modal_pay_invoice')
@endsection


@section('customScript')
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
function setFormAction(redirectUrl){
	$("#invoice_form").attr('action', redirectUrl);
	$("#invoice_form").submit();
}
$(document).ready(function(){
    $("#opentask").click(function(){
        $(".taskcontent").toggleClass("open");
    });

    $(".release_amount").on('click', function(){
    	
    });

    //$('input[name="invoicedaterange"]').daterangepicker();
    $('input[name="invoicedaterange"]').daterangepicker({
        //autoUpdateInput: false,
        locale: {
            format: 'DD/MM/YYYY'
        }
	});
});

function pay_respect_invoice(invoiceId, payableAmount){
	process.on();
	$(".invoicePaymentmodal").modal('show');
	$(".invoiceId").val(invoiceId);
	$(".payableAmount").val(payableAmount);
	process.off();
}
</script>
@endsection