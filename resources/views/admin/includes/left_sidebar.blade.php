	<a class="logo">
		<img src="{{ asset(config('constants.ADMIN_ASSETS_URL')) }}/images/logo.png" class="img-responsive">
	</a>
	<ul class="mainmenu list-unstyled">
		<li class="{!! Request::segment(2) == 'supports'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Supports</a></li>
		<li class="{!! Request::segment(2) == 'categories'?'treeview active':'treeview' !!}"><a href="{!! admin_url('categories') !!}">Categories</a></li>
		<li class="{!! Request::segment(2) == 'disputes'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Disputes</a></li>
		<li class="{!! Request::segment(2) == 'faqs'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">FAQs</a></li>
		<li class="{!! Request::segment(2) == 'tranings'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Tranings</a></li>
		<li class="{!! Request::segment(2) == 'press'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Press</a></li>
		<li class="{!! Request::segment(2) == 'community'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Community</a></li>
		<li class="{!! Request::segment(2) == 'users'?'treeview active':'treeview' !!}"><a href="{!! admin_url('users') !!}">User</a></li>
		<li class="{!! Request::segment(2) == 'admins'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Admins</a></li>
		<li class="{!! Request::segment(2) == 'group'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Group</a></li>
		<li class="{!! Request::segment(2) == 'free'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Free</a></li>
		<li class="{!! Request::segment(2) == 'subscriptions'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Subscriptions</a></li>
		<li class="{!! Request::segment(2) == 'payments'?'treeview active':'treeview' !!}"><a href="{!! admin_url() !!}">Payments</a></li>
	</ul>
