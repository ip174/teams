<style>
.notification_count{
	background:#6bb96f;
	color:#FF0000;
	position:relative;
	top:-10px;
	left:-10px;
	padding:3px 3px 3px 3px;
}
</style>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<header id="header" class="{{ isset($site_home) && $site_home == '1' ? 'homeheader' : '' }}"   data-pages="header" data-pages-header="autoresize" data-pages-resize-class="light">
	<div class="headercont">
		<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="logo">
				<a href="{!! url('/') !!}">
					<img class="offforhome" src="{!! asset('assets/frontend/images/logo_inner_v3.png') !!}" alt=""/>
					<img class="showforhome hidden" src="{!! asset('assets/frontend/images/logo_v3.png') !!}" alt=""/>
				</a>
			</div>
		</div>


			<div class="visible-sm-inline visible-xs-inline menu-toggler pull-right p-l-10" data-pages="header-toggle" data-pages-element="#header">
              <div class="one"></div>
              <div class="two"></div>
              <div class="three"></div>
            </div>

		<div class="col-md-9 menu-content mobile-dark clearfix" data-pages="menu-content" data-pages-direction="slideRight">
			<div class="headerRight">
				<div class="headerNav">
					<a class="{{ isset($activeMenuHeader) && $activeMenuHeader == 'Jobs' ? 'selected' : '' }}" href="{{ url('jobs/search-jobs') }}">Jobs</a>
					<a class="{{ isset($activeMenuHeader) && $activeMenuHeader == 'Freelancer' ? 'selected' : '' }}" href="{!! url('freelancers/search-freelancers') !!}">Professionals<!-- People --></a>
					<a href="{{url('/how-it-works')}}">How it Works</a>
				</div>
				
			<!-- 	<a href="javascript:void(0);" class="normalbtn pink">How it Works</a> -->
				<!-- before login menu [[ -->
				
					@if(Auth::check())
						<!--<div class="loginReg">
						<a href="{!! url('logout') !!}" class="normalbtn green text-uppercase">Logout</a>
						</div>-->
					@else
						<div class="loginbtn pull-right">
						<a href="{!! url('login') !!}" class="btn btn-sm fs-14  btn-primary text-white "style="margin-right:10px;">Login</a>
						<a href="{!! url('register') !!}" class="btn btn-sm fs-14  btn-primary text-white">Sign Up</a>
						</div>
					@endif
				<!-- ]] -->
				<!-- after login menu [[ -->
				<div class="afterloginlinks clearfix {{ Auth::check() ? '' : 'hidden' }}">
					<a href="javascript:void(0)">
						<i class="material-icons">star_border</i>
					</a>
					<a href="{{ url('/jobs/my-workstream') }}">
						<i class="material-icons">
							mail_outline
							{!! getMessageNotificationCount() !!}
							<!--<sup class="notification_count">3</sup>-->
   						</i>
   					</a>
   					
   					<!-- Notification Area Start -->
   					@if(isset(Auth::user()->id)  && Auth::user()->id > 0)
   					@php
   					$userNotification = array();
   					if(isset(Auth::user()->id)  && Auth::user()->id > 0){
	   					$data = getProfileNotificationHelper(Auth::user()->id);
	   					$unreadNotifications = $data['unreadNotifications'];
	   					$readNotifications = $data['readNotifications'];
	   				}
   					@endphp
					<div class="dropdown">

						<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="material-icons">notifications_none</i>
						</button>
						<sup class="badge notibdge notificationCounter">
							{{count($unreadNotifications)}}
						</sup>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<p class="clearfix">
								MY NOTIFICATIONS
								<i class="fa fa-cog pull-right" style="cursor:pointer;" onClick="window.open('/settings/user-general-settings', '_self')"></i>
							</p>
							<div class="notificationArea">@php
							$counter = 0;
							@endphp
							@foreach($unreadNotifications as $eachNotification)
								<li>
									<i class="fa fa-file"></i>
									<a href="{{ $eachNotification->notification_link ? url($eachNotification->notification_link) : 'javascript:void(0);' }}">
										{{ $eachNotification->short_description }}
									</a>
								</li>
								@php
								$counter++;
								if($counter >= 5){
									break;
								}
								@endphp
							@endforeach



							@if($counter < 5)
								@foreach($readNotifications as $eachNotification)
								<li>
									<i class="fa fa-file"></i>
									<a href="{{ $eachNotification->notification_link ? url($eachNotification->notification_link) : 'javascript:void(0);' }}">
										{{ $eachNotification->short_description }}
									</a>
								</li>
								@php
								$counter++;
								if($counter >= 5){
									break;
								}
								@endphp
								@endforeach
							@endif
							<p class="seeallnotification text-center"><a href='{{ url('/my-notification') }}'>SEE ALL NOTIFICATIONS</a></p>
						</ul>
					</div>
					@endif
					<!-- Notification Area End -->

					<div class="dropdown profilemenu opendropdown">
						<!-- <button  class="profilePic" id="dLabel2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:url({!! asset('assets/frontend/images/profile-pic.jpg') !!}) no-repeat;">
							<span class="shape"></span>
						</button> -->
						@php
						$profilePic = isset(Auth::user()->profile_picture) ? Auth::user()->profile_picture : '';
						@endphp
						<button  class="profilePic showdrop" id="dLabel2" type="button" style="background-image:url('{!! profilePicPath($profilePic) !!}');">
							<span class="shape"></span>
						</button>
						@php
						$authUser = isset(Auth::user()->id) ? Auth::user()->id : '0';
						$userDetails = getUserDetails(array($authUser));
						$userDetails = count($userDetails) ? $userDetails[0] : array();
						$isAvailable = isset($userDetails->availability_status) ? $userDetails->availability_status : 'Offline';
						$checboxVal = $isAvailable=='Available' ? 'Offline' : 'Available';
						$isChecked = ($isAvailable=='Available') ? 'checked' : '';
						//echo $isAvailable; exit;
						@endphp
						<div class="dropdown-menu frontdbmenu" aria-labelledby="dLabel2" style="">
							<div class="availability clearfix">
								<p class="pull-left"><strong>I am <span class="available availabilityText">{{$isAvailable}}</span></strong></p>
								<label class="i-switch i-switch-md bg-info csswitch">
									<input type="checkbox" class="availabilityStatusBar" id="chkprivacy" onchange="setAvailableUnavailable()" value="{{ $checboxVal }}" {{ $isChecked }}>
									<i></i>
								</label>
							</div>
							<ul class="list-unstyled themenu">
								<li class="availability clearfix">
									<a href="{{ url('/user/dashboard') }}"><span class="menu_ico"><span><img src="{!! asset('assets/frontend/images/menu_ico.png') !!}" class="img-responsive"></span></span><p class="pull-left">Dashboard</p></a>
								</li>
								<li class="availability clearfix">
									<div class="ex_atag"><span class="menu_ico"><span><img src="{!! asset('assets/frontend/images/menu_ico2.png') !!}" class="img-responsive"></span></span>
										<p class="clearfix">
											<a href="{{ url('/user/my-profile') }}">Profile</a>
											<a href="{{ url('/user/edit-profile') }}">Edit</a>
										</p>
									</div>
								</li>
								

								<li class="availability clearfix">
									<a href="{{ url('/jobs/my-workstream') }}"><span class="menu_ico"><span><img src="{!! asset('assets/frontend/images/menu_ico3.png') !!}" class="img-responsive"></span></span><p class="pull-left">My Workstream</p></a>
								</li>
								<li class="availability clearfix">
									<a href="{{ url('/jobs/my-jobs-list') }}"><span class="menu_ico"><span><img src="{!! asset('assets/frontend/images/menu_ico4.png') !!}" class="img-responsive"></span></span><p class="pull-left">My Posted Jobs</p></a>
								</li>
								<li class="availability clearfix">
									<a href="{{ url('/payments/payments-overview') }}"><span class="menu_ico"><span><img src="{!! asset('assets/frontend/images/menu_ico5.png') !!}" class="img-responsive"></span></span><p class="pull-left">My Funds</p></a>
								</li>
								<li class="availability clearfix">
									<a href="{{ url('/settings/user-general-settings') }}"><span class="menu_ico"><span><img src="{!! asset('assets/frontend/images/menu_ico6.png') !!}" class="img-responsive"></span></span><p class="pull-left">Settings</p></a>
								</li>
								<li class="availability clearfix">
									<a href="{!! url('logout') !!}"><span class="menu_ico"><span><img src="{!! asset('assets/frontend/images/menu_ico7.png') !!}" class="img-responsive"></span></span><p class="pull-left">Signout</p></a>
								</li>
								<li class="availability clearfix">
									<a href="javascript:void(0)"><span class="menu_ico"><span><img src="{!! asset('assets/frontend/images/menu_ico8.png') !!}" class="img-responsive"></span></span><p class="pull-left">Get Support</p></a>
								</li>
								<!--<div class="availability clearfix">
									<a href="{{ url('/jobs/search-jobs') }}"><p class="pull-left">Bid on Jobs</p></a>
								</div>-->
							</ul>
						</div>
					</div><!-- ]] -->
				</div>
				<div class="spacer"></div>
			</div>
		</div>
	</div>
		</div>
	</div>
</header>