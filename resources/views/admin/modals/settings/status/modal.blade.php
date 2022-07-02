<div class="modal fade" id="modal-status" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal-status-form">
                <div class="modal-body">
                    <div class="card-body padding0">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Module</label>
                            {!! Form::select('module', [], '', ['class'=>'custom-select select-sm','id'=>'modal_dropdown_module']) !!}
                        </div>
                        <div class="form-group">
                            <label class="">Status Name</label>
                            <input type="text" name="name" id="modal_status" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label class="">Badge Design</label>
                            <select name="badge" class="custom-select select-sm" id="modal_dropdown_badge">
                                @foreach($badges as $key => $val)
                                <option value="{{ $val }}">{{ $val }} <small class="badge {{ $val }}">
                                        <div class="w50px h5px"></div>
                                    </small></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="modal_div_sms_template">
                            <label class="col-form-label col-form-label-sm">Select SMS Template</label>
                            <select name="sms_template_id" class="form-control form-control-sm" id="modal-status-select-template-sms"></select>
                        </div>
                        <div class="form-group hideme" id="modal_div_emailsending">
                            <label class="col-form-label col-form-label-sm">Enable Send Automatic Emails</label>
                            {!! Form::select('email_sending', [], '', ['class'=>'custom-select select-sm','id'=>'modal_dropdown_enableoptions']) !!}
                        </div>
                        <div class="form-group" id="modal_div_emailtemplate">
                            <label class="col-form-label col-form-label-sm">Template Content</label>
                            <textarea id="summernote" name="template"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id" id="modal_status_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="brand-submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
