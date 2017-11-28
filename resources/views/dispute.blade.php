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
					<a href="javascript:void(0);" class="btn btn-info btnhwsp"><i class="material-icons">forum</i> Live Support, Chat Now</a>
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
				<li><a href="{{url('/service-fee')}}">Service Fee</a></li>
				<li class="active"><a href="javascript:void(0);">Dispute</a></li>
				<li><a href="{{url('/community')}}">Community</a></li>
				<li><a href="{{url('/contact-us')}}">Contact Us</a></li>
			</ul>
		</div>
	</section>

<section class="disputwrap">
	<div class="container">
		<h2 class="serfeetitel">Disputes</h2>
		<div class="shdw_bx">
			<div class="tabsdisput">
				<div class="menuwrapdsp clearfix">
			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs pull-left" role="tablist">
			    <li role="presentation" class="active"><a href="#tabdisput_1" aria-controls="tabdisput_1" role="tab" data-toggle="tab">Active Disputes</a></li>
			    <li role="presentation"><a href="#tabdisput_2" aria-controls="tabdisput_2" role="tab" data-toggle="tab">Close Disputes</a></li>
			  </ul>
			  <a href="javascript:void(0);" class="btn btn-success btn-sm pull-right btncretdisp clearfix"><i class="material-icons pull-left">gavel</i> CREATE NE DISPUTE</a>
			</div>

			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="tabdisput_1">
			    	<div class="text-center contdsp">
						<img src="{{asset('assets/frontend/images/disput_src.png')}}" class="img-responsive inline-block">
						
						<p class="parad">You do not have any active disputes</p>
						<p class="parad"><a class="text-success" href="#">Click here</a> to learn more about how disputes work</p>
					</div>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="tabdisput_2">
			    	<h3 class="text-muted text-center panel-body">No Data to show</h3>
			    </div>
			  </div>

			</div>
			
		</div>

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