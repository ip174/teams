<div class="modal fade raiseInvoiceModal" id="raiseInvoiceModal" role="dialog">
	<!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
	<div class="modal-dialog1 container modalcontainer" role="document">
	    
        <form action="{{ url('/payments/create-invoice') }}" name="invoiceCreateFrm" method="post">
            {{ csrf_field() }}
        <input type="hidden" name="job_id" value="{{ $job_id }}">
        <input type="hidden" name="proposal_id" value="{{ isset($proposal_id) ? $proposal_id : '' }}">
        <input type="hidden" name="user_for_job_posted" value="{{ isset($jobDetails->posted_by_user) ? $jobDetails->posted_by_user : '' }}">
        <input type="hidden" name="user_for_proposal" value="{{ $proposalByUser }}">
        <div class="modal-content">
	      <div class="modal-header newMheader">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h2 class="mr0 task_titel">Raise Invoice</h2>
	      </div>
	      <div class="greybg panel-body">
	      	<h3 class="invtitle">Why are you raising an invoice? <span class="badge bg-success nobg">?</span></h3>
	      	<div class="radio radionlist">
				<label class="i-checks block">                                
					<input type="radio" class="noother" name="checkmeinvoice" value="I have completed and delivered the job as per contract agreement with the hirer." required><i></i>
					I have completed and delivered the job as per contract agreement with the hirer.
                </label>

				<label class="i-checks block">                                
					<input type="radio" class="noother" name="checkmeinvoice" value="I have completed and delivered the message the agreed milestone." required><i></i>
					I have completed and delivered the message the agreed milestone.
                </label>
				<label class="i-checks block">                                
					<input type="radio" class="showother" name="checkmeinvoice" value="Others" required><i></i>
					Others
                </label>
                <div class="`form-group showmeother newform" style="display:none;">
                	<input type="text" class="form-control" placeholder="Write the resson if you've chosen others..." name="raise_invoice_others">
                </div>
            </div>
          </div>

    <div class="panel-body newform">
        
        <div class="clearfix createsectitle">
        	<h2 class="mr0 task_titel pull-left">Create a new invoice</h2>
        	<h3 class="smgreytitle pull-right">
                <!-- Funds in escrew (estimated GBP value): <span class="text-success">£560.00</span> -->
            </h3>
    	</div>
        <div>
        	<div class="row itemformclone">
        		<div class="col-sm-3">
        			<label>Description</label>
        			<input type="text" class="form-control" placeholder="Item description..." name="invoice_description[]" required>
        		</div>
        		<div class="col-sm-1">
        			<label>Quantity</label>
        			<input type="text" class="form-control quantity1" name="quantity[]" onkeyup="calculateAmount(1); numeric_only(this)" min="1" required>
        		</div>
        		<div class="col-sm-2">
        			<label>Type</label>
        			<select class="form-control minimal" name="invoice_type[]">
        				<option value="Fixed">Fixed</option>
        				<option value="Hourly">Hourly</option>
        			</select>
        		</div>

                <div class="col-sm-2">
                    <label>Unit Cost</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">£</div>
                            <input type="text" class="form-control unit_cost1" name="unit_cost[]" onkeyup="calculateAmount(1); numeric_with_dot(this)" min="0" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label>Time Period</label>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon withimage"><img src="{{asset('assets/frontend/images/calender_ico.png')}}"></div>
                            <input type="text" class="form-control time_period" placeholder="6/10 - 6/11" name="time_period[]" id="time_period" required>
                            <!--<input type="text" name="daterange" value="01/01/2015 1:30 PM - 01/01/2015 2:00 PM" />-->
                        </div>
                    </div>
                </div>
        		<div class="col-sm-2">
        			<label>Amount(Fixed Fee)</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">£</div>
                            <input type="text" class="form-control amount_fixed_cost1" placeholder="0.00" name="amount_fixed_cost[]" keyup="calculateTotalAmount()" readonly>
                        </div>
                    </div>
        		</div>
        	</div>
            <div class="moreInvoiceArea"></div>
            <div class="showcloneditemform"></div>
            <a class="clonetheform textfradd" href="javascript:void(0);">+ Add another item</a>
        </div>

        <div class="clearfix">
            <div class="row">
                <div class="col-sm-7 hidden-xs"></div>
                <label class="col-sm-3 text-right">VAT % <span class="badge badge-success">?</span></label>
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">£</div>
                            <input type="text" class="form-control vat_percent" name="vat_percent" onkeyup="numeric_with_dot(this); calculateTotalAmount();" min="0" max="100" required value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7 hidden-xs"></div>
                <label class="col-sm-3 text-right">Total <span class="badge badge-success">?</span></label>
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">£</div>
                            <input type="text" class="form-control total_invoice_amount" placeholder="0.00" name="total_invoice_amount" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer clearfix">
            <label class="pull-left labelMfoter">
                <input type="checkbox" class="hidden" name="terms_condition" value="1" required>
                <i class="checknew"></i>
                I acknowledge that all billing regarding this job (including follow on work) has to be conducted throgh teams Network in order to comply with Teams Network policy
            </label>
            <input type="submit" class="btn btn-success pull-right" value="SEND INVOICE" name="raiseInvoiceBtn">
        </div>
</div>
	       </div>
        </form>
    </div>

</div>