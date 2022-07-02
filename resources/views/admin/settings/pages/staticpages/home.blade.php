<form action="{{ url('admin/settings/pages/storestatic') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-12">
      <label>Header</label>
      <input type="text" name="header1" class="form-control form-control-sm" value="{{ $result->header1 }}" />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label class="col-form-label col-form-label-sm">Parallax Image 1</label>
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
      <input type="file" name="image1" class="form-control-file">
      @endif
    </div>
    <div class="form-group col-md-6">
      <label class="col-form-label col-form-label-sm">Parallax Image 2</label>
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
      <input type="file" name="image2" class="form-control-file">
      @endif
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label class="col-form-label col-form-label-sm">Header</label>
      <input type="text" name="header2" class="form-control form-control-sm" value="{{ $result->header2 }}" />
    </div>
    <div class="form-group col-md-6">
      <label class="col-form-label col-form-label-sm">Sub Header</label>
      <input type="text" name="sub_header" class="form-control form-control-sm" value="{{ $result->sub_header }}" />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label class="col-form-label col-form-label-sm">Text 1</label>
      <input type="text" name="text1" class="form-control form-control-sm" value="{{ $result->text1 }}" />
      <textarea class="form-control form-control-sm textarea" name="content1">{{ $result->content1 }}</textarea>
    </div>
    <div class="form-group col-md-3">
      <label class="col-form-label col-form-label-sm">Text 2</label>
      <input type="text" name="text2" class="form-control form-control-sm" value="{{ $result->text2 }}" />
      <textarea class="form-control form-control-sm textarea" name="content2">{{ $result->content2 }}</textarea>
    </div>
    <div class="form-group col-md-3">
      <label class="col-form-label col-form-label-sm">Text 3</label>
      <input type="text" name="text3" class="form-control form-control-sm" value="{{ $result->text3 }}" />
      <textarea class="form-control form-control-sm textarea" name="content3">{{ $result->content3 }}</textarea>
    </div>
    <div class="form-group col-md-3">
      <label class="col-form-label col-form-label-sm">Text 4</label>
      <input type="text" name="text4" class="form-control form-control-sm" value="{{ $result->text4 }}" />
      <textarea class="form-control form-control-sm textarea" name="content4">{{ $result->content4 }}</textarea>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label class="col-form-label col-form-label-sm">Card 1</label>
      <input type="text" name="card1h" class="form-control form-control-sm" value="{{ $result->card1h }}" />
      <input type="text" name="card1t" class="form-control form-control-sm" value="{{ $result->card1t }}" style="margin-top: 10px;" />
    </div>
    <div class="form-group col-md-4">
      <label class="col-form-label col-form-label-sm">Card 2</label>
      <input type="text" name="card2h" class="form-control form-control-sm" value="{{ $result->card2h }}" />
      <input type="text" name="card2t" class="form-control form-control-sm" value="{{ $result->card2t }}" style="margin-top: 10px;" />
    </div>
    <div class="form-group col-md-4">
      <label class="col-form-label col-form-label-sm">Card 3</label>
      <input type="text" name="card3h" class="form-control form-control-sm" value="{{ $result->card3h }}" />
      <input type="text" name="card3t" class="form-control form-control-sm" value="{{ $result->card3t }}" style="margin-top: 10px;" />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label class="col-form-label col-form-label-sm">Google Map</label>
      <input type="text" name="google_map" class="form-control form-control-sm" value="{{ $result->google_map }}" />
    </div>
  </div>
  <div class="form-group">
    <div class="text-center">
      <input type="hidden" name="type" value="home" />
      <input type="hidden" name="page_id" value="{{ $page_id }}" />
      <button type="submit" class="btn btn-primary btn-flat">Save Changes</button>
    </div>
  </div>
</form>