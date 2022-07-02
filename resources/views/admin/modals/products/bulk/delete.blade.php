<div class="modal fade" id="bulk-delete-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deleting all the selected items</h5>
            </div>
            <div class="modal-body">
                <h6>Are you sure you want to delete all selected products?</h6>
                <span class="text-danger">Note! This cannot be undone</span>
                <form action="{{ url('/admin/products/bulk-delete') }}" method="POST" id="bulk-delete-form">
                    @csrf
                    @method("DELETE")

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">
                    Close
                </button>
                <button class="btn btn-danger" type="button" id="bulk_delete_submit">
                    Delete
                </button>
            </div> 
        </div>
    </div>
</div>