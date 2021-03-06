<div class="modal fade" id="acceptModal" role="dialog" style="display:none;">
	<div class="container modalcontainer">
	  <!-- Modal content-->
	  <div class="modal-content">        
		<button type="button" class="close" data-dismiss="modal">×</button>
		<div class="modal-body">
			<div class="col-xs-12">
			<a href="javascript:void(0)" class="text-success backlink">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
				BACK TO PROPOSAL
			</a>
			</div> 
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 full-vxs">
				<center><img src="{{ asset('assets/frontend/images/acceptmodal_src.png') }}"></center>
				<center><h1 class="infoh1">Your money is protected in our secure escrew system.</h1>
				<p class="smallinfop"><a href="javascript:void(0)">Learn more</a> about our Payment Protection.</p></center>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 full-vxs">
				<h2 class="acotitle gpbottom">Your job is just a step away to get started.</h2>
				<p class="smallinfop">Please pay the required deposite amount of 
					@php
					$totalEstimatedAmount=0;
					if(count($porposalAmount) > 0){
						foreach($porposalAmount as $eachAmount){
							$totalEstimatedAmount += $eachAmount->amount;
						}
					}
					@endphp
					£ {{ $totalEstimatedAmount }}
				to
				@php
				$frelancerName = $proposalDetails->user->first_name.' '.$proposalDetails->user->last_name;
				$frelancerNameSlug = str_replace(' ', '-', trim(strtolower($frelancerName)));
				@endphp
				<a href="{{ url('/freelancers/freelancer-details/'.$frelancerNameSlug.'/'.$proposalDetails->sent_by_user) }}" target="_blank">{{ $frelancerName }}</a>
				to get the job started.</p>
				<form action="{{ url('/jobs/pay-now') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="job_id" value="{{ $job_id }}">
					<input type="hidden" name="proposal_id" value="{{ $proposal_id }}">
					<div class="accordianset panel-group" id="accordion">
						<div class="panel panel-default default visible">
						  <div class="panel-heading">
							<h4 class="panel-title">
								<label for="r11">
									<input class="hidden" checked="" type="radio" id="r11" name="paymentoption" value="S" required="">
									<i class="chekradio"></i>
									<span class="pull-left">Credit &amp; Debit cards
										<small>Transaction fee may apply</small>
									</span>
									<img src="{{ asset('assets/frontend/images/cards.png') }}" class="img-responsive pull-right">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"></a>
								</label>
							</h4>
						  </div>
						  <div id="collapseOne" class="panel-collapse collapse in">
							<!--<div class="panel-body">
								<div class="form-group">
									<label>Name</label>
									<input name="cardholder-name" class="form-control field" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" readonly/>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input class="form-control field" type="email" value="{{ Auth::user()->email }}" readonly />
								</div>
								<div class="form-group">
									<label>
										<span>Card</span>
										<div id="card-element" class="field"></div>
									</label>
								</div>
								<div class="form-group">
									<label>Card Number</label>
									<div class="visasrc">
										<img src="{{ asset('assets/frontend/images/visasrc.png') }}">
										<input type="text" class="form-control" name="">
									</div>
								</div>
								<div class="smallinput form-group row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 enddatecol">
										<label>End Date</label>
										<div class="row">
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 withinlineq">
												<input type="text" placeholder="mm" class="form-control" name="">
												<span class="inputque">?</span>
											</div>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 withinlineq">
												<input type="text" placeholder="yyyy" class="form-control" name="">
												<span class="inputque">?</span>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 cvvcol">
										<label>CVV</label>
										<div class="row">
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">	
												<input type="text" class="form-control" name="">
											</div>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">	
											<span class="inputque">?</span> <span>3 digits</span>
											</div>
										</div>
									</div>
								</div>
								<p class="agreetext form-group">I have read and accept the term of use and privacy policy</p>
								<input type="button" class="btn btn-success btn-block text-center paynowbtn" value="Pay Now" name="">
							</div>-->
						  </div>
						</div>
						<div class="panel panel-default default one">
						  <div class="panel-heading">
							<h4 class="panel-title">
								<label for="r12">
								  <input class="hidden" type="radio" id="r12" name="paymentoption" value="" required="">
								  <i class="chekradio"></i>
								  <span> Online banking &amp; Direct debit
									  <small>Free of charge</small>
								  </span>
								  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"></a>
								</label>
							</h4>
						  </div>
						  <div id="collapseTwo" class="panel-collapse collapse">
							
						  </div>
						</div>

						<div class="panel panel-default default two">
						  <div class="panel-heading">
							<h4 class="panel-title">
								<label for="r13">
								  <input class="hidden" type="radio" id="r13" name="paymentoption" value="" required="">
								  <i class="chekradio"></i>
								  <span class="pull-left"> Online banking &amp; Direct debit 
									<small>Free of charge</small>
								  </span>
								  <img src="{{ asset('assets/frontend/images/paypal.png') }}" class="img-responsive pull-right">
								  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"></a>
								</label>
							</h4>
						  </div>
						  <div id="collapseThree" class="panel-collapse collapse">
							
						  </div>
						</div>
						
						<div class="panel panel-default default">
							<input type="submit" class="btn btn-success btn-block text-center paynowbtn" value="Pay Now" name="">
						</div>
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	  </div>
	</div>
</div>