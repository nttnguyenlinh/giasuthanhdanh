<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-language" content="vi"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title'){{config('app.name')}}</title>
    <meta name="abstract" content="{{config('app.name')}}">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon image_src" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('font-awesome/css/all.min.css')}}">
{{--    <script src="{{asset('font-awesome/63f2921f68.js')}}"></script>--}}
    <meta name="copyright" content="Copyright 2019 - {{config('app.name')}}">
    <link rel="stylesheet" href="{{asset('adm/css/ace.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('adm/css/ace-part2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('adm/css/style_cs.css')}}"/>
    <link rel="stylesheet" href="{{asset('toastr/toastr.min.css')}}"/>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('ckfinder/ckfinder.js')}}"></script>
</head>
<body class="no-skin">
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="{{route('home')}}" class="navbar-brand uppercase"
               style="font-size: 13pt; padding-top: 15px;">{{config('app.name')}}</a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                @if(Auth::check())
                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle">
                            <span class="user-info">
                                <smal>Xin chào,</smal><br>
                                {{Auth::user()->name}}
                            </span>
                            <i class="nav-menu-icon fal fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="{{route('admin.logout')}}">
                                    <i class="ace-icon far fa-power-off"></i>
                                    Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>

<div class="main-container" id="main-container">
    <div id="sidebar" class="sidebar responsive">
        <ul class="nav nav-list" style="top: 0px;">
            <li class="{{Request::is('admin') ? 'active' : ''}}">
                <a href="{{route('admin')}}">
                    <i class="menu-icon fal fa-tachometer-alt"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>
                <b class="arrow"></b>
            </li>

            <li class="{{Request::is('*nguoi-dung') ? 'active' : ''}}">
                <a href="{{route('admin.nguoidung')}}">
                    <i class="menu-icon fal fa-users"></i>
                    <span class="menu-text"> Người dùng </span>
                </a>
                <b class="arrow"></b>
            </li>

            <li class="{{Request::is('*gia-su') ? 'active' : ''}}">
                <a href="{{route('admin.giasu')}}">
                    <i class="menu-icon fal fa-chalkboard-teacher"></i>
                    <span class="menu-text"> Gia sư </span>
                    @if(\App\GiaSu::where('trangthai', 0)->count() != 0)
                        <span class="badge badge-danger">{{\App\GiaSu::where('trangthai', 0)->count()}}</span>
                    @endif
                </a>
                <b class="arrow"></b>
            </li>

            <li class="{{Request::is('*danh-sach-dang-ky') ? 'active' : ''}}">
                <a href="{{route('admin.dangky')}}">
                    <i class="menu-icon fal fa-layer-plus"></i>
                    <span class="menu-text"> D.sách đăng ký </span>
                    @if(\App\PhieuDangKy::where('trangthai', 0)->count() != 0)
                        <span class="badge badge-danger">{{\App\PhieuDangKy::where('trangthai', 0)->count()}}</span>
                    @endif
                </a>
                <b class="arrow"></b>
            </li>

            <li class="{{Request::is('*danh-sach-lop') ? 'active' : ''}}">
                <a href="{{route('admin.dslop')}}">
                    <i class="menu-icon fal fa-list-alt"></i>
                    <span class="menu-text"> Danh sách Lớp </span>
                    @if(\App\PhieuMoLop::where('trangthai', 0)->count() != 0)
                        <span class="badge badge-danger">{{\App\PhieuMoLop::where('trangthai', 0)->count()}}</span>
                    @endif
                </a>
                <b class="arrow"></b>
            </li>

            <li class="{{Request::is('*danh-sach-nhan-day') ? 'active' : ''}}">
                <a href="{{route('admin.dsnhanday')}}">
                    <i class="menu-icon fal fa-list-ol"></i>
                    <span class="menu-text"> D.sách nhận dạy </span>
                    @if(\App\PhieuNhanLop::where('trangthai', 0)->count() != 0)
                        <span class="badge badge-danger">{{\App\PhieuNhanLop::where('trangthai', 0)->count()}}</span>
                    @endif
                </a>
                <b class="arrow"></b>
            </li>

            <li class="{{Request::is('*bai-viet') ? 'active' : ''}}">
                <a href="{{route('admin.baiviet')}}">
                    <i class="menu-icon fal fa-atom-alt"></i>
                    <span class="menu-text"> Bài viết </span>
                </a>
                <b class="arrow"></b>
            </li>

            <li class="{{Request::is('*media') ? 'active' : ''}}">
                <a href="{{route('admin.media')}}">
                    <span class="menu-icon">
                        <svg style="width:20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M608 0H160c-17.67 0-32 13.13-32 29.33V128h128V32h256v288h-32v32h128c17.67 0 32-13.13 32-29.33V29.33C640 13.13 625.67 0 608 0zM224 96h-64V32h64zm384 224h-64v-64h64zm0-96h-64v-96h64zm0-128h-64V32h64zm-192 64H32a32 32 0 0 0-32 32v288a32 32 0 0 0 32 32h384a32 32 0 0 0 32-32V192a32 32 0 0 0-32-32zm0 320H32v-24l81.69-61.26 80 40 126.84-95.14L416 403.23zm0-115.23l-96.53-64.36-129.16 96.86-80-40L32 416V192h384zM112 320a48 48 0 1 0-48-48 48 48 0 0 0 48 48zm0-64a16 16 0 1 1-16 16 16 16 0 0 1 16-16z"></path></svg>
                    </span>
                    <span class="menu-text"> Media </span>
                </a>
                <b class="arrow"></b>
            </li>

            <li class="{{Request::is('*tools') ? 'active' : ''}}">
                <a class="dropdown-toggle">
                    <i class="menu-icon fal fa-cogs"></i>
                    <span class="menu-text">Công cụ</span>
                    <b class="arrow fal fa-level-down-alt"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu nav-show" style="display: block;">
                    <li class="{{Request::is('*tools') ? 'active' : ''}}">
                        <a href="{{route('admin.tools')}}">
                            <i class="menu-icon fal fa-caret-right"></i>
                            Thay đổi thông tin
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon far fa-angle-double-left"
               data-icon1="ace-icon far fa-angle-double-left" data-icon2="ace-icon far fa-angle-double-right"></i>
        </div>
    </div>

    <div class="main-content">
        <div class="main-content-inner">
            @section('nav-content')
            @show
            <div class="page-content">
                @if(Session::has('status'))
                    <div class="alert alert-block alert-{{Session::get('status')}} alert-dismissible">
                        {!! Session::get('message') !!}
                    </div>
                @endif

                <div class="row">
                    <div class="col-xs-12">
                        @section('content')
                        @show
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
		        <span class="bigger-120">
				    <span class="blue bolder">Gia sư Thành Danh</span> &copy; 2019
			    </span>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dataTables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('adm/js/ace.min.js')}}"></script>
    <script src="{{asset('toastr/toastr.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('mask/jquery.mask.min.js')}}"></script>
    <script src="{{asset('dropify/dist/js/dropify.js')}}"></script>

    <script>
        $(".alert").fadeTo(2000, 500).slideUp(500, function() {
            $(".alert").slideUp(500);
        });

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    @section('footer')
    @show

    @if(Session::has('status'))
        <script>
            toastr.{!!Session::get('status')!!}("{!!Session::get('message')!!}");
        </script>
    @endif
</body>
</html>
