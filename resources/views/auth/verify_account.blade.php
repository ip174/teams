@extends('layouts.app')
@section('title')
Job bidding | Login
@endsection
@section('content')
<div class="mainBody loginpage">
    <div class="wrapper">
        <!--<h2>Work, better. Faster. Together. <small>The world’s leading freelancing, collaboration &amp; teamwork platform</small></h2>-->
        <div class="center-block">
			@if($response_msg == 'success')
			Thank you!<br>Your Account is successfully verified.<br>
			<a href="{{ url('/user/dashboard') }}">Click</a>View your dashboard.
			@else
			Sorry, you don't have permission to access this page!
			@endif
        </div>
    </div>
</div>
@endsection
@section('customScript')

@endsection