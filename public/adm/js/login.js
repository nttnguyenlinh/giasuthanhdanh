$(document).ready(function () {
    $.validator.addMethod("email_regex", function (value) {
        return /^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/.test(value);
    });

    $("#form-login").validate({
        rules: {
            email: {required: true, email: true, email_regex: true},
            password: {required: true},
        },

        messages: {
            email: {
                required: 'Vui lòng nhập email.',
                email: 'Email không hợp lệ!',
                email_regex: 'Email không hợp lệ!'
            },

            password: {
                required: 'Vui lòng nhập mật khẩu.'
            }
        }
    });
});