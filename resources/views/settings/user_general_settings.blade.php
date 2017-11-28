@extends('layouts.app')
@section('title')
Job bidding | Settings
@endsection


@section('content')

@php
$weekdays = config("constants.WEEKDAYS");
@endphp
<div class="mainSite innerpage">


<section class="container">
	<div class="task_title_wrap clearfix">
		<div class="task_titel pull-left">			
			User Settings
		</div>
		<div class="line_gp"></div>		
    </div>

    <div class="row col-lg-12">
    	@if(session()->has('message'))
		    <div class="alert alert-success">
		        {{ session()->get('message') }}
		    </div>
		@endif
    </div>

    <div class="infobox clearfix settingtab white-bg">
    	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    		<div class="panel-body">
    			<!-- Nav tabs -->
			    <ul class="nav nav-tabs" role="tablist">
			      <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab" aria-expanded="true"><span><i class="fa fa-cog"></i></span>General</a></li>
			      <li role="presentation" class=""><a href="#notification" aria-controls="notification" role="tab" data-toggle="tab" aria-expanded="false"><span><i class="fa fa-bell"></i></span>Notification</a></li>
			      <li role="presentation" class=""><a href="#privacy" aria-controls="privacy" role="tab" data-toggle="tab" aria-expanded="false"><span><i class="fa fa-lock"></i></span>Privacy</a></li>
			      <li role="presentation" class=""><a href="#NDSA" aria-controls="NDSA" role="tab" data-toggle="tab" aria-expanded="false"><span><i class="fa fa-file-text-o"></i></span>NDAs</a></li>
			      <li role="presentation" class=""><a href="#payments" aria-controls="payments" role="tab" data-toggle="tab" aria-expanded="false"><span><i class="fa fa-gbp"></i></span>Payments</a></li>
			    </ul>
    		</div>
    	</div><!-- col ]] -->
    	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    		<div class="tab-content message_section">
			    <div role="tabpanel" class="tab-pane active" id="general">
			    	<div class="panel-body">
	    				<h2 class="catetitle">General Settings</h2>
	    				<ul class="list-unstyled contlist">
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Availability</label>
	    						</div>

	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<div class="form-inline pull-left">
	    								<div class="form-group">
	    									<select class="form-control minimal">
	    										<option selected="">Everyday</option>
	    										<option value="1"> Sunday </option>
												<option value="2"> Monday </option>
												<option value="3"> Tuesday </option>
												<option value="4"> Wednesday </option>
												<option value="5"> Thursday </option>
												<option value="6"> Friday </option>
												<option value="7"> Saturday </option>
	    									</select>
	    								</div>
	    								<div class="form-group paddlr10">
	    									<label>From</label>
	    									<select class="form-control minimal">
	    										<option>09:00 am</option>	    										
	    									</select>
	    								</div>
	    								<div class="form-group">
	    									<label>To</label>
	    									<select class="form-control minimal">
	    										<option>05:00 pm</option>	    										
	    									</select>
	    								</div>
	    							</div>

	    							<button type="submit" onclick="save_availability()" class="btn btn-success editbtn pull-right availability_editbtn"><i class="fa fa-pencil"></i>Save</button>
	    						</div>
	    						<!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 clearfix">
	    							<p class="para pull-left">
		    							<select name="working_days_from" class="form-control working_days_from">
		    								<option value=""> -Select- </option>
		    								@foreach($weekdays as $eachdaysKey => $eachdaysVal)
		    								<option value="{{ $eachdaysKey }}" {{ $availableFrom == $eachdaysKey ? 'selected' : '' }}> {{ $eachdaysVal }} </option>
		    								@endforeach
		    							</select>
	    							</p>
	    						</div>
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 clearfix">
	    							<p class="para pull-left">
		    							<select name="working_days_to" class="form-control working_days_to">
		    								<option value=""> -Select- </option>
		    								@foreach($weekdays as $eachdaysKey => $eachdaysVal)
		    								<option value="{{ $eachdaysKey }}" {{ $availableTo == $eachdaysKey ? 'selected' : '' }}> {{ $eachdaysVal }} </option>
		    								@endforeach
		    							</select>
	    							</p>
	    						</div>
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 clearfix">
	    							<button type="submit" onclick="save_availability()" class="btn btn-success editbtn pull-right availability_editbtn"><i class="fa fa-pencil"></i>Save</button>
	    						</div> -->
	    					</li>
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Password</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">******</p>
	    							<a href="javascript:void(0)" class="btn btn-success editbtn pull-right" onclick="openmodal('changePassModal')"><i class="fa fa-pencil"></i>EDIT</a>
	    						</div>
	    					</li>
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Security</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">{{ isset(Auth::user()->SecurityQuestion->question) ? Auth::user()->SecurityQuestion->question : '' }}</p>
	    							<a href="javascript:void(0)" onclick="openmodal('securityQuestionModal')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>EDIT</a>
	    						</div>
	    					</li>
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Account</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">Active</p>
	    							<a href="javascript:void(0)" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>Inactive</a>
	    						</div>
	    					</li>
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Bid Credit</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">{{ $creditBids-$debitBids }}</p>
	    							<a href="javascript:void(0)" data-toggle="modal" data-target="#buycreditModal" class="btn btn-success editbtn pull-right buyCreditBtn">BUY MORE</a>
	    						</div>
	    					</li>
	    				</ul>
    				</div>
			    </div>

			    <div role="tabpanel" class="tab-pane" id="notification">
			    	<div class="panel-body">
	    				<h2 class="catetitle">Notifications Settings</h2>
    					<ul class="list-unstyled contlist">
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Job Notifications</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left notificationDetailsArea">
	    								@php
	    								$userNotificationUpdate = getNotificationsUpdateByUsers($authUser);
										$notificationValues = array('None');
										if(count($userNotificationUpdate) > 0){
											$notificationValues = array();
											foreach($userNotificationUpdate as $row){
												$notificationValues[] = $row->details;
											}
										}
										$notificationValues = implode(', ', $notificationValues);
	    								@endphp
	    								{{$notificationValues}}
	    							</p>
	    							<a href="javascript:void(0)" onclick="openmodal('notificationSettingModal')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>EDIT</a>
	    						</div>
	    					</li>
							<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Alerts</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<div class="para pull-left">Play a sound when a new notification is received</div>
	    							<br />
	    							<div class="para pull-left" style="width:50% !important;">
	    								<select name="notificationSoundAlert" class="form-control notificationSoundAlert">
	    									<option value="Y" {{ Auth::user()->notificationSoundAlert == 'Y' ? 'selected' : '' }}>Yes</option>
	    									<option value="N" {{ Auth::user()->notificationSoundAlert == 'N' ? 'selected' : '' }}>No</option>
	    								</select>
	    							</div>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxUser('notificationSoundAlert','{{ url('/settings/edit-profile') }}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>Save</a>
	    						</div>
	    					</li>
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Updates</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left needUpdateDetailsArea">
	    							@php
    								$usersNeedUpdate = getUpdateNeedsByUsers($authUser);
									$needforUpdatesValues = array('None');
									if(count($usersNeedUpdate) > 0){
										$needforUpdatesValues = array();
										foreach($usersNeedUpdate as $row){
											$needforUpdatesValues[] = $row->details;
										}
									}
									$needforUpdatesValues = implode(', ', $needforUpdatesValues);
    								@endphp
    								{{$needforUpdatesValues}}</p>
	    							<a href="javascript:void(0)" onclick="openmodal('needUpdateSettingModal')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li>
	    					<!--<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Emails</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">Get notified about interesting stuff is worth knowing about/p&gt;
	    							<a href="javascript:void(0)" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</p></div>
	    					</li>
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Account</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">When my bidding creadit reach to 5</p>
	    							<a href="javascript:void(0)" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li>-->
    					</ul>
    				</div>
			    </div>



			    <div role="tabpanel" class="tab-pane" id="privacy">
			    	<div class="panel-body">
	    				<h2 class="catetitle">Privacy Settings</h2>
    					<ul class="list-unstyled contlist">
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Visibility</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							
	    							<p class="para pull-left">Show profile in search engine</p>
	    							<br />
	    							<div class="para" style="width:50% !important;">
	    								<select name="profile_availability" class="form-control profile_availability">
	    									<option value="1" {{ Auth::user()->profile_availability == '1' ? 'selected' : '' }}>Yes</option>
	    									<option value="0" {{ Auth::user()->profile_availability == '0' ? 'selected' : '' }}>No</option>
	    								</select>
	    							</div>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxUser('profile_availability','{{ url('/settings/edit-profile') }}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>Save</a>
	    						</div>
	    					</li><!-- one list -->
							<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Earnings</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">Show my earning in my profile</p>
	    							<br />
	    							<div class="para" style="width:50% !important;">
	    								<select name="showEarningsInProfile" class="form-control showEarningsInProfile">
	    									<option value="Y" {{ Auth::user()->showEarningsInProfile == 'Y' ? 'selected' : '' }}>Yes</option>
	    									<option value="N" {{ Auth::user()->showEarningsInProfile == 'N' ? 'selected' : '' }}>No</option>
	    								</select>
	    							</div>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxUser('showEarningsInProfile','{{ url('/settings/edit-profile') }}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>Save</a>
	    						</div>
	    					</li><!-- one list -->
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Feedback</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">Show client feedback on my profile</p>
	    							<br />
	    							<div class="para" style="width:50% !important;">
	    								<select name="showClientFeedbackInProfile" class="form-control showClientFeedbackInProfile">
	    									<option value="Y" {{ Auth::user()->showClientFeedbackInProfile == 'Y' ? 'selected' : '' }}>Yes</option>
	    									<option value="N" {{ Auth::user()->showClientFeedbackInProfile == 'N' ? 'selected' : '' }}>No</option>
	    								</select>
	    							</div>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxUser('showClientFeedbackInProfile','{{ url('/settings/edit-profile') }}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>Save</a>
	    						</div>
	    					</li><!-- one list -->
    					</ul>
    				</div>
			    </div><!-- end tab one ]] -->


			    <div role="tabpanel" class="tab-pane" id="NDSA">
			    	<div class="panel-body">
	    				<h2 class="catetitle">Non Disclousure Agreement Settings</h2>
    					<ul class="list-unstyled contlist">
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Name</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left"><input type="text" class="form-control ndaName" value="{{ isset($UserNdaSetting->ndaName) ? $UserNdaSetting->ndaName : '' }}"></p>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxNda('ndaName', '{{url("/settings/change-nda-settings")}}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li><!-- one list -->
							<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Company No</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left"><input type="text" class="form-control ndaCompanyNo" value="{{ isset($UserNdaSetting->ndaCompanyNo) ? $UserNdaSetting->ndaCompanyNo : '' }}"></p>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxNda('ndaCompanyNo', '{{url("/settings/change-nda-settings")}}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li><!-- one list -->
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>VAT reg</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left"><input type="text" class="form-control ndaVatReg" value="{{ isset($UserNdaSetting->ndaVatReg) ? $UserNdaSetting->ndaVatReg : '' }}"></p>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxNda('ndaVatReg', '{{url("/settings/change-nda-settings")}}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li><!-- one list -->
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Address</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left"><textarea class="form-control ndaAddress">{{ isset($UserNdaSetting->ndaAddress) ? $UserNdaSetting->ndaAddress : '' }}</textarea></p>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxNda('ndaAddress', '{{url("/settings/change-nda-settings")}}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li><!-- one list -->
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Signature</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">
	    								@if(isset($authUserSignature))
	    									<img src="{{ asset('/assets/upload/profile_signature/'.$authUserSignature) }}" style="width:300px; height:40px;" />
	    								@endif
	    							</p>
	    							<a href="javascript:void(0)" onclick="openmodal('uploadSignatureModal')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li><!-- one list -->
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Security</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<div class="para pull-left" style="width:50% !important;">
	    								<select name="ndaSecurity" class="form-control ndaSecurity">
	    									<option value="Y" {{ isset($UserNdaSetting->ndaSecurity) && $UserNdaSetting->ndaSecurity == 'Y' ? 'selected' : '' }}>Yes</option>
	    									<option value="N" {{ isset($UserNdaSetting->ndaSecurity) && $UserNdaSetting->ndaSecurity == 'N' ? 'selected' : '' }}>No</option>
	    								</select>
	    							</div>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxNda('ndaSecurity', '{{url("/settings/change-nda-settings")}}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li><!-- one list -->
    					</ul>
    				</div>
			    </div><!-- end tab one ]] -->



			    <div role="tabpanel" class="tab-pane" id="payments">
			    	<div class="panel-body">
	    				<h2 class="catetitle">Payment Settings</h2>
    					<ul class="list-unstyled contlist">
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Withdrawal AC</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">1 Bank account - 1 PayPal account</p>
	    							<a href="javascript:void(0)" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li>
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Address</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">
	    								<textarea name="user_address" class="form-control user_address" id="user_address">{{ isset(Auth::user()->userdet->user_address) ? Auth::user()->userdet->user_address : '' }}</textarea>
	    							</p>
	    							<a href="javascript:void(0)" onclick="saveOnAjax('user_address', '{{url('/user/edit-profile')}}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li>
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>VAT reg</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left"><input type="text" name="paymentVatRegNo" class="form-control paymentVatRegNo" value="{{ Auth::user()->paymentVatRegNo }}" /></p>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxUser('paymentVatRegNo', '{{url("/settings/edit-profile")}}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li>
							<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Identification</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<div class="para pull-left" style="width:50% !important;">
	    								<select name="paymentIdentificationSettings" class="form-control paymentIdentificationSettings">
	    									<option value="Aadhaar Card" {{ isset(Auth::user()->paymentIdentificationSettings) && Auth::user()->paymentIdentificationSettings == 'Aadhaar Card' ? 'selected' : '' }}>Aadhaar Card</option>
	    									<option value="Passport" {{ isset(Auth::user()->paymentIdentificationSettings) && Auth::user()->paymentIdentificationSettings == 'Passport' ? 'selected' : '' }}>Passport</option>
	    									<option value="Voter ID" {{ isset(Auth::user()->paymentIdentificationSettings) && Auth::user()->paymentIdentificationSettings == 'Voter ID' ? 'selected' : '' }}>Voter ID</option>
	    								</select>
	    							</div>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxUser('paymentIdentificationSettings', '{{url("/settings/edit-profile")}}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li>
	    					<!--<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Currency</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<p class="para pull-left">£ - GBP</p>
	    							<a href="javascript:void(0)" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li>-->
	    					<li class="clearfix">
	    						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    							<label>Security</label>
	    						</div>
	    						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearfix">
	    							<div class="para pull-left" style="width:50% !important;">
		    							<select name="paymentSecuritySettings" class="form-control paymentSecuritySettings">
	    									<option value="Y" {{ isset(Auth::user()->paymentSecuritySettings) && Auth::user()->paymentSecuritySettings == 'Y' ? 'selected' : '' }}>Yes</option>
	    									<option value="N" {{ isset(Auth::user()->paymentSecuritySettings) && Auth::user()->paymentSecuritySettings == 'N' ? 'selected' : '' }}>No</option>
	    								</select>
    								</div>
	    							<a href="javascript:void(0)" onclick="saveOnAjaxUser('paymentSecuritySettings', '{{url("/settings/edit-profile")}}')" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i>UPDATE</a>
	    						</div>
	    					</li>
    					</ul>
    				</div>
			    </div><!-- end tab one ]] -->
			</div>
    	</div><!--  col ]] -->
    </div>
