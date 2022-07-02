<div class="modal fade" id="modal-show-tracker" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Track Order</h4>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <iframe id="iframe-order-tracker"></iframe>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                </div> 
            </div>   
        </div>
    </div>
</div>
<script>
    $(function () {
        $( "p" )
        .contents()
        .filter(function(){
            return this.nodeType !== 1;
        })
        .wrap( "<b></b>" );
        return false;
    });
</script>