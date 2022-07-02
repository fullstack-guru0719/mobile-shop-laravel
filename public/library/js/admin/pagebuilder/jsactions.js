
$(function () {
    var base_url = $('body').attr('data-url');

    
    /**
     *  Open Modal for Creating Page Builder
     */

    $('#create-page').click(function (){
        $('#page-title, #page-url, #page_id').val('');
        $('#create_pagebuilder').removeClass('hideme');
        $('#edit_pagebuilder').addClass('hideme');
        $('#page-url').removeAttr("readonly");
        $('#modal-page').modal();
    });

    /**
     *  Open Modal for Editing Page Builder
     */
    $('.edit-page').click(function () {
        var hashedId = $(this).attr('data-attr-id');
        var identification = $(this).attr('data-attr-identification');
        if (identification == 1 || identification == 7) {
            $('#page-url').prop("readonly", true);
        } else {
            $('#page-url').prop("readonly", false);
        }
        $('#page-title, #page-url, #page_id').val('');
        $('#create_pagebuilder, #edit_pagebuilder').addClass('hideme');
		var form_url = base_url+"/admin/pagebuilder/"+hashedId;
        $.ajax({
            type: "GET",
            url: form_url,
            dataType: "json",
            success: function (response) {
                $('#page-title').val(response.title);
                $('#page-url').val(response.url);
                $('#page_id').val(response.hashedid);
                $('#edit_pagebuilder').removeClass('hideme');
                $('#modal-page').modal();
            }
        });
    });

    /**
     *  Submit Form for Posting Page Builder Content
     */
    $('#create_pagebuilder').click(function () {
        $('#page_id').val('');
        var form_url = base_url+"/admin/pagebuilder/";
        var datas = $('#form_pagebuilder').serializeArray();
        $.ajax({
            url: form_url,
            type: "POST",
            data: datas,
            dataType: 'json',
        })
        .done(function(result) {
            if (result.response == 200) {
                swal({
                    title : "Congratulations!",
                    text : result.message,
                    icon : "success", 
                    buttons: "Ok",
                })
                location.reload();
            } else {
                swal({
                    title : "Oops!",
                    text : result.message,
                    icon : "warning", 
                    buttons: "Close",
                })
            }
        })
        .fail(function() {
            console.log("error");
        });
        return false;
    });

    $('#edit_pagebuilder').click(function () {
        var hashedId = $('#page_id').val();
        var form_url = base_url+"/admin/pagebuilder/"+hashedId;
        var datas = $('#form_pagebuilder').serializeArray();
        $.ajax({
            url: form_url,
            type: "PUT",
            data: datas,
            dataType: 'json',
        })
        .done(function(result) {
            if (result.response == 200) {
                swal({
                    title : "Congratulations!",
                    text : result.message,
                    icon : "success", 
                    buttons: "Ok",
                })
                location.reload();
            } else {
                swal({
                    title : "Opps!",
                    text : result.message,
                    icon : "warning", 
                    buttons: "Close",
                })
            }
        })
        .fail(function() {
            console.log("error");
        });
        return false;
    });

    $('.colorpicker').colorpicker()
    $('.colorpicker').on('colorpickerChange', function(event) {
        $('.colorpicker .fa-square').css('color', event.color.toString());
    });
});