</section>
</div>



<div class="modal fade buycreditmodal getquotemodal " id="buycreditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header newMheader">
        <button type="button" class="close style" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="mr0 task_titel" id="myModalLabel">Buy bid credits</h4>
      </div>
      <form action="{{ url('/settings/buy-bid-credit') }}" method="post">
      	{{ csrf_field() }}
	      <div class="modal-body">
	        <ul class="list-unstyled contlist">
	        	<li><p class="para"><strong>Add more bid credit to your acount, apply for more jobs and increase your winning chance?</strong></li>

	        	<li>
	        		<h4 class="newtitl">Available credits: <span class="text-success">{{ $creditBids-$debitBids }} credits remaining</span></h4>
	        	</li>
	        	<li>
	        		<h4 class="newtitl">Add extra credits:</h4>
	        		@if(count($JobBidCreditList) > 0)
	        		<div class="radio">
	        			@foreach($JobBidCreditList as $eachCreditList)
	        			<label class="radionew btn-block">
	        				<input type="radio" name="creditextra" class="hidden" value="{{ $eachCreditList->id }}" required checked>
	        				<i class="checks"></i>
	        				{!! $eachCreditList->description !!}
	        			</label>
	        			@endforeach
	        		</div>
	        		@endif
	        	</li>
	        </ul>

	        <div class="clearfix btnMbottom">
		        <label class="pull-left labelMfoter inline">
		        	<input type="checkbox" class="hidden" name="terms_condition" value="1" required checked>
		        	<i class="checknew"></i>
		        	<p>By clicking Buy Now, You agree with our</p>
		        </label>&nbsp;
		        <a href="javascript:void(0);" class="linkltxt pull-left">terms &amp; conditions, Fees</a>
	            <input type="submit" class="btn btn-success pull-right" value="BUY NOW" name="depositeFunds">
		    </div>
	      </div>
      </form>
    </div>
  </div>
