@extends('layouts.app')
@section('title')
Job bidding | Profile
@endsection
@section('content')
<div class="profiletop">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 full-vxs pull-right pull-xs-left text-right">
				<div class="projectprice">
					£ {{ isset($userDetails->rate_per_hour) ? $userDetails->rate_per_hour : '' }} <small>PER HOUR</small>
				</div>
				<ul class="rating list-inline">
					<li class="active"><i class="fa fa-star"></i></li>
					<li class="active"><i class="fa fa-star"></i></li>
					<li class="active"><i class="fa fa-star"></i></li>
					<li class="active"><i class="fa fa-star"></i></li>
					<li class="active"><i class="fa fa-star"></i></li>
				</ul>
			</div><!-- price and rating col ]] -->

			<div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 full-vxs">
				@if(!empty($user->profile_picture))
					<div class="profilePic" style="background-image:url('{{ asset('assets/frontend/profile_pictures/'.$user->profile_picture) }}');">
				@else
					<div class="profilePic" style="background-image:url('{{ asset('assets/frontend/images/icon-no-image.png') }}');">
				@endif
				<!--<div class="profilePic" style="background:url({{ asset('assets/frontend/images/profile-pic.jpg') }}) no-repeat;">-->
					<div class="shape"></div>
					
				</div><!-- profile ]] -->
				<div class=" pull-left profiledata">
					@php
					$usersName = isset($user->first_name) ? $user->first_name : '';
					$usersName .= isset($user->last_name) ? " ".$user->last_name : '';
					@endphp
               <div class="clearfix"> <h1 class="avatarname pull-left">{{ isset($user->first_name) ? $user->first_name : '' }} {{ isset($user->last_name) ? $user->last_name : '' }}</h1>
				<ul class="list-inline">
					<li>
						
						<p style="color:#f2f3f4;"><i class="fa fa-map-marker"></i> {{ isset($userDetails->location) ? $userDetails->location : '' }}</p>
					</li>
					<li>
						<p>
							<i class="fa fa-align-center"></i>
							Portfolio({{ count(getPortfolioByUserID($user->id)) }})
						</p>
					</li>
					<!---
					<li><p><img src="{{ asset('assets/frontend/images/verified.png') }}" class="img-responsive inline-block">
					@if($user->is_active == 'Y')
						Verified Member
					@else
						<span class='error-msg'>Not Verified</span>
					@endif
					</p></li> -->
				</ul>
               </div> 
				<div class="avfield"><strong>Fields:</strong> {{ isset($userDetails->fieldOfWorkType->type_title) ? $userDetails->fieldOfWorkType->type_title : '' }}</div>
                </div>
			</div><!-- name and info col ]] -->
		</div>
	</div><!-- container ]] -->
</div>

<div class="tabmenu">
	<div class="container clearfix">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs pull-left" role="tablist">
			<li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
			<li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Review</a></li>
		</ul>

		@if($user->id == Auth::user()->id)
		<a href="{{ url('/user/edit-profile') }}" class="btn btn-success newbtnfrelancr pull-right postjobbtn viewbtn" style="margin-left:10px;">EDIT PROFILE</a>
		<a href="javascript:void(0);" onclick="edit_portfolio('')" class="btn btn-success newbtnfrelancr pull-right postjobbtn"><i class="fa fa-plus"></i> ADD PORTFOLIO</a>
		@else
		@php
		$viewedUser = $user->id;
		$quoteForUser = str_random('3').$viewedUser.str_random('3');
		$encryptStr = config('constants.FIXED_ENCRYPT_STRING');
		$quoteForUser = encrypt($quoteForUser, $encryptStr);

		$task = "post a job for";
		$task .= ' '.$user->first_name;
		$task .= ' '.$user->last_name;
		$str = str_replace(' ', '+', $task);
		@endphp
		<a href="javascript:void(0);" data-toggle="modal" data-target="#getaquoteModal" class="btn btn-success newbtnfrelancr pull-right postjobbtn getQuoteBtn"><i class="fa fa-plus"></i> GET A QUOTE</a><!-- 
		<a href="{{ url('/jobs/post-jobs?task='.$str.'&for='.$quoteForUser) }}" onclick="" class="btn btn-success newbtnfrelancr pull-right postjobbtn"><i class="fa fa-plus"></i> GET A QUOTE</a> -->
		@endif
	</div><!-- container ]] -->
