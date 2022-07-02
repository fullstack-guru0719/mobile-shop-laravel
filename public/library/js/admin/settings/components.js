var baseUrl = $('body').attr('data-url');

$(function () {
    

    $('#create-status').click(function (){
        $('#modal-status-form')[0].reset();
        $('#modal-status').modal();
        getDropdownOptionsStatic(baseUrl+'/api/modules', 'GET', 'modal_dropdown_module');

        $('#modal-status-select-template-sms').html('<option value="">Please Select SMS Template</option>');

        $.ajax({
            type: "GET",
            url: baseUrl+"/api/templates/sms",
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    $.each(response.model, function( index, value ) {
                        $('#modal-status-select-template-sms').append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            }
        });
        // getDropdownOptionsStatic(baseUrl+'/api/enableoptions', 'GET', 'modal_dropdown_enableoptions');
    });

    $('#modal-status-form').on('submit', function () {
        var data = $(this).serializeArray();
        var form_url = baseUrl+'/api/settings/status';
        doAjaxProcess('PATCH', '#modal-status-form', data, form_url);
        return false;
    });

    $('#modal_dropdown_module').on('change', function () 
    {
        if ($(this).val() == "Order") 
        {
            getDropdownOptionsStatic(baseUrl+'/api/enableoptions', 'GET', 'modal_dropdown_enableoptions');
            $('#modal_div_emailsending').removeClass('hideme');
        }
        else 
        {
            $('#modal_dropdown_enableoptions').html('');
            $('#modal_div_emailsending').addClass('hideme');
        }
    }); 


    $('#create-category').click(function (){
        $('#modal-category-form')[0].reset();
        $('#modal-category').modal();
        // getDropdownOptionsStatic(baseUrl+'/api/modules', 'GET', 'modal_dropdown_module');
        // getDropdownOptionsStatic(baseUrl+'/api/enableoptions', 'GET', 'modal_dropdown_enableoptions');
    });

    $('#modal-category-form').on('submit', function () {
        var data = $(this).serializeArray();
        var form_url = baseUrl+'/api/settings/categories';
        doAjaxProcess('PATCH', '#modal-category-form', data, form_url);
        return false;
    });


    if($("#category-table").length)
    {
        var categoryTable;
        categoryTable = $('#category-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: baseUrl+'/api/settings/categories',
                type:'POST'
            },
            columns: [
                {
                    width:'5%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'name', name: 'name', searchable: true, orderable: true, width:'85%' },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'10%', className: "text-center"},
            ]
        });
    }

    
    if($("#user-table").length)
    {
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: baseUrl+'/api/settings/users',
                type:'POST'
            },
            columns: [
                {
                    width:'2%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'name', name: 'name', searchable: true, orderable: true, width:'25%' },
                { data: 'email', name: 'email', searchable: true, orderable: true, width:'25%' },
                { data: 'status', name: 'status', searchable: false, orderable: false, width:'15%' },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'20%', className: "text-center"},
            ],
            "order": [[1, "asc"]],
        });
    }

    if($("#status-table").length)
    {
        var statusTable = $('#status-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: baseUrl+'/api/settings/statuses',
                type:'POST'
            },
            columns: [
                {
                    width:'2%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'name', name: 'name', searchable: true, orderable: true, width:'24%' },
                { data: 'module', name: 'module', searchable: true, orderable: true, width:'22%', className: "text-center" },
                { data: 'email_sending', name: 'email_sending', searchable: false, orderable: false, width:'10%', className: "text-center" },
                { data: 'default', name: 'default', searchable: false, orderable: false, width:'16%', className: "text-center" },
                { data: 'badge', name: 'badge', searchable: false, orderable: false, width:'16%', className: "text-center" },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'10%', className: "text-center"},
            ]
        });
    }

});

function editStatus (hashedId) 
{
    $('#modal-status-form')[0].reset();
    getDropdownOptionsStatic(baseUrl+'/api/modules', 'GET', 'modal_dropdown_module');
    getDropdownOptionsStatic(baseUrl+'/api/enableoptions', 'GET', 'modal_dropdown_enableoptions');
    $('#modal_status_id').val(hashedId);

    $('#modal-status-select-template-sms').html('<option value="">Please Select SMS Template</option>');

	$.ajax({
		url: baseUrl+'/api/settings/status/'+hashedId,
		type: "GET",
		dataType: 'json',
		success: function (result)
		{
            if (result.status == 200) 
            {
                $('#summernote').summernote('reset');
                $('select[name="module"] option[value="' + result.model.module + '"]').attr('selected','selected');
                $('#modal_status').val(result.model.name);
                if (result.model.module == "Order") {
                    $('#modal_div_emailsending').removeClass('hideme');
                }
                if (result.model.email_sending == "Disable" || result.model.module != "Order") {
                    $('#summernote').summernote('reset');
                }
                $('select[name="badge"] option[value="' + result.model.badge + '"]').attr('selected','selected');
                $('select[name="email_sending"] option[value="' + result.model.email_sending + '"]').attr('selected','selected');
                if (result.model.template != "") {
                    $('#summernote').summernote('code', result.model.template);
                }
                window.template__sms_id = result.model.template__sms_id;
                $('#modal-status').modal();
            } else {
                swalWarning ("Oops", "Status not found", "warning", "Close");
                return false;
            }
		}
	});

    $.ajax({
        type: "GET",
        url: baseUrl+"/api/templates/sms",
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                $.each(response.model, function( index, value ) {
                    if (window.template__sms_id == value.id) {
                        $('#modal-status-select-template-sms').append('<option value="'+value.id+'" selected="selected">'+value.name+'</option>');
                    } else {
                        $('#modal-status-select-template-sms').append('<option value="'+value.id+'">'+value.name+'</option>');
                    }
                });
            }
        }
    });
}

function deleteStatus (hashedId) 
{
    var form_url = baseUrl+'/api/settings/status/'+hashedId;
    doAjaxConfirmProcessing('DELETE', '', {}, form_url);
}


function editCategory (hashedId) 
{
    $('#modal-category-form')[0].reset();
    $('#modal_category_id').val(hashedId);
	$.ajax({
		url: baseUrl+'/api/settings/categories/'+hashedId,
		type: "GET",
		dataType: 'json',
		success: function (result) 
		{
            if (result.status == 200) 
            {
                $('#modal_category_name').val(result.model.name);
                $('#modal-category').modal();
            } else {
                swalWarning ("Oops", "Category not found", "warning", "Close");
                return false;
            }
		}
	});
}

function deleteCategory (hashedId) 
{
    var form_url = baseUrl+'/api/settings/categories/'+hashedId;
    doAjaxConfirmProcessing('DELETE', '', {}, form_url);
}

function deleteuser(id){
    var form_url = baseUrl+'/admin/settings/users/'+id;
    doAjaxConfirmProcessing ('DELETE', '', {}, form_url)
}
