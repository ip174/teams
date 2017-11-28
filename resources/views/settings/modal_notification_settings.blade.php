<div id="notificationSettingModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Notification Settings</h4>
      </div>
      <div class="modal-body notificationSetting_change_modal">
        <form action="{{ url('/settings/change-notification-settings') }}" name="notificationSetting_form" id="notificationSetting_form" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Send me notifications for</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="form-group">
                @if(count($notificationMasterArray) > 0)
                  <select name="getNotificationFor" class="getNotificationFor" id="getNotificationFor" multiple>
                    <option value=""> -Select- </option>
                    @foreach($notificationMasterArray as $eachRow)
                    <option value="{{ $eachRow->id }}">{{ $eachRow->details }}</option>
                    @endforeach
                  </select>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
              <input type="button" class="btn btn-success notificationSetting" name="notificationSetting" value="Update">
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