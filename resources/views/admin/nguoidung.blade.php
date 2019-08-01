@extends('layouts.admin')
@section('title', 'Người dùng - ')

@section('nav-content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="{{route('admin')}}">Dashboard</a></li>
            <li style="font-weight:bold;"><a href="{{Route('admin.nguoidung')}}">Người dùng</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <button class="btn btn-white btn-info btn-bold" data-toggle="modal" data-target="#div_add" style="float:right;">
        <i class="ace-icon fal fa-user-plus"></i> Thêm người dùng
    </button>

    <div class="clearfix" style="margin-bottom: 10px;"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">
                        <i class="fas fa-users"></i>
                        Danh sách người dùng
                    </h3>
                </div>
                <div class="card-body pad table-responsive">
                    <table id="tb_nguoidung" class="table table-striped table-hover table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th width="20">ID</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th width="100">Xác thực</th>
                            <th width="40">T.Thái</th>
                            <th width="120">Ngày tạo</th>
                            <th width="180">#</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="div_add" role="dialog">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Thêm người dùng</h4>
                    <span class="close" style="font-size: 12pt; padding-top: 10px; padding-right: 10px; color: #ff4871;"
                          data-dismiss="modal">&times;</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">

                        <form method="post" id="frm_them_nguoidung" action="{{route('admin.them_nguoidung')}}">
                            @csrf
                            <h5 class='text-warning'><i class="fal fa-info"></i> Lưu ý: Không hỗ trợ thêm tài khoản gia
                                sư.</h5><br>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" id="name" value="{{old('name')}}" autocomplete="name"
                                           placeholder="Tên bạn" required maxlength="30" autofocus/>
                                    <i class="ace-icon fal fa-user"></i>
                                </span>
                                @error('name')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" id="email" value="{{old('email')}}" autocomplete="email"
                                           placeholder="Địa chỉ email" required>
                                    <i class="ace-icon fal fa-envelope"></i>
                                </span>
                                @error('email')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" id="password" placeholder="Mật khẩu" required>
                                    <i class="ace-icon fal fa-lock"></i>
                                </span>
                                @error('password')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </label>

                            <div style="text-align: center;">
                                <button type="reset" class="btn btn-danger" style="margin-right:20px;">Clear</button>
                                <button type="submit" class="btn btn-success">Thêm</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{asset('adm/js/nguoidung.js')}}"></script>
@endsection

