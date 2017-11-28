@if($users_details)
<ul class="jobpostedlist infobox">
	@foreach($users_details as $user_det)
		<li class="clearfix">
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 full-vxs">
				<div class="freelancerlist">
					@if(!empty($user_det->profile_picture))
						<div class="profilePic" style="background:url({{ asset('assets/frontend/profile_pictures/'.$user_det->profile_picture) }}) no-repeat;">
					@else
						<div class="profilePic" style="background:url({{ asset('assets/frontend/images/icon-no-image.png') }}) no-repeat;">
					@endif
						<div class="shape"></div>
					</div>
					<h3 class="jobtitle avname clearfix">
						<strong><a href="{{ url('freelancers/freelancer-details/'.strtolower($user_det->first_name).'-'.strtolower($user_det->last_name).'/'.@$user_det->id) }}">{{ $user_det->first_name.' '.$user_det->last_name }}</a></strong>
						@if($user_det->availability_status)
						@php
						switch($user_det->availability_status){
							case 'Available':
							$backgroundColor = "#449d44";
							$fontColor = "#000000";
							break;

							case 'Busy':
							$backgroundColor = "#FCC15B";
							$fontColor = "#000000";
							break;

							case 'Offline':
							$backgroundColor = "#ffffff";
							$fontColor = "#000000";
							break;

							default:
							$backgroundColor = "#ffffff";
							$fontColor = "#ffffff";
							break;
						}
						@endphp
						<span class="staus available" style="background-color: {{$backgroundColor}}; font-color: {{$fontColor}};">{{ $user_det->availability_status }}</span>
						@endif
					</h3>
					<ul class="list-inline profiledata">					
						@if($user_det->availability_status)
						<li><p><i class="fa fa-map-marker"></i> {{ $user_det->location }}</p></li><br>
						@endif
						<li><p><i class="fa fa-align-center"></i> Portfolio(12)</p></li><br>
						<!--- <li><p><img src="{{ asset('assets/frontend/images/verified.png') }}" class="img-responsive inline-block"> Verified Member</p></li> -->
					</ul>
					<div class="jobsortdetails">
						<strong>Fields:</strong> {{ $user_det->type_title }}
					</div>
					<div class="tags">
						@if(getSkillsByUserID($user_det->id))
							@foreach(getSkillsByUserID($user_det->id) as $rowSkill)
								<a href="javascript:void(0);" class="btn btn-default">{{ $rowSkill->skill_name }}</a>
							@endforeach
						@endif
					</div>
				</div>
			</div><!-- col left ]] -->
			<div class="col-lg-3 col-md-3 col-sm-3 co-xs-3 full-vxs text-right text-xs-left">
				<div class="projectprice">
					@if($user_det->rate_per_hour)
					{{ $user_det->rate_per_hour }} / h
					@endif
				</div>
				<a href="{{ url('freelancers/freelancer-details/'.strtolower($user_det->first_name).'-'.strtolower($user_det->last_name).'/'.@$user_det->id.'?q=contact') }}" class="btn btn-success viewbtn">CONTACT</a>
			</div>
		</li>
		<!-- one jop ]] -->
	@endforeach
</ul>
<nav aria-label="..." class="paginationew text-right">
	{{ $users_details->render() }}
</nav>
@endif

