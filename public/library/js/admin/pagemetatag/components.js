var baseUrl = $('body').attr('data-url');

$(function () {
    
    $('#create-meta-tags').click(function (){
        $('#modal_tag_content').html('Meta Tag Content');
        $('#modal-metatags-form')[0].reset();
        $('#modal-metatags').modal();
    });

    $('#modal-metatags-form').on('submit', function () {
        var hashedpageid = $('#hashedpageid').attr('data-attr-id');
        var data = $(this).serializeArray();
        var form_url = baseUrl+'/api/pagebuilder/'+hashedpageid+'/tags';
        doAjaxProcess('PATCH', '#modal-metatags-form', data, form_url);
        return false;
    });

    if($("#metatags-table").length)
    {
        var hashedpageid = $('#hashedpageid').attr('data-attr-id');
        var categoryTable;
        categoryTable = $('#metatags-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: baseUrl+'/api/pagebuilder/'+hashedpageid+'/tags',
                type:'POST'
            },
            columns: [
                {
                    width:'5%', searchable: false, orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, className: "text-center"
                },
                { data: 'name', name: 'name', searchable: true, orderable: true, width:'25%' },
                { data: 'page', name: 'page', searchable: true, orderable: true, width:'25%' },
                { data: 'content', name: 'content', searchable: true, orderable: true, width:'35%' },
                { data: 'action', name: 'action', searchable: false, orderable: false, width:'10%', className: "text-center"},
            ]
        });
    }

    $('#modal_dropdown_metatag_name').on('change', function () {
        if ($(this).val() === 'keywords') { 
            $('#modal_tag_content').html('Site Keywords (Separate with commas)');
        } else {
            $('#modal_tag_content').html('Meta Tag Content');
        }
    })
});



function updatemetatag (hashedId) 
{
    var hashedpageid = $('#hashedpageid').attr('data-attr-id');
    $('#modal-metatags-form')[0].reset();
    $('#modal_page_metatag_id').val(hashedId);
	$.ajax({
		url: baseUrl+'/api/pagebuilder/'+hashedpageid+'/tags/'+hashedId,
		type: "GET",
		dataType: 'json',
		success: function (result) 
		{
            if (result.status == 200) 
            {
                if (result.model.name === 'keywords') { 
                    $('#modal_tag_content').html('Site Keywords (Separate with commas)');
                } else {
                    $('#modal_tag_content').html('Meta Tag Content');
                }
                $('#modal_dropdown_metatag_name option[value="' + result.model.name + '"]').attr('selected','selected');
                $('#modal_metatag_content').val(result.model.content);
                $('#modal-metatags').modal();
            } else {
                swalWarning ("Oops", "Category not found", "warning", "Close");
                return false;
            }
		}
	});
}

function deletemetatag (hashedId) 
{
    var hashedpageid = $('#hashedpageid').attr('data-attr-id');
    var form_url = baseUrl+'api/pagebuilder/'+hashedpageid+'/tags/'+hashedId;
    doAjaxConfirmProcessing('DELETE', '', {}, form_url);
}

