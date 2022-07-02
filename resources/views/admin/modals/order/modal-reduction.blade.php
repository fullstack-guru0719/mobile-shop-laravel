<div class="modal fade" id="modal-reduction-order" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adjust Cash Offer</h4>
            </div>
            <form role="form" method="POST" id="modal-reduction-order-form">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Adjust to:</label>
                                <input type="number" id="reduction" name="reduction" class="form-control cart-item-quantity modal-reduction-status-id" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <input type="hidden" id="selectedOrderId" name="hashedid">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm modal-button-order-reduction">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>