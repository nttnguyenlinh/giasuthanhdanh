$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#luong').mask("#.##0", {reverse: true});
    $('#lephi').mask("00");

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
    $("#lephi").inputFilter(function (value) {
        return /^\d*$/.test(value);
    });

    $('#tb_dslop').DataTable({
        language: {'url': '/dataTables/Vietnamese.json'},
        responsive: true,
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: 'danh-sach-lop/danh-sach',
            type: 'get',
        },
        rowId: 'id',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'thongtin', name: 'thongtin', orderable: false, searchable: false},
            {data: 'dangky', name: 'dangky', orderable: false, searchable: false},
            {data: 'chitiet', name: 'chitiet', orderable: false, searchable: false},
            {data: 'thanhtoan', name: 'thanhtoan', orderable: false, searchable: false},
            {data: 'yeucau', name: 'yeucau', orderable: false, searchable: true},
            {data: 'trangthai', name: 'trangthai', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "order": [[ 0, "desc" ]]
    });

    $(document).on('click', '#edit', function() {
        var id = $(this).val();

        $('#sid').text('');
        $('#id').val('');
        $('#malop').val('');
        $('#diachi').val('');
        $('#monday').val('');
        $("#lopday").val('');
        $("#loailop").val('');
        $("#thongtin").val('');
        $("#sobuoihoc").val('');
        $("#thoigianhoc").val('');
        $("#luong").val('');
        $("#lephi").val('');
        $("#yeucau").val('');

        $.ajax({
            url: 'danh-sach-lop/lay-thong-tin',
            type: 'get',
            data: {id:id},
            dataType: 'json',
            success: function(data){
                $('#sid').text(data.id);
                $('#id').val(data.id);
                $('#malop').val(data.malop);
                $('#diachi').val(data.diachi);
                $('#monday').val(data.monday);
                $("#lopday").val(data.lopday);
                $("#loailop").val(data.loailop);
                $("#thongtin").val(data.thongtin);
                $("#sobuoihoc").val(data.sobuoihoc);
                $("#thoigianhoc").val(data.thoigianhoc);
                $("#luong").val(data.luong);
                $("#lephi").val(data.lephi);
                $("#yeucau").val(data.yeucau);
            }
        });
    });

    $(document).on('click', '#trangthai', function() {
        var id = $(this).val();
        var trangthai = $(this).data('status');
        $.ajax({
            url: 'danh-sach-lop/thay-doi',
            type: 'post',
            data: {id: id, trangthai:trangthai},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_dslop').DataTable().ajax.reload();
            }
        });
    });

    $(document).on('click', '#remove', function() {
        var id = $(this).val();
        $.ajax({
            url: 'danh-sach-lop/xoa',
            type: 'delete',
            data: {id: id, _method: 'delete'},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_dslop').DataTable().ajax.reload();
            }
        });
    });
});