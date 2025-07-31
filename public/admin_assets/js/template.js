(function ($) {
    'use strict'

    $(document).on('click', ".password-icon, .password-icon-js",function () {
        let passwordInput = $(this).data("input");
        passwordInput = $(`#${passwordInput}`);
        if (passwordInput.attr('type') == 'text') {
            passwordInput.attr('type', 'password');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        }else{
            passwordInput.attr('type', 'text');
            
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });    

    // Restrict numbers in fields with the 'no-numbers' class
    $(document).on("keypress", ".alpha-allowed", function (e) {
        if (e.which >= 48 && e.which <= 57) { // ASCII codes for numbers 0-9
            e.preventDefault();
        }
    });

    // Allow only numbers in fields with the 'only-numbers' class
    $(document).on("keypress", ".numeric-allowed", function (e) {
        if (e.which < 48 || e.which > 57) { // Allow only 0-9
            e.preventDefault();
        }
    });

    // Prevent pasting non-numeric characters into 'numeric-allowed' fields
    $(document).on("paste", ".numeric-allowed", function (e) {
        let clipboardData = (e.originalEvent || e).clipboardData.getData("text");
        if (!clipboardData.match(/^\d+$/)) {
            e.preventDefault();
        }
    });

})(jQuery)
