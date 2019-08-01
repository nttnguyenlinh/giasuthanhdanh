<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="vi"/>
    <title>Đăng nhập</title>
    <meta name="abstract" content="Gia Sư Thành Danh">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon image_src" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>

<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="{{route('login')}}" method="post">
                        @csrf
                        <h3 class="text-center text-info">GIA SƯ ĐĂNG NHẬP</h3>
                        <div class="form-group">
                            <label for="cmnd" class="text-info">CMND/CCCD:</label><br>
                            <input id="cmnd" type="text"
                                   class="form-control @error('cmnd') is-invalid @enderror"
                                   name="cmnd" value="{{ old('cmnd') }}" required
                                   autocomplete="cmnd" placeholder="CMND/CCCD" autofocus>
                            @error('cmnd')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="text-info">Mật khẩu:</label><br>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password"
                                   placeholder="Mật khẩu">
                            @error('password')
                            <span class="error"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="remember" class="text-info">
                                <span>
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                </span>
                                <span>Ghi nhớ đăng nhập</span>
                            </label><br>
                            <input type="submit" class="btn btn-info btn-md" value="Đăng nhập">
                        </div>
                        <div id="forgot-link" class="text-right">
                            @if (Route::has('password.request'))
                                <a class="text-info" href="{{route('password.request') }}">Quên mật khẩu?</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{asset('js/login.js')}}"></script>
</body>
</html>
