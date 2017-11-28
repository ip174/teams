<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left image">
			<img src="{!! asset('assets/admin/dist/img/avatar5.png') !!}" class="img-circle" alt="User Image">
		</div>
		<div class="pull-left info">
			<p>Admin</p>
			<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	</div>
	<ul class="sidebar-menu">
		<li class="header">MAIN NAVIGATION</li>
		<li>
			<a href="{!! admin_url() !!}">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>
		<li class="{!! Request::segment(2) == 'users'?'treeview active':'treeview' !!}">
			<a href="{!! admin_url('users') !!}">
				<i class="fa  fa-group"></i> <span>Users</span>
			</a>
		</li>
		<li class="{!! Request::segment(2) == 'settings'?'treeview active':'treeview' !!}">
			<a href="{!! admin_url('settings') !!}">
				<i class="fa fa-cog"></i> <span>Settings</span>
			</a>
		</li>
		{{--<li class="{!! Request::segment(2) == 'passenger'?'treeview active':'treeview' !!}">
			<a href="#">
				<i class="fa fa-user"></i>
				<span>Manage Passengers</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class="{!! Request::segment(2) == 'passenger' && Request::segment(3) == ''?'active':'' !!}">
					<a href="{!! admin_url('passenger') !!}"><i class="fa fa-circle-o"></i> List</a>
				</li>
			</ul>
		</li>
		<li class="{!! Request::segment(2) == 'driver'?'treeview active':'treeview' !!}">
			<a href="#">
				<i class="fa fa-id-card-o"></i>
				<span>Manage Driver</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class="{!! Request::segment(2) == 'driver' && Request::segment(3) == ''?'active':'' !!}">
					<a href="{!! admin_url('driver') !!}"><i class="fa fa-circle-o"></i> List</a>
				</li>
			</ul>
		</li>--}}

		
	</ul>
</section>