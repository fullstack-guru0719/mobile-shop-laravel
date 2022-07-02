<div class="modal fade" id="modal-section" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="section-form" action="{{ url('admin/settings/pages/manage') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label>Header</label>
              <input type="text" name="header" id="section-header" class="form-control form-control-sm">
              <span class="invalid-feedback">The header field is required.</span>
            </div>
            <div class="form-group">
              <label>Sub Header</label>
              <input type="text" name="sub_header" id="section-sub-header" class="form-control form-control-sm">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Header Text Color</label>
                  <select class="custom-select" name="header_color" id="section-header-color" style="height: 34px; line-height: 1">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Sub Header Text Color</label>
                  <select class="custom-select" name="sub_header_color" id="section-sub-header-color" style="height: 34px; line-height: 1">
                    <option value="light">Light</option>
                    <option value="dark">Dark</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Background Color</label>
              <div class="input-group">
                <input type="text" name="background_color" id="section-bg-color" class="form-control colorpicker" style="height: 18px;" value="#eee">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Background Image</label>
              <div id="section-div-file">
                <input type="file" name="background_image" class="form-control-file" id="section-bg-file">
                <small class="form-text text-muted">Upload Image with dimensions higher or equal to 1920 x 1080</small>
              </div>
              <div style="display: none;" id="section-div-bgimage">
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-sm" id="section-image-val" disabled>
                  <div class="input-group-append">
                    <button class="btn btn-outline-danger btn-sm" type="button" id="section-remove-image"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="type" value="section" />
          <input type="hidden" name="page_id" value="{{ $page_id }}" />
          <input type="hidden" name="section_id" id="sec_id" />
          <button type="button" class="btn btn-default" data-dismiss="modal" id="section-close">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
          <a href="{{ url('admin/settings/pages') }}" class="btn btn-default" id="back-btn">Back</a>
        </div>      
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-row">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="row-form" action="{{ url('admin/settings/pages/manage') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label>How many columns you want to add in this new row?</label>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Columns</label>
                  {!! Form::selectRange('columns', 1, 4, '', ['class'=>'form-control form-control-sm', 'id'=>'columns']) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" id="column-ratio" style="display: none;">
                  <label>Column Ratio</label>
                  {!! Form::select('column_ratio', $ratio, '', ['class'=>'form-control form-control-sm']) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="type" value="row" />
          <input type="hidden" name="section_id" id="section_id" />
          <input type="hidden" name="page_id" value="{{ $page_id }}" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>      
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-content">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card-body text-center">
          <a class="btn btn-app" onclick="content('paragraph')">
            <i class="fas fa-align-left"></i> Add Paragraph
          </a>
          <a class="btn btn-app" onclick="content('heading')">
            <i class="fas fa-heading"></i> Add Header
          </a>
          <a class="btn btn-app" onclick="content('image')">
            <i class="fas fa-image"></i> Add Image
          </a>
          <a class="btn btn-app" onclick="content('video')">
            <i class="fab fa-youtube"></i> Add Video
          </a>
          <a class="btn btn-app" onclick="content('link')">
            <i class="fas fa-link"></i> Add Link
          </a>
        </div>
        <div class="card" id="div-paragraph" style="display: none;">
          <div class="card-body">
            <form method="POST" id="paragraph-form" action="{{ url('admin/settings/pages/manage') }}">
              @csrf
              <textarea class="textarea" name="paragraph" placeholder="Place some text here" style="width: 100%"></textarea>
              <div class="form-group">
                <label>Text Color</label>
                <select class="custom-select" name="paragraph_color" style="height: 34px; line-height: 1">
                  <option value="light">Light</option>
                  <option value="dark">Dark</option>
                </select>
              </div>
              <div class="form-group">
                <input type="hidden" name="type" value="paragraph" />
                <input type="hidden" name="column_id" class="column-id" />
                <input type="hidden" name="column" class="column" />
                <input type="hidden" name="content_id" class="content-id" />
                <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card" id="div-heading" style="display: none;">
          <div class="card-body">
            <form method="POST" id="header-form" action="{{ url('admin/settings/pages/manage') }}">
              @csrf
              <div class="form-group">
                <label>Header</label>
                <input type="text" name="header" id="header" class="form-control form-control-sm">
                <span class="invalid-feedback">The header field is required.</span>
              </div>
              <div class="form-group">
                <input type="hidden" name="type" value="header" />
                <input type="hidden" name="column_id" class="column-id" />
                <input type="hidden" name="column" class="column" />
                <input type="hidden" name="content_id" class="content-id" />
                <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card" id="div-image" style="display: none;">
          <div class="card-body">
            <form method="POST" id="image-form" action="{{ url('admin/settings/pages/manage') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Image</label>
                <div id="input-file">
                  <input type="file" name="image" class="form-control-file form-control-sm" id="input-image" required>
                </div>
                <div class="input-group mb-3" style="display: none;" id="image-file">
                  <input type="text" class="form-control form-control-sm" id="image-val" disabled>
                  <div class="input-group-append">
                    <button class="btn btn-outline-danger btn-sm" type="button" id="remove-image"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Image Alignment</label>
                {!! Form::select('align', $alignment, '', ['class'=>'custom-select','style'=>'height: 34px; line-height: 1','id'=>'alignment']) !!}
              </div>
              <div class="form-group">
                <input type="hidden" name="type" value="image" />
                <input type="hidden" name="column_id" class="column-id" />
                <input type="hidden" name="column" class="column" />
                <input type="hidden" name="content_id" class="content-id" />
                <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card" id="div-video" style="display: none;">
          <div class="card-body">
            <form method="POST" id="youtube-form" action="{{ url('admin/settings/pages/manage') }}">
              @csrf
              <div class="form-group">
                <label>Youtube URL</label>
                <input type="text" name="youtube_url" id="youtube_url" class="form-control form-control-sm">
                <span class="invalid-feedback">The youtube url field is required.</span>
              </div>
              <div class="form-group">
                <label>Video Ratio</label>
                {!! Form::select('ratio', $videoratio, '', ['class'=>'custom-select','style'=>'height: 34px; line-height: 1','id'=>'vratio']) !!}
              </div>
              <div class="form-group">
                <input type="hidden" name="type" value="video" />
                <input type="hidden" name="column_id" class="column-id" />
                <input type="hidden" name="column" class="column" />
                <input type="hidden" name="content_id" class="content-id" />
                <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card" id="div-link" style="display: none;">
          <div class="card-body">
            <form method="POST" id="link-form" action="{{ url('admin/settings/pages/manage') }}">
              @csrf
              <div class="form-group">
                <label>Link Value</label>
                <input type="text" name="link_value" id="link_value" class="form-control form-control-sm">
                <span class="invalid-feedback">The live value field is required.</span>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Link URL</label>
                    <input type="url" name="link_url" id="link_url" class="form-control form-control-sm">
                    <span class="invalid-feedback">The link url field is required.</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Link Target</label>
                    <select name="link_target" id="link_target" class="custom-select" style="height: 34px; line-height: 1">
                      <option value="">Same Page</option>
                      <option value="_blank">New Window</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <input type="hidden" name="type" value="link" />
                <input type="hidden" name="column_id" class="column-id" />
                <input type="hidden" name="column" class="column" />
                <input type="hidden" name="content_id" class="content-id" />
                <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> 
    </div>
  </div>
</div>