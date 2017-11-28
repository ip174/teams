@extends('admin.layouts.app')

@section('pageTitle', 'Users')

@section('content')



<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
	<div class="shadowbox">
		<div class="panel-body clearfix">
			<figure class="avatar pull-left">
				<img src="{{ asset(config('constants.ADMIN_ASSETS_URL')) }}/images/avatar.png" class="img-responsive">
				<span class="avatarwrap"></span>
			</figure>


			<h3 class="avatarname">Roxie McCormick</h3>

			<div class="clearfix">
				<p class="pull-left avaddress"><i class="fa fa-map-marker"></i> Oxford, GB</p>
				<a href="#" class="btn btn-success editbtn pull-right"><i class="fa fa-pencil"></i></a>
			</div>

			<ul class="list-unstyled borderlist">
				<li>
					<div class="sordesc ">
					As a designer I love to collaborate with people, using the creative process to find new ideas and innovative solutions to design challenges, I call this ~ creative lifesaving. I am pasinate about Peole, Creativity. Design, Innovation, Technology &amp; South Africa. ...
					<a class="readmore" href="#">Read More</a>
					</div>

					<a href="#" class="btn btn-success viewbtn"><i class="fa fa-video-camera"></i> WATCH MY INTRO VIDEO</a>
				</li>

				<li>
					<p class="smtitle">Focus</p>
					<div class="sordesc ">
						Industrial Design, Product Design, Enterpreneurship
					</div>
				</li>
				
				<li>
					<p class="smtitle">Expertise</p>
					<div class="sordesc ">
						Motion Graphics and Animation
					</div>
				</li>
				
				<li>
					<p class="smtitle">Tools</p>
					<div class="tags">
						<a href="#" class="btn btn-default">PHP</a>
						<a href="#" class="btn btn-default">ANGULAR</a>
						<a href="#" class="btn btn-default">HTML</a>
					</div>
				</li>

				<li>
					<div class="dl-inline">
					  <p><strong>Rate:</strong> £25 per hour</p>
					</div>

					<div class="dl-inline">
					  <p><strong>Job Type:</strong> Hourly &amp; Fixed prices</p>
					</div>
				</li>

				<li>
					<ul class="list-inline sharelinks clearfix">
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#"><i class="fa fa-vimeo"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-behance"></i></a></li>
						<li class="moreshare"><a href="#"><img src="{{ asset(config('constants.ADMIN_ASSETS_URL')) }}/images/share-more.png" class="img-responsive"></a></li>
					</ul>
				</li>

			</ul>

		</div>

	</div>
</div><!-- left col -->
<div class="col-lg-8 col-md-4 col-sm-9 col-xs-12 usercontrolinfo">
	<h2 class="subtitle">User Control</h2>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="row form-group">
				<label class="col-lg-4">Profile URL</label>
				<p class="col-lg-6"><a href="#">www.teamnetwork/roxiemc</a></p>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="row form-group">
				<label class="col-sm-4">Status</label>
				<p class="col-sm-6"><a href="#">Active</a></p>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="row form-group">
				<label class="col-sm-4">First name</label>
				<p class="col-sm-6">roxiemc</p>
			</div>
		</div>
		

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="row form-group">
				<label class="col-sm-4">Portfolio</label>
				<p class="col-sm-6"><a href="#">10 Files</a></p>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="row form-group">
				<label class="col-sm-4">Last Name</label>
				<p class="col-sm-6"><a href="#">McCronick</a></p>
			</div>
		</div>
		

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="row form-group">
				<label class="col-sm-4">Review</label>
				<p class="col-sm-6"><a href="#">2 Review</a></p>
			</div>
		</div>
		

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="row form-group">
				<label class="col-sm-4">Status</label>
				<p class="col-sm-6"><a href="#">Active</a></p>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="row form-group">
				<label class="col-sm-4">Status</label>
				<div class="col-sm-6">
					<label class="i-switch i-switch-md bg-info csswitch">
                        <input type="checkbox" id="chkprivacy" onchange="updateShowRevenue();" value="false">
                        <i></i>
                    </label>
				</div>
			</div>
		</div>

	</div><!-- row ]] -->
	<div class="gpmt30 clearfix replbtn">
		<button class="btn btn-primary pull-right">Save</button>
    	 <button class="btn btn-default pull-right cancelbtnsp">Cancel</button>
	</div>
</div>
@endsection
