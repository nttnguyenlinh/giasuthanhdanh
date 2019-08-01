$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#tb_baiviet').DataTable({
        language: {'url': '/dataTables/Vietnamese.json'},
        processing: true,
        serverSide: true,
        ajax: {
            url: 'bai-viet/danh-sach',
            type: 'get',
        },
        rowId: 'id',
        columns: [
            {data: 'id'},
            {data: 'danhmuc', orderable: false},
            {data: 'tieude', name: 'tieude', orderable: false},
            {data: 'mota', orderable: false, searchable: false},
            {data: 'anhbia', orderable: false, searchable: false},
            {data: 'trangthai', orderable: false, searchable: false},
            {data: 'action', orderable: false, searchable: false}
        ],
        "order": [[ 0, "desc" ]]
    });

    $(document).on("click", "#remove", function(){
        var id = $(this).val();
        $.ajax({
            url: 'bai-viet/xoa',
            type: 'delete',
            data: {id: id, _method: 'delete'},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_baiviet').DataTable().ajax.reload();
            }
        });
    });
});