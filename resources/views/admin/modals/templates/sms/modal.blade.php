<div class="modal fade" id="modal-smstemplate" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="modal-header-smstemplate-action"></span> SMS Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal-smstemplate-form">
                <div class="modal-body">
                    <div class="card-body padding0">
                        <div class="form-group">
                            <input name="name" id="modal_smstemplate_name" data-attr="Template Name" class="form-control form-control-sm" value="" placeholder="Template Name:">
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control form-control-sm" id="modal_smstemplate_receiver" name="receiver" data-attr="Reciever">
                                        <option value="">Select Receiver</option>
                                        <option value="Customer">Customer</option>
                                        <option value="TronicsPay">TronicsPay</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control form-control-sm" id="modal_smstemplate_status" name="status" data-attr="Template Status">
                                        <option value="">Template Status</option>
                                        <option value="Active">Active</option>
                                        <option value="In-Active">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control  form-control-sm" id="modal_smstemplate_model" name="model" data-attr="Module">
                                        <option value="">Select Module</option>
                                        <option value="Registration">Registration</option>
                                        <option value="Orders">Orders</option>
                                        <option value="Products">Products</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="content" rows="4" cols="" class="form-control form-control-sm" id="modal_smstemplate_content" placeholder="Template Message:" maxlength="600" data-attr="Message"></textarea>
                            <div id="modal_smstemplate_content_counter"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="callout callout-warning">
                                        <h8 style="font-weight: bold;"><i class="fas fa-info"></i> Note:</h8>
                                        Use placeholder below to fill up the details automatically.
                                    </div>
                                    <div class="card card-outline card-warning collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-user"></i> Customer Details</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if(isset($placeholder_customer_list))
                                            @foreach($placeholder_customer_list as $key => $val)
                                            <li>
                                                {{ $val['name'] }} :
                                                <input class="text-yellow" style="{{ $val['style'] }}" readonly id="{{ $val['id'] }}" value="{{ $val['value'] }}">
                                                <a href="javascript:void(0);" id="tooltip_button_{{ $val['id'] }}" onClick="copyInputToClipBoard('{{ $val['id'] }}')"><i class="fas fa-copy"></i> Copy</a>
                                            </li>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card card-outline card-warning collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-people-carry"></i> Order Details</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if(isset($placeholder_order_list))
                                            @foreach($placeholder_order_list as $key => $val)
                                            <li>
                                                {{ $val['name'] }} :
                                                <input class="text-yellow" style="{{ $val['style'] }}" readonly id="{{ $val['id'] }}" value="{{ $val['value'] }}">
                                                <a href="javascript:void(0);" id="tooltip_button_{{ $val['id'] }}" onClick="copyInputToClipBoard('{{ $val['id'] }}')"><i class="fas fa-copy"></i> Copy</a>
                                            </li>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id" id="modal_smstemplate_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="sms-submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
