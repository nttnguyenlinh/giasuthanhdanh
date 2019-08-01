$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#chosen_malop").chosen({
        no_results_text: "Không tìm thấy dữ liệu...",
        placeholder_text_single: "Chọn mã lớp...",
        width: "40%",
    });

    $("#status").chosen({
        no_results_text: "Không tìm thấy dữ liệu...",
        placeholder_text_single: "Chọn trạng thái...",
        width: "100%",
    });

    $("#chosen_malop").on('change', function() {
        if($('#div-table').hasClass('table-hide'))
        {
            $('#div-table').removeClass("table-hide");
            $('#div-table').addClass("table-show");
        }

        $('#tb_dsnhanday').DataTable().destroy();

        $('#tb_dsnhanday').DataTable({
            language: {'url': '/dataTables/Vietnamese.json'},
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: true,
            paging: false,
            searching: false,
            ajax: {
                url: 'danh-sach-nhan-day/lay-thong-tin',
                type: 'get',
                data:{malop: this.value}
            },
            rowId: 'id',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'thongtin', name: 'thongtin', orderable: false},
                {data: 'giasu', name: 'dangky', orderable: false},
                {data: 'thoigian', name: 'chitiet', orderable: false},
                {data: 'trangthai', name: 'trangthai', orderable: false}
            ],
            "order": [[ 0, "desc" ]]
        });
    });

    $(document).on('click', '#remove', function() {
        var id = $(this).val();
        $.ajax({
            url: 'danh-sach-nhan-day/xoa',
            type: 'delete',
            data: {id: id, _method: 'delete'},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_dsnhanday').DataTable().ajax.reload();
            }
        });
    });

    $('#btn-trangthai').click(function(e){
        e.preventDefault();
        var id = $("#trangthai").val();
        var molop_id = $("#trangthai").data('molop');
        var status = $("#status").val();
        $.ajax({
            url: 'danh-sach-nhan-day/thay-doi',
            type: 'post',
            data: {id: id, molop_id:molop_id, status:status},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $("#div_trangthai .close").click();
                $('#tb_dsnhanday').DataTable().ajax.reload();
            }
        });
    });

    $('#btn-giasu').click(function(e){
        e.preventDefault();
        var id = $("#edit").val();
        var giasu = $("#giasu").val();
        $.ajax({
            url: 'danh-sach-nhan-day/thay-doi-gia-su',
            type: 'post',
            data: {id: id, giasu:giasu},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $("#div_chinhsua .close").click();
                $('#tb_dsnhanday').DataTable().ajax.reload();
            }
        });
    });
});