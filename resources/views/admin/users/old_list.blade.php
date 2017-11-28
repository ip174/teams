@extends('admin.layouts.app')

@section('pageTitle', 'Users')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Users </h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0);"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="{!! admin_url('') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Users</li>
		</ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Users</h3>
					</div>
					
					
					@if($errors->any())
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							@foreach($errors->all() as $error)
								<p>{!! $error !!}</p>
							@endforeach
						</div>
					@endif
					@if(session('success'))
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{!! session('success') !!}
					</div>
					@endif
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email ID</th>
									<th>Picture</th>
									<th>Field of work</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($users_details)
									@foreach($users_details as $each_user)
									<tr>
										<td>{{ $each_user->first_name.' '.$each_user->last_name }}</td>
										<td>{{ $each_user->email }}</td>
										<td>
											@if($each_user->profile_picture)
											<img src="{{ asset('assets/frontend/profile_pictures/').'/'.$each_user->profile_picture }}" height="80px" width="80px" />
											@endif
										</td>
										<td>{{ $each_user->type_title }}</td>
										<td>
										<a href="{{ url('admin/edit-users-profile/').'/'.$each_user->id }}" class="btn btn-primary btn-xs" title="Edit">
											<i class="fa fa-pencil"></i>
										</a>
										&nbsp;
										<a href="{{ url('admin/delete-users-profile/').'/'.$each_user->id }}" class="btn btn-danger btn-xs" title="Delete">
											<i class="fa fa-trash-o"></i>
										</a>
										</td>
									</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
					<div class="row">
						<div class="col-md-12">
							<div class="col-sm-5"></div>
							<div class="col-sm-7 text-right">{{ $users_details->links() }}</div>
						</div>
					</div>
					
					
					
				</div><!-- /.box -->
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->



@endsection