</div>

@include('settings.modal_change_password')
@include('settings.modal_set_security_questions')
@include('settings.modal_notification_settings')
@include('settings.modal_need_update_settings')
@include('settings.modal_upload_signatire')
@endsection


@section('customScript')
<script>
$(document).ready(function(){
    $("#opentask").click(function(){
        $(".taskcontent").toggleClass("open");
    });

    @if(isset($immediateTask) && $immediateTask=='bid-purchase')
	$(".buyCreditBtn").trigger('click');
	var url = window.location.href.split('?');
    //alert(url[0]);
	window.history.pushState("", "", url[0]);
	@endif
});

function updateProfileSetting(user_id, field_name, field_class){
	field_value = $("."+field_class).value();
	$.ajax({
		type:'post',
		url:"{{ url('settings/update-users-settings') }}",
		data:{
			isAjax:true,
			user_id:user_id,
			field_name:field_name,
			field_value:field_value
		},
		success:function(response){
			//var res = $.parseJSON(response);
		}, error: function(){
			alert("Oops! Something went wrong, try again later.");
		}
	});
}

function saveOnAjaxNda(field_class, request_url){
	var fieldValue = $("."+field_class).val();
	//var token = $("input[name=_token]").val();
	process.on();
	$.ajax({
		type:'post',
		url:request_url,
		data:{
			isAjax:true,
			field_name:field_class,
			field_data:fieldValue
		},
		success:function(response){
			//var res = $.parseJSON(response);
			alert(response.msg);
			process.off();
		}, error: function(){
			//alert("Oops! Something went wrong, try again later.");
			process.off();
		}
	});
}
</script>

@include('settings.user_settings_js');
@endsection