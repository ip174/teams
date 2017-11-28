@extends('layouts.app')
@section('title')
Job bidding | Login
@endsection
@section('content')
<div class="mainBody loginpage">
    <div class="container">
       <!--  <h2>Work, better. Faster. Together. <small>The world’s leading freelancing, collaboration &amp; teamwork platform</small></h2> -->

        <div class="panel-body loginboxnew">
        	<div class="col-lg-7">
        		<img src="{{asset('assets/frontend/images/login-bg-src.png')}}" class="img-responsive">
        	</div>
        <div class="col-lg-5">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title" style="margin-left: -62px !important;">Login to work together</h4>
            </div>
			{{ @session_start() ? '' : '' }}
			@if(isset($_SESSION['errorMsg']))
				<div class="alert alert-danger">
					<ul>
					<li>{{ $_SESSION['errorMsg'] }}</li>
					</ul>
				</div>
			@endif
			{{ session_destroy() ? '' : '' }}
			
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			
				<div class="panel-body formstyless">
					<form name="" action="{{ route('login') }}" id="loginform" method="POST">
				{{ csrf_field() }}
					<div class="form-group">
						<label>Email ID</label>
						<input type="text" name="email" class="form-control" required value="{{ old('email') }}">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="clearfix">
						<div class="checkbox pull-left">
							<label class="i-checks">
								<input type="checkbox" name="remember"><i></i> Keep me signed in
							</label>
						</div>
						<p class="text-muted frgptxt pull-right"><a href="{{ route('password.request') }}">Forget password?</a></p>
					</div><!-- 
					<input type="submit" class="btn btn-success btn-block btn-lg submitbtn" value="LOGIN WITH TEAMS NETWORK" name=""> -->
					<button class="newbtnlog btn btn-purple btn-block clearfix"><span class="imgico pull-left"><img src="{{asset('assets/frontend/images/ico_login.png')}}" class="img-responsive"></span>Login with Teams Network</button>

					<!-- <p class="ortxt text-center"><span>OR</span></p> -->

				</form>
				<!-- <button class="newbtnlog btn btn-blue btn-block"><i class="fa fa-linkedin"></i>Login with LinkedIn</button> -->
				</div>
					
            
        </div><!-- col-right form ]]-->
    </div><!-- row ]] -->
    </div>
</div>
@endsection
@section('customScript')

@endsection