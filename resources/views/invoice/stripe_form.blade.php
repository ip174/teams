<!DOCTYPE html>
<html>
<head>
<title>Payment using Stripe</title>
<style type="text/css">
	* {
	  font-family: "Helvetica Neue", Helvetica;
	  font-size: 15px;
	  font-variant: normal;
	  padding: 0;
	  margin: 0;
	}

	html {
	  height: 100%;
	}

	body {
	  background: #E6EBF1;
	  align-items: center;
	  min-height: 100%;
	  display: flex;
	  width: 100%;
	}

	form {
	  width: 480px;
	  margin: 20px auto;
	}

	.group {
	  background: white;
	  box-shadow: 0 7px 14px 0 rgba(49,49,93,0.10),
				  0 3px 6px 0 rgba(0,0,0,0.08);
	  border-radius: 4px;
	  margin-bottom: 20px;
	}

	label {
	  position: relative;
	  color: #8898AA;
	  font-weight: 300;
	  height: 40px;
	  line-height: 40px;
	  margin-left: 20px;
	  display: block;
	}

	.group label:not(:last-child) {
	  border-bottom: 1px solid #F0F5FA;
	}

	label > span {
	  width: 20%;
	  text-align: right;
	  float: left;
	}

	.field {
	  background: transparent;
	  font-weight: 300;
	  border: 0;
	  color: #31325F;
	  outline: none;
	  padding-right: 10px;
	  padding-left: 10px;
	  cursor: text;
	  width: 70%;
	  height: 40px;
	  float: right;
	}

	.field::-webkit-input-placeholder { color: #CFD7E0; }
	.field::-moz-placeholder { color: #CFD7E0; }
	.field:-ms-input-placeholder { color: #CFD7E0; }

	button {
	  float: left;
	  display: block;
	  background: #666EE8;
	  color: white;
	  box-shadow: 0 7px 14px 0 rgba(49,49,93,0.10),
				  0 3px 6px 0 rgba(0,0,0,0.08);
	  border-radius: 4px;
	  border: 0;
	  margin-top: 20px;
	  font-size: 15px;
	  font-weight: 400;
	  width: 100%;
	  height: 40px;
	  line-height: 38px;
	  outline: none;
	}

	button:focus {
	  background: #555ABF;
	}

	button:active {
	  background: #43458B;
	}

	.outcome {
	  float: left;
	  width: 100%;
	  padding-top: 8px;
	  min-height: 24px;
	  text-align: center;
	}

	.success, .error {
	  display: none;
	  font-size: 13px;
	}

	.success.visible, .error.visible {
	  display: inline;
	}

	.error {
	  color: #E4584C;
	}

	.success {
	  color: #666EE8;
	}

	.success .token {
	  font-weight: 500;
	  font-size: 13px;
	}
</style>
</head>
<body>
@php
$totalEstimatedAmount=$porposalAmount;
@endphp
<script src="https://js.stripe.com/v3/"></script>
<form action='{{ url("invoice/stripe-payment/$txn/$totalEstimatedAmount") }}' method="POST" id="payment-form">
	{{ csrf_field() }}
	<h4>Payment using Stripe</h4>
	<div class="group">
		<label>
			<span>Name</span>
			<input name="cardholder-name" class="field" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" readonly/>
		</label>
		<label>
			<span>Email</span>
			<input class="field" type="email" value="{{ Auth::user()->email }}" readonly />
		</label>
	</div>
	<div class="group">
		<label>
			<span>Card</span>
			<div id="card-element" class="field"></div>
		</label>
	</div>
	<button type="submit" id="btn_payment">Pay &nbsp;£ {{ base64_decode($totalEstimatedAmount) }}</button>
	<div class="outcome">
		<div class="error" role="alert"></div>
		<div class="success">
			Success! Your Stripe token is <span class="token"></span>
		</div>
	</div>
</form>

<script
	src="https://code.jquery.com/jquery-3.2.1.min.js"
	integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	crossorigin="anonymous"></script>
<script type="text/javascript">
var stripe = Stripe('pk_test_uzsHYYxZA3ZVsVAJYnU7RIud');
var elements = stripe.elements();

var card = elements.create('card', {
	style: {
		base: {
			iconColor: '#666EE8',
			color: '#31325F',
			lineHeight: '40px',
			fontWeight: 300,
			fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
			fontSize: '15px',

			'::placeholder': {
				color: '#CFD7E0',
			},
		},
	}
});
card.mount('#card-element');

function setOutcome(result){
	var successElement = document.querySelector('.success');
	var errorElement = document.querySelector('.error');
	successElement.classList.remove('visible');
	errorElement.classList.remove('visible');
	if (result.token){
		// Use the token to create a charge or a customer
		// https://stripe.com/docs/charges
		successElement.querySelector('.token').textContent = result.token.id;
		//successElement.classList.add('visible');
		var $form = $('#payment-form');
		$form.append($('<input type="hidden" name="stripeToken" />').val(result.token.id));

		setTimeout(function(){
			$form.get(0).submit();
		}, 1000);

	}else if (result.error){
		errorElement.textContent = result.error.message;
		errorElement.classList.add('visible');
	}
}

card.on('change', function(event) {
	setOutcome(event);
});

document.querySelector('form').addEventListener('submit', function(e) {
	e.preventDefault();
	$('#btn_payment').prop('disabled', false);
	var form = document.querySelector('form');
	var $form = $('#payment-form');
	$form.find('button').prop('disabled', false);
	var extraDetails = {
		name: form.querySelector('input[name=cardholder-name]').value,
	};
	stripe.createToken(card, extraDetails).then(setOutcome);
});
</script>
</body>
</html>


