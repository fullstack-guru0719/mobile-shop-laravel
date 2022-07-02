<div class="modal fade" id="modal-approve-order" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Payment Method</h4>
            </div>
            <form role="form" method="POST" id="modal-approve-order-form">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group" align="center">
                                <div id="approve-payment-image"></div>
                                
                                <div id="smart-button-container" class="hideme paypal-payment">
                                    <div style="text-align: center;">
                                        <div id="paypal-button-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <div class="float-right">
                        <input type="hidden" id="selectedForApproveOrderId" name="hashedid">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm confirm-pay-approval">Approve & Pay</a>
                    </div> 
                </div>   
            </form>
        </div>
    </div>
</div>

@if(isset($paypal))
    <script src="https://www.paypal.com/sdk/js?client-id={{ $paypal['paypal_account_client_id'] }}&currency=USD" data-sdk-integration-source="button-factory"></script>
@endif

<!-- <script>
    initPayPalButton();
</script> -->