</div><!-- tab menu wrap ]] -->


<div class="container profilecontent">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="boxtitle">{{ !isset($viewAnotherProfile) ? 'My' : 'View' }} Profile</div>
			<div class="shadowbox">
				<div class="panel-body clearfix">
					@if(!empty($user->profile_picture))
						<div class="profilePic  medium" style="background-image:url('{{ asset('assets/frontend/profile_pictures/'.$user->profile_picture) }}');">
					@else
						<div class="profilePic  medium" style="background-image:url('{{ asset('assets/frontend/images/icon-no-image.png') }}');">
					@endif
					<!--<div class="profilePic" style="background:url({{ asset('assets/frontend/images/profile-pic.jpg') }}) no-repeat;">-->
					<div class="shape"></div>
					</div><!-- profile ]] -->
					<h3 class="avatarname">{{ $user->first_name.' '.$user->last_name }}</h3>
					<div class="clearfix">
						<p class="pull-left avaddress"><i class="fa fa-map-marker"></i> {{ isset($userDetails->location) ? $userDetails->location : '' }}</p>
						@if(!isset($viewAnotherProfile))
							<a href="{{ url('/user/edit-profile') }}" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i></a>
						@endif
					</div>
					<ul class="list-unstyled borderlist">
						<li>
							<div class="sordesc">
							<span>{{ isset($userDetails->about) ? $userDetails->about : '' }}</span>
							@if(isset($userDetails->about) && strlen($userDetails->about) > 100)
							<a class="readmore" href="javascript:void(0)">Read More</a>
							@endif
							</div>

							<a href="javascript:void(0);" class="btn btn-success viewbtn" data-toggle="modal" data-target="#profileIntroVideoModal"><i class="fa fa-video-camera"></i> WATCH {{ !isset($viewAnotherProfile) ? 'MY' : '' }} INTRO VIDEO</a>
						</li>
						<li>
							<p class="smtitle">Focus</p>
							<div class="sordesc ">
								{{ isset($userDetails->focusType->focus_type) ? $userDetails->focusType->focus_type : '' }}
							</div>
						</li>
						<!--<li>
							<p class="smtitle">Expertise</p>
							<div class="sordesc ">
								Motion Graphics and Animation
							</div>
						</li>-->
						<li>
							<p class="smtitle">Tools</p>
							<div class="tags">
								<div class="row"> 
									@if(count($mySkills) > 0)
										@foreach($mySkills as $eachSkill)
										<a href="javascript:void(0);" class="btn btn-default">{{ $eachSkill->skill_name }}</a>
										@endforeach
									@endif
								</div>
							</div>
						</li>
						<li>
							<div class="dl-inline">
							  <p><strong>Rate:</strong> {{ isset($userDetails->rate_per_hour) ? '£ '. $userDetails->rate_per_hour.' per hour' : '' }} </p>
							</div>

							<div class="dl-inline">
							  <p><strong>Job Type:</strong> {{ isset($userDetails->jobType->job_title) ? $userDetails->jobType->job_title : '' }}</p>
							</div>
						</li>
						<li>
							<ul class="list-inline sharelinks clearfix">
								<li><a href="javascript:void(0);" title="LinkedIn" onclick="openDiv('linkedin')"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="javascript:void(0);" title="Vimeo" onclick="openDiv('vimeo')"><i class="fa fa-vimeo"></i></a></li>
								<li><a href="javascript:void(0);" title="Twitter" onclick="openDiv('twitter')"><i class="fa fa-twitter"></i></a></li>
								<li><a href="javascript:void(0);" title="Behance" onclick="openDiv('behance')"><i class="fa fa-behance"></i></a></li>
								<li class="moreshare"><a href="javascript:void(0);" title="My Profile Link" onclick="openDiv('myProfile')"><img src="{{ asset('assets/frontend/images/share-more.png') }}" class="img-responsive"></a></li>
							</ul>
						</li>
						<li style="display:none">
							<div class="userinfoFld userinfoLinks linkedin">
								@if(isset($userDetails->linkedin_profile))
									<span class="fldTl">LinkedIn Link</span>
									<small>{{ $userDetails->linkedin_profile }}</small>
								@endif
							</div>
							<div class="userinfoFld userinfoLinks vimeo">
								@if(isset($userDetails->vimeo_profile))
									<span class="fldTl">Vimeo Link</span>
									<small>{{ $userDetails->vimeo_profile }}</small>
								@endif
							</div>
							<div class="userinfoFld userinfoLinks twitter">
								@if(isset($userDetails->twitter_profile))
									<span class="fldTl">Twitter Link</span>
									<small>{{ $userDetails->twitter_profile }}</small>
								@endif
							</div>
							<div class="userinfoFld userinfoLinks behance">
								@if(isset($userDetails->behance_profile))
									<span class="fldTl">Behance Link</span>
									<small>{{ $userDetails->behance_profile }}</small>
								@endif
							</div>
							<div class="userinfoFld userinfoLinks myProfile">
								@if(isset($userDetails->profile_link))
									<span class="fldTl">My Profile Link</span>
									<small>{{ $userDetails->profile_link }}</small>
								@endif
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div><!-- my portfolio col ]] -->

		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
			<!-- Tab panes -->
		  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="profile">
				@if(!isset($viewAnotherProfile))
				<!-- <div class="addportbtn clearfix" >
					<button id="oepnportfolio" class="pull-right">+</button>
					<p class="pull-right">Add Portfolio</p>
				</div>-->
				@endif
				
				@php
				if($user_id == Auth::user()->id){
					$form_action = "/user/my-profile";
				}else{
					$form_action = "/freelancers/freelancer-details/".strtolower(str_replace(" ", "-", $usersName))."/".$id;
				}
				@endphp
				<form action="{{ url($form_action) }}" method="get" accept-charset="utf-8" id="portfolio_search">
					<div class="boxtitle clearfix">Portfolio
						<select name="portfolio_type" class="jobfilter pull-right" onchange="$('#portfolio_search').submit();">
							<option value="">All</option>
							<option value="1" {{ $portfolio_type=='1' ? 'selected' : '' }}>Most Viewed</option>
							<option value="2" {{ $portfolio_type=='2' ? 'selected' : '' }}>Most Liked</option>
						</select>
					</div>
				</form>
				<div class="row">
					@if(count($userPortfolios) > 0)
						@foreach($userPortfolios as $eachportfolio)
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 full-vxs portfolioArea{{ $eachportfolio->portfolio_id }}">
								<div class="shadowbox">
									<div class="dropdown dropdwnnew">
									  	@if($eachportfolio->user_id == Auth::user()->id)
											<a id="dLabel" data-target="#" href="javascript:void(0);" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
											    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
											  </a>

											  <ul class="dropdown-menu" aria-labelledby="dLabel">
											    <li onclick="edit_portfolio('{{ $eachportfolio->portfolio_id }}')">
											    	<a href="javascript:void(0);">
											    		<i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit
											    	</a>
											    </li>
											    <li onclick="like_portfolio('{{ $eachportfolio->portfolio_id }}', 4)">
											    	<a href="javascript:void(0);">
											    		<i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete
											    	</a>
											    </li>
											  </ul>
										@endif
									</div>
									<figure>
										<img src="{{ $eachportfolio->file_path.'/'.$eachportfolio->file_name }}" class="img-responsive" onclick="like_portfolio('{{ $eachportfolio->portfolio_id }}', 2)">
									</figure>
									<div class="panel-body">
										<h3 class="projectname">
										<span style="cursor:pointer" onclick="like_portfolio('{{ $eachportfolio->portfolio_id }}', 2)">{{ $eachportfolio->portfolio_name }}</span>
										<!-- @if($eachportfolio->user_id == Auth::user()->id)
											<a href="javascript:void(0);" onclick="edit_portfolio('{{ $eachportfolio->portfolio_id }}')" class="btn btn-success editbtn pull-right" title="Edit this portfolio"><i class="fa fa-pencil"></i></a>
										@endif -->
										</h3>
										<div class="pdate">{{ date('d-m-Y', strtotime($eachportfolio->uploaded_date)) }}</div>
										<div class="sordesc">{!! ucfirst(strtolower($eachportfolio->short_desription)) !!}{{ (strlen($eachportfolio->description) > 30) ? '...' : '' }}</div>
									</div>
									<ul class="list-inline lvslist clearfix">
										@php
										$isLiked = getActionStatusByPortfolioID_UserID(Auth::user()->id, $eachportfolio->portfolio_id, 1);
										@endphp
										<li>
											<a style="text-decoration:none;" class="like_link{{ $eachportfolio->portfolio_id }}" href="javascript:void(0);" onclick="like_portfolio('{{ $eachportfolio->portfolio_id }}', 1)" title="{{ count($isLiked) ? 'liked' : 'like' }}">
												<i class="fa fa-thumbs-up like{{ $eachportfolio->portfolio_id }}" style="{{ count($isLiked) ? 'color:blue;' : '' }}"></i>
											</a>
											<span class="like_count{{ $eachportfolio->portfolio_id }}">{{ $eachportfolio->likes }} likes</span>
										</li>
										<li>
										<a href="javascript:void(0);" onclick="like_portfolio('{{ $eachportfolio->portfolio_id }}', 2)" title="views">
											<i class="fa fa-eye"></i></a>
											<span class="preview_count{{ $eachportfolio->portfolio_id }}">{{ $eachportfolio->number_of_views }}</span>
										</li>
										<li class="pull-right"><a href="javascript:void(0);" title="share"><i class="fa fa-share-alt"></i></a> &nbsp;{{ $eachportfolio->shares }}</li>
									</ul>
								</div>
							</div><!-- portfolio col  ]] -->
						@endforeach
					@else
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full-vxs" style="height:50px;">
							<div class="shadowbox">
								<div class="panel-body"> No portfolio available to show</div>
							</div>
						</div><!-- portfolio col  ]] -->
					@endif
					

					<div class="col-xs-12 text-right">
					{{ @$userPortfolios->appends(['portfolio_type' => $portfolio_type])->render() }}
					</div>

				</div>


			</div><!-- tabe one ]] -->


			<div role="tabpanel" class="tab-pane" id="review">
				<div class="boxtitle clearfix">Review
					<select class="jobfilter pull-right">
						<option>Most Recent</option>
						<option>Lorem ipsum</option>
					</select>
				</div>

				@if(count($reviewPostedJobsDetails) > 0)
					@foreach($reviewPostedJobsDetails as $eachJob)
						<div class="shadowbox forreview">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 full-vxs pull-right pull-xs-left text-right">
										@php
										$acceptedProposalDet = getProposalDetails('0', $eachJob->job_id, '', 'Y');
										//dd($acceptedProposalDet);
										$proposalId = count($acceptedProposalDet)>0 && isset($acceptedProposalDet[0]->proposal_id) ? $acceptedProposalDet[0]->proposal_id : '0';
										$proposalAmount = getProposalAmtByFreelancer($eachJob->job_id, $proposalId);
										$totalAmount = 0;
										if(count($proposalAmount) > 0)
										{
											foreach($proposalAmount as $eachMIlestoneAmount)
											{
												$totalAmount = $totalAmount + $eachMIlestoneAmount->amount;
											}
										}
										@endphp
										<p class="earned">
											BID Amount
											<span>£ {{$totalAmount}}</span>
										</p>
										<ul class="rating list-inline">
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
											<li class="active"><i class="fa fa-star"></i></li>
										</ul>
									</div>

									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 full-vxs">
										<h3 class="reviewtitle">{!! nl2br($eachJob->needs_to_design_job) !!}</h3>
										<div class="datepost">
											Posted: {{ date('dS M, Y', strtotime($eachJob->created_at)) }}
											&nbsp;&nbsp;&nbsp;
											<!-- 100% POSITIVE &nbsp;&nbsp;&nbsp;SOLD: 49 -->
										</div>
									</div>
								</div><!-- row ]] -->

								<ul class="list-unstyled reviewcomment">
									<li>
										<div class="profilePic small" style="background:url({{ asset('assets/frontend/images/profile-pic.jpg') }}) no-repeat;">
											<div class="shape"></div>
										</div><!-- avatar photo ]] -->
										<h5 class="pull-left">Jonathon Moss</h5>
										<div class="pull-left avaddress"> <i class="fa fa-map-marker"></i> Noewich, GB</div>
										<div class="avaddress pull-right"><strong>Posted:</strong> 22 APR 2016</div>
										<div class="clearfix"></div>
										<div class="sordesc ">
											Shoot MLM is a true professional team. I realy enjoyed working with them. Artwork and design skill were an excellent fit for our iOS project. I will definitely be using this team again in the future.
										</div>
									</li><!-- comment one ]] -->
									<li>
										<div class="profilePic small" style="background:url({{ asset('assets/frontend/images/profile-pic.jpg') }}) no-repeat;">
											<div class="shape"></div>
										</div><!-- avatar photo ]] -->
										<h5 class="pull-left">Jonathon Moss</h5>
										<div class="avaddress pull-right"><strong>Posted:</strong> 22 APR 2016</div>
										<div class="clearfix"></div>
										<div class="sordesc ">
											Shoot MLM is a true professional team. I realy enjoyed working with them. Artwork and design skill were an excellent fit for our iOS project. I will definitely be using this team again in the future.
										</div>
									</li><!-- comment two ]] -->
								</ul>
							</div>
						</div><!-- review main div ]] -->
					@endforeach
				@else
					<div class="shadowbox forreview">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<p class="earned"><span>No data available!</span></p>
								</div>
							</div><!-- row ]] -->
						</div>
					</div><!-- review main div ]] -->
				@endif

			</div><!-- tab two ]] -->
		  </div>
		</div><!-- right col for tab view box ]] -->
	</div>
