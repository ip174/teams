<div class="modal fade invoicePaymentmodal" id="invoicePaymentmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="{{ URL('/invoice/pay-invoice') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="invoiceId" class="invoiceId" />
        <input type="hidden" name="payableAmount" class="payableAmount" />
      <div class="modal-header newMheader">
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	    	<h2 class="mr0 task_titel">Pay Now</h2>
	  </div>
      <div class="modal-body">

        <h4 class="task_titel titlenew">Select your payment method</h4>

        <div class="radio newradiosty">
        	<label>
        		<input checked="" type="radio" class="hidden" name="paymethod" required value="VISA">
        		<div class="radionstle">
        			<i class="checks"></i>
        			<i class="fa fa-cc-visa" aria-hidden="true"></i>
        			<strong>Visa</strong> (ending in 2342)
        		</div>
        	</label>
        	<label>
        		<input type="radio" class="hidden" name="paymethod" required value="PAYPAL_BILLING">
        		<div class="radionstle">
        			<i class="checks"></i>
        			<i class="fa fa-credit-card-alt" aria-hidden="true"></i>
        			<strong>PayPal Billing Agreement</strong> (PayPal Billing Agreement)
        		</div>
        	</label>

        	<label>
        		<input type="radio" class="hidden" name="paymethod" required value="CREDITCARD">
        		<div class="radionstle">
        			<i class="checks"></i>
        			<div class="pull-left">
	        			<i class="fa fa-credit-card-alt" aria-hidden="true"></i>
	        			<strong>Credit Card - Add new</strong>

	        		</div>
	        		<div class="pull-right">
	        			<img src="{{asset('assets/frontend/images/cards-paymethod.png')}}" class="img-responsive">
	        		</div>
	        		<div class="clearfix"></div>
        		</div>
        	</label>
        	<label>
        		<input type="radio" class="hidden" name="paymethod" required value="PAYPAL">
        		<div class="radionstle">
        			<i class="checks"></i>
        			<div class="pull-left">
	        			<i class="fa fa-paypal" aria-hidden="true"></i>
	        			<strong>PayPal</strong>

	        		</div>
	        		<div class="pull-right">
	        			<img src="{{asset('assets/frontend/images/paypal-new.png')}}" class="img-responsive">
	        		</div>
	        		<div class="clearfix"></div>
        		</div>
        	</label>
        	
        	<label>
        		<input type="radio" class="hidden" name="paymethod" required value="BANK_TRANSFER">
        		<div class="radionstle">
        			<i class="checks"></i>
        			<div class="pull-left">
	        			<i class="fa fa-university" aria-hidden="true"></i>
	        			<strong>Bank Transfer</strong> (can take 3-5 business days)

	        		</div>
	        		<div class="pull-right">
	        			<img src="{{asset('assets/frontend/images/bank-new.png')}}" class="img-responsive">
	        		</div>
	        		<div class="clearfix"></div>
        		</div>
        	</label>

        	<label>
        		<input type="radio" class="hidden" name="paymethod" required value="OTHER">
        		<div class="radionstle">
        			<i class="checks"></i>
        			<div class="pull-left">
	        			<img src="{{asset('assets/frontend/images/other-card.png')}}" class="img-responsive inline">&nbsp;
	        			<strong>Other</strong>

	        		</div>
	        		<div class="pull-right">
	        			<img src="{{asset('assets/frontend/images/other-paymenthod.png')}}" class="img-responsive">
	        		</div>
	        		<div class="clearfix"></div>
        		</div>
        	</label>
        </div>

    	<div class="clearfix btnMbottom">
	        <label class="pull-left labelMfoter inline">
	            <input type="checkbox" class="hidden" name="terms_condition" value="1" required />
	            <i class="checknew"></i>
	            <p>By clicking Deposit Funds, You agree with our</p>
	        </label>&nbsp;
	        <a href="javascript:void(0);" class="linkltxt pull-left">terms & conditions, Fees</a>
	        <!-- <input type="button" class="btn btn-success pull-right" value="SEND INVOICE" name="raiseInvoiceBtn"> -->
            <input type="submit" class="btn btn-success pull-right" value="CONTINUE" name="depositeFunds">
	    </div>

      </div>
      <!-- <div class="modal-footer clearfix">
        <label class="pull-left labelMfoter">
            <input type="checkbox" class="hidden" name="terms_condition" value="1">
            <i class="checknew"></i>
            I acknowledge that all billing regarding this job (including follow on work) has to be conducted throgh teams Network in order to comply with Teams Network policy
        </label>
        <input type="button" class="btn btn-success pull-right" value="SEND INVOICE" name="raiseInvoiceBtn">
    </div> -->
    </form>
    </div>
  </div>
</div>