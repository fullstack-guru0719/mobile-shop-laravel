<div class="modal fade" id="modal-note-order" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Order Note</h4>
            </div>
            <form role="form" method="POST" id="modal-note-order-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <textarea rows="4" name="notes" class="form-control form-control-sm" cols=""></textarea>
                        </div>  
                    </div>  
                </div>  
                <div class="modal-note-order-preloader"></div>
                <div class="modal-footer">
                    <div class="float-right">
                        <input type="hidden" id="selectedForNotesOrderId" name="hashedid">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add Note</button>
                    </div> 
                </div>   
            </form>
        </div>
    </div>
</div>
