$(document).ready(function () {
    $("#frmngaysinh").datepicker({
        language: 'vi-VN',
        format: 'dd-mm-yyyy',
        date: new Date(Date.now()),
        autoHide: true
    });

    $("#frmngaysinh").val($.datepicker.formatDate('dd-mm-yy', new Date()));

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
    $("#frmsdt").inputFilter(function (value) {
            return /^\d*$/.test(value);
        });

    $("#frmcmnd").inputFilter(function (value) {
        return /^\d*$/.test(value);
    });

    $.validator.addMethod("phone_regex", function (value) {
        return /^(03[2|3|4|5|6|7|8|9]|05[6|8|9]|07[0|6|7|8|9]|08[1|2|3|4|5|6|8|9]|09[0|1|2|3|4|6|7|8|9])+([0-9]{7})$/.test(value);
    });

    $.validator.addMethod("email_regex", function (value) {
        return /^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/.test(value);
    });

    $.validator.addMethod("cmnd_regex", function (value) {
        return /^((?!(0))[0-9]{9,12})$/.test(value);
    });

    $.validator.addMethod("gioitinh_regex", function (value) {
        return /^[0-1]{1}$/.test(value);
    });

    $.validator.addMethod("year_regex", function (value) {
        return /^\b(19|20)\d{2}\b$/.test(value);
    });

    $.validator.addMethod("date_regex", function (value, element) {
        return /^([0-2][0-9]|(3)[0-1])(\/|-)(((0)[0-9])|((1)[0-2]))(\/|-)\d{4}$/.test(value);
});

    var availableTruongs = [];
    var availableNganhs = [];
    availableTruongs.push('ĐH Sư Phạm HCM');
    availableTruongs.push('ĐH Ngoại Thương HCM');
    availableTruongs.push('ĐH Ngân Hàng HCM');
    availableTruongs.push('ĐH Bách Khoa HCM');
    availableTruongs.push('ĐH Kinh Tế HCM');
    availableTruongs.push('ĐH Khoa Học Tự Nhiên HCM');
    availableTruongs.push('ĐH Y Dược HCM');
    availableTruongs.push('ĐH Y Khoa Phạm Ngọc Thạch HCM');
    availableTruongs.push('ĐH Công Nghiệp HCM');
    availableTruongs.push('ĐH Luật HCM');
    availableTruongs.push('ĐH Kinh Tế Luật HCM');
    availableTruongs.push('ĐH Mở HCM');
    availableTruongs.push('ĐH Quốc Gia HCM');
    availableTruongs.push('ĐH Công Nghệ Thông Tin HCM');
    availableTruongs.push('ĐH FPT');
    availableTruongs.push('ĐH Giao Thông Vận Tải HCM');
    availableTruongs.push('ĐH Giao Thông Vận Tải Cơ Sở 2');
    availableTruongs.push('HV Bưu Chính Viễn Thông HCM');
    availableTruongs.push('ĐH Nông Lâm HCM');
    availableTruongs.push('ĐH Sư Phạm Kỹ Thuật HCM');
    availableTruongs.push('ĐH Sài Gòn HCM');
    availableTruongs.push('ĐH RMIT');
    availableTruongs.push('ĐH Ngoại Ngữ Tin Học HCM');
    availableTruongs.push('ĐH Quốc Tế HCM');
    availableTruongs.push('ĐH Kiến Trúc HCM');
    availableTruongs.push('ĐH Khoa Học Xã Hội Và Nhân Văn HCM');
    availableTruongs.push('HV Hàng Không');
    availableTruongs.push('ĐH Tài Chính Marketing HCM');
    availableTruongs.push('ĐH Tôn Đức Thắng HCM');
    availableTruongs.push('ĐH Mỹ Thuật HCM');
    availableTruongs.push('Nhạc Viện HCM');
    availableTruongs.push('ĐH Tài Nguyên Và Môi Trường HCM');
    availableTruongs.push('ĐH Văn Hóa');
    availableTruongs.push('CĐ Công Thương HCM');
    availableTruongs.push('CĐ Kinh Tế Đối Ngoại HCM');
    availableTruongs.push('CĐ Tài Chính Hải Quan');
    availableTruongs.push('CĐ Sư Phạm Trung Ương HCM');
    availableTruongs.push('CĐ Điện Lực HCM');
    availableTruongs.push('CĐ Giao Thông Vận Tải 3 HCM');
    availableTruongs.push('CĐ Giao thông Vận tải HCM');
    availableTruongs.push('CĐ Kinh tế HCM');
    availableTruongs.push('CĐ Kỹ thuật Cao Thắng HCM');
    availableTruongs.push('CĐ Kỹ thuật Lý Tự Trọng HCM');
    availableTruongs.push('CĐ Phát thanh Truyền hình 2');
    availableTruongs.push('CĐ Văn hóa Nghệ thuật HCM');
    availableTruongs.push('CĐ Xây dựng số 2 HCM');
    availableTruongs.push('ĐH Công nghiệp Thực phẩm HCM');
    availableTruongs.push('ĐH Sân khấu Điện ảnh HCM');
    availableTruongs.push('ĐH Thể dục Thể thao HCM');
    availableTruongs.push('ĐH Quốc tế Hồng Bàng HCM');
    availableTruongs.push('ĐH Nguyễn Tất Thành HCM');
    availableTruongs.push('ĐH Văn Hiến HCM');
    availableTruongs.push('ĐH Văn Lang HCM');
    availableTruongs.push('ĐH Kinh tế - Tài chính HCM');
    availableTruongs.push('ĐH Hoa Sen HCM');
    availableTruongs.push('ĐH Thủy Lợi - Cơ sở 2 HCM');
    availableTruongs.push('ĐH Quy Nhơn');
    availableNganhs.push('Sư phạm Toán học');
    availableNganhs.push('Sư phạm Tin học');
    availableNganhs.push('Sư phạm Vật lý');
    availableNganhs.push('Sư phạm Hóa học');
    availableNganhs.push('Sư phạm Sinh học');
    availableNganhs.push('Sư phạm Ngữ văn');
    availableNganhs.push('Sư phạm Lịch sử');
    availableNganhs.push('Sư phạm Địa lý');
    availableNganhs.push('Sư phạm Tiếng Anh');
    availableNganhs.push('Giáo dục Mầm non');
    availableNganhs.push('Giáo dục Tiểu học');
    availableNganhs.push('Giáo dục Đặc biệt');
    availableNganhs.push('Sư phạm tiếng Nga');
    availableNganhs.push('Sư phạm Tiếng Pháp');
    availableNganhs.push('Sư phạm Tiếng Trung Quốc');
    availableNganhs.push('Kế Toán');
    availableNganhs.push('Kiểm toán');
    availableNganhs.push('Kế toán - Kiểm toán');
    availableNganhs.push('Quản Trị Kinh Doanh');
    availableNganhs.push('Toán - Tin');
    availableNganhs.push('Công Nghệ Thông Tin');
    availableNganhs.push('Ngôn ngữ Anh');
    availableNganhs.push('Ngôn ngữ Nga');
    availableNganhs.push('Ngôn ngữ Pháp');
    availableNganhs.push('Ngôn ngữ Trung Quốc');
    availableNganhs.push('Ngôn ngữ Nhật');
    availableNganhs.push('Ngôn ngữ Hàn Quốc');
    availableNganhs.push('ngoại ngữ');
    availableNganhs.push('Nhật bản học');

    $("#frmtruonghoc").autocomplete({
        source: availableTruongs
    });

    $("#frmnganhhoc").autocomplete({
        source: availableNganhs
    });

    $("#frmReg").validate({
        rules: {
            frmholot:{required: true, maxlength: 30},
            frmten:{required: true, maxlength: 30},
            frmngaysinh:{required: true, date_regex:true},
            frmgioitinh:{required: true, gioitinh_regex:true},
            frmnoisinh:{required: true, maxlength: 20},
            frmdiachi:{required: true, maxlength: 20},
            frmquanhuyen:{required: true, maxlength: 20},
            frmtinhthanh:{required: true, maxlength: 20},
            frmemail: {required: true, email:true, email_regex: true},
            frmsdt: {required: true, phone_regex: true},
            frmcmnd: {required: true, cmnd_regex: true},

            frmtruonghoc: {required: true},
            frmnganhhoc: {required: true},
            frmnamtn: {required: true, year_regex:true},
            frmtrinhdo: {required: true},
            'frmmonday[]': {required: true},
            'frmlopday[]': {required: true},
            'frmkhuvuc[]': {required: true},
        },
        messages: {
            frmholot: {
                required: 'Vui lòng nhập họ lót.',
                maxlength: 'Họ lót quá dài.'
            },
            frmten: {
                required: 'Vui lòng nhập tên.',
                maxlength: 'Tên quá dài.'
            },
            frmngaysinh: {
                required: 'Vui lòng nhập ngày sinh.',
                date_regex: 'Ngày sinh không hợp lệ.'
            },
            frmgioitinh: {
                required: 'Vui lòng chọn giới tính.',
                gioitinh_regex: 'Giới tính không hợp lệ.'
            },

            frmnoisinh: {
                required: 'Vui lòng chọn nơi sinh.',
                maxlength: 'Nơi sinh quá dài.'
            },

            frmdiachi: {
                required: 'Vui lòng nhập địa chỉ.',
                maxlength: 'Địa chỉ quá dài.'
            },

            frmquanhuyen: {
                required: 'Vui lòng nhập quận huyện.',
                maxlength: 'Quận huyện quá dài.'
            },

            frmtinhthanh: {
                required: 'Vui lòng chọntỉnh thành.',
                maxlength: 'Tỉnh thành quá dài.'
            },

            frmemail: {
                required: 'Vui lòng nhập địa chỉ email.',
                email: 'Email không hợp lệ.',
                email_regex: 'Email không hợp lệ.',
            },

            frmsdt: {
                required: 'Vui lòng nhập số điện thoại.',
                phone_regex: 'Số điện thoại không hợp lệ.',
            },
            frmcmnd: {
                required: 'Vui lòng nhập CMND/CCCD.',
                cmnd_regex: 'CMND/CCCD không hợp lệ.',
            },

            frmtruonghoc: {
                required: 'Vui lòng chọn trường học.'
            },

            frmnganhhoc: {
                required: 'Vui lòng chọn ngành học.'
            },
            frmnamtn: {
                required: 'Vui lòng chọn năm TN.',
                year_regex: 'Năm TN không hợp lệ.',
            },

            frmtrinhdo: {
                required: 'Vui lòng chọn trình độ.'
            },

            'frmmonday[]': {
                required: 'Vui lòng chọn môn dạy.'
            },

            'frmlopday[]': {
                required: 'Vui lòng chọn lớp dạy.'
            },

            'frmkhuvuc[]': {
                required: 'Vui lòng chọn khu vực dạy.'
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("type") == "checkbox")
                error.insertAfter($(element).parent().parent().next($('.error')));
            else
                error.insertAfter($(element));
        }
    });

    $("#frmReg").ready(function () {

        $('#anhthebtn').on('click', function() {
            $('#frmanhthe').click();
        });

        $('#cmndbtn').on('click', function() {
            $('#frmanhcmnd').click();
        });

        $('#frmanhthe').change(function() {
            var f = this.files[0];
            if(f.size>3145728)
            {
                Swal.fire({
                    type: "error",
                    title: "Hình ảnh quá lớn",
                    text: "Vui lòng chọn tệp hình ảnh khác nhỏ hơn 3MB!",
                });
                $('#anhthetext').text("Chưa có ảnh nào được chọn");
                $('#frmanhthe').attr("src","blank");
                $('#frmanhthe').wrap('<form>').closest('form').get(0).reset();
                $('#frmanhthe').unwrap();
                return false;
            }

            if(f.type.indexOf("image")==-1)
            {
                Swal.fire({
                    type: "error",
                    title: "Hình ảnh không hợp lệ",
                    text: "Vui lòng chọn tệp hình ảnh!",
                });
                $('#anhthetext').text("Chưa có ảnh nào được chọn");
                $('#frmanhthe').attr("src","blank");
                $('#frmanhthe').wrap('<form>').closest('form').get(0).reset();
                $('#frmanhthe').unwrap();
                return false;
            }
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#frmanhthe').src = e.target.result;
                $('#frmanhthe').show();
                $('#anhthetext').text(f.name);
            };
            reader.readAsDataURL(f);
        });

        $('#frmanhcmnd').change(function() {
            var ff = this.files[0];
            if(ff.size>3145728){
                Swal.fire({
                    type: "error",
                    title: "Hình ảnh quá lớn",
                    text: "Vui lòng chọn tệp hình ảnh khác nhỏ hơn 3MB!",
                });
                $('#cmndtext').text("Chưa có ảnh nào được chọn");
                $('#frmanhcmnd').attr("src","blank");
                $('#frmanhcmnd').wrap('<form>').closest('form').get(0).reset();
                $('#frmanhcmnd').unwrap();
                return false;
            }
            if(ff.type.indexOf("image")==-1) {
                Swal.fire({
                    type: "error",
                    title: "Hình ảnh không hợp lệ",
                    text: "Vui lòng chọn tệp hình ảnh!",
                });
                $('#cmndtext').text("Chưa có ảnh nào được chọn");
                $('#frmanhcmnd').attr("src", "blank");
                $('#frmanhcmnd').wrap('<form>').closest('form').get(0).reset();
                $('#frmanhcmnd').unwrap();
                return false;
            }

            var readerr = new FileReader();
            readerr.onload = function (e) {
                $('#frmanhcmnd').src = e.target.result;
                $('#frmanhcmnd').show();
                $('#cnmdtext').text(ff.name);
            };
            readerr.readAsDataURL(ff);
        });
    });
});

