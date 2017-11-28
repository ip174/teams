<!-- Add Review feedback Modal View Modal -->
<div class="modal fade rfModal" id="reviewfeedModal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close style" data-dismiss="modal">&times;</button>
				<h1 class="modal-title">Review & feedback</h1>
			</div>
			<form action="" method="post" id="reviewForm">
				{{ csrf_field() }}
				<input type="hidden" name="modal_job_id" class="modal_job_id" value="" />
				<input type="hidden" name="modal_review_val" class="modal_review_val" value="" />
				<div class="modal-body" style="margin-top:-15px;">
					<p class="validationMsg"></p>
					<p class="txtrfinfo">How was your experience working with this work?</p>
					<div class="ratinguc">
						<div class="rate">
						    <input type="radio" id="rating10" name="rating" value="5" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="fullstar" for="rating10" title="5 stars"></label>

						    <input type="radio" id="rating9" name="rating" value="4.5" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="half" for="rating9" title="4 1/2 stars"></label>

						    <input type="radio" id="rating8" name="rating" value="4" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="fullstar" for="rating8" title="4 stars"></label>

						    <input type="radio" id="rating7" name="rating" value="3.5" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="half" for="rating7" title="3 1/2 stars"></label>

						    <input type="radio" id="rating6" name="rating" value="3" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="fullstar" for="rating6" title="3 stars"></label>

						    <input type="radio" id="rating5" name="rating" value="2.5" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="half" for="rating5" title="2 1/2 stars"></label>

						    <input type="radio" id="rating4" name="rating" value="2" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="fullstar" for="rating4" title="2 stars"></label>

						    <input type="radio" id="rating3" name="rating" value="1.5" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="half" for="rating3" title="1 1/2 stars"></label>

						    <input type="radio" id="rating2" name="rating" value="1" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="fullstar" for="rating2" title="1 star"></label>

						    <input type="radio" id="rating1" name="rating" value="0.5" onclick="$('.modal_review_val').val((this.value))" />
						    <label class="half" for="rating1" title="1/2 star"></label>
						</div>
					</div>

					<div class="form-group">
						<label>Please leave a review feedback</label>
						<textarea class="form-control reviewComment" placeholder="Describe how your experience..." cols="" rows="12" name="reviewComment"></textarea>
					</div>
					<div class="clearfix">
						<p class="pull-left">PLease note that this will be a public review feedback</p>
						<input type="button" class="btn btn-success pull-right" value="SEND" name="submitReview" onclick="saveReview()">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Add Portfolio View Modal End -->