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
    $("#sdt").inputFilter(function (value) {
            return /^\d*$/.test(value);
        });

    $.validator.addMethod("phone_regex", function (value) {
        return /^(03[2|3|4|5|6|7|8|9]|05[6|8|9]|07[0|6|7|8|9]|08[1|2|3|4|5|6|8|9]|09[0|1|2|3|4|6|7|8|9])+([0-9]{7})$/.test(value);
    });

    $.validator.addMethod("email_regex", function (value) {
        return /^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/.test(value);
    });

    $("#frmReg").validate({
        rules: {
            frmhoten:{required: true, maxlength: 30},
            frmdiachi:{required: true, maxlength: 50},
            frmsdt: {required: true, phone_regex: true},
            frmlophoc: {required: true},
            frmmonhoc: {required: true, maxlength: 50},
            frmloailop: {required: true},
            frmsobuoihoc: {required: true},
            frmyeucau: {required: true},
            frmthoigianhoc: {required: true, maxlength: 30},
        },
        messages: {
            frmhoten: {
                required: 'Vui lòng nhập họ tên.',
                maxlength: 'Họ và tên bạn quá dài.'
            },
            frmdiachi: {
                required: 'Vui lòng nhập địa chỉ.',
                maxlength: 'Địa chỉ quá dài.'
            },
            frmsdt: {
                required: 'Vui lòng nhập số điện thoại.',
                phone_regex: 'Số điện thoại không hợp lệ.',
            },
            frmlophoc: {
                required: 'Vui lòng chọn lớp học.'
            },
            frmmonhoc: {
                required: 'Vui lòng điền môn học cần đăng ký.',
                maxlength: 'Nội dung quá dài.'
            },
            frmloailop: {
                required: 'Vui lòng chọn loại lớp học.'
            },
            frmsobuoihoc: {
                required: 'Vui lòng chọn số buổi học.'
            },
            frmthoigianhoc: {
                required: 'Vui lòng nhập thời gian học [thứ mấy - mấy giờ - buổi nào].',
                maxlength: 'Nội dung quá dài.'
            },
            frmyeucau: {
                required: 'Vui lòng chọn người dạy.'
            }
        }
    });
});