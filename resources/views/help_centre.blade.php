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
				<li class="active"><a href="javascript:void(0);">Help Centre</a></li>
				<li><a href="{{url('/service-fee')}}">Service Fee</a></li>
				<li><a href="{{url('/dispute')}}">Dispute</a></li>
				<li><a href="{{url('/community')}}">Community</a></li>
				<li><a href="{{url('/contact-us')}}">Contact Us</a></li>
			</ul>
		</div>
	</section>

	
<section class="helpwrap" style="background-image:url('{{asset('assets/frontend/images/hwhelp_src.png')}}');">
	<div class="container">
		<h2 class="helphwTitle">Hi, how can we help?</h2>

		<div class="form-group hwhelinpu">
			<input type="text" class="form-control" placeholder="I have a question about..." name="">
			<input type="button" class="btn btn-success btn-lg" value="GET SUPPORT" name="">
		</div>

		<div class="clearfix">
			<p class="pull-left parahwtag">Trending topics</p>
			<ul class="list-inline tagsllist">
				<li><a>Latest releases</a></li>
				<li><a>Create a team</a></li>
				<li><a>Escrew system</a></li>
				<li><a>Invoice</a></li>
			</ul>	
		</div>

		<h3 class="faqhwTitle">Frequently Asked Questions</h3>

		<div class="row">
			<div class="col-sm-4 faqhwCol">
				<div class="thebxfaq">					
					<h2 class="headfaqhw">Getting started</h2>
					<ul class="list-unstyled">
						<li><a href="javascript:void(0);">How to get started?</li>
						<li><a href="javascript:void(0);">How to add portal?</li>
						<li><a href="javascript:void(0);">How to invite</li>
					</ul>
					<a href="javascript:void(0);" class="btn btn_more">More</a>
				</div>
			</div>   

			<div class="col-sm-4 faqhwCol">
				<div class="thebxfaq">					
					<h2 class="headfaqhw">Workstream</h2>
					<ul class="list-unstyled">
						<li><a href="javascript:void(0);">How to get create ...?</li>
					</ul>
					<a href="javascript:void(0);" class="btn btn_more">More</a>
				</div>
			</div> 

			<div class="col-sm-4 faqhwCol">
				<div class="thebxfaq">					
					<h2 class="headfaqhw">Account settings</h2>
					<ul class="list-unstyled">
						<li><a href="javascript:void(0);">Edit profile</li>
						<li><a href="javascript:void(0);">Account visibility</li>
						<li><a href="javascript:void(0);">Set notifications</li>
						<li><a href="javascript:void(0);">Schedule automatic payments</li>
						<li><a href="javascript:void(0);">Non disclosure agreements auto fill data</li>
					</ul>
					<a href="javascript:void(0);" class="btn btn_more">More</a>
				</div>
			</div>  


			<div class="col-sm-4 faqhwCol">
				<div class="thebxfaq">					
					<h2 class="headfaqhw">Project management</h2>
					<ul class="list-unstyled">
						<li><a href="javascript:void(0);">How to get started?</li>
						<li><a href="javascript:void(0);">How to add portal?</li>
						<li><a href="javascript:void(0);">How to invite</li>
						<li><a href="javascript:void(0);">NDAs</li>
					</ul>
					<a href="javascript:void(0);" class="btn btn_more">More</a>
				</div>
			</div> 


			<div class="col-sm-4 faqhwCol">
				<div class="thebxfaq">					
					<h2 class="headfaqhw">Post jobs</h2>
					<ul class="list-unstyled">
						<li><a href="javascript:void(0);">Access your earnings</li>
						<li><a href="javascript:void(0);">Create invoice</li>
					</ul>
					<a href="javascript:void(0);" class="btn btn_more">More</a>
				</div>
			</div> 


			<div class="col-sm-4 faqhwCol">
				<div class="thebxfaq">					
					<h2 class="headfaqhw">Workstream</h2>
					<ul class="list-unstyled">
						<li><a href="javascript:void(0);">How to</li>
					</ul>
					<a href="javascript:void(0);" class="btn btn_more">More</a>
				</div>
			</div> 


			<div class="col-sm-4 faqhwCol">
				<div class="thebxfaq">					
					<h2 class="headfaqhw">Rules of engagement</h2>
					<ul class="list-unstyled">
						<li><a href="javascript:void(0);">How to get started?</li>
						<li><a href="javascript:void(0);">How to add portal?</li>
						<li><a href="javascript:void(0);">How to invite</li>
					</ul>
					<a href="javascript:void(0);" class="btn btn_more">More</a>
				</div>
			</div>  


			<div class="col-sm-4 faqhwCol">
				<div class="thebxfaq">					
					<h2 class="headfaqhw">Agreements and policies</h2>
					<ul class="list-unstyled">
						<li><a href="javascript:void(0);">User policies</li>
						<li><a href="javascript:void(0);">Agreements</li>
					</ul>
					<a href="javascript:void(0);" class="btn btn_more">More</a>
				</div>
			</div>  


			<div class="col-sm-4 faqhwCol">
				<div class="thebxfaq">					
					<h2 class="headfaqhw">Disputes Resolutions</h2>
					<ul class="list-unstyled">
						<li><a href="javascript:void(0);">How to</li>
					</ul>
					<a href="javascript:void(0);" class="btn btn_more">More</a>
				</div>
			</div>   
		</div><!-- row ]] -->
	</div>

</section>



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