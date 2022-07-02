<div class="modal fade" id="modal-emailtemplate" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="modal-header-emailtemplate-action"></span> Email Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal-emailtemplate-form">
                <div class="modal-body">
                    <div class="card-body padding0">
                        <div class="form-group">
                            <input name="name" id="modal_emailtemplate_name" class="form-control form-control-sm" value="" placeholder="Template Name:" data-attr="Template Name">
                        </div>
                        <div class="form-group">
                            <input name="subject" id="modal_emailtemplate_subject" class="form-control form-control-sm" value="" placeholder="Subject:" data-attr="Template Subject">
                        </div>
                        <div class="form-group">
                            <textarea name="description" rows="4" cols="" class="form-control form-control-sm" id="modal_emailtemplate_description" placeholder="Template Description:" data-attr="Template Description"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm" id="modal_emailtemplate_receiver" name="receiver" data-attr="Receiver">
                                            <option value="">Select Receiver</option>
                                            <option value="Customer">Customer</option>
                                            <option value="TronicsPay">TronicsPay</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm" id="modal_emailtemplate_status" name="status" data-attr="Template Status">
                                            <option value="">Select Template Status</option>
                                            <option value="Active">Active</option>
                                            <option value="In-Active">In-Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control  form-control-sm" id="modal_emailtemplate_model" name="model" data-attr="Template Module">
                                            <option value="">Select Module</option>
                                            <option value="Registration">Registration</option>
                                            <option value="Orders">Orders</option>
                                            <option value="Products">Products</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group modal_div_schedule_reminder hideme">
                                        Schedule after 
                                        <input name="scheduled_days" id="modal_emailtemplate_scheduled_days" class="form-control form-control-sm" type="number" style="width: 75px; display: inline;" value="0"> 
                                        day(s) to follow up
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea id="email-content" name="content" class="form-control" style="height: 300px"></textarea>                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id" id="modal_emailtemplate_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="brand-submit">Save changes</button>
                </div>      
            </form>
        </div>
    </div>
</div>