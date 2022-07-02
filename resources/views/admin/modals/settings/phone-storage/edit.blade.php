<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="edit-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Phone Storage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Capacity</label>
                        <input type="text" id="edit-phone-storage-capacity" name="name" class="form-control">
                        <small class="text-danger d-none" id="edit-phone-storage-name-error">Capacity is required.</small>
                    </div>  
                    <div class="form-group">
                        <label for="name">Label</label>
                        <input type="text" id="edit-phone-storage-label" name="name" class="form-control">
                        <small class="text-danger d-none" id="edit-phone-storage-label-error">Label required.</small>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
