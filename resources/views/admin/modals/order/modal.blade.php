<div class="modal fade" id="modal-order" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Item Information</h4>
            </div>
            <form role="form" method="POST" id="modal-order-form">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Product Device:</label>
                                <select class="form-control" name="product_id" id="order-product-device">
                                    <option value="0">Please Select Product</option>
                                    @if(isset($products) && count($products) >= 1)
                                    @foreach($products as $pKey => $pVal)
                                    <option value="{{ $pVal['id'] }}">{{ $pVal['brand']['name'].' '.$pVal['model'].' ('.$pVal['color'].')' }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Storage:</label>
                                <select class="form-control" name="product_storage_id" id="order-storage-device">
                                    <option value="">Please Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Quantity:</label>
                                <input type="number" name="quantity" id="order-quantity-device" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Device Condition:</label>
                                <select class="form-control" name="device_type" id="order-type-device">
                                    <option value="1">Excellent</option>
                                    <option value="2">Good</option>
                                    <option value="3">Fair</option>
                                    <option value="0">Poor</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Carrier:</label>
                                <select class="form-control" name="network_id" id="order-network-device">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <input type="hidden" id="isBuyForEdit" value="">
                        <input type="hidden" id="selectedId" name="hashedid">
                        <input type="hidden" name="sku" class="form-control form-control-sm" id="sku" value="{{ isset($product->sku) ? $product->sku : '' }}">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>