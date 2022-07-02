var baseUrl = $('body').attr('data-url');

let sms_content = 600;
let counter_color = '';

$(function () {
    
    /**
     * EMAIL
     */

    if($("#emailtemplate-table").length)
    {
        $('#emailtemplate-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: baseUrl+'/api/templates/email',
                type:'POST'
            },
            columns: [
                {
                    width:'4%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'name', name: 'name', searchable: true, orderable: true, width:'16%' },
                { data: 'description', name: 'description', searchable: true, orderable: true, width:'16%' },
                { data: 'model', name: 'model', searchable: true, orderable: true, width:'16%' },
                { data: 'status', name: 'status', searchable: false, orderable: false, width:'16%' },
                { data: 'scheduled_days', name: 'scheduled_days', searchable: true, orderable: true, width:'16%' },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'16%', className: "text-center"},
            ]
        });
    }
    
    $('#create-emailtemplate').click(function (){
        $('.modal-header-emailtemplate-action').html('Create');
        $('#modal-emailtemplate-form')[0].reset();
        getDropdownOptionsStatic(baseUrl+'/api/notificationmodules', 'GET', 'modal_emailtemplate_model');
        $('.modal_div_schedule_reminder').addClass('hideme');
        $('#modal_emailtemplate_scheduled_days').val(0);
        $('#modal-emailtemplate').modal();
    });
    

    $('#modal-emailtemplate-form').on('submit', function () {
        var data = $(this).serializeArray();

        if (
            validate_field ('modal_emailtemplate_name') == false || 
            validate_field ('modal_emailtemplate_subject') == false || 
            validate_field ('modal_emailtemplate_description') == false || 
            validate_field ('modal_emailtemplate_receiver') == false || 
            validate_field ('modal_emailtemplate_status') == false || 
            validate_field ('modal_emailtemplate_model') == false
        ) 
        {
            return false;
        }

        var form_url = baseUrl+'/api/templates/email';
        doAjaxProcess('PATCH', '#modal-emailtemplate-form', data, form_url);
        return false;
    });

    $('#modal_emailtemplate_model').on('change', function () {
        if ($(this).val() != "Reminder") {
            $('#modal_emailtemplate_scheduled_days').val(0);
            $('.modal_div_schedule_reminder').addClass('hideme');
        } else {
            $('.modal_div_schedule_reminder').removeClass('hideme');
        }
    });

    /**
     * SMS
     */

    if($("#smstemplate-table").length)
    {
        $('#smstemplate-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: baseUrl+'/api/templates/sms',
                type:'POST'
            },
            columns: [
                {
                    width:'4%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'name', name: 'name', searchable: true, orderable: true, width:'20%' },
                { data: 'receiver', name: 'receiver', searchable: true, orderable: true, width:'20%' },
                { data: 'status', name: 'status', searchable: true, orderable: true, width:'20%' },
                { data: 'model', name: 'model', searchable: true, orderable: true, width:'20%' },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'16%', className: "text-center"},
            ]
        });
    }
    
    $('#create-smstemplate').click(function (){
        $('.modal-header-smstemplate-action').html('Create');
        $('#modal-smstemplate-form')[0].reset();
        $('#modal-smstemplate').modal();
    });
    

    $('#modal-smstemplate-form').on('submit', function () {
        var data = $(this).serializeArray();
        if (
            validate_field ('modal_smstemplate_name') == false || 
            validate_field ('modal_smstemplate_receiver') == false || 
            validate_field ('modal_smstemplate_status') == false || 
            validate_field ('modal_smstemplate_model') == false || 
            validate_field ('modal_smstemplate_content') == false
        ) 
        {
            return false;
        }
        $('#sms-submit').html('<i class="fa fa-spinner fa-spin"></i> Please wait..')
        var form_url = baseUrl+'/api/templates/sms';
        doAjaxProcess('PATCH', '#modal-smstemplate-form', data, form_url);
        return false;
    });

    $('#modal_smstemplate_content_counter').html('<span class="text-green">'+ sms_content + '</span> characters remaining');


    $('#modal_smstemplate_content').on("keyup", function () {
        processCounter('#modal_smstemplate_content');
    });
});


