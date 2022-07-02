var baseUrl = $('body').attr('data-url');

$(function () {
    $('.btn-edit-sell-device').on('click', function () {
        $('#selectedId').val('');
        $('#customer-transaction-sell-form')[0].reset();
        $('#device-seller-storage-device, #device-seller-network-device').html('');
        var hashedid = $(this).attr('data-attr-id');
        $('#selectedId').val(hashedid);
        $.ajax({
            type: "GET",
            url: baseUrl+"/admin/device-sellers/"+hashedid+"/customersell",
            dataType: "json",
            success: function (result) {
                $('select[name="product_id"] option[value="' + result.customerSell.product_id + '"]').attr('selected','selected');
                $.each(result.productDetails.storages, function( index, value ) {
                    if (result.customerSell.product_storage.title == value.title) {
                        $('#device-seller-storage-device').append('<option value="'+value.id+'" selected="selected">'+value.title+'</option>');
                    } else {
                        $('#device-seller-storage-device').append('<option value="'+value.id+'">'+value.title+'</option>');
                    }
                });
                
                $.each(result.productDetails.networks, function( index, value ) {
                        $('#device-seller-network-device').append('<option value="'+value.network_id+'">'+value.network.title+'</option>');
                });
                $('#device-seller-quantity-device').val(result.customerSell.quantity);
                $('#device-seller-type-device').val(result.device_type);
                $('#device-seller-type-device option[value="' + result.customerSell.device_type + '"]').attr('selected','selected');
               
            }
        });
        $('#modal-customer-transaction-sell').modal();
    });

    $('#device-seller-product-device').on('change', function () {
        var id = $(this).val();
        $.ajax({
            type: "GET",
            url: baseUrl+"/api/products/"+id,
            dataType: "json",
            success: function (response) {
                $('#device-seller-storage-device, #device-seller-network-device').html('');
                $.each(response.storages, function( index, value ) {
                    if (response.storages.title == value.title) {
                        $('#device-seller-storage-device').append('<option value="'+value.id+'" selected="selected">'+value.title+'</option>');
                    } else {
                        $('#device-seller-storage-device').append('<option value="'+value.id+'">'+value.title+'</option>');
                    }
                });
                $.each(response.networks, function( index, value ) {
                        $('#device-seller-network-device').append('<option value="'+value.network_id+'">'+value.network.title+'</option>');
                });
            }
        });
    });

    $('#customer-transaction-sell-form').on('submit', function () {
        var data = $(this).serializeArray();
        form_url = baseUrl+'/api/products/'+$('#selectedId').val();
        if ($('#device-seller-product-device').val() == 0) 
        {
            swalWarning ("Opps!", "Product is required", "warning", "Close");
            return false;
        }
        else if ($('#device-seller-storage-device').val() == '') 
        {
            swalWarning ("Opps!", "Storage is required", "warning", "Close");
            return false;
        }
        else if ($('#device-seller-quantity-device').val() == '' || $('#device-seller-quantity-device').val() == 0) 
        {
            swalWarning ("Opps!", "Quantity is required", "warning", "Close");
            return false;
        }
        else if ($('#device-seller-network-device').val() == '') 
        {
            swalWarning ("Opps!", "Storage is required", "warning", "Close");
            return false;
        }
        else if ($('#device-seller-type-device').val() == '') 
        {
            swalWarning ("Opps!", "Device Condition is required", "warning", "Close");
            return false;
        }
        
        doAjaxProcess('PATCH', '#customer-transaction-sell-form', data, form_url);
        // console.log($('#device-seller-product-device').val());
        return false;
    });
});

