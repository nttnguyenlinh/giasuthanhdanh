$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#thoigianday").datepicker({
        language: 'vi-VN',
        format: 'dd-mm-yyyy',
        date: new Date(Date.now()),
        autoHide: true
    });

    $("#ccmnd").inputFilter(function (value) {
        return /^\d*$/.test(value);
    });

    $("#ccmnd" ).change(function() {
        var cmnd = $(this).val();
        $.ajax({
            url:"kiem-tra-cmnd",
            type:"get",
            data:{cmnd:cmnd},
            dataType:"json",
            success:function(data){
                if(data.status == 'error')
                {
                    $('#btnnhanlop').attr("disabled", "disabled")
                    $('#checkcmnd').attr('class', data.status);
                    $('#checkcmnd').text(data.message);
                }
                else
                {
                    $('#btnnhanlop').removeAttr('disabled');
                    $('#checkcmnd').remove();
                }
            }
        });
    });
});

