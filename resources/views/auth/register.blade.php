@extends('layouts.app')
@section('title')
Job bidding | Register
@endsection
@section('content')
<div class="mainBody loginpage">
    <div class="wrapper1">
        <!-- <h2>Work, better. Faster. Together. <small>The world’s leading freelancing, collaboration &amp; teamwork platform</small></h2> -->
       <div class="panel-body loginboxnew">
        	<div class="col-lg-6">
        		<div class="panel-body">
        			<h2 class="titlelog">Create an account with Teams Network</h2>
        			<h3 class="title_sub"><i>With Teams Network, you can be a hire, a collaborator or both at the same time!</i></h3>
        			<p class="logpara"><span class="text-success">Post a job</span> - Post your project, receive proposals from professionals within minutes, shortlist and the right collaborator.</p>

        			<p class="logpara"><span class="text-success">Find work</span> - Search and find a job or project online. Work with your choice of employer as full-time, part-time or a freelancer.</p>

        			<p class="logpara"><span class="text-success">Find People</span> - There are mathes for your specific needs in our database - people who really know the value of collaboration.</p>

        			<p class="logpara"><span class="text-success">collaborate</span> - Our dedicated workstream has a bespoke set of tools that make collaboration a breeze, unlock your potential, immediately!</p>
        		</div>
        	</div>
            
        	<div class="col-lg-6">
        		<div class="panel-body formstyless regiborder">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<!-- <button class="newbtnlog btn btn-blue btn-block"><i class="fa fa-linkedin"></i>Sign up with LinkedIn</button>

					<p class="ortxt text-center"><span>OR</span></p> -->


		            <form action="{{ route('register') }}" name="signupform" id="signupform" method="post">
						{{ csrf_field() }}

						<div class="row">
							<div class="form-group col-sm-6">
								<label>First Name</label>
								<input type="text" name="first_name" id="first_name" class="form-control first_name" required value="{{ old('first_name') }}">
							</div>
							
							<div class="form-group col-sm-6">
								<label>Surname</label>
								<input type="text" name="last_name" id="last_name" class="form-control last_name" required value="{{ old('last_name') }}">
							</div>
						</div>
							<div class="form-group">
								<label>Email Address</label>
								<input type="text" name="email" id="email" class="form-control email" required value="{{ (isset($_GET['email']) && !empty($_GET['email'])) ? $_GET['email'] : old('email') }}">
							</div>
							
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" id="username" class="form-control username" required value="{{ old('username') }}">
							</div>
							<!-- <div class="form-group">
								<label>Email address</label>
								<input type="email" name="" id="" class="form-control username" required value="{{ old('username') }}">
							</div> -->
						
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" id="password" class="form-control password" required value="{{ old('password') }}">
							</div>
							
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="password" name="password_confirmation" id="password_confirmation" class="form-control password_confirmation" required value="{{ old('password_confirmation') }}">
							</div>
							
							<!-- <div class="form-group">
								<label>Sign Up as</label>
								<select name="type" id="type" class="form-control minimal type" required>
									<option value=""> Select </option>
									@foreach (Config::get('constants.langs') as $optionk=>$optionv)
										<option value="{{ $optionk }}" {{ old('type') == $optionk ? 'selected' : '' }}> {{ $optionv }} </option>
									@endforeach
								</select>
							</div> -->
							<input type="hidden" name="type" value="1">

							<p class="text-muted acctptxt">
								By clicking "Create Account" you agree to our <a href="#" class="text-success">Terms of service</a> and <a href="#" class="text-success">Privacy Policy</a>, include our <a href="#" class="text-success">Cookie Use Policy</a></p>
							</p>
							<!-- <div class="clearfix checknterm">
								<label class="checkFld pull-left">                                
									<input type="checkbox" name="terms_cond_check" id="terms_cond_check" value="Y" required><i class="fa fa-square-o"></i> I agree with
								</label>
								<p class="text-muted pull-left"><a href="#">Term & Conditions</a></p>
							</div> -->
							<input type="hidden" name="terms_cond_check" value="Y">

							<button class="newbtnlog btn btn-purple btn-block clearfix"><span class="imgico pull-left"><img src="{{asset('assets/frontend/images/ico_login.png')}}" class="img-responsive"></span>Create account with Teams Network</button>

							<!-- <input type="submit" class="btn btn-success btn-block btn-lg submitbtn" value="CREATE ACCOUNT" name="form_submit" disabled> -->
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
@section('customScript')

@endsection
