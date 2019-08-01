lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
});

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#tb_giasu').DataTable({
        language: {'url': '/dataTables/Vietnamese.json'},
        responsive: true,
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: 'gia-su/danh-sach',
            type: 'get',
        },
        rowId: 'id',
        columns: [
            {data: 'cmnd', name: 'cmnd'},
            {data: 'holot', name: 'holot'},
            {data: 'ten', name: 'ten'},
            {data: 'email', name: 'email'},
            {data: 'sdt', name: 'sdt'},
            {data: 'trinhdo', name: 'trinhdo'},
            {data: 'quanhuyen', name: 'quanhuyen'},
            {data: 'khuvucday', name: 'khuvucday'},
            {data: 'trangthai', name: 'trangthai', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });

    $(document).on('click', '#lock', function() {
        var id = $(this).val();
        var trangthai = $(this).attr('id');
        $.ajax({
            url: 'gia-su/thay-doi',
            type: 'post',
            data: {id: id, trangthai: trangthai},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_giasu').DataTable().ajax.reload();
            }
        });
    });

    $(document).on('click', '#unlock', function() {
        var id = $(this).val();
        var trangthai = $(this).attr('id');
        $.ajax({
            url: 'gia-su/thay-doi',
            type: 'post',
            data: {id: id, trangthai: trangthai},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_giasu').DataTable().ajax.reload();
            }
        });
    });

    $(document).on('click', '#remove', function() {
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: 'gia-su/xoa',
            type: 'get',
            type: 'delete',
            data: {id: id, _method: 'delete'},
            dataType: 'json',
            success: function (data) {
                toastr[data.status](data.message);
                $('#tb_giasu').DataTable().ajax.reload();
            },
            error: function(e) {
                console.log(e);
            }
        });
    });

    $(document).on('click', '#view', function() {
        var id = $(this).val();
        $('#aanhthe').attr('href','');
        $('#aanhthe').attr('data-title','');
        $('#vanhthe').attr('src','');
        $('#vanhcmnd').attr('src','');
        $('#aanhcmnd').attr('href','');
        $('#aanhcmnd').attr('data-title','');
        $('#vhoten').text('');
        $('#vquequan').text('');
        $('#vnoio').text('');
        $('#vtruonghoc').text('');
        $('#vnienkhoa').text('');
        $('#vtrinhdo').text('');
        $('#vmonday').text('');
        $('#vlopday').text('');
        $('#vnoiday').text('');
        $('#vuudiem').text('');

        $.ajax({
            url: 'gia-su/lay-thong-tin',
            type: 'get',
            data: {id:id},
            dataType: 'json',
            success:function(data){
                if(data.anhthe == null)
                {
                    $('#aanhthe').attr('href', '/storage/anhthe/no_image.jpg');
                    $('#aanhthe').attr('data-title', 'Gia sư ' + data.holot + ' ' + data.ten);
                    $('#vanhthe').attr('src', '/storage/anhthe/no_image.jpg');
                }
                else
                {
                    $('#aanhthe').attr('href', '/storage/anhthe/' + data.anhthe);
                    $('#aanhthe').attr('data-title', 'Gia sư ' + data.holot + ' ' + data.ten);
                    $('#vanhthe').attr('src', '/storage/anhthe/' + data.anhthe);
                }

                if(data.anhcmnd == null)
                {
                    $('#aanhcmnd').attr('href', '/storage/anhcmnd/no_image.jpg');
                    $('#aanhcmnd').attr('data-title', 'Gia sư ' + data.holot + ' ' + data.ten);
                    $('#vanhcmnd').attr('src', '/storage/anhcmnd/no_image.jpg');
                }
                else
                {
                    $('#aanhcmnd').attr('href', '/storage/anhcmnd/' + data.anhcmnd);
                    $('#aanhcmnd').attr('data-title', 'Gia sư ' + data.holot + ' ' + data.ten);
                    $('#vanhcmnd').attr('src', '/storage/anhcmnd/' + data.anhcmnd);
                }

                $('#vhoten').text('Gia sư ' + data.holot + ' ' + data.ten + ' (' + data.ngaysinh + ')');
                $('#vquequan').text(data.noisinh);
                $('#vnoio').text(data.diachi + ', ' + data.quanhuyen + ', ' + data.tinhthanh);
                $('#vtruonghoc').text(data.truonghoc);
                $('#vnienkhoa').text(data.namtn);
                $('#vtrinhdo').text(data.trinhdo);
                $('#vmonday').text(data.monday);
                $('#vlopday').text(data.lopday);
                $('#vnoiday').text(data.khuvucday);
                $('#vuudiem').text(data.uudiem);
            }
        });
    });
});