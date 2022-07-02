<form action="{{ url('admin/settings/pages/storestatic') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-4">
      <label class="col-form-label col-form-label-sm">Image 1</label>
      @if(isset($result->image1) && File::exists($result->image1))
      <div id="div-image-1">
        <div class="input-group mb-3">
          <input type="text" class="form-control form-control-sm" value="{{ basename($result->image1) }}" disabled>
          <div class="input-group-append">
            <button class="btn btn-outline-danger btn-sm" type="button" onclick="removeImage('<?php echo $result->image1; ?>', 1)"><i class="fas fa-trash-alt"></i></button>
          </div>
        </div>
      </div>
      @else
      <input type="file" name="bgimage1" class="form-control-file">
      @endif
    </div>
    <div class="form-group col-md-4">
      <label class="col-form-label col-form-label-sm">Image 2</label>
      @if(isset($result->image2) && File::exists($result->image2))
      <div id="div-image-2">
        <div class="input-group mb-3">
          <input type="text" class="form-control form-control-sm" value="{{ basename($result->image2) }}" disabled>
          <div class="input-group-append">
            <button class="btn btn-outline-danger btn-sm" type="button" onclick="removeImage('<?php echo $result->image2; ?>', 2)"><i class="fas fa-trash-alt"></i></button>
          </div>
        </div>
      </div>
      @else
      <input type="file" name="bgimage2" class="form-control-file">
      @endif
    </div>
    <div class="form-group col-md-4">
      <label class="col-form-label col-form-label-sm">Image 3</label>
      @if(isset($result->image3) && File::exists($result->image3))
      <div id="div-image-3">
        <div class="input-group mb-3">
          <input type="text" class="form-control form-control-sm" value="{{ basename($result->image3) }}" disabled>
          <div class="input-group-append">
            <button class="btn btn-outline-danger btn-sm" type="button" onclick="removeImage('<?php echo $result->image3; ?>', 3)"><i class="fas fa-trash-alt"></i></button>
          </div>
        </div>
      </div>
      @else
      <input type="file" name="bgimage3" class="form-control-file">
      @endif
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label class="col-form-label col-form-label-sm">Message Box 1</label>
      <input type="text" name="header_2" class="form-control form-control-sm" placeholder="Header 1" value="{{ $result->header_2 }}" />
      <textarea class="form-control form-control-sm textarea" name="text_2">{{ $result->text_2 }}</textarea>
    </div>
    <div class="form-group col-md-6">
      <label class="col-form-label col-form-label-sm">Message Box 2</label>
      <input type="text" name="header_3" class="form-control form-control-sm" placeholder="Header 2" value="{{ $result->header_3 }}" />
      <textarea class="form-control form-control-sm textarea" name="text_3">{{ $result->text_3 }}</textarea>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label class="col-form-label col-form-label-sm">Message Box 3</label>
      <input type="text" name="header_4" class="form-control form-control-sm" placeholder="Header 3" value="{{ $result->header_4 }}" />
      <textarea class="form-control form-control-sm textarea" name="text_4">{{ $result->text_4 }}</textarea>
    </div>
    <div class="form-group col-md-6">
      <label class="col-form-label col-form-label-sm">Header</label>
      <input type="text" name="social_text" class="form-control form-control-sm" value="{{ $result->social->text }}">
      <label class="col-form-label col-form-label-sm">Facebook Like</label>
      <input type="text" name="facebook" class="form-control form-control-sm" value="{{ $result->social->facebook }}">
      <label class="col-form-label col-form-label-sm">Twitter Link</label>
      <input type="text" name="twitter" class="form-control form-control-sm" value="{{ $result->social->twitter }}">
      <label class="col-form-label col-form-label-sm">Instagram Link</label>
      <input type="text" name="instagram" class="form-control form-control-sm" value="{{ $result->social->instagram }}">
      <label class="col-form-label col-form-label-sm">Youtube Link</label>
      <input type="text" name="youtube" class="form-control form-control-sm" value="{{ $result->social->youtube }}">
    </div>
  </div>
  <div class="form-group">
    <div class="text-center">
      <input type="hidden" name="type" value="about" />
      <input type="hidden" name="page_id" value="{{ $page_id }}" />
      <button type="submit" class="btn btn-primary btn-flat">Save Changes</button>
    </div>
  </div>
</form>