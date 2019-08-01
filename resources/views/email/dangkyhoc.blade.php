<html>
<body style="margin:0px; background: #f8f8f8;">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.11/sweetalert2.min.css"/>
<div style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width:100%; color: #514d6a;">
    <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
            <tr>
                <td style="padding-bottom:10px;" align="center">
                    <img src="https://i.imgur.com/OCHQ45c.png" style="border:none;">
                </td>
            </tr>
        </table>
        <div style="padding: 40px; background: #fff;">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tr>
                    <td>
                        <b>Xin chào, {{$hoten}}</b>
                        <div class="swal2-center">
                            <div class="swal2-icon swal2-success">
                                <span class="swal2-success-line-tip"></span>
                                <span class="swal2-success-line-long"></span>
                            </div>
                            <div class="swal2-content" id="swal2-content" style="display: block;">
                                Cảm ơn anh(chị) đã lựa chọn {{config('app.name')}}. Chúng tôi sẽ liên hệ lại với anh(chị) để trao đổi thêm.
                            </div>
                        </div>
                        <b>Chúc anh(chị) một ngày tốt lành!</b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
        <h3>{{config('app.name')}} - {{config('app.subname')}}</h3>
    </div>
</div>
</body>
</html>