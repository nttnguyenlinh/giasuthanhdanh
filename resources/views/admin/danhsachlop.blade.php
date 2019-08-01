@extends('layouts.admin')
@section('title', 'Danh sách lớp - ')

@section('nav-content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="{{route('admin')}}">Dashboard</a></li>
            <li style="font-weight:bold;"><a href="{{Route('admin.dslop')}}">Danh sách lớp</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">
                        <i class="fas fa-layer-plus"></i>
                        Danh sách lớp
                    </h3>
                </div>
                <div class="table-responsive">
                    <table id="tb_dslop" class="table table-striped table-hover table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th width="20">Mã lớp</th>
                            <th>Thông tin</th>
                            <th>Đăng ký</th>
                            <th>Chi tiết</th>
                            <th>Thanh toán</th>
                            <th>Yêu cầu</th>
                            <th><i class="fas fa-check"></i></th>
                            <th width="80">#</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="div_chinhsua">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Chỉnh sửa thông tin lớp <span id="sid" style="border:white 1px solid; padding:2px;"></span></h4>
                    <span class="close" style="font-size: 12pt; padding-top: 10px; padding-right: 10px; color: #ff4871;" data-dismiss="modal">&times;</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <form method="post" id="frm_dslop" action="{{route('admin.capnhat_dslop')}}">
                            @csrf
                            <input type="hidden" name="id" id="id" required/>
                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input style="color:#057bbe;" type="text" name="malop" id="malop" title="Mã lớp"  class="form-control" required readonly/>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input style="color:#057bbe;" type="text" name="diachi" id="diachi" title="Địa chỉ"  maxlength="50" placeholder="Địa chỉ dạy" class="form-control" oninvalid="this.setCustomValidity('Địa chỉ không được bỏ trống.')"
                                           onchange="this.setCustomValidity('')" required/>
                                    <i class="ace-icon fal fa-map-marked"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block">
                                    <select name="lopday" id="lopday" required style="width: 40%;" title="Chọn lớp cần học">
                                        <option value="" disabled selected>Chọn lớp cần học</option>
                                        @foreach(\App\LopHoc::all() as $item)
                                            <option value="{{$item->tenlop}}">{{$item->tenlop}}</option>
                                        @endforeach
                                    </select>

                                     <select name="loailop" id="loailop" required title="Chọn loại lớp" style="width: 59%;">
                                        <option value="" disabled selected>Chọn loại lớp</option>
                                        <option value="1">Lớp thường</option>
                                        <option value="2">Lớp chất lượng cao</option>
                                        <option value="3">Lớp đảm bảo</option>
                                    </select>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input style="color:#057bbe;" type="text" name="monday" id="monday" title="Môn cần học" class="form-control"  placeholder="Môn cần học | Ví dụ: Toán, lý, hóa,..." maxlength="100" oninvalid="this.setCustomValidity('Vui lòng nhập tên môn học.')"
                                           onchange="this.setCustomValidity('')" required/>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input style="color:#057bbe;" type="text" name="thongtin" id="thongtin" title="Thông tin người học" maxlength="50" class="form-control" placeholder="Thông tin người học"/>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <?php $buoi_array = array('2', '3', '4', '5'); ?>
                                    <select name="sobuoihoc" id="sobuoihoc" style="width: 40%;" required>
                                        <option value="" disabled selected>Số buổi học /tuần</option>
                                        @foreach($buoi_array as $id => $value)
                                            <option value="{{$value}}">{{$value}} buổi/tuần</option>
                                        @endforeach
                                    </select>
                                    <input style="color:#057bbe; width:59%;" type="text" name="thoigianhoc" id="thoigianhoc" maxlength="50" title="Thời gian để học" style="width: 59%;" placeholder="Ví dụ: Thứ 2 - thứ 4; 17h - 19h" oninvalid="this.setCustomValidity('Vui lòng nhập thời gian học.')"
                                           onchange="this.setCustomValidity('')" required/>
                                    <i class="ace-icon fal fa-calendar-star"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input style="color:#057bbe;" type="text" name="luong" id="luong" title="Lương gia sư (chưa tính phí %)" maxlength="10" placeholder="Lương gia sư (chưa tính phí %), VD: 3.600.000" class="form-control" required/>
                                    <i class="ace-icon fal fa-money-bill"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input style="color:#057bbe;" type="text" name="lephi" id="lephi" title="Mức phí %" placeholder="Mức phí, mặc định: 20" class="form-control" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required/>
                                    <i class="ace-icon fal fa-exchange"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input style="color:#057bbe;" type="text" name="yeucau" id="yeucau" title="Yêu cầu" maxlength="100" placeholder="Yêu cầu" class="form-control" required/>
                                </span>
                            </label>

                            <div class="clearfix">
                                <input type="submit" value="Cập nhật" class="width-30 pull-right btn btn-sm btn-success"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <style>
        a{cursor: pointer !important;}
        a:hover{color:#00C9A7;}
    </style>
    <link rel="stylesheet" href="{{asset('switch/css/simpleCheck.min.css')}}"/>
    <script src="{{asset('switch/js/simpleCheck.min.js')}}"></script>
    <script src="{{asset('adm/js/danhsachlop.js')}}"></script>
@endsection

