var baseUrl = $('body').attr('data-url');
var customerTable;

function changepasswordcustomer (hashedId) 
{
    $('#modal_customer_id').val('');
    $('#modal_customer_id').val(hashedId);
    $('#modal-changepassword').modal();
}

function deleteCustomers(customerIds) {
    if (!confirm('Are you sure ?')) return;

    $.ajax({
        type: 'DELETE',
        url: baseUrl+'/api/admin/customers/delete',
        data: {
            ids: customerIds
        },
        dataType: 'JSON',
        success: function(res) {
            if (res.message) {
                alert(res.message)
            }
            customerTable.ajax.reload();
  
        },
        
    });
}


function openCustomerModal(hashedId) {
    $.ajax({
        type: 'GET',
        url: baseUrl+'/api/admin/customers/info/' + hashedId,
        dataType: 'JSON',
        success: function(res) {
            $('#modal-update-customer-info input[name=customer_id]').val(hashedId);

            $('#modal-update-customer-info input[name=fname]').val(res.fname);
            $('#modal-update-customer-info input[name=lname]').val(res.lname);
            $('#modal-update-customer-info input[name=email]').val(res.email);
            $('#modal-update-customer-info input[name=bill_phone]').val(res.bill.phone);
            $('#modal-update-customer-info input[name=bill_street]').val(res.bill.street);
            $('#modal-update-customer-info input[name=bill_city]').val(res.bill.city);
            $('#modal-update-customer-info input[name=bill_state]').val(res.bill.state);

            $('#modal-update-customer-info').modal('show');
        }
    });
}

$(function () {

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
        const form_url = baseUrl+'/api/admin/customers/changepassword';
        doAjaxProcess('PATCH', '#modal-profile-form', data, form_url);
        return false;
    });


    if($("#customer-table").length)
    {
        customerTable = $('#customer-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: baseUrl+'/api/admin/customers',
                type:'POST'
            },
            columns: [
                {
                    width:'2%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, 
                    className: "text-center"
                },
                {
                    width: "2%",
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return `<input type="checkbox" name="ids[]" value="${row.id}" />`;
                    },
                },
                { data: 'fullname', name: 'fullname', searchable: true, orderable: true, width:'18%' },
                { data: 'email', name: 'email', searchable: true, orderable: true, width:'20%' },
                { data: 'phone', name: 'phone', searchable: true, orderable: true, width:'15%' },
                { data: 'address', name: 'address', searchable: true, orderable: true, width:'35%' },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'8%', className: "text-center" },
            ]
        });

        // select all rows
        $(document).on('change', '#select_all', function(e) {
            $("#customer-table tbody tr input[type=checkbox]").each(function(index, item) {
                item.checked = e.target.checked;
            });
        });

        // delete multiple customers
        $(document).on('click', '#multi-delete-rows', function(e) {
            var checkedCount = $("#customer-table tbody tr input[type=checkbox]:checked").length;

            if (checkedCount == 0) {
                alert('Please select customers to delete.');
                return;
            }

            var customerIds = [];
            $("#customer-table tbody tr input[type=checkbox]:checked").each(function(index, item) {
                customerIds.push(item.value);
            });

            deleteCustomers(customerIds);
        });

        // save customer info
        $(document).on('submit', '#modal-update-customer-info-form', function(e) {
            e.preventDefault();
            e.stopPropagation();

            $.ajax({
                type: 'PATCH',
                url: baseUrl+'/api/admin/customers/update',
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function(res) {
                    customerTable.ajax.reload();
                    alert('Updated successfully.');
                    $('#modal-update-customer-info').modal('hide');
                }
            });
        });
    }
});