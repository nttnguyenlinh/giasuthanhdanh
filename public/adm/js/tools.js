$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#chosen-idSDT").chosen({
        no_results_text: "Không tìm thấy dữ liệu...",
        placeholder_text_single: "Chọn gia sư cần đổi...",
        width: "100%",
    });

    $("#chosen-idEMAIL").chosen({
        no_results_text: "Không tìm thấy dữ liệu...",
        placeholder_text_single: "Chọn gia sư cần đổi...",
        width: "100%",
    });

    $("#chosen-idCMND").chosen({
        no_results_text: "Không tìm thấy dữ liệu...",
        placeholder_text_single: "Chọn gia sư cần đổi...",
        width: "100%",
    });

    $("#sdt").on('change', function() {
        var sdt = $(this).val();
        $.ajax({
            url: 'tools/kiem-tra-sdt',
            type: 'get',
            data: {sdt:sdt},
            dataType: 'json',
            success:function(data){
                $('.kiemtraSDT').children('#lb_kiemtrasdt').remove()
                $('.kiemtraSDT').append("<label id='lb_kiemtrasdt' class='" + data.status + "'>" +data.message + "</label>");
            }
        });
    });

    $("#email").on('change', function() {
        var email = $(this).val();
        $.ajax({
            url: 'tools/kiem-tra-email',
            type: 'get',
            data: {email:email},
            dataType: 'json',
            success:function(data){
                $('.kiemtraEMAIL').children('#lb_kiemtraemail').remove()
                $('.kiemtraEMAIL').append("<label id='lb_kiemtraemail' class='" + data.status + "'>" +data.message + "</label>");
            }
        });
    });

    $("#cmnd").on('change', function() {
        var cmnd = $(this).val();
        $.ajax({
            url: 'tools/kiem-tra-cmnd',
            type: 'get',
            data: {cmnd:cmnd},
            dataType: 'json',
            success:function(data){
                $('.kiemtraCMND').children('#lb_kiemtracmnd').remove()
                $('.kiemtraCMND').append("<label id='lb_kiemtracmnd' class='" + data.status + "'>" +data.message + "</label>");
            }
        });
    });
});