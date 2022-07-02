$(function () {

    $('.page-form-login').on('submit', function () {
        $('.page-form-login-button').html('<i class="fa fa-spinner fa-spin"></i> Signing in...')
    });
    
    $('#signUp').on('click', function () {
        window.location.href = "register";
    });
});
