$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#luong').mask("#.##0", {reverse: true});
    $('#lephi').mask("00");

    $('#btn_taoma').click(function() {
        $('#malop').click();
    });

    $('#malop').click(function() {
        var malop = Math.floor(Math.random() * 1000000);
        $(this).val(malop);
        $.ajax({
            url: 'danh-sach-dang-ky/kiem-tra-ma-lop',
            type: 'get',
            data: {malop:malop},
            dataType: 'json',
            success:function(data){
                $('.kiemtra').children('#lb_kiemtra').remove()
                $('.kiemtra').append("<label id='lb_kiemtra' class='" + data.status + "'>" +data.message + "</label>");
            }
        });
    });

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

    $('#tb_phieudangky').DataTable({
        language: {'url': '/dataTables/Vietnamese.json'},
        responsive: true,
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: 'danh-sach-dang-ky/danh-sach',
            type: 'get',
        },
        rowId: 'id',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'hoten', name: 'hoten', orderable: false},
            {data: 'thongtinlienhe', name: 'sdt', orderable: false},
            {data: 'thongtinlop', name: 'thongtinlop', orderable: false, searchable: false},
            {data: 'thongtinhocvien', name: 'thongtinhocvien', orderable: false, searchable: false},
            {data: 'thoigianhoc', name: 'thoigianhoc', orderable: false, searchable: false},
            {data: 'yeucau', name: 'yeucau', orderable: false, searchable: false},
            {data: 'trangthai', name: 'trangthai', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "order": [[ 0, "desc" ]]
    });

    $(document).on('click', '#molop', function() {
        var id = $(this).val();
        $.ajax({
            url: 'danh-sach-dang-ky/lay-thong-tin',
            type: 'get',
            data: {id:id},
            dataType: 'json',
            success: function(data){
                $('#phieudangky_id').val(data.id);
                $('#diachi').val(data.diachi);
                $('#monday').val(data.monday);
                $("#lopday").val(data.lopday);
                $("#loailop").val(data.loailop);
                $("#thongtin").val(data.sohocsinh + ', ' + data.hocluc);
                $("#sobuoihoc").val(data.sobuoihoc);
                $("#thoigianhoc").val(data.thoigianhoc);
                $("#yeucau").val(data.yeucau + ' - ' + data.yeucauthem);
            }
        });
    });

    $(document).on('click', '#remove', function() {
        var id = $(this).val();
        $.ajax({
            url: 'danh-sach-dang-ky/xoa',
            type: 'delete',
            data: {id: id, _method: 'delete'},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_phieudangky').DataTable().ajax.reload();
            }
        });
    });
});