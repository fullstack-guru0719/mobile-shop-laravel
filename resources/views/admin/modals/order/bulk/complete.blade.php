<div class="modal fade" id="modal-bulk-status-order" aria-hidden="true">
    <!-- <div class="modal fade" id="bulk-complete-modal" aria-hidden="true"> -->
    <div class="modal-dialog">
        <form action="{{ route('orders.bulk_update') }}" method="POST" id="bulk-complete-form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update orders</h5>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Change Status to:</label>
                                <select name="status-id" class="custom-select select-sm modal-bulk-order-status-id"></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group modal-bulk-status-template-sms hideme">
                                <select name="sms_template_id" class="form-control form-control-sm" id="modal-bulk-status-select-template-sms"></select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm modal-button-bulk-order-status-id">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>