<style>
    .custom-file {
        font-size: 14px !important;
    }
</style>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-light bg-light">
                            <div class="container-fluid">
                                <span class="navbar-brand mb-0"><b>Device Information</b></span>
                            </div>
                        </nav>
                        <p style="margin-top: 10px;">Input all information about the device</p>
                    </div>
                </div>
                <input type="hidden" name="device_type" id="device_type" value="Both">
                <!-- <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">I want to:</label>
                            <select name="device_type" class="form-control form-control-sm device-check" id="device_type">
                                <option value="">---</option>
                                <option value="Buy" {{ (isset($product->device_type) && $product->device_type == 'Buy') ? 'selected' : '' }}>Buy a device</option>
                                <option value="Sell"{{ (isset($product->device_type) && $product->device_type == 'Sell') ? 'selected' : '' }}>Sell a device</option>
                                <option value="Both"{{ (isset($product->device_type) && $product->device_type == 'Both') ? 'selected' : '' }}>Buy and Sell a device</option>
                            </select>
                            
                        </div>
                    </div>
                </div> -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Brand Name</label>
                        {!! Form::select('brand_id', $brandList, isset($product->brand_id) ? $product->brand_id : '', ['class'=>'custom-select select-sm','id'=>'brand_id']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Model</label>
                        <input type="text" name="name" id="product-name" class="form-control form-control-sm" placeholder="Enter model" value="{{ isset($product->model) ? $product->model : '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Color</label>
                        <input type="text" name="color" class="form-control form-control-sm" id="color" value="{{ isset($product->color) ? $product->color : '' }}">
                    </div>
                    <div class="form-group col-md-6">

                        <label class="col-form-label col-form-label-sm">Device Photo</label>
                        <div style="<?php echo isset($product->photo) ? 'display:none' : ''; ?>">

                            <!-- <div class="input-group">
                                <div class="custom-file">
                                    <input class="custom-file-input" name="photo" id="inputGroupFile04" type="file" accept="image/*">
                                    <label class="custom-file-label" for="inputGroupFile04">Upload Device Photo</label>
                                </div>
                                <div class="input-group-append">
                                </div>
                            </div> -->
                            <input accept="image/*" type="file" name="photo" class="form-control custom-file form-control-sm">
                        </div>
                        <div style="<?php echo isset($product->photo) ? 'display:block' : 'display:none'; ?>">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-sm" aria-describedby="remove-photo" value="{{ isset($product->photo) ? $product->photo->photo_display : '' }}" readonly>
                                <div class="input-group-append">
                                    <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm" id="remove-photo"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Height (inches)</label>
                        <input type="number" name="height" id="height" class="form-control form-control-sm" value="{{ isset($product->height) ? $product->height : '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Width (inches)</label>
                        <input type="number" name="width" id="width" class="form-control form-control-sm" value="{{ isset($product->width) ? $product->width : '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Length (inches)</label>
                        <input type="text" name="length" class="form-control form-control-sm" id="length" value="{{ isset($product->length) ? $product->length : '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Weight (ounces)</label>
                        <input type="number" name="weight" id="weight" class="form-control form-control-sm" value="{{ isset($product->weight) ? $product->weight : '' }}">
                    </div>
                </div>
                <div class="form-row">
                    {{-- <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Network</label>
                        <select name="network[]" class="form-control" multiple>
                            @if(count($networkList) >= 1)
                                @foreach($networkList as $nlKey => $nlVal)
                                    <option 
                                        value="{{ $nlVal->id }}"
                    <?php if (isset($product) && $product->networks != null) { ?>
                        {{ (selectItem($product->networks, 'network_id', $nlVal->id) == true) ? ' selected="selected"' : '' }}
                    <?php } ?>
                    >
                    {{ $nlVal->title }}
                    </option>
                    @endforeach
                    @endif
                    </select>
                </div> --}}
                <div class="form-group col-md-6">
                    <label class="col-form-label col-form-label-sm">Categories</label>
                    <select name="categories[]" class="form-control" multiple>
                        @if(count($categoryList) >= 1)
                        @foreach($categoryList as $clKey => $clVal)
                        <option value="{{ $clVal->id }}" <?php if (isset($product) && $product->categories != null) { ?> {{ (selectItem($product->categories, 'category_id', $clVal->id) == true) ? ' selected="selected"' : '' }} <?php } ?>>
                            {{ $clVal->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="col-form-label col-form-label-sm">Description</label>
                    <textarea name="description" id="description" class="textarea">{{ isset($product->description) ? $product->description : '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <!-- style="<?php  // echo (isset($product->device_type) && in_array($product->device_type, ['Buy','Both'])) ? '' : 'display: none'; 
                ?>" -->
    <div class="row" id="div-offer">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-light bg-light">
                                <div class="container-fluid">
                                    <span class="navbar-brand mb-0"><b>Buy Device Information</b></span>
                                </div>
                            </nav>
                            <p style="margin-top: 10px;">Input a price offer depends on the condition</p>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-nowrap table-sm" id="parent-table-product-buy">
                                    <thead>
                                        <tr>
                                            <th width="20%">
                                                <center>Storage</center>
                                            </th>
                                            <th width="20%">
                                                <center>Network</center>
                                            </th>
                                            <th width="16%">
                                                <center>Excellent Offer</center>
                                            </th>
                                            <th width="16%">
                                                <center>Good Offer</center>
                                            </th>
                                            <th width="16%">
                                                <center>Fair Offer</center>
                                            </th>
                                            <th width="16%">
                                                <center>Poor Offer</center>
                                            </th>
                                            <!-- <th width="14%"><center>Amount</center></th> -->
                                            <th width="16%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-product-buy">
                                        @if(isset($product) && count($product['storages']) > 0)
                                        @foreach($product['storages'] as $sKey => $sVal)
                                        @if($sVal['amount'] == '')
                                        <tr class="tr-id-{{ $sVal['hashedId']}}" data-attr-saved="true" data-attr-id="{{ $sVal['hashedId']}}">
                                            <td align="center">{{ $sVal['title'] }}</td>
                                            <td align="center">{{ optional($sVal->network)->title }}</td>
                                            <td align="right">${{ number_format($sVal['excellent_offer'], 2, '.', ',') }}</td>
                                            <td align="right">${{ number_format($sVal['good_offer'], 2, '.', ',') }}</td>
                                            <td align="right">${{ number_format($sVal['fair_offer'], 2, '.', ',') }}</td>
                                            <td align="right">${{ number_format($sVal['poor_offer'], 2, '.', ',') }}</td>
                                            <td align="center">
                                                @if(Route::current()->getName() == 'products.edit')
                                                <a href="javascript:void(0);" class="edit-row-product-storage btn btn-primary btn-xs" data-attr-saved="true" data-attr-id="{{ $sVal['hashedId']}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @else
                                                <a href="javascript:void(0);" class="edit-row-product-storage btn btn-primary btn-xs" data-attr-saved="true" data-attr-id="{{ $sVal['hashedId']}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @endif
                                                @if(Route::current()->getName() != 'products.edit')
                                                <a href="javascript:void(0);" class="delete-row-product-storage btn btn-danger btn-xs" data-attr-saved="true" data-attr-id="{{ $sVal['hashedId']}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @else
                                                <button type="button" onClick="deleteStoragePrice('{{ $sVal['hashedId'] }}')" class="btn btn-danger btn-xs" data-attr-saved="true" data-attr-id="{{ $sVal['hashedId']}}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" id="btn-product-buy" class="btn btn-sm btn-primary">
                                        Add Storage Prices
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- style="<?php // echo (isset($product->device_type) && in_array($product->device_type, ['Sell','Both'])) ? '' : 'display: none'; 
                ?>" -->
    <div class="row" id="div-amount">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-light bg-light">
                                <div class="container-fluid">
                                    <span class="navbar-brand mb-0"><b>Sell Device Information</b></span>
                                </div>
                            </nav>
                            <p style="margin-top: 10px;">Input a price for the device you are selling</p>
                        </div>
                        <div class="col-md-12 fn">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-nowrap table-sm" id="parent-table-product-sell">
                                    <thead>
                                        <tr>
                                            <th width="30%">
                                                <center>Storage</center>
                                            </th>
                                            <th width="30%">
                                                <center>Network</center>
                                            </th>
                                            <th width="30%">
                                                <center>Price</center>
                                            </th>
                                            <!-- <th width="14%"><center>Amount</center></th> -->
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-product-sell">
                                        @if(isset($product) && count($product['storages']) > 0)
                                        @foreach($product['storages'] as $sKey => $sVal)
                                        @if($sVal['amount'] != '')
                                        <tr class="tr-id-{{ $sVal['hashedId']}}" data-attr-saved="true" data-attr-id="{{ $sVal['hashedId']}}">
                                            <td align="center">{{ $sVal['title'] }}</td>
                                            <td align="center">{{ optional($sVal->network)->title }}</td>
                                            <td align="right">${{ number_format($sVal['amount'], 2, '.', ',') }}</td>
                                            <td align="center">
                                                <button type="button" class="edit-row-product-sell btn btn-primary btn-xs" data-target="#edit-modal-product-sell" data-toggle="modal" data-attr-saved="true" data-storage="{{ $sVal->title }}" data-amount="{{ $sVal->amount }}" data-network_id="{{ $sVal->network_id }}" data-id="{{ $sVal['hashedId']}}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                @if(Route::current()->getName() != 'products.edit')
                                                <a href="javascript:void(0);" class="delete-row-product-storage btn btn-danger btn-xs" data-attr-saved="true" data-attr-id="{{ $sVal['hashedId']}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @else
                                                <button type="button" onClick="deleteStoragePrice('{{ $sVal['hashedId'] }}',true)" class="btn btn-danger btn-xs" data-attr-saved="true" data-attr-id="{{ $sVal['hashedId']}}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @endif
                                        <!-- <tr>
                                                <td colspan="7" align="center">
                                                    No Record Found.
                                                </td>
                                            </tr> -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="javascript:void(0);" id="btn-product-sell" class="btn btn-sm btn-primary">
                                        Add Device Prices
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>


<!-- <div class="row" id="div-offer" style="<?php echo (isset($product->device_type) && in_array($product->device_type, ['Buy', 'Both'])) ? '' : 'display: none'; ?>">
    <div class="col-md-4 fn">
        <div class="config-legend">
            <h4>Price Offer</h4>
            <p>Input a price offer depends on the condition</p>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="offer_type" id="offer_type" value="1" {{ (isset($product->offer_type) && $product->offer_type == 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="offer_type">Auto generate offer base on the percentage</label>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="col-form-label col-form-label-sm">Excellent Offer</label>
                        <input type="number" name="excellent_offer" id="excellent_offer" class="form-control form-control-sm" value="{{ isset($product->excellent_offer) ? $product->excellent_offer : '' }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label col-form-label-sm">Good Offer</label>
                        <input type="number" name="good_offer" id="good_offer" class="form-control form-control-sm" value="{{ isset($product->good_offer) ? $product->good_offer : '' }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label col-form-label-sm">Fair Offer</label>
                        <input type="number" name="fair_offer" id="fair_offer" class="form-control form-control-sm" value="{{ isset($product->fair_offer) ? $product->fair_offer : '' }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label col-form-label-sm">Poor Offer</label>
                        <input type="number" name="poor_offer" id="poor_offer"class="form-control form-control-sm" value="{{ isset($product->poor_offer) ? $product->poor_offer : '' }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->


<!-- <div class="row" id="div-amount" style="<?php echo (isset($product->device_type) && in_array($product->device_type, ['Sell', 'Both'])) ? '' : 'display: none'; ?>">
    <div class="col-md-4 fn">
        <div class="config-legend">
            <h4>Device Price</h4>
            <p>Input a price for the device you are selling</p>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group col-md-3">
                    <label class="col-form-label col-form-label-sm">Device Price</label>
                    <input type="number" name="amount" id="amount" class="form-control form-control-sm" value="{{ isset($product->amount) ? $product->amount : '' }}">
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row pb-50">
    <div class="col-md-12 fn">
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-md" id="">Save Changes</button>
        </div>
    </div>
</div>