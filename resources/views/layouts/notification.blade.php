
@php
$counter = 0;
@endphp
@foreach($unreadNotifications as $eachNotification)
	<li>
		<i class="fa fa-file"></i>
		<a href="{{ $eachNotification->notification_link ? url($eachNotification->notification_link) : 'javascript:void(0);' }}">
			{{ $eachNotification->short_description }}
		</a>
	</li>
	@php
	$counter++;
	if($counter >= 5){
		break;
	}
	@endphp
@endforeach



@if($counter < 5)
	@foreach($readNotifications as $eachNotification)
	<li>
		<i class="fa fa-file"></i>
		<a href="{{ $eachNotification->notification_link ? url($eachNotification->notification_link) : 'javascript:void(0);' }}">
			{{ $eachNotification->short_description }}
		</a>
	</li>
	@php
	$counter++;
	if($counter >= 5){
		break;
	}
	@endphp
	@endforeach
@endif
<p class="seeallnotification text-center">
	<a href='{{ url('/my-notification') }}'>
		SEE ALL NOTIFICATIONS
	</a>
</p>
