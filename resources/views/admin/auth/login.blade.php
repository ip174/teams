<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Dashboard</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="{{ asset(config('constants.ADMIN_ASSETS_URL')) }}/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset(config('constants.ADMIN_ASSETS_URL')) }}/css/login.css">

</head>
<body>

<div class="container">
	<div class="login-box">
		<div class="logo">
			<img src="{{ asset(config('constants.ADMIN_ASSETS_URL')) }}/images/logo.png" class="img img-responsive center-block"/>
			<h1 class="logo-caption"><span class="tweak">L</span>ogin</h1>
		</div><!-- /.logo -->
		<form method="POST" action="{{ admin_url('login') }}" name="student_login">
		    {!! csrf_field() !!}
		    @if (!empty($errors))
		        <div class="validation_error">
		            <ul>
		                @foreach ($errors->all() as $error)
		                    <li>{{ $error }}</li>
		                @endforeach
		            </ul>
		        </div>
		    @endif
		    <div class="controls">
		       	<input type="text" name="email" placeholder="Username" class="form-control" />
				<input type="password" name="password" placeholder="Password" class="form-control" />
				<button type="submit" class="btn btn-default btn-block btn-custom">Login</button>
			</div><!--- /.controls -->
		</form>
	</div><!-- /#login-box -->
</div><!-- /.container -->

</body>
</html>