</div>



<!-- Profile Intro Video Modal Start -->
<div class="modal fade profileIntroVideoModal" id="profileIntroVideoModal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close closeModal" data-dismiss="modal">&times;</button>
				<h2 class="modal-title">Profile Intro Video</h2>
			</div>
			<div class="modal-body profileIntroVideobody">
				@if(isset($userDetails->sample_video))
					<video width="400" id="introVideo" controls>
						<source src="{{ asset('assets/frontend/introvideos/'.$userDetails->sample_video) }}">
					</video>
				@else
					No video available.
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default closeModal" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Profile Intro Video Modal End -->

<!-- Add Portfolio Modal Start -->
<div class="modal fade addPortfolio" id="addPortfolio" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close style" data-dismiss="modal">&times;</button>
				<h2 class="modal-title task_titel">Add Portfolio</h2>
			</div>
			<div class="modal-body">
				<form action="{{ url('/user/portfolio-upload') }}" method="post" enctype="multipart/form-data" id="uploadForm">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-lg-12">
						<div class="colm">
							<div class="userinfoFld nameArea">
								<span class="fldTl">Name*</span>
								<input type="text" name="portfolio_name" class="fld portfolio_name" value=""/>
							</div>
						</div>
					
						<div class="colm">
							<div class="userinfoFld descArea">
								<span class="fldTl">Description*</span>
								<textarea name="description" class="fld description" style="height:120px;"></textarea>
							</div>
						</div>
						
						<div class="colm">
							<div class="userinfoFld linkArea">
								<span class="fldTl">Any Link <small>(Optional)</small></span>
								<input type="text" name="link" class="fld link" value=""/>
							</div>
						</div>
						
						<div class="colm imageSection">
							<div class="userinfoFld fileArea">
								<span class="fldTl">Portfolio File*</span>
								<label class="uploadBox">
									<input type="file" name="userImage" id="userImage" class="introduce_file demoInputBox" />
									<div class="txtF">
										<!--<i class="fa fa-microphone"></i>-->
										<i class="fa fa-video-camera"></i>
										<span class="introduce-file-text">Browse or Drop file here<!-- or <span>Record from here--></span>
									</div>
								</label>
							</div>
						</div>
						
						<div class="colm progressBarArea" style="display:none;">
							<div id="progress-div"><div id="progress-bar"></div></div>
							<div id="targetLayer"></div>
						</div>
						
						
					</div>
					
				</div>
				<div class="form-group"></div>
				<div class="colm">
					<div class="userinfoFld clearfix">
						<input type="submit" name="submit" class="btn btn-success right btnSubmit1 btn-lg" id="btnSubmit" value="Upload" />
						<input type="hidden" name="field_id" id="field_id" class="field_id" />
						<input type="hidden" name="file_name" id="file_name" class="file_name" />
					</div>
				</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
