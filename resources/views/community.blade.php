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
				<li><a href="{{url('/service-fee')}}">Service Fee</a></li>
				<li><a href="{{url('/dispute')}}">Dispute</a></li>
				<li class="active"><a href="javascript:void(0);">Community</a></li>
				<li><a href="{{url('/contact-us')}}">Contact Us</a></li>
			</ul>
		</div>
	</section>

	
	
<section class="gereybxcommunity">
	<div class="container">
		<h2 class="titlecomnty pull-left">Recent posts from our blog</h2>
		<a href="javascript:void(0);" class="btn btn-success btn-sm pull-right btncretdisp clearfix">SUBSCRIBE</a>
		<div class="clearfix"></div>

		<div class="row">
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>

			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_2.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>

			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_3.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_4.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>

			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_5.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>

			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_6.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>
</section>
	
	
<section class="popularbxcmm white-bg">
	<div class="container">
		<h2 class="titlecomnty pull-left">Recent posts from our blog</h2>
		<a href="javascript:void(0);" class="btn btn-success btn-sm pull-right btncretdisp clearfix">SUBSCRIBE</a>
		<div class="clearfix"></div>

		<div class="row">
			
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_7.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>

			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_8.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>

			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_9.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_10.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>

			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_11.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
					</ul>
				</div>
			</div>


			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs">
				<div class="shadowbox newthumbox white-bg">
					<div class="dropdown dropdwnnew">
					  										</div>
					<figure>
						<img src="{{asset('assets/frontend/images/comunity_src_12.png')}}" class="img-responsive">
					</figure>
					<div class="panel-body">
						<h3 class="projectname">
						<span style="cursor:pointer" onclick="like_portfolio('13', 2)">the Basic Of Buying</span>
						<!--  -->
						</h3>
						<div class="pdate">By deHaaas - 11 April, 2016</div>
						<div class="sordesc">Find out which factors affect your ranking, and learn how to improve your visibility.</div>
					</div>
					<ul class="list-inline lvslist clearfix">
																<li>
							<a style="text-decoration:none;" class="like_link13" href="javascript:void(0);" onclick="like_portfolio('13', 1)" title="like"><i class="material-icons">thumb_up</i>
							</a>
							<span class="like_count13">0 likes</span>
						</li>
						<li>
						<a href="javascript:void(0);" onclick="like_portfolio('13', 2)" title="views">
							<i class="material-icons">remove_red_eye</i></a>
							<span class="preview_count13">2</span>
						</li>
						<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="material-icons">share</i></a></li>
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