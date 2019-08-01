<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="vi"/>
    <title>Admin đăng nhập</title>
    <meta name="abstract" content="Gia Sư Thành Danh">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon image_src" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('adm/css/ace.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('font-awesome/css/all.min.css')}}">
    <style>
        label.error, span.error {
            color: #e74c3c;
        }
    </style>
</head>

<body class="login-layout light-login">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-12" style="margin: 150px 0;">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <span class="white">Gia Sư</span>
                            <span class="blue">Thành Danh</span>
                        </h1>
                    </div>
                    <div class="space-6"></div>
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="fal fa-sign-in-alt text-info"></i>
                                        <span style="font-size:20pt;">Đăng nhập hệ thống</span>
                                    </h4>

                                    <div class="space-6"></div>
                                    <form id="form-login" action="{{route('admin.login.submit')}}" method="post">
                                        @csrf
                                        <label class="block clearfix">
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required
                                                   autocomplete="email" placeholder="Email" autofocus>

                                            @error('email')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </label>

                                        <label class="block clearfix">
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="current-password"
                                                   placeholder="Mật khẩu">
                                            @error('password')
                                                <span class="error"> {{ $message }}</span>
                                            @enderror
                                        </label>

                                        <label class="clearfix">
                                            <input type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                   for="remember">Ghi nhớ đăng nhập</label>
                                            </span>
                                        </label>

                                        <div class="space"></div>

                                        <div class="clearfix">
                                            <button type="submit" class="width-35 btn btn-sm btn-primary">Đăng nhập
                                            </button>

                                            @if (Route::has('admin.password.request'))
                                                <a class="btn btn-link" href="{{ route('admin.password.request') }}">Quên mật
                                                    khẩu?</a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('adm/js/login.js')}}"></script>
</body>
</html>
