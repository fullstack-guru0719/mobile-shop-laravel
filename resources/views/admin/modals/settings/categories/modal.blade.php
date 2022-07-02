<div class="modal fade" id="modal-category" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal-category-form">
                <div class="modal-body">
                    <div class="card-body padding0">
                        <div class="form-group">
                            <label class="">Category Name</label>
                            <input type="text" name="name" id="modal_category_name" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id" id="modal_category_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="brand-submit">Save changes</button>
                </div>      
            </form>
        </div>
    </div>
</div>