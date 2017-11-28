@extends('layouts.app')
@section('title')
Job bidding | Forget Password
@endsection
@section('content')
<div class="wrapper forget-password-area">
    <div id="login_panel" class="login_half">
        <form class="login-form forget_password_form" role="form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}
            <span style="font-size:20px;">Reset Password</span>
			<br><br>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
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

            <label for="email">Enter registered E-mail Address*</label>
            <input id="email" type="email" class="input-form" name="email" value="{{ old('email') }}" autocomplete="off" required>
            <button type="submit" class="submit-btn button forget-password-btn">Send Password Reset Link</button>
            <br>
            <br>
        </form>
        <div class="clear"></div>
    </div>
</div>
@endsection
