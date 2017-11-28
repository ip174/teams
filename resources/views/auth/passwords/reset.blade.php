@extends('layouts.app')
@section('title')
Job bidding | Reset Password
@endsection
@section('content')
<div class="wrapper">
    <div id="login_panel" class="login_half">
        <form class="login-form login-form_left" role="form" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">
            <h3>Reset Password</h3>

            @if (!empty($errors))
                <div class="validation_error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <label for="email">E-mail Address*</label>
            <input id="email" type="email" class="input-form" name="email" value="{{ $email or old('email') }}" required autofocus>
            {{--@if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif--}}
            <label for="resetPassword">Password*</label>
            <input tabindex="2" class="input-form" id="resetPassword" type="password" name="password">
            <label for="password-confirm">Password*</label>
            <input tabindex="3" class="input-form" id="password-confirm" type="password" name="password_confirmation">

            <button type="submit" class="submit-btn button">Reset Password</button>
            <br>
            <br>
        </form>
        <div class="clear"></div>
    </div>
</div>
@endsection