function editEmailTemplate (hashedId) 
{
    $('.modal-header-emailtemplate-action').html('Update');
    $('#modal-emailtemplate-form')[0].reset();
    getDropdownOptionsStatic(baseUrl+'/api/notificationmodules', 'GET', 'modal_emailtemplate_model');
    $('.modal_div_schedule_reminder').addClass('hideme');
    $('#modal_emailtemplate_scheduled_days').val(0);
    $('#modal_emailtemplate_id').val(hashedId);
	$.ajax({
		url: baseUrl+'/api/templates/email/'+hashedId,
		type: "GET",
		dataType: 'json',
		success: function (result) 
		{
            if (result.status == 200) 
            {
                $('#modal_emailtemplate_name').val(result.emailtemplate.name);
                $('#modal_emailtemplate_subject').val(result.emailtemplate.subject);
                $('#modal_emailtemplate_description').val(result.emailtemplate.description);
                $('#modal_emailtemplate_model option[value="'+result.emailtemplate.model+'"]').attr('selected', 'selected');
                $('#modal_emailtemplate_status option[value="'+result.emailtemplate.status+'"]').attr('selected', 'selected');
                $('#modal_emailtemplate_receiver option[value="'+result.emailtemplate.receiver+'"]').attr('selected', 'selected');
                
                
                $('#email-content').summernote('reset');
                if (result.emailtemplate.content != "") {
                    $('#email-content').summernote('code', result.emailtemplate.content);
                }
                
                if (result.emailtemplate.model == "Reminder") {
                    $('.modal_div_schedule_reminder').removeClass('hideme');
                    $('#modal_emailtemplate_scheduled_days').val(result.emailtemplate.scheduled_days);
                }

                $('#modal-emailtemplate').modal();
            } else {
                swalWarning ("Oops", "Status not found", "warning", "Close");
                return false;
            }
		}
	});
}


function deleteEmailTemplate (hashedId) 
{
    var form_url = baseUrl+'/api/templates/email/'+hashedId;
    doAjaxConfirmProcessing('DELETE', '', {}, form_url);
}


function editSmsTemplate (hashedId) 
{

    $('.modal-header-smstemplate-action').html('Update');
    $('#modal-smstemplate-form')[0].reset();
    $('#modal_smstemplate_id').val(hashedId);
	$.ajax({
		url: baseUrl+'/api/templates/sms/'+hashedId,
		type: "GET",
		dataType: 'json',
		success: function (result) 
		{
            if (result.status == 200) 
            {
                $('#modal_smstemplate_name').val(result.smstemplate.name);
                $('#modal_smstemplate_content').val(result.smstemplate.content);
                $('#modal_smstemplate_model option[value="'+result.smstemplate.model+'"]').attr('selected', 'selected');
                $('#modal_smstemplate_receiver option[value="'+result.smstemplate.receiver+'"]').attr('selected', 'selected');
                $('#modal_smstemplate_status option[value="'+result.smstemplate.status+'"]').attr('selected', 'selected');

                processCounter('#modal_smstemplate_content');

                $('#modal-smstemplate').modal();
            } else {
                swalWarning ("Oops", "Status not found", "warning", "Close");
                return false;
            }
		}
	});
}


function deleteSmsTemplate (hashedId) 
{
    var form_url = baseUrl+'/api/templates/sms/'+hashedId;
    doAjaxConfirmProcessing('DELETE', '', {}, form_url);
}

function processCounter (strProperty) 
{
    var text_length = $(strProperty).val().length;
    var text_remaining = sms_content - text_length;
    if (text_remaining <= 600 && text_remaining > 50) {
        counter_color = 'text-green';
    } else if (text_remaining <= 50 && text_remaining > 10) {
        counter_color = 'text-yellow';
    } else if (text_remaining <= 9)  {
        counter_color = 'text-red';
    }

    $('#modal_smstemplate_content_counter').html('<span class="'+ counter_color +'">'+ text_remaining + '</span> characters remaining');
}