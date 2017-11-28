<div class="pagetop clearfix">
	<h1 class="pull-left">User - All Users</h1>
	<div class="pull-right">
		<ul class="list-unstyled rightmenu nav navbar-nav">
			<li><a href="#"><i class="fa fa-bell"></i></a></li>
			<li class="avatardropdown dropdown">
				<a class="clearfix"  id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<figure class="avatar pull-left">
						<img src="{{ asset(config('constants.ADMIN_ASSETS_URL')) }}/images/avatar.png" class="img-responsive">
						<span class="avatarwrap"></span>
					</figure>
					<i class="fa fa-angle-down pull-right" aria-hidden="true"></i>
				</a>
				 <ul class="dropdown-menu" aria-labelledby="dLabel">
				    <li>
				    	<a href="{!! admin_url('logout') !!}">Sign out</a>
				    </li>
				 </ul>
			</li>
		</ul>	
	</div>
</div>