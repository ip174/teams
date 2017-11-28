<div class="modal fade" id="jobviewModal" role="dialog" style="display: none;">
	<div class="container modalcontainer">
	<!-- Modal content-->
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<div class="panel-body">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="shadowbox">
						<div class="panel-body clearfix">
							<div class="profilePic medium" style="background:url({{ asset('assets/frontend/profile_pictures'.'/'.isset($proposalDetails->user->profile_picture) ? $proposalDetails->user->profile_picture : '') }}) no-repeat;">
								<div class="shape"></div>
							</div><!-- profile ]] -->
							<h3 class="avatarname">{{ isset($proposalDetails->user->first_name) ? $proposalDetails->user->first_name : '' }} {{ isset($proposalDetails->user->last_name) ? $proposalDetails->user->last_name : '' }}</h3>
							<div class="clearfix">
								<p class="pull-left avaddress"><i class="fa fa-map-marker"></i> {{ isset($proposalDetails->userDet->location) ? $proposalDetails->userDet->location : '' }}</p>
								<!--<a href="#" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i></a>-->
							</div>
							<ul class="list-unstyled borderlist">
								<li>
									<div class="sordesc">
										{{ isset($proposalDetails->userDet->about) ? $proposalDetails->userDet->about : '' }}
										<a class="readmore" href="#">Read More</a>
									</div>
									<!--<a href="#" class="btn btn-success viewbtn"><i class="fa fa-video-camera"></i> WATCH MY INTRO VIDEO</a>-->
									<a href="javascript:void(0);" class="btn btn-success viewbtn" data-toggle="modal" data-target="#profileIntroVideoModal" onclick="$('#jobviewModal').modal('hide')">
										<i class="fa fa-video-camera"></i> WATCH MY INTRO VIDEO
									</a>
								</li>
								<li>
									<p class="smtitle">Focus</p>
									<div class="sordesc ">
										<!--Industrial Design, Product Design, Enterpreneurship-->
										{{ isset($proposalDetails->userDet->focusType->focus_type) ? $proposalDetails->userDet->focusType->focus_type : '' }}
									</div>
								</li>
								<li>
									<p class="smtitle">Expertise</p>
									<div class="sordesc ">
										<!--Motion Graphics and Animation-->
										{{ isset($proposalDetails->userDet->fieldOfWorkType->type_title) ? $proposalDetails->userDet->fieldOfWorkType->type_title : '' }}
									</div>
								</li>
								<li>
									<p class="smtitle">Tools</p>
									<div class="tags">
										<div class="row"> 
											@php
											$mySkills = getSkillsByUserID(isset($proposalDetails->sent_by_user) ? $proposalDetails->sent_by_user : '0');
											@endphp
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
										<p><strong>Rate:</strong> £ {{ isset($proposalDetails->userDet->rate_per_hour) ? $proposalDetails->userDet->rate_per_hour : '' }} per hour</p>
									</div>
									<div class="dl-inline">
										<p><strong>Job Type:</strong> {{ isset($proposalDetails->userDet->jobType->job_title) ? $proposalDetails->userDet->jobType->job_title : '' }}</p>
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
								<li>
									<div class="userinfoFld userinfoLinks linkedin">
										@if(isset($proposalDetails->userDet->linkedin_profile))
											<span class="fldTl">LinkedIn Link</span>
											<small>{{ $proposalDetails->userDet->linkedin_profile }}</small>
										@endif
									</div>
									<div class="userinfoFld userinfoLinks vimeo">
										@if(isset($proposalDetails->userDet->vimeo_profile))
											<span class="fldTl">Vimeo Link</span>
											<small>{{ $proposalDetails->userDet->vimeo_profile }}</small>
										@endif
									</div>
									<div class="userinfoFld userinfoLinks twitter">
										@if(isset($proposalDetails->userDet->twitter_profile))
											<span class="fldTl">Twitter Link</span>
											<small>{{ $proposalDetails->userDet->twitter_profile }}</small>
										@endif
									</div>
									<div class="userinfoFld userinfoLinks behance">
										@if(isset($proposalDetails->userDet->behance_profile))
											<span class="fldTl">Behance Link</span>
											<small>{{ $proposalDetails->userDet->behance_profile }}</small>
										@endif
									</div>
									<div class="userinfoFld userinfoLinks myProfile">
										@if(isset($proposalDetails->userDet->profile_link))
											<span class="fldTl">My Profile Link</span>
											<small>{{ $proposalDetails->userDet->profile_link }}</small>
										@endif
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div><!-- left col -->
				<div class="col-lg-9 col-md-9 col-sm-9 colxs-12">
					<p class="smtitle">Proposal</p>
					<div class="detailsbox">
					<label>Description</label><br />
					{!! nl2br(isset($proposalDetails->description) ? $proposalDetails->description : '') !!}
					</div>
					<p class="smtitle">Interview Question: What challenges do you see doing this job?</p>
					<div class="detailsbox">
						{!! nl2br(isset($proposalDetails->interview_question_challanges) ? $proposalDetails->interview_question_challanges : '') !!}
					</div>
					<div class="form-group clearfix newattachment">
						<label class="pull-left">Attachments:</label>
						<ul class="list-inline attachmenticon pull-left">
							<a href="{{ asset('asset/upload/job_proposal_files'.'/'.$proposalDetails->attached_file) }}"><li style="margin-top: 13px;">Download attached file</li></a>
						</ul>
					</div>
					<ul class="greyinfo clearfix">
						<li class="pull-left"><span class="depoinfo">Deposit: <span class="bigger"> 
							@php
							$estimatedAmount = getProposalAmtByFreelancer($proposalDetails->job_id, $proposalDetails->proposal_id);
							$totalEstimatedAmount=0;
							if(count($estimatedAmount) > 0){
								foreach($estimatedAmount as $eachAmount){
									$totalEstimatedAmount += $eachAmount->amount;
								}
							}
							@endphp
							£ {{ $totalEstimatedAmount }}
						</span></span></li>
						
						@if(count($getAcceptedProposal) == 0)
						<li class="pull-right leftborder">
							<a type="button" onclick="acceptProposal('{{ $proposalDetails->proposal_id }}', '{{ $proposalDetails->job_id }}', 'Y')" class="btn btn-lg btn-success viewbtn acceptbtn jobviesbtn">ACCEPT <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
						</li>
						@endif

						<li class="pull-right">
							<a type="button" class="btn btn-lg btn-success viewbtn acceptbtn jobviesbtn padd0" onclick="shortlistProposal('{{ $proposalDetails->proposal_id }}', '{{ $proposalDetails->job_id }}')"><span class="mr0">SHORTLIST<!-- PROPOSAL--></span></a>
						</li>
					</ul>
					<div class="border_line"></div>
					<form action="{{ url('/chat/send-chat-messages') }}" method="post" id="reply_form">
						{{ csrf_field() }}
						<input type="hidden" name="job_id" value="{{ $job_id }}" />
						<input type="hidden" name="to_user_id" value="{{ $proposalDetails->sent_by_user }}" />
						<p class="smtitle">Reply to proposal</p>
						<div class="form-group">
							<textarea class="form-control" rows="8" cols="" placeholder="Reply" name="message" required></textarea>
						</div>
						<div class="text-right">
							<input type="submit" class="btn btn-success btntheme" value="SEND REPLY" name="reply_submit">
						</div>
					</form>
				</div>
			</div>
		</div>
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
				@if(isset($proposalDetails->userDet->sample_video))
					<video width="400" id="introVideo" controls>
						<source src="{{ asset('assets/frontend/introvideos/'.$proposalDetails->userDet->sample_video) }}">
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