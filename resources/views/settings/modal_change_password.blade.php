<div id="changePassModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body password_change_modal">
        <form action="{{ url('') }}" id="change_password_form" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Old Password</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="form-group">
                <input type="password" class="form-control" name="old_password" id="old_password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>New Password</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="form-group">
                <input type="password" class="form-control" name="password" id="password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Confirm Password</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
              <input type="submit" class="btn btn-success" name="changePass" value="Update">
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