<!-- Add Portfolio Modal End -->


<div class="modal fade paymentmethodmodal getquotemodal" id="getaquoteModal" role="dialog">
	<div class="modal-dialog modal-mds">
		<form action="{{ url('/user/get-a-quote') }}" method="post" id="getAQuote" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="quoteForUserId" id="quoteForUserId" value="{{ $user->id }}">
			<div class="modal-content">
				<div class="modal-header newMheader">
					<button type="button" class="close style" data-dismiss="modal">&times;</button>
					<h2 class="mr0 task_titel">Get a quote</h2>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>What is the message to get about?</label>
						<select class="form-control minimal" name="message_to_get_about" required>
							<option value=""> -Select- </option>
							<option value="1">A new job</option>
						</select>
					</div>

					<div class="form-group">
						<label>What do you need to get done?</label>
						<!-- <input class="form-control" placeholder="e.g. I need a website design..."> -->
						<input placeholder="Motion Graphic Design Job" class="form-control" name="needs_to_design_job" type="text" value="{{ old('needs_to_design_job') }}" id="needs_to_design_job" required>
					</div>
					<div class="form-group">
						<label>Job Description</label>
						<!-- <textarea rows="13" class="form-control" placeholder="Description what you need in more details"></textarea> -->
						<textarea class="form-control job_description" name="job_description" rows="7" placeholder="Type here job description" id="job_description" required>{{ old('job_description') }}</textarea>
					</div>
					<label class="labelMfoter">
						<input type="checkbox" name="agree_terms_conditions" class="hidden" value="1" {{ old('agree_terms_conditions')==1 ? 'checked' : '' }} required>
						<i class="checknew"></i>
						<p>By clicking Deposit Funds, You agree with our</p>
					</label>
					<input type="submit" class="btn btn-success pull-right" value="SEND" name="depositeFunds">
					<div class="clearfix"></div>
				</div>
			</div>
		</form>
	</div>
