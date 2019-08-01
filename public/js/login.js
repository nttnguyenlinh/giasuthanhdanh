$(document).ready(function () {
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };

    $("#cmnd").inputFilter(function (value) {
            return /^\d*$/.test(value);
        }
    );

    $.validator.addMethod("cmnd_regex", function (value) {
        return /^((?!(0))[0-9]{9,12})$/.test(value);
    });

    $("#login-form").validate({
        rules: {
            cmnd: {required: true, number: true, cmnd_regex: true},
            password: {required: true},
        },

        messages: {
            cmnd: {
                required: 'Vui lòng nhập CMND/CCCD.',
                number: 'CMND/CCCD là một dãy số.',
                cmnd_regex: 'CMND/CCCD không hợp lệ!'
            },

            password: {
                required: 'Vui lòng nhập mật khẩu.'
            }
        }
    });
});