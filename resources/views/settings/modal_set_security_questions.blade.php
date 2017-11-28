<div id="securityQuestionModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Security Question</h4>
      </div>
      <div class="modal-body password_change_modal">
        <form action="{{ url('') }}" id="security_question_form" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Select Question*</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="form-group">
                <select name="security_question" class="form-control" id="security_question" required>
                  <option value=""> -Select- </option>
                  @if(count($SecurityQuestions) > 0)
                    @foreach($SecurityQuestions as $each_question)
                      <option value="{{ $each_question->id }}"> {{ $each_question->question }} </option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Your Answer*</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="form-group">
                <input type="text" class="form-control" name="security_question_answer" id="security_question_answer" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
              <input type="submit" class="btn btn-success" name="security_question" value="Update">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>