</div>



<!-- Add Portfolio View Modal -->
<div class="modal fade viewPortfolio" id="viewPortfolio" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modal-title">View Portfolio</h2>
			</div>
			<div class="modal-body viewPortfolio-body" style="min-height:285px !important;">
				<div class="preview-image-div">
					<div class="row">
						<div class="col-lg-12">
							<img src="" class="viewPortfolio_img" />
						</div>
					</div>
				</div>
				<div class="preview-content-div">
					<div class="row">
						<div class="col-lg-12">
							<span class="fldTl">
								<strong>Name:</strong> 
								<span class="nameAreaPrev"></span>
							</span><br><br>
							<span class="fldTl">
								<strong>Description:</strong> 
								<span class="descAreaPrev"></span>
							</span><br><br>
							<span class="fldTl">
								<strong>Link:</strong> 
								<span class="linkAreaPrev"></span>
							</span>
						</div>
						<div class="col-lg-12 modal_action_area">
							<ul class="list-inline lvslist clearfix">
								<li>
									<a style="text-decoration:none;" href="javascript:void(0);" title="like" class="modal_likes">
										<i class="fa fa-thumbs-up" style=""></i>
									</a>
									<span class="totalLike"> &nbsp;0</span>
								</li>
								<li>
									<a style="text-decoration:none;" href="javascript:void(0);" title="views">
										<i class="fa fa-eye"></i>
									</a>
									<span class="totalPreview"> &nbsp;0</span>
								</li>
								<li class="pull-right"><a href="javascript:void(0);" title="share">
								<i class="fa fa-share-alt"></i></a> &nbsp;0</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="border-top:none !important;">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Add Portfolio View Modal End -->

