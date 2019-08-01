<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="vi"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title'){{config('app.name')}} - Dạy kèm tại nhà</title>
    <meta name="abstract" content="{{config('app.name')}}">
    <meta name="description" content="{{config('app.name')}} nhận dạy kèm tại nhà lớp 1 lớp 2 lớp 3 lóp 4 lớp 5 lớp 6 lớp 7 lớp 8 lớp 9 lớp 10 lớp 11 lớp 12, dạy kèm toán, dạy kèm lý, dạy kèm hóa, dạy kèm sinh, dạy kèm tiếng việt rèn chữ, dạy kèm ngoại ngữ tiếng anh tiếng trung tiếng nhật tiếng hàn, dạy tin học, dạy đàn piano đàn organ"/>
    <meta name="keywords" content="{{config('app.name')}}, dạy kèm tại nhà, gia sư dạy kèm"/>
    <meta property="og:title" content="@yield('title'){{config('app.name')}} - Dạy kèm tại nhà"/>
    <meta property="og:description" content="gia sư dạy kèm tại nhà, gia sư dạy kèm lớp 1 2 3 4 5 6 7 8 9 10 11 12, gia sư dạy kèm toán, lý, hóa, sinh, tiếng việt, rèn chữ, tiếng anh, tiếng trung, tiếng nhật, tiếng hàn, dạy tin học, dạy đàn piano, đàn organ"/>
    <meta property="og:url" content="{{route('home')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{asset('images/thanhdanh_5.jpg')}}"/>
    <meta name="author" content="Nguyễn Linh, ntt.nguyenlinh@gmail.com">
    <meta name="copyright" content="Copyright 2019 - {{config('app.name')}}">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon image_src" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" media="screen,print">
    <link rel="stylesheet" href="{{asset('font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/faq.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
</head>
<body>
    <div id="background"></div>
    <div class="wrapper">
        <div class="header">
            <img class="logo" src="{{asset('images/logo.png')}}" alt="{{config('app.name')}}"/>
            <ul class="menu clearfix" style="margin-top:4px;">
                <li class="m1" style="width:150px;">
                    <a href="{{route('home')}}" title="{{config('app.name')}}">TRANG CHỦ</a>
                </li>
                <li class="m2" style="width:190px;">
                    <a href="{{route('dang-ky-tim-gia-su.index')}}" title="Đăng ký tìm gia sư">ĐĂNG KÝ TÌM GIA SƯ</a>
                </li>

                <li class="m4">
                    <a href="{{route('danhsachlop')}}" title="Lớp hiện có">LỚP HIỆN CÓ</a>
                </li>

                <li class="m5">
                    <a href="{{route('noiquy')}}" title="Nội quy nhận lớp">NỘI QUY NHẬN LỚP</a>
                </li>
            </ul>

            <ul class="menu clearfix" style="margin-top:-4px; padding-top:0; background:#008CC9; width:945px; height:50px;">
                <li class="m1" style="width:150px; border-right: 2px solid #004469;">
                    <a href="{{route('tailieu')}}" title="tài liệu học tập">TÀI LIỆU HỌC TẬP</a>
                </li>
                <li class="m2" style="width:190px;">
                    <a href="{{route('hocphi')}}" title="Học phí tham khảo">HỌC PHÍ THAM KHẢO</a>
                </li>

                <li class="m4" style="margin-left:260px; width:168px; border-right: 2px solid #004469;">
                    <a href="{{route('dang-ky-lam-gia-su.index')}}" title="Đăng ký thành viên">ĐĂNG KÝ THÀNH VIÊN</a>
                </li>

                <li class="m5" style="width:170px; margin-right:0px;">
                    <a href="{{route('lienhe')}}" title="Thông tin liên hệ">THÔNG TIN LIÊN HỆ</a>
                </li>
            </ul>

        </div>
        <div class="slideOut">
            <div id="slider" class="swipe">
                <div class="swipe-wrap">
                    <div>
                        <img src="{{asset('images/trung-tam-gia-su.jpg')}}" alt="{{config('app.name')}}"/>
                    </div>
                    <div>
                        <img src="{{asset('images/trung-tam-gia-su-1.jpg')}}" alt="{{config('app.name')}}"/>
                    </div>
                    <div>
                        <img src="{{asset('images/trung-tam-gia-su-2.jpg')}}" alt="{{config('app.name')}}"/>
                    </div>
                    <div>
                        <img src="{{asset('images/trung-tam-gia-su-3.jpg')}}" alt="{{config('app.name')}}"/>
                    </div>
                    <div>
                        <img src="{{asset('images/trung-tam-gia-su-4.jpg')}}" alt="{{config('app.name')}}"/>
                    </div>
                </div>
            </div>
            <p class="slide_top">
                <img src="{{asset('images/bg_slide.png')}}" alt="{{config('app.name')}}"/>
            </p>
            <div class="slide_left">
                <p style="font-size: 13pt; text-align: center; color:#1c87c9;">
                    Quý phụ huynh / học viên
                    <span style="text-align: center; font-size: 13pt;" class="blink-two">Tìm gia sư</span>
                </p>
                <p style="font-size: 13pt; margin-top: 5pt; color:red;" class="blink-two">0947.582.586 (Thầy Thiên)</p>
            </div>
            <div class="slide_right">
                <p style="font-size: 13pt; text-align: center; color:#1c87c9; margin-left:50px;">
                    Giáo viên - sinh viên
                    <span class="blink-two" style="text-align: center; font-size: 13pt;">Tìm lớp dạy</span>
                </p>
                <p class="blink-two" style="font-size: 13pt; margin-top: 5pt; color:red; margin-right: -30px;">0947.582.586 (Thầy Thiên)</p>

                <div style="margin-top:20px; margin-right:-50px;">
                    <p style="text-align:center; margin-bottom:10px;">
                        <img src="{{asset('images/thanhdanh_2.png')}}" alt="{{config('app.name')}}" style="width:100%;"/>
                    </p>
                    <p style="text-align:left; padding:10px 30px; font-size: 14pt; font-style: oblique; color:#80ffff;">
                        <blink class="blink-two"><i class="fal fa-check"></i> CHUYÊN NGHIỆP</blink>
                    </p>
                    <p style="text-align:left; padding:10px 30px; font-size: 14pt; font-style: oblique; color:#80ffff;">
                        <blink class="blink-two"><i class="fal fa-check"></i> TẬN TÂM</blink>
                    </p>
                    <p style="text-align:left; padding:10px 30px; font-size: 14pt; font-style: oblique; color:#80ffff;">
                        <blink class="blink-two"><i class="fal fa-check"></i> TRÁCH NHIỆM</blink>
                    </p>
                    <p style="text-align:left; padding:10px 30px; font-size: 14pt; font-style: oblique; color:#80ffff;">
                        <blink class="blink-two"><i class="fal fa-check"></i> HÀI LÒNG</blink>
                    </p>
                    <p style="text-align:left; padding:10px 30px; font-size: 14pt; font-style: oblique; color:#80ffff;">
                        <blink class="blink-two"><i class="fal fa-check"></i> VỮNG VÀNG KIẾN THỨC</blink>
                    </p>
                </div>
            </div>
        </div>
