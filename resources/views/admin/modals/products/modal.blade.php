<div class="modal fade" id="modal-product" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-product-title">Duplicate Device</h4>
      </div>
      <form role="form" method="POST" id="product-form">
        <div class="modal-body">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="col-form-label col-form-label-sm">Network</label>
                {!! Form::select('network', $networkList, '', ['class'=>'custom-select select-sm','id'=>'network']) !!}
                <span id="network-exist-error" class="invalid-feedback" style="display: none;">This device is already exist in the database.</span>
              </div>
              <div class="form-group col-md-6">
                <label class="col-form-label col-form-label-sm">Storage</label>
                {!! Form::select('storage', $storageList, '', ['class'=>'custom-select select-sm']) !!}
              </div>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="offer_type" id="offer_type" value="1" {{ (isset($product->offer_type) && $product->offer_type == 1) ? 'checked' : '' }}>
              <label class="form-check-label" for="offer_type">Auto generate offer base on the percentage</label>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label class="col-form-label col-form-label-sm">Excellent Offer</label>
                <input type="number" name="excellent_offer" id="excellent_offer" class="form-control form-control-sm">
              </div>
              <div class="form-group col-md-3">
                <label class="col-form-label col-form-label-sm">Good Offer</label>
                <input type="number" name="good_offer" id="good_offer" class="form-control form-control-sm">
              </div>
              <div class="form-group col-md-3">
                <label class="col-form-label col-form-label-sm">Fair Offer</label>
                <input type="number" name="fair_offer" id="fair_offer" class="form-control form-control-sm">
              </div>
              <div class="form-group col-md-3">
                <label class="col-form-label col-form-label-sm">Poor Offer</label>
                <input type="number" name="poor_offer" id="poor_offer"class="form-control form-control-sm">
              </div>
            </div>
            <div class="alert alert-danger" id="exist-error" role="alert" style="display: none;">
              This type of device already exists!
            </div>
          </div>
        </div>  
        <div class="modal-footer">
          <div class="float-right">
            <input type="hidden" name="id" id="product_id">
            <input type="hidden" id="good" value="{{ $config->good }}">
            <input type="hidden" id="fair" value="{{ $config->fair }}">
            <input type="hidden" id="poor" value="{{ $config->poor }}">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm" id="product-submit">Save changes</button>
          </div> 
        </div>   
      </form>
    </div>
  </div>
</div>