@endsection
@section('customScript')




<script src="{!! asset('assets/frontend/js/jquery.form.min.js') !!}" type="text/javascript"></script>
<script>
jQuery( document ).ready(function($){
	@if(isset($getQuote))
	$(".getQuoteBtn").trigger('click');
	var url = window.location.href.split('?');
    //alert(url[0]);
	window.history.pushState("", "", url[0]);
	@endif

	$('.closeModal').click(function(){
		@if(isset($userDetails->sample_video))
			document.getElementById('introVideo').pause();
		@endif
    });
	
	$('#uploadForm').submit(function(e){
		$(".errorMsgArea").remove();
		$('.progressBarArea').css("display", "none");
		var errStatus = 0;
		if($(".portfolio_name").val() == ""){
			$(".nameArea").append("<span class='errorMsgArea'>Please enter portfolio name.</span>");
			errStatus = 1;
		}
		if($(".description").val() == ""){
			$(".descArea").append("<span class='errorMsgArea'>Please write some description.</span>");
			errStatus = 1;
		}
		if($("#userImage").val() == "" && $(".field_id").val() == ''){
			$(".fileArea").append("<span class='errorMsgArea'>Please browse any file.</span>");
			errStatus = 1;
		}
		if(errStatus!=0){
			return false;
		}else{
			$('.progressBarArea').css("display", "block");
			e.preventDefault();
			$('.btnSubmit').prop('disabled', true);
			$(this).ajaxSubmit({
				target:'#targetLayer',
				beforeSubmit: function(){
					$("#progress-bar").width('0%');
				},
				uploadProgress: function (event, position, total, percentComplete){
					$("#progress-bar").width(percentComplete + '%');
					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
				},
				success:function(){
					$('#loader-icon').hide();
					//$('.btnSubmit').prop('disabled', false);
					//$(".introduce-file-text").html('Browse or Drop file here');
					location.reload();
				},
				resetForm: true
			});
			return false;
		}
	});
});

