
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#tb_nguoidung').DataTable({
        language: {'url': '/dataTables/Vietnamese.json'},
        processing: true,
        serverSide: true,
        ajax: {
            url: 'nguoi-dung/danh-sach',
            type: 'get',
        },
        rowId: 'id',
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'email_verified_at'},
            {data: 'is_active'},
            {data: 'created_at'},
            {data: 'action', orderable: false, searchable: false}
        ]
    });

    $.validator.addMethod("email_regex", function (value) {
        return /^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/.test(value);
    });

    $("#frm_them_nguoidung").validate({
        rules: {
            name: {required: true},
            email: {required: true, email: true, email_regex: true},
            password: {required: true},
        },

        messages: {
            name: {
                required: 'Vui lòng nhập tên bạn.'
            },

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

    $(document).on('click', '#lock', function() {
        var id = $(this).val();
        var is_active = $(this).attr('id');
        $.ajax({
            url: 'nguoi-dung/thay-doi',
            type: 'post',
            dataType: 'json',
            data: {id: id, is_active: is_active},
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_nguoidung').DataTable().ajax.reload();
            }
        });
    });

    $(document).on('click', '#unlock', function() {
        var id = $(this).val();
        var is_active = $(this).attr('id');
        $.ajax({
            url: 'nguoi-dung/thay-doi',
            type: 'post',
            dataType: 'json',
            data: {id: id, is_active: is_active},
            success: function (data) {
               toastr[data.status](data.message);
                $('#tb_nguoidung').DataTable().ajax.reload();
            }
        });
    });

    $(document).on('click', '#remove', function() {
        var id = $(this).val();
        $.ajax({
            url: 'nguoi-dung/xoa',
            type: 'delete',
            data: {id: id, _method: 'delete'},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_nguoidung').DataTable().ajax.reload();
            }
        });
    });
});