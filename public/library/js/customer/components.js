var baseUrl = $('body').attr('data-url');

$(function () {
    
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        
    if($("#dashboard-my-device-table").length)
    {
        console.log("2")
        const DashboardMyDevices = $('#dashboard-my-device-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            "lengthChange": false,
            searching: false,
            ajax: {
                url: baseUrl+"/customer/datatable/dashboardmydevices",
                type:'POST'
            },
            columns: [
                {
                    width:'2%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'device', name: 'device', searchable: true, orderable: true, width:'20%' },
                { data: 'storage', name: 'storage', searchable: true, orderable: false, width:'20%' },
                { data: 'status', name: 'status', searchable: true, orderable: false, width:'20%', className: "text-center" },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'18%', className: "text-center" }
            ]
        });
    }

    if($("#my-device-table").length)
    {
        const CustomerMyDevices = $('#my-device-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: baseUrl+"/customer/datatable/customermydevices",
                type:'POST'
            },
            columns: [
                {
                    width:'2%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'device', name: 'device', searchable: true, orderable: true, width:'14%' },
                { data: 'carrier', name: 'carrier', searchable: true, orderable: true, width:'14%' },
                { data: 'storage', name: 'storage', searchable: true, orderable: false, width:'14%' },
                { data: 'quantity', name: 'quantity', searchable: true, orderable: false, width:'14%' },
                { data: 'amount', name: 'amount', searchable: true, orderable: false, width:'14%' },
                { data: 'status', name: 'status', searchable: true, orderable: false, width:'14%', className: "text-center" },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'14%', className: "text-center" },
            ]
        });
    }
    
    $('#profile-change-password').on('click', function () {
        $('#modal_customer_id').val('');
        const id = $(this).attr('data-attr-id');
        $('#modal_customer_id').val(id);
        $('#modal-changepassword').modal();
    });

    $('#modal-profile-form').on('submit', function () {
        const data = $(this).serializeArray();
        if ($.trim($('#new-password').val()) == '') {
            swalWarning ('Oops', 'New Password is required', 'warning', 'Close');
            return false;
        }
        if ($.trim($('#new-password').val()).length <= 5) {
            swalWarning ('Oops', 'New password must be atleast 6 characters', 'warning', 'Close');
            return false;
        }
        if ($.trim($('#retype-password').val()) == '') {
            swalWarning ('Oops', 'Re-type Password is required', 'warning', 'Close');
            return false;
        }
        if ($('#new-password').val() != $('#retype-password').val()) {
            swalWarning ('Oops', 'New Password and Re-type Password not matched', 'warning', 'Close');
            return false;
        }
        const form_url = baseUrl+'/api/customer/profile/changepassword';
        doAjaxProcess('PATCH', '#modal-profile-form', data, form_url);
        return false;
    });

    

        
    if($("#dashboard-my-bundle-table").length)
    {
        const DashboardMyDevices = $('#dashboard-my-bundle-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            "lengthChange": false,
            searching: false,
            ajax: {
                url: baseUrl+"/customer/datatable/dashboardmybundles",
                type:'POST'
            },
            columns: [
                {
                    width:'2%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'order_no', name: 'order_no', searchable: true, orderable: true, width:'20%' },
                // { data: 'tracking_code', name: 'tracking_code', searchable: true, orderable: false, width:'20%' },
                { data: 'shipping_status', name: 'shipping_status', searchable: true, orderable: false, width:'20%', className: "text-center" },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'18%', className: "text-center" }
            ]
        });
    }

        
    if($("#dashboard-my-stats").length)
    {
        console.log("1")
        $('#dashboard-my-stats').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            "lengthChange": false,
            searching: false,
            ajax: {
                url: baseUrl+"/customer/datatable/dashboardmystats",
                type:'POST'
            },
             columns: [
                {
                    width:'2%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'quantity', name: 'quantity', searchable: true, orderable: false, width:'50%' },
                { data: 'status', name: 'status', searchable: true, orderable: false, width:'50%', className: "text-center" },
            ]
        });
    }

    if($("#my-bundle-table").length)
    {
        const CustomerMyDevices = $('#my-bundle-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: baseUrl+"/customer/datatable/customermybundles",
                type:'POST'
            },
            columns: [
                {
                    width:'2%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'order_no', name: 'order_no', searchable: true, orderable: true, width:'17%' },
                { data: 'tracking_code', name: 'tracking_code', searchable: true, orderable: false, width:'17%' },
                { data: 'shipping_status', name: 'shipping_status', searchable: true, orderable: true, width:'16%' },
                { data: 'transaction_date', name: 'transaction_date', searchable: true, orderable: false, width:'16%' },
                { data: 'delivery_due', name: 'delivery_due', searchable: true, orderable: false, width:'16%' },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'16%', className: "text-center" },
            ]
        });
    }



    var selectedDevice = "";

    if($(".btn-edit-sell-mydevice").length)
    {
        $('.btn-edit-sell-mydevice').on('click', function () {
            $('#selectedId').val('');
            $('#order-storage-device, #order-network-device').html('');
            var hashedid = $(this).attr('data-attr-id');
            $('#selectedId').val(hashedid);
        $.ajax({
            type: "GET",
            url: baseUrl+"/api/customer/orders/"+hashedid+"/orderItem",
            dataType: "json",
            success: function (result) {
                selectedDevice = result.productDetails;
                $('select[name="product_id"] option[value="' + result.customerSell.product_id + '"]').attr('selected','selected');
                $.each(result.productDetails.storages, function( index, value ) {
                    if (result.customerSell.network_id == value.network_id) {
                        if (result.customerSell.product_storage.title == value.title) {
                            $('#order-storage-device').append('<option value="'+value.id+'" selected="selected">'+value.title+'</option>');
                        } else {
                            $('#order-storage-device').append('<option value="'+value.id+'">'+value.title+'</option>');
                        }
                    }
                });
                $.each(result.networks, function( id, value) {
                    if (result.customerSell.network_id == id) {
                        $('#order-network-device').append('<option value="'+id+'" selected="selected">'+value+'</option>');
                    } else {
                        $('#order-network-device').append('<option value="'+id+'">'+value+'</option>');
                    }
                });
                $('#order-quantity-device').val(result.customerSell.quantity);
                $('#order-type-device').val(result.customerSell.device_type);
                $('#order-type-device option[value="' + result.customerSell.device_type + '"]').attr('selected','selected');
               
            }
        });
            $('#modal-bundle').modal();
        });
    }

    $('#order-product-device').on('change', function () {
        var id = $(this).val();
        var selectedNetwork = $('#order-network-device :selected').text();

        $.ajax({
            type: "GET",
            url: baseUrl+"/api/products/"+id,
            dataType: "json",
            success: function (response) {
                selectedDevice = response;
                $('#order-network-device').html('');
                $.each(response.networks, function( id, value ) {
                    if (selectedNetwork == value) {
                        $('#order-network-device').append('<option value="'+id+'" selected="selected">'+value+'</option>');
                    } else {
                        $('#order-network-device').append('<option value="'+id+'">'+value+'</option>');
                    }
                });
                $('#order-network-device').trigger('change');
            }
        });
    });

    $('#order-network-device').on('change', function () {
        var id = $(this).val();
        var selectedStorage = $('#order-storage-device :selected').text();

        $('#order-storage-device').html('');
        $.each(selectedDevice.storages, function( index, value ) {
            if (id == value.network_id) {
                if (selectedStorage == value.title) {
                    $('#order-storage-device').append('<option value="'+value.id+'" selected="selected">'+value.title+'</option>');
                } else {
                    $('#order-storage-device').append('<option value="'+value.id+'">'+value.title+'</option>');
                }
            }
        });
    });
    
    if($("#modal-bundle-form").length)
    {

        $('#modal-bundle-form').on('submit', function () {           
            var data = $(this).serializeArray();
            form_url = baseUrl+'/api/customer/orders/'+$('#selectedId').val()+'/orderItem';
            
            if ($('#order-product-device').val() == 0) 
            {
                swalWarning ("Opps!", "Product is required", "warning", "Close");
                return false;
            }
            else if ($('#order-storage-device').val() == '') 
            {
                swalWarning ("Opps!", "Storage is required", "warning", "Close");
                return false;
            }
            else if ($('#order-quantity-device').val() == '' || $('#order-quantity-device').val() == 0) 
            {
                swalWarning ("Opps!", "Quantity is required", "warning", "Close");
                return false;
            }
            else if ($('#order-network-device').val() == '') 
            {
                swalWarning ("Opps!", "Storage is required", "warning", "Close");
                return false;
            }
            else if ($('#order-type-device').val() == '') 
            {
                swalWarning ("Opps!", "Device Condition is required", "warning", "Close");
                return false;
            }
            
            doAjaxProcess('PATCH', '#modal-bundle-form', data, form_url);
            return false;
        });
    }

    $('.btn-delete-sell-device').on('click', function () {
        const hashedId = $(this).attr('data-attr-id');
        var form_url = baseUrl+'/api/customer/bundle/'+hashedId+'/orderItem';
        doAjaxConfirmProcessing('DELETE', '', {}, form_url);
    });
});


function cancelOrder(hash) {
    console.log(hash)
    // const hashedId = $(this).attr('data-attr-id');
    var form_url = baseUrl+'/api/customer/orders/'+hash+'/cancel';
    doAjaxConfirmProcessing('DELETE', '', {}, form_url);
}