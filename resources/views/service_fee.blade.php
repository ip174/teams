@extends('layouts.app')
@section('title')
Job bidding
@endsection
@section('content') 

<!--  <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" /> -->
<!-- <link class="main-stylesheet" href="{{asset('assets/frontend/forhome/css/pages.css')}}" rel="stylesheet" type="text/css" /> -->
<link href="{{asset('assets/frontend/pages/css/forhome-icons.css" rel="stylesheet')}}" type="text/css" />
<link class="main-stylesheet" href="{{asset('assets/frontend/forhome/css/icofont.css')}}" rel="stylesheet" type="text/css" />

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  

	<section class="postjobtitlebox getsupportwrp">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h1>Get Support
					<small>With Teams Network you get free, unlimited support 24/7</small>
					</h1>
				</div>
				<div class="col-sm-4 text-right txt-dvxs">
					<a href="javascript:void(0);" class="btn btn-info btnhwsp">
						<i class="material-icons">forum</i> Live Support, Chat Now
					</a>
					<div class="clearfix"></div>
					<p class="txtsmhw">Our support team is ready to assits you</p>
				</div>
		</div>
	</section>
	<section class="hwmenu">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="{{url('/how-it-works')}}">How it works</a></li>
				<li><a href="{{url('/help-centre')}}">Help Centre</a></li>
				<li class="active"><a href="javascript:void(0);">Service Fee</a></li>
				<li><a href="{{url('/dispute')}}">Dispute</a></li>
				<li><a href="{{url('/community')}}">Community</a></li>
				<li><a href="{{url('/contact-us')}}">Contact Us</a></li>
			</ul>
		</div>
	</section>

<section class="servicefee">
	<div class="container">

		<div class="serfeebx">
			<h2 class="serfeetitel">Service fee and commissions</h2>
			<p class="paraserfee">Teams Network Service fee charges are based on the total amount Collaborator(s) collect from Hirer every month. The Service Fee rates decrease as the total fees collected from Hirer meet certain thresholds as follows:</p>

			<div class="tablecsuc">
				<table class="table table-bordered">
					<thead>
						<th>Total amount</th>
						<th>Service fee</th>
					</thead>

					<tbody>
						<tr>
							<td data-th="Total amount">£600.00 and below 10% Fixed</td>
							<td data-th="Service fee">10% Fixed</td>
						</tr>
						<tr>
							<td data-th="Total amount">£600.01 - £6,000.00</td>
							<td data-th="Service fee">(10% for first £600.00) + 6% for the remaining £5,400.00</td>
						</tr>
						<tr>
							<td data-th="Total amount">£600.01 and up</td>
							<td data-th="Service fee">(10% for first £600.00) + (6% of £5,400.00) + 5% for the remaining</td>
						</tr>
					</tbody>

				</table>
			</div>

			<p class="paraserfee"><small>All the service charges are excluding VAT and payment processing fees.</small></p>

			<p class="paraserfee">The service fee will only be deducted from the total amount that transfers from Hierer escrew account into Collaborator's account on completion and approval of the Assignment.</p>

			<p class="paraserfee">Teams Network will not charge any other fees for opening an Account, using our website to change/edit user profile, using our website to post/edit materials, Posting and Assignment, bidding on Assignments, or for fulfilling other account-related activities.</p>
		</div>

		<div class="serfeebx">
			<h2 class="serfeetitel">Additional Services Fee</h2>
			<p class="paraserfee">Teams Network can optionally purchase additional service such as Bid upgrades, Highlight Bid and Urgent Assignments. Each Additional service has a different price and users will be charged at the time of purchase. All the fees are Inclusive VAT but Payment Processing Fee may apply.</p>

			<div class="tablecsuc">
				<table class="table table-bordered">
					<thead>
						<th>Service type</th>
						<th>Fee</th>
					</thead>

					<tbody>
						<tr>
							<td data-th="Service type">
								<strong>Urgent Assignment</strong>
								<small class="btn-block">
								Receive a faster response from collaborators.</small>
							</td>
							<td data-th="Fee">£3.00</td>
						</tr>
						
						<tr>
							<td data-th="Service type">
								<strong>Highlight bid</strong>
								<small class="btn-block">
								Highlight bids visually stand out to the<br> Employer from other bidders.</small>
							</td>
							<td data-th="Fee">£1.00</td>
						</tr>
						<tr>
							<td data-th="Service type">
								<strong>Bid Upgrades</strong>
								<small class="btn-block">
								Users can buy additional bids if they run out of bids on the allowance of<br> a selected package.</small>
							</td>
							<td data-th="Fee">5 bids for £3.99, 15 bids for £6.99, 50 bids for £9.99 and 100 bids for £16.99</td>
						</tr>

					</tbody>

				</table>
			</div>
		</div>

		<div class="serfeebx">
			<h2 class="serfeetitel">Payment Processing Fee</h2>
			<p class="paraserfee">Teams Network will charge Users a payment processing and administration fee of the total amount of each payment made for the site services as following:</p>

			<div class="tablecsuc">
				<table class="table table-bordered">
					<thead>
						<th>Transaction type</th>
						<th>Fee</th>
					</thead>

					<tbody>
						<tr>
							<td data-th="Transaction type">Local Bank Deposit</td>
							<td data-th="Fee">Free</td>
						</tr>
						
						<tr>
							<td data-th="Transaction type">Credit Card, PayPal, Skrill</td>
							<td data-th="Fee">£3.00 or 3%</td>
						</tr>
						<tr>
							<td data-th="Transaction type">International Wire Transfer</td>
							<td data-th="Fee">(10% for first £600.00) + (6% of E5,400.00) + 5% for the remaining</td>
						</tr>

					</tbody>

				</table>
			</div>
		</div>

	</div>
</section>


@include('layouts.footer_you_are_waiting')


@endsection

@section('customScript') <!-- 
<script type="text/javascript" src="{{asset('assets/frontend/forhome/plugins/vide/jquery.vide.min.js')}}"></script>  -->
<script type="text/javascript">
	 $(document).ready(function() {
        //toggle the component with class accordion_body
        $(".accordion_head").click(function() {
            if ($('.accordion_body').is(':visible')) {
                $(".accordion_body").slideUp(300);
                $(".plusminus").addClass('open');
            }
            if ($(this).next(".accordion_body").is(':visible')) {
                $(this).next(".accordion_body").slideUp(300);
                $(this).children(".plusminus").addClass('open');
            } else {
                $(this).next(".accordion_body").slideDown(300);
                $(this).children(".plusminus").removeClass('open');
            }
        });
    });

</script> 
@endsection