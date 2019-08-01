<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="vi"/>
    <title>Đặt Lại Mật Khẩu</title>
    <meta name="abstract" content="Gia Sư Thành Danh">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon image_src" href="{{asset('favicon.ico')}}">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('font-awesome/css/all.min.css')}}">
    <style>
        .form-gap {
            padding-top: 70px;
        }
    </style>
</head>
<body>
<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center text-info">
                        <h3><i class="far fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Đặt lại mật khẩu</h2>
                        <div class="panel-body">
                            <form method="POST" action="{{route('password.update')}}" class="form">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="font-size:20px;">
                                            <i class="fal fa-envelope text-info"></i>
                                        </span>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Nhập địa chỉ email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @error('email')
                                    <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="font-size:20px;">
                                            <i class="fal fa-lock text-info"></i>
                                        </span>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nhập mật khẩu mới" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                   @error('password')
                                        <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="font-size:20px;">
                                            <i class="fal fa-lock text-info"></i>
                                        </span>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận mật khẩu" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Đặt lại</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>