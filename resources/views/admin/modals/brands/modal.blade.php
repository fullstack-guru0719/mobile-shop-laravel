<div class="modal fade" id="modal-brand" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create Brand</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="POST" id="brand-form">
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label class="col-form-label col-form-label-sm">Device Type</label>
              {!! Form::select('device_type', $types, '', ['class'=>'custom-select select-sm','id'=>'device_type']) !!}
            </div>
            <div class="form-group">
              <label class="col-form-label col-form-label-sm">Brand Name</label>
              <input type="text" name="name" id="brand-name" class="form-control form-control-sm" placeholder="Enter brand name">
            </div>
            <div class="form-group">
              <label class="col-form-label col-form-label-sm">Brand Photo</label>
              <div id="image-file">
                <input type="file" name="photo" class="custom-file">
              </div>
              <div style="display: none;" id="div-image">
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-sm" id="image-val" disabled>
                  <div class="input-group-append">
                    <button class="btn btn-outline-danger btn-sm" type="button" id="remove-image"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-5">
                <label class="col-form-label col-form-label-sm">Display to Home page</label>
                {!! Form::select('feature', $featureList, '', ['class'=>'custom-select select-sm','id'=>'feature']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="id" id="brand_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="brand-submit">Save changes</button>
        </div>      
      </form>
    </div>
  </div>
</div>