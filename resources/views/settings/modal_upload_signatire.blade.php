<div id="uploadSignatureModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Signature</h4>
      </div>
      <div class="modal-body password_change_modal">
        <form action="{{ url("/settings/upload-profile-signature") }}" id="profile_signature_form" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Browse Signature*</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="form-group">
                <input name="profileSignatureImage" id="profileSignatureImage" type="file" 
    onchange="document.getElementById('viewImage').src = window.URL.createObjectURL(this.files[0])" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">&nbsp;</div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="form-group">
                <img id="viewImage" alt="" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
              <input type="submit" class="btn btn-success" name="submit_signature" value="Save">
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