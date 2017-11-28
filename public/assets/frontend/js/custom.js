// Windows Loader

/*$(window).load(function(){

	$("#intro-loader").delay(10).fadeOut();

	$(".mask").delay(10).fadeOut("slow");

});*/

$(document).ready(function(){
	$(".opendropdown .dropdown-menu").on("click", function(e){
		e.stopPropagation();
	});
	$(".showdrop").click(function(e){
		e.stopPropagation();
		$(".opendropdown .dropdown-menu").hide();
		$(this).parent().children(".opendropdown .dropdown-menu").show();
	});
	$("body").click(function(){
		$(".opendropdown .dropdown-menu").hide();
	});
});


/*$(document).ready(function(){
	$(".dropdown-menu").on("click", function(e){
	  e.stopPropagation();
	});

    $(".showdrop").click(function(){
    	 e.stopPropagation();
        $(this).parent().addClass("open");
    });

        $("body").click(function(){
		
          $(this).parent().removeClass("open");
    });
});*/



// Inline Block's Space Removal
$('.inline, .formRow').contents().filter(function() {
	return this.nodeType === 3;
}).remove();


$(document).ready(function(){
	$("#signupform").validate({
		rules: {
			'email': {
				required: true,
				email: true,
				minlength: 5,
				maxlength: 191
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
			$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});
	
	$("#terms_cond_check").on('change', function(){
		if($("#terms_cond_check").is(':checked')){
			$(".submitbtn").removeAttr('disabled');
		}else{
			$(".submitbtn").attr('disabled', true);
		}
	})
	
	$("#loginform").validate({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});
	
	$(".introduce_file").on('change', function(e){
		var path = $(".introduce_file").val();
		var fileName = path.match(/[^\/\\]+$/);
		//alert(fileName);
		$(".introduce-file-text").html(fileName);
	});
	
	$(".remove_pic").on('click', function(){
		$("#image_preview").attr('src', '');
		$(".profiePic").val('');
	});
	
	$("#profile_pic_upload").validate({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			//$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});
	
	$(".forget_password_form").validate({
		rules:{
			'email': {
				required: true,
				email: true,
				minlength: 5,
				maxlength: 191
			}
		},
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			//$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});
	
	$(".reset_password_form").validate({
		rules:{
			'password':{
				required: true,
				minlength: 5,
				maxlength: 25
			},
			'password_confirmation':{
				required: true,
				minlength: 5,
				maxlength: 25,
				equalTo: "#password"
			}
		},
		highlight: function(element){
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			//$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});
	
	$("#jobPostForm").validate({
		highlight: function(element){
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		submitHandler: function(form) {
			//$(".submitbtn").attr('disabled', true);
			form.submit();
		}
	});
});

jQuery.validator.addMethod("email", function(value, element){
    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
}, 'Please enter valid email address.');

function saveOnAjaxUser(field_class, request_url){
	var fieldValue = $("."+field_class).val();
	//var token = $("input[name=_token]").val();
	process.on();
	$.ajax({
		type:'post',
		url:request_url,
		data:{
			isAjax:true,
			field_name:field_class,
			field_data:fieldValue
		},
		success:function(response){
			//var res = $.parseJSON(response);
			process.off();
		}, error: function(){
			//alert("Oops! Something went wrong, try again later.");
			process.off();
		}
	});
}

function saveOnAjax(field_class, request_url){
	var fieldValue = $("."+field_class).val();
	var token = $("input[name=_token]").val();
	process.on();
	$.ajax({
		type:'post',
		url:request_url,
		data:{
			isAjax:true,
			field_name:field_class,
			field_data:fieldValue,
			_token:token
		},
		success:function(response){
			//var res = $.parseJSON(response);
			process.off();
		}, error: function(){
			alert("Oops! Something went wrong, try again later.");
			process.off();
		}
	});
}

function openDiv(openDivCls){
	$(".userinfoLinks").css('display', 'none');
	$("."+openDivCls).css('display', 'block');
}

var loadFile = function(event){
	var output = document.getElementById('image_preview');
	output.src = URL.createObjectURL(event.target.files[0]);
};

function isNumberKey(event){
	var charCode = (event.which) ? event.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 39 && charCode != 37 && charCode != 46 && charCode != 9 && charCode != 16 && charCode != 45 && charCode != 36 && charCode != 35)
	return false;
	return true;
}
function numeric_with_dash(txt){
	txt.value = txt.value.replace(/[^ 0-9\n\r]+/g, '');
}



