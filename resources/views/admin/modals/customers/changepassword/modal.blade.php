<div class="modal fade" id="modal-changepassword" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal-profile-form">
                <div class="modal-body">
                    <div class="card-body padding0">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">New Password <span class="text-red">*</span></label>
                            <input type="password" name="password" class="form-control" id="new-password">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Re-type Password <span class="text-red">*</span></label>
                            <input type="password" name="retype-password" class="form-control" id="retype-password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id" id="modal_customer_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" id="profile-submit">Ok</button>
                </div>      
            </form>
        </div>
    </div>
</div>