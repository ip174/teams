<script>
function openmodal(modalId){
	process.on();
	$("#"+modalId).modal('show');
	process.off();
}

function save_availability(){
	process.on();
	$(".availability_editbtn").css("display", "none");
	var working_days_from = $(".working_days_from").val();
	var working_days_to = $(".working_days_to").val();
	if(working_days_from!='' && working_days_to!='' && working_days_from <= working_days_to){
		//alert("success");
		$.ajax({
			type:'post',
			url:'{{ url("/settings/change-availability") }}',
			data:{
				isAjax:true,
				working_days_from:working_days_from,
				working_days_to:working_days_to
			},
			success:function(response){
				$(".message_section").prepend('<div class="row message_div"  style="margin-top:20px; margin-bottom:-20px;"><div class="col-lg-12 '+response.msg_class+'">'+response.msg+'</div></div>');
				setTimeout(function(){
					$(".message_div").remove();
					$(".availability_editbtn").css("display", "block");
				}, 3000);
				process.off();
			}, error: function(){
				$(".availability_editbtn").css("display", "block");
				process.off();
			}
		});
	}else{
		//alert(working_days_from);
		//alert(working_days_to);
		$(".message_section").prepend('<div class="row message_div" style="margin-top:20px; margin-bottom:-20px;"><div class="col-lg-12 alert alert-danger">Please provide appropriate value for availability!</div></div>');
		setTimeout(function(){
			$(".message_div").remove();
			$(".availability_editbtn").css("display", "block");
		}, 3000);
		process.off();
	}
}

function saveAlertSetting(){
	notificationSoundAlert = $(".notificationSoundAlert").val();
}

$(document).ready(function(){
    $("#change_password_form").validate({
		rules: {
			'old_password': {
				required: true,
				minlength: 5,
				maxlength: 25
			},
			'password': {
				required: true,
				minlength: 5,
				maxlength: 25
			},
			'password_confirmation': {
				required: true,
				minlength: 5,
				maxlength: 25,
				equalTo: "#password"
			}
		},
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			process.on();
			//form.submit();
			old_password = $("#old_password").val();
			password = $("#password").val();
			password_confirmation = $("#password_confirmation").val();
			$.ajax({
				type:'post',
				url:'{{ url("/settings/change-password") }}',
				data:{
					isAjax:true,
					old_password:old_password,
					password:password,
					password_confirmation:password_confirmation
				},
				success:function(response){
					if(response.logout_status){
						window.location.href = '{{ url("/login") }}';
					}
					document.getElementById("change_password_form").reset();
					$(".password_change_modal").prepend('<div class="row msg_area"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 '+response.msg_class+'">'+response.msg+'</div></div>');
					setTimeout(function(){
						$(".msg_area").remove();
					}, 3000);
					process.off();
				}, error: function(){
					process.off();
				}
			});
		}
	});

	$("#security_question_form").validate({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			process.on();
			//form.submit();
			security_question = $("#security_question").val();
			security_question_answer = $("#security_question_answer").val();
			$.ajax({
				type:'post',
				url:'{{ url("/settings/change-security-question") }}',
				data:{
					isAjax:true,
					security_question:security_question,
					security_question_answer:security_question_answer
				},
				success:function(response){
					if(response.logout_status){
						window.location.href = '{{ url("/login") }}';
					}
					document.getElementById("change_password_form").reset();
					$(".password_change_modal").prepend('<div class="row msg_area"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 '+response.msg_class+'">'+response.msg+'</div></div>');
					setTimeout(function(){
						$(".msg_area").remove();
					}, 3000);
					process.off();
				}, error: function(){
					process.off();
				}
			});
		}
	});

	
	$(".notificationSetting").on('click', function(){
		process.on();
		str = '';
		for (i=0;i<notificationSetting_form.getNotificationFor.options.length;i++) {
		    if (notificationSetting_form.getNotificationFor.options[i].selected) {
		        str = str + i + " ";
		    }
		}
		notificationsOptions = str;
		//alert(notificationsOptions);
		$.ajax({
			type:'post',
			url:'{{ url("/settings/change-notification-settings") }}',
			data:{
				isAjax:true,
				notificationsOptions:notificationsOptions
			},
			success:function(response){
				if(response.logout_status){
					window.location.href = '{{ url("/login") }}';
				}
				$(".notificationDetailsArea").html(response.notificationValues);
				//document.getElementById("notificationSetting_form").reset();
				$(".notificationSetting_change_modal").prepend('<div class="row msg_area"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 '+response.msg_class+'">'+response.msg+'</div></div>');
				setTimeout(function(){
					$(".msg_area").remove();
					process.off();
				}, 3000);
			}, error: function(){
				process.off();
			}
		});
	});

	$(".needUpdateSetting").on('click', function(){
		process.on();
		str = '';
		for (i=0;i<needUpdateSetting_form.needUpdateFor.options.length;i++) {
		    if (needUpdateSetting_form.needUpdateFor.options[i].selected) {
		        str = str + i + " ";
		    }
		}
		needUpdateOptions = str;
		//alert(needUpdateOptions);
		$.ajax({
			type:'post',
			url:'{{ url("/settings/change-need-update-settings") }}',
			data:{
				isAjax:true,
				needUpdateOptions:needUpdateOptions
			},
			success:function(response){
				if(response.logout_status){
					window.location.href = '{{ url("/login") }}';
				}
				$(".needUpdateDetailsArea").html(response.needforUpdatesValues);
				//document.getElementById("notificationSetting_form").reset();
				$(".needUpdateSetting_change_modal").prepend('<div class="row msg_area"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 '+response.msg_class+'">'+response.msg+'</div></div>');
				setTimeout(function(){
					$(".msg_area").remove();
					process.off();
				}, 3000);
			}, error: function(){
				process.off();
			}
		});
	});
});


</script>