<div class="modal fade" id="modal-metatags" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Page Meta Tags</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal-metatags-form">
                <div class="modal-body">
                    <div class="card-body padding0">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Page</label>
                            <input type="text" class="custom-select select-sm" id="modal_dropdown_metatag_pagename" value="{{ (isset($page)) ? $page->title : '' }}" readonly>
                            <input type="hidden" name="page_id" class="custom-select select-sm" id="modal_dropdown_metatag_pageid" value="{{ (isset($page)) ? $page->id : '0' }}">
                        </div>
                        <div class="form-group">
                            <label class="">Meta Tag Name</label>
                            <select name="name" class="custom-select select-sm" id="modal_dropdown_metatag_name">
                            @if(isset($tags) && count($tags) > 0)
                                @foreach($tags as $tkey => $tval)
                                    <option value="{{ $tval }}">{{ $tval }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="form-group" id="modal_div_emailtemplate">
                            <label class="col-form-label col-form-label-sm"><div id="modal_tag_content"></div></label>
                            <textarea class="form-control form-control-sm" name="content" id="modal_metatag_content"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id" id="modal_page_metatag_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="brand-submit">Save changes</button>
                </div>      
            </form>
        </div>
    </div>
</div>