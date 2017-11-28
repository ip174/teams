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
						<i class="material-icons">forum</i>  Live Support, Chat Now
					</a>
					<div class="clearfix"></div>
					<p class="txtsmhw">Our support team is ready to assits you</p>
				</div>
		</div>
	</section>
	<section class="hwmenu">
		<div class="container">
			<ul class="nav navbar-nav">
				<li class="active"><a href="javascript:void(0);">How it works</a></li>
				<li><a href="{{url('/help-centre')}}">Help Centre</a></li>
				<li><a href="{{url('/service-fee')}}">Service Fee</a></li>
				<li><a href="{{url('/dispute')}}">Dispute</a></li>
				<li><a href="{{url('/community')}}">Community</a></li>
				<li><a href="{{url('/contact-us')}}">Contact Us</a></li>
			</ul>
		</div>
	</section>

	<section class="videowraphw">
		<div class="container">
			<h3 class="hwvdo_title">At Teams Network, you can be a hirer, a collaborator or both at the same time!</h3>
			<ul class="list-unstyled vdolisthw clearfix">
				<li>
					<div class="videobxhw">	
						<iframe width="560" height="315" src="https://www.youtube.com/embed/Bey4XXJAqS8" frameborder="0" allowfullscreen></iframe>
					</div>
					<h3 class="vdotitlehw">OUTSOURCE YOUR PROJECT</h3>
					<a href="javascript:void(0);" class="btn btn-default btnhwvdo">EXPLORE HIRER'S GUIDE</a>
				</li>
				<li>
					<div class="videobxhw">	
						<iframe width="560" height="315" src="https://www.youtube.com/embed/Bey4XXJAqS8" frameborder="0" allowfullscreen></iframe>
					</div>
					<h3 class="vdotitlehw">BECOME A COLLABORATOR</h3>
					<a href="javascript:void(0);" class="btn btn-default btnhwvdo">EXPLORE COLLABORATOR'S GUIDE</a>
				</li>
			</ul>
		</div>
	</section>

	<section class="howitlist">
		<div class="container">
			<ul class="list-unstyled thehwlist">
				<li>
					<div class="row">
						<div class="col-sm-6 txthwcol">
							<h4 class="txtcoltitle">Hire the best talent online</h4>
							<h5 class="txtcolSubtitle">Sign up and start posting your projects on Teams Network.</h5>
							<ul class="parabullet">
								<li><a href="#">Post a job</a> and start receiving proposals</li>
								<li>Browse, review and shortlist potential collaborators</li>
								<li>Communicate and hire the right collaborator for your project</li>
							</ul>

							<ul class="list-unstyled hwaccordian">
								<li>
									<div class="accordion_head clearfix">
										Can I edit the details of my posted job?
										<span class="plusminus open"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body">										
										Yes, you can edit the details of your posted job prior to accepting any proposal. All collaborators who have bid so far on your posted job will also be notified so they can amend their proposal to match your revised project.
									</div>
								</li>
								<li>
									<div class="accordion_head clearfix">
										Can I contact a collaborator directly and get a quote? 
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
									</div>
								</li>
								<li>
									<div class="accordion_head clearfix">
										Can I be both a hirer and a collaborator? 
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
									</div>
								</li>
							</ul>
						</div>
						<div class="col-sm-6 imghwcol">
							<img class="img-responsive" src="{{asset('assets/frontend/images/hwlist_src.png')}}">
						</div>
					</div>
				</li>
				<li>
					<div class="row">
						<div class="col-sm-6 txthwcol">
							<h4 class="txtcoltitle">Find online jobs</h4>
							<h5 class="txtcolSubtitle">Teams Network helps you to find jobs, increase your client list and grow your business. You can:</h5>
							<ul class="parabullet">
								<li><a href="#">Sign up</a> and create a user profile, add your skills and portfolio</li>
								<li>Search and find your suitable assignment from our Jobs page</li>
								<li>Send proposals (Bid), communicate and get hired!</li>
							</ul>

							<ul class="list-unstyled hwaccordian">
								<li>
									<div class="accordion_head clearfix">
										What kind of assignments can I find on Teams Network?
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Yes, you can edit the details of your posted job prior to accepting any proposal. All collaborators who have bid so far on your posted job will also be notified so they can amend their proposal to match your revised project.
									</div>
								</li>
								<li>
									<div class="accordion_head clearfix">
										 How can I increase my chance of winning jobs? 
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
									</div>
								</li>
								
							</ul>
						</div>
						<div class="col-sm-6 imghwcol">
							<img class="img-responsive" src="{{asset('assets/frontend/images/hwlist_src2.png')}}">
						</div>
					</div>
				</li>
				<li>
					<div class="row">
						<div class="col-sm-6 txthwcol">
							<h4 class="txtcoltitle">Collaborate</h4>
							<h5 class="txtcolSubtitle">You can manage and collaborate on your projects through shared Workstreams. Workstream offers:</h5>
							<ul class="parabullet">
								<li>A dedicated space for project control</li>
								<li>An easy-to-use workflow system that monitors progress</li>
								<li>Real-time communication, messaging and feedback</li>
							</ul>

							<ul class="list-unstyled hwaccordian">
								<li>
									<div class="accordion_head clearfix">
										How does a project Workstream operate?
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Yes, you can edit the details of your posted job prior to accepting any proposal. All collaborators who have bid so far on your posted job will also be notified so they can amend their proposal to match your revised project.
									</div>
								</li>
								<li>
									<div class="accordion_head clearfix">
										Workstream Q2 
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
									</div>
								</li>
								<li>
									<div class="accordion_head clearfix">
										Workstream Q3 
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
									</div>
								</li>
							</ul>
						</div>
						<div class="col-sm-6 imghwcol">
							<img class="img-responsive" src="{{asset('assets/frontend/images/hwlist_src3.png')}}">
						</div>
					</div>
				</li>
				<li>
					<div class="row">
						<div class="col-sm-6 txthwcol">
							<h4 class="txtcoltitle">Payments protection</h4>
							<h5 class="txtcolSubtitle">Teams Network accepts major credit cards and banking payments and ensures that all payments are protected through our escrow system.</h5>
							<ul class="parabullet">
								<li>Avoid the high fees of other networks</li>
								<li>Simple invoicing and rapid payment</li>
								<li>Full reporting facilities</li>
							</ul>

							<ul class="list-unstyled hwaccordian">
								<li>
									<div class="accordion_head clearfix">
										What is an Escrow Account?
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Yes, you can edit the details of your posted job prior to accepting any proposal. All collaborators who have bid so far on your posted job will also be notified so they can amend their proposal to match your revised project.
									</div>
								</li>
								<li>
									<div class="accordion_head clearfix">
										Payments Q2 
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
									</div>
								</li>
								<li>
									<div class="accordion_head clearfix">
										Payments Q3 
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
									</div>
								</li>
							</ul>
						</div>
						<div class="col-sm-6 imghwcol">
							<img class="img-responsive" src="{{asset('assets/frontend/images/hwlist_src4.png')}}">
						</div>
					</div>
				</li>
				<li>
					<div class="row">
						<div class="col-sm-6 txthwcol">
							<h4 class="txtcoltitle">Review and feedback</h4>
							<h5 class="txtcolSubtitle">On Teams Network, we encourage both Hirer and Collaborator to review each other's professional work at the end of each project. This will help us with ranking our users based on their performance on the site.</h5>
							<ul class="parabullet">
								<li>A dedicated space for project control</li>
								<li>Easy-to-use workflow system monitors progress</li>
								<li>Real-time communication, messaging and feedback</li>
							</ul>

							<ul class="list-unstyled hwaccordian">
								<li>
									<div class="accordion_head clearfix">
										Should I rate a Hirer/Collaborator and leave feedback?
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Yes, you can edit the details of your posted job prior to accepting any proposal. All collaborators who have bid so far on your posted job will also be notified so they can amend their proposal to match your revised project.
									</div>
								</li>
								<li>
									<div class="accordion_head clearfix">
										How can I leave a feedback? 
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
									</div>
								</li>
								<li>
									<div class="accordion_head clearfix">
										Reviews and feedback Q3 
										<span class="plusminus"><i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></span>
									</div>
									<div class="accordion_body" style="display:none;">										
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis
									</div>
								</li>
							</ul>
						</div>
						<div class="col-sm-6 imghwcol">
							<img class="img-responsive" src="{{asset('assets/frontend/images/hwlist_src5.png')}}">
						</div>
					</div>
				</li>

			</ul>
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