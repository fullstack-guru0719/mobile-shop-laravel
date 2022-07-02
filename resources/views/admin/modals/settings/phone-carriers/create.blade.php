<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="create-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Phone Carrier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="create-phone-carrier-name" name="name" class="form-control">
                        <small class="text-danger d-none" id="create-phone-carrier-name-error">Phone name is required.</small>
                    </div>  
                    <div class="form-group">
                        <label for="iamge">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="create-phone-carrier-image" aria-describedby="inputGroupFileAddon04">
                              <label class="custom-file-label" id="create-phone-carrier-image-label" for="create-phone-carrier-image">Choose file</label>
                            </div>
                        </div>
                        <small class="text-gray" id="create-phone-carrier-image-error">You can leave this empty use the current image.</small>
                    </div>
                    <div class="w-50 mr-auto ml-auto">
                        <img src="" alt="" id="create-image-container" class="w-100 d-none" style="height: 10rem;">
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
