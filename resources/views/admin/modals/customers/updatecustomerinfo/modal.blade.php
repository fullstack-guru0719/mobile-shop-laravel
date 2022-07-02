<div class="modal fade" id="modal-update-customer-info" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Customer Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal-update-customer-info-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group mb-1 col-md-6">
                            <label class="col-form-label col-form-label-sm">First name <span class="text-red">*</span></label>
                            <input name="fname" class="form-control" id="fname" />
                        </div>
                        <div class="form-group mb-1 col-md-6">
                            <label class="col-form-label col-form-label-sm">Last name <span class="text-red">*</span></label>
                            <input name="lname" class="form-control" id="lname" />
                        </div>
                    </div>

                    <div class="form-group mb-1">
                        <label class="col-form-label col-form-label-sm">Email <span class="text-red">*</span></label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>

                    <div class="form-group mb-1">
                        <label class="col-form-label col-form-label-sm">Mobile number <span class="text-red">*</span></label>
                        <input name="bill_phone" class="form-control" id="bill_phone">
                    </div>

                    <div class="form-group mb-1">
                        <label class="col-form-label col-form-label-sm">Billing street</label>
                        <input name="bill_street" class="form-control" id="bill_street">
                    </div>

                    <div class="row">
                        <div class="form-group mb-1 col-md-6">
                            <label class="col-form-label col-form-label-sm">Billing City</label>
                            <input name="bill_city" class="form-control" id="bill_city" />
                        </div>
                        <div class="form-group mb-1 col-md-6">
                            <label class="col-form-label col-form-label-sm">Billing State</label>
                            <input name="bill_state" class="form-control" id="bill_state" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="customer_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning text-white" id="save_customer_info">Save</button>
                </div>      
            </form>
        </div>
    </div>
</div>