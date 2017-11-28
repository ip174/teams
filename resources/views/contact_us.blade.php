@extends('layouts.app')
@section('title')
Job bidding
@endsection
@section('content') 


<link href="{{asset('assets/frontend/pages/css/forhome-icons.css" rel="stylesheet')}}" type="text/css" />
<link class="main-stylesheet" href="{{asset('assets/frontend/forhome/css/icofont.css')}}" rel="stylesheet" type="text/css" />

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@php
//url()->current()
//url('/')
@endphp
@include('layouts.info_pages_common_header')


<section class="contact_infolist">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shdw_bx white-bg text-center">
					<figure>
						<span>
							<img src="{{asset('assets/frontend/images/contact_src.png')}}" class="img-responsive">
						</span>
					</figure>
					<h3>TRAINING AND EVENTS</h3>
					<P>Learn with online webinars, case studies, local events and training courses</P>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shdw_bx white-bg text-center">
					<figure>
						<span>
							<img src="{{asset('assets/frontend/images/contact_src2.png')}}" class="img-responsive">
						</span>
					</figure>
					<h3>CONTACT HELP DESK</h3>
					<P>Report a problem, user or any errors or issues that you may have using Teams Network</P>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shdw_bx white-bg text-center">
					<figure>
						<span>
							<img src="{{asset('assets/frontend/images/contact_src3.png')}}" class="img-responsive">
						</span>
					</figure>
					<h3>PRESS RELEASES</h3>
					<P>Leave us a message and our customer support team will get back to you right away</P>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="conatctform white-bg">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<h2 class="ctf_title">Contact us</h2>
				<div class="thectnform">
					<div class="form-group">
						<label>Full name</label>
						<input type="text" class="form-control" placeholder="John Doe" value="Roxie" name="">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" placeholder="johndoe@teamnetwork.com" value="" name="">
					</div>
					<div class="form-group">
						<label>Email</label>
						<textarea class="form-control" cols="" rows="10" placeholder="Type the message you wish to send"></textarea>
					</div>
					<div class="text-right">
						<input type="button" class="btn btn-success btn-lg" value="SEND" name="">
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="continfobx">
					<h3>Teams Network Limited</h3>
					<p>Registered in England and Wales</p>
					<p>2 Minton Place, Victoria Road, Bicester, Oxfordshire, United Kingdom, OX26 6QB</p>
					<p>Email: <a class="text-success" href="mailto:support@teams.network">support@teams.network</a></p>
					<p>Tel: +44 232 3222234</p>
					<p>Fax: +44 232 3222234</p>
					<p class="cmpnmbr text-muted">Company number 10722020</p>
					<p class="text-muted">Follow us on:</p>
					<ul class="list-inline sociallinks">
						<li>
							<a href="#"><i class="fa fa-facebook-square fa-3x text-muted" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-twitter-square fa-3x text-muted" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-linkedin-square fa-3x text-muted" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-youtube-square fa-3x text-muted" aria-hidden="true"></i></a>
						</li>
					</ul>
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