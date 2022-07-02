<div class="modal fade" id="modal-page">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create Page</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{ url('admin/settings/pages') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label>Page Title</label>
              <input type="text" name="title" id="page-title" class="form-control" placeholder="Enter page title">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="id" id="page_id" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>      
      </form>
    </div>
  </div>
</div>