<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title> @yield('title')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--Start CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/date-time-picker/css/bootstrap-datetimepicker.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/font-awesome.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/common.css') }}" />
<!--End CSS-->
<!--Start Responsive CSS (Keep All CSS Above This)-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/responsive.css') }}" />
<!--End Responsive CSS (Don't Keep Any CSS Below This)-->

<style>
.ajax_loader{
	position: fixed;
	width: 100%;
	height:100%;
	background:rgba(255,255,255,0.5) url({{ asset('assets/frontend/images/loading.gif') }}) no-repeat center;
	top:0;
	left: 0;
	z-index:9999;
	text-align: center;
	background-size:100px 100px;
}
</style>
</head>
<body>
	<div class="mainSite innerpage {{ isset($class_for_home) ? 'class_for_home' : '' }}">
		@include('layouts.header')
		@yield('content')
		@include('layouts.footer')
	</div>
	<!--Start Javascript-->
	<script>
	var base_url = '{{ url('') }}/';
	</script>
	<!--<script src="{!! asset('assets/frontend/js/jquery-3.2.1.min.js') !!}"></script>-->
	<script src="{!! asset('assets/frontend/js/jquery-2.1.1.min.js') !!}"></script>

	<script src="{!! asset('assets/frontend/js/bootstrap.min.js') !!}" type="text/javascript"></script>
	
	<script src="{!! asset('assets/frontend/date-time-picker/js/moment.2.9.0-with-locales.js') !!}"></script>
	<script src="{!! asset('assets/frontend/date-time-picker/js/bootstrap-datetimepicker.js') !!}"></script>
	
	
	<script type="text/javascript" src="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	


	<link rel="stylesheet" href="{!! asset('assets/frontend/multiple_autocomplete/dist/fastselect.min.css') !!}">
	<script src="{!! asset('assets/frontend/multiple_autocomplete/dist/fastselect.standalone.js') !!}"></script>
	<!--PlugIn for jquery multiselect end-->
	
	
	<script src="{!! asset('assets/frontend/js/jquery.validate.min.js') !!}" type="text/javascript"></script>
	
	
	<script src="{!! asset('assets/frontend/js/pages.frontend.js') !!}" type="text/javascript"></script>
	
	@yield('customScript')
	<script type="text/javascript">
		$(document).ready(function(){
			//$('input[name="invoicedaterange"]').daterangepicker();
		    $('input[name="invoicedaterange"]').daterangepicker({
		        //autoUpdateInput: false,
		        locale: {
		            format: 'DD/MM/YYYY'
		        }
			});
		});
	</script>
	<script src="{!! asset('assets/frontend/js/custom.js') !!}" type="text/javascript"></script>
	<script type="text/javascript">
function subscriptionMyEmail(inputbox, msgClass){
  //alert("okkkkkkk!");
  process.on();
  hirer_SubscriptionEmail = $("input[name="+inputbox+"]").val();
  $.ajax({
    type:'post',
    url:"{{ url('/user/hirer-subscription') }}",
    data:{
      email:hirer_SubscriptionEmail
    },
    dataType: "json",
    success:function(response){
     $("."+msgClass).html(response.ret_msg);
     $("."+msgClass).css("color", response.color);
     $("."+msgClass).css("font-weight", response.fontweight);
      process.off();
    },error: function(){
      alert("Oops! Something went wrong, try again later.");
      process.off();
    }
  });
}
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

	    $('.due_date_area').datetimepicker({
	    	format:'DD/MM/YYYY'
	    });

	    $('.due_date_area').on('click', function(){
	    	$('.glyphicon-chevron-left').addClass('fa fa-angle-double-left').removeClass('glyphicon-chevron-left');
	    	$('.glyphicon-chevron-right').addClass('fa fa-angle-double-right').removeClass('glyphicon-chevron-right');
	    });


        //Code for message notification in header section, start
        @if(isset(Auth::user()->id) && Auth::user()->id > 0)
        setInterval(function(){
        	//alert("Hello");
        	var request_url = '{{ url('/chat/get-message-notification') }}';
        	$.ajax({
				type:'post',
				url:request_url,
				data:{
					isAjax:true
				},
				success:function(response){
					//var res = $.parseJSON(response);
					$(".notification_envelop").html(response.html);
				}, error: function(){
					
				}
			});
        }, {{config('constants.NOTIFICATION_AJAX_CALLING_INTERVAL')}});
        //Code for message notification in header section, end

        setInterval(function(){
        	//alert("Hello");
        	var request_url = '{{ url('/chat/get-profile-notification') }}';
        	$.ajax({
				type:'post',
				url:request_url,
				data:{
					isAjax:true
				},
				dataType: "json",
				success:function(response){
					//var res = $.parseJSON(response);
					$(".notificationArea").html(response.returnHTML);
					$(".notificationCounter").html(response.countNewNotification);
				}, error: function(){
					
				}
			});
        }, {{config('constants.NOTIFICATION_AJAX_CALLING_INTERVAL')}});
        //Code for message notification in header section, end
        @endif
    });
	
	var process = {
		on: function(){
			 $('body').append('<div class="ajax_loader"></div>');
		},
		off: function(){	
			setTimeout( function () {
			  $('body').find('.ajax_loader').remove();
			}, 1000);
		}
	};
	</script>
	
	<!--Code for jquery multiselect start-->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-69265879-1', 'auto');
	ga('send', 'pageview');

	$('.multipleSelect').fastselect();

	function setAvailableUnavailable(){
		var availabilityStatusBar = $(".availabilityStatusBar").val();
		//alert('Calling');
		process.on();
		$.ajax({
			type:'post',
			url:'{{url('user/set-online-offline')}}',
			data:{
				isAjax:true,
				availability_status:availabilityStatusBar
			},
			success:function(response){
				//var res = $.parseJSON(response);
				$(".availabilityStatusBar").val(response.statusReturnTo);
				$(".availability_status").val(availabilityStatusBar);
				$(".availabilityText").text(availabilityStatusBar);
				process.off();
			}, error: function(){
				alert("Oops! Something went wrong, try again later.");
				process.off();
			}
		});
	}
	</script>
	<!--Code for jquery multiselect end-->

	
</body>
</html>