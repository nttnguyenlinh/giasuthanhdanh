@extends('layouts.admin')
@section('title', 'Danh sách lớp - ')

@section('nav-content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="{{route('admin')}}">Dashboard</a></li>
            <li style="font-weight:bold;"><a href="{{Route('admin.dsnhanday')}}">Danh sách nhận dạy</a></li>
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
                        Danh sách nhận dạy
                    </h3>
                </div>

                <div style="padding:20px;">
                    <select class="chosen-select form-control" id="chosen_malop">
                        <option value=""></option>
                        @foreach($pnd as $row)
                            <option value="{{$row->lop}}">{{$row->lop}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="table-responsive table-hide" id="div-table">
                    <table id="tb_dsnhanday" class="table table-striped table-hover table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th width="20">ID</th>
                            <th>Thông tin lớp</th>
                            <th>Thông tin Gia sư</th>
                            <th>Thời gian</th>
                            <th width="150px">Trạng thái</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="div_trangthai">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Thay đổi trạng thái lớp</h4>
                    <span class="close" style="font-size: 12pt; padding-top: 10px; padding-right: 10px; color: #ff4871;" data-dismiss="modal">&times;</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <form method="post" id="frm-trangthai">
                            <label for="form-field-select-1">Lựa chọn tình trạng?</label>

                            <select name="status" id="status" class="chosen-select form-control" required>
                                <option value="0">Chờ duyệt</option>
                                <option value="1">Đủ điều kiện</option>
                                <option value="2">Đang dạy</option>
                                <option value="3">Đã dạy</option>
                                <option value="4">Ngưng dạy</option>
                                <option value="4">Không đạt</option>
                            </select>
                            <div class="clearfix" style="margin-top:10px;">
                                <button id="btn-trangthai" class="width-30 pull-right btn btn-sm btn-success">Thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="div_chinhsua">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Thay đổi Gia sư khác</h4>
                    <span class="close" style="font-size: 12pt; padding-top: 10px; padding-right: 10px; color: #ff4871;" data-dismiss="modal">&times;</span>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <form method="post" id="frm-giasu">
                            <label for="form-field-select-1">Lựa chọn gia sư?</label>

                            <?php
                                $giasu = \App\GiaSu::where('trangthai', 1)->select(['id', 'holot', 'ten'])->get();
                            ?>
                            <select name="giasu" id="giasu" class="chosen-select form-control" required>
                                @foreach($giasu as $item)
                                    <option value="{{$item->id}}">[{{$item->id}}]-{{$item->holot}} {{$item->ten}}</option>
                               @endforeach
                            </select>
                            <div class="clearfix" style="margin-top:10px;">
                                <button id="btn-giasu" class="width-30 pull-right btn btn-sm btn-success">Thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <link rel="stylesheet" href="{{asset('chosen/chosen.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('adm/css/danhsachnhanday.css')}}"/>
    <link rel="stylesheet" href="{{asset('switch/css/simpleCheck.min.css')}}"/>
    <script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('switch/js/simpleCheck.min.js')}}"></script>
    <script src="{{asset('adm/js/danhsachnhanday.js')}}"></script>
@endsection

