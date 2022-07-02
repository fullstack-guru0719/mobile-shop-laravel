<form action="{{ url('admin/settings/pages/storestatic') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Google Map</label>
      <input type="text" name="google_map" class="form-control form-control-sm" value="{{ $result->google_map }}" />
    </div>
    <div class="form-group col-md-6">
      <label>Image</label>
      @if(isset($result->image) && File::exists($result->image))
      <div id="div-image-4">
        <div class="input-group mb-3">
          <input type="text" class="form-control form-control-sm" value="{{ basename($result->image) }}" disabled>
          <div class="input-group-append">
            <button class="btn btn-outline-danger btn-sm" type="button" onclick="removeImage('<?php echo $result->image; ?>', 4)"><i class="fas fa-trash-alt"></i></button>
          </div>
        </div>
      </div>
      @else
      <input type="file" name="bgimage4" class="form-control-file">
      @endif
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Schedule <i class="far fa-clock fa-fw"></i></label>
      <input type="text" name="schedule" class="form-control form-control-sm" value="{{ $result->schedule }}" />
    </div>
    <div class="form-group col-md-6">
      <label>Location <i class="fas fa-map-marker-alt fa-fw"></i></label>
      <input type="text" name="location" class="form-control form-control-sm" value="{{ $result->location }}" />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Contact <i class="fas fa-phone fa-fw"></i></label>
      <input type="text" name="contact" class="form-control form-control-sm" value="{{ $result->contact }}" />
    </div>
    <div class="form-group col-md-6">
      <label>Email Address <i class="fas fa-at fa-fw"></i></label>
      <input type="text" name="email" class="form-control form-control-sm" value="{{ $result->email }}" />
    </div>
  </div>
  <div class="form-group">
    <div class="text-center">
      <input type="hidden" name="type" value="contact" />
      <input type="hidden" name="page_id" value="{{ $page_id }}" />
      <button type="submit" class="btn btn-primary btn-flat">Save Changes</button>
    </div>
  </div>
</form>