function edit_portfolio(p_id){
	$(".errorMsgArea").remove();
	$('#uploadForm')[0].reset();
	$(".prevImage").remove();
	$(".field_id").val('');
	$(".file_name").val('');
	if(p_id !='' && p_id !=undefined){
		var token = $("input[name=_token]").val();
		//alert(p_id);
		$.ajax({
			type:'post',
			url:"{{ url('/user/get-portfolio') }}",
			data:{
				isAjax:true,
				p_id:p_id,
				_token:token
			},
			success:function(response){
				//var res = $.parseJSON(response);
				//alert(response.portfolios_data.portfolio_name);
				if(response.return_status == 1){
					$(".prevImage").remove();
					$(".portfolio_name").val(response.portfolios_data.portfolio_name);
					$(".description").val(response.portfolios_data.description.replace(/(<|&lt;)br\s*\/*(>|&gt;)/g,""));
					$(".link").val(response.portfolios_data.portfolio_link);
					$(".field_id").val(response.portfolios_data.portfolio_id);
					$(".file_name").val(response.portfolios_data.file_name);
					$(".imageSection").append("<img class='prevImage' src='"+response.portfolios_data.file_path + '/' + response.portfolios_data.file_name+"' />");
					
					$(".addPortfolio").modal('show');
				}else{
					alert("No record found!");
				}
			}, error: function(){
				alert("Oops! Something went wrong, try again later.");
			}
		});
	}else{
		$(".addPortfolio").modal('show');
	}
}

function like_portfolio(p_id, type_id){
	if(p_id!="" && p_id!=undefined && type_id!="" && type_id!=undefined){
		if(type_id == 4){
			var r = confirm("Are you sure to delete?");
			if(!r){
				return false;
			}
		}
		var token = $("input[name=_token]").val();
		process.on();
		$.ajax({
			type:'post',
			url:base_url+'user/portfolio-action',
			data:{
				isAjax:true,
				p_id:p_id,
				type_id:type_id,
				_token:token
			},
			success:function(response){
				//var res = $.parseJSON(response);
				switch(type_id){
					case 1:
						//Like code
						if(response.like_status==1)
						{
							$(".like"+p_id).css('color', 'blue');
							$(".like_link"+p_id).attr('title', 'liked');
							$(".like_count"+p_id).html(response.likes_count+' likes');
						}
					break;
					
					case 2:
						//Preview code
						$(".preview_count"+p_id).html(response.previews_count);
						$(".viewPortfolio_img").attr("src", response.fetch_data.file_path+'/'+response.fetch_data.file_name);
						$(".nameAreaPrev").html(response.fetch_data.portfolio_name);
						$(".descAreaPrev").html(response.fetch_data.description.replace(/(<|&lt;)br\s*\/*(>|&gt;)/g,""));
						$(".linkAreaPrev").html(response.fetch_data.portfolio_link);
						$(".totalLike").html($(".like_count"+p_id).html());
						$(".totalPreview").html($(".preview_count"+p_id).html());
						$(".viewPortfolio").modal("show");
					break;
					
					case 4:
						$(".portfolioArea"+p_id).remove();
						alert("Deleted Successfully!");
					break;
					
					default:
					//alert("Something went wrong. Please try again!");
				}
				process.off();
			}, error: function(){
				alert("Oops! Something went wrong, try again later.");
				process.off();
			}
		});
		/*switch(type_id){
			case 1:
			break;
			
			case 2:
			break;
			
			default:alert("Something went wrong. Please try again!");
		}*/
	}
}
</script>
@endsection