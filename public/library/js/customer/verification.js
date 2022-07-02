var baseUrl = $('body').attr('data-url');

$(function() {
    'use strict';

    var body = $('body');

    function goToNextInput(e) {
        var key = e.which,
        t = $(e.target),
        sib = t.next('input');

        if (key != 9 && (key < 48 || key > 57)) {
            e.preventDefault();
            return false;
        }

        if (key === 9) {
            return true;
        }

        if (!sib || !sib.length) {
            sib = body.find('input').eq(0);
        }
        sib.select().focus();
    }

    function onKeyDown(e) {
        var key = e.which;

        if (key === 9 || (key >= 48 && key <= 57)) {
            return true;
        }

        e.preventDefault();
        return false;
    }

    function onFocus(e) {
        $(e.target).select();
    }

    body.on('keyup', 'input', goToNextInput);
    body.on('keydown', 'input', onKeyDown);
    body.on('click', 'input', onFocus);


    $('#verify').on('click', function () {
        if ($('#input1').val() == '' || $('#input2').val() == '' || $('#input3').val() == '' || $('#input4').val() == '') 
        {
            swalWarning ("Oops", "Please enter valid verification code", "warning", "Close");
            return false;
        }
        $('#verify').html('<i class="fas fa-spinner fa-spin"></i> Verifying...');
        $('#verify').addClass('disabled');
        $.ajax({
            type: "POST",
            url: baseUrl+"/api/customer/verification",
            data: {
                'input1' : $('#input1').val(), 
                'input2' : $('#input2').val(), 
                'input3' : $('#input3').val(), 
                'input4' : $('#input4').val()
            },
            dataType: "json",
            success: function (result) {
                if (result.status == "400") 
                {
                    swal({
                        title : "Opps!",
                        text : result.message,
                        icon : "warning", 
                        buttons: "Close",
                    });
                    $('#verify').html('Verify');
                    $('#verify').removeClass('disabled');
                    return false;
                }
                else 
                {
                    swal({
                        title : "Congratulations!",
                        text : result.message,
                        icon : "success", 
                        buttons: "Done",
                    });
                    window.location.href = "dashboard";
                }
            }
        });
    });

    $('#resend-code').on('click', function () {
        let form_url = baseUrl+'/api/customer/verification/resend';
        doAjaxProcess('PATCH', '', {}, form_url);
    });
})