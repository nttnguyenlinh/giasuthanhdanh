$(document).ready(function () {
    //Kiểm tra mật khẩu
    // Mật khẩu mạnh. Có ít nhất 1 chữ thường, 1 chữ in hoa, 1 chữ số, 1 ký tự đặc biệt và độ dài từ 6-20 ký tự.
    //     Trình tự không quan trọng. Được microsoft chỉ định cho một mật khẩu mạnh.

    $.validator.addMethod("pass_regex", function (value) {
        return /(?=^.{6,20}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&amp;*()_+}{&quot;:;'?/&gt;.&lt;,])(?!.*\s).*$/.test(value);
    });

    $("#frmdmk").validate({
        rules: {
            mkht: {
                required: true
            },
            mkm: {
                required: true,
                pass_regex: true
            },
            xnmk: {
                required: true,
                equalTo: "#mkm"
            },
        },

        messages: {
            mkht: {
                required: 'Vui lòng nhập mật khẩu hiện tại.'
            },

            mkm: {
                required: 'Vui lòng nhập mật khẩu mới.',
                pass_regex: 'Mật khẩu từ 6-20 ký tự, bao gồm: chữ thường, hoa, số, ký tự đặc biệt như: !@#$%^*()-_+{}|\'"/<>.~='
            },
            xnmk: {
                required: 'Vui lòng nhập lại mật khẩu mới.',
                equalTo: 'Mật khẩu mới không trùng khớp.'
            },
        }
    });
});
