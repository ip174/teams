@extends('layouts.app')
@section('title')
Job bidding | Reset Password
@endsection
@section('content')
<div class="wrapper forget-password-area">
    <div id="login_panel" class="login_half">
        <form class="login-form reset_password_form" role="form" method="POST" action="{{ url('reset-password').'/'.$email }}">
            {{ csrf_field() }}
            <span style="font-size:20px;">Reset Password</span>
			<br><br>

			@if(isset($errorMsg))
				<div class="alert alert-danger">
					<ul>
					<li>{{ $errorMsg }}</li>
					</ul>
				</div>
			@endif
			
			@if(isset($succMsg))
				<div class="alert alert-success seccess-msg" id="seccess-msg">
					<ul>
					<li>{{ $succMsg }}</li>
					</ul>
				</div>
			@endif
			
            @if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			
			@if(empty($succMsg))
            <label for="resetPassword">Password*</label>
            <input tabindex="2" class="input-form" id="password" type="password" name="password" required>
            <label for="password-confirm">Confirm Password*</label>
            <input tabindex="3" class="input-form" id="password_confirmation" type="password" name="password_confirmation" required>
			
			<input type="hidden" name="ptoken" value="{{ $email }}">
            <button type="submit" class="submit-btn button forget-password-btn">Reset Password</button>
            <br>
            <br>
			@endif
        </form>
        <div class="clear"></div>
    </div>
</div>
@endsection
