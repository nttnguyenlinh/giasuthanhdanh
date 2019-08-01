@extends('layouts.admin')
@section('title', 'Công cụ - ')

@section('nav-content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="{{route('admin')}}">Dashboard</a></li>
            <li style="font-weight:bold;"><a href="{{Route('admin.tools')}}">Công cụ</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">
                        <i class="fas fa-cogs"></i>
                        Công cụ
                    </h3>
                </div>

                <div class="col-lg-6 col-md-6" style="float: none; display: block; margin: 0 auto;">
                    <div class="widget-box widget-color-blue">
                        <div class="widget-header">
                            <h4 class="widget-title">Thay Đổi SĐT</h4>
                            <div class="widget-toolbar">
                                <a href="javascript:void(0);" data-action="collapse">
                                    <i class="ace-icon fal fa-chevron-down"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <form method="post" action="{{route('admin.tools.thaydoi')}}">
                                    @csrf
                                    <div>
                                        <p class="bolder">Thay đổi cho</p>
                                        <select class="chosen-select" id="chosen-idSDT" name="id" required>
                                            <option value=""></option>
                                            @foreach($giasu as $row)
                                                <option value="{{$row->id}}">{{$row->id}} - {{$row->holot}} {{$row->ten}}</option>
                                            @endforeach
                                        </select>

                                        <p class="bolder" style="padding-top: 20px;">Nhập số điện thoại mới</p>
                                        <div class="kiemtraSDT">
                                            <div class="input-group">
                                                <input class="form-control" style="border: #057bbe 1px solid; color: #057bbe;" type="text" id="sdt" name="sdt" placeholder="" class="in_405" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required/>
                                                <span class="input-group-addon" style="border: #057bbe 1px solid; color: #057bbe;"><i class="ace-icon fal fa-phone"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="center">
                                        <input type="submit" name="thaydoiSDT" class="btn btn-sm btn-primary" value="Thay đổi"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6" style="float: none; display: block; margin: 0 auto;">
                    <div class="widget-box widget-color-blue">
                        <div class="widget-header">
                            <h4 class="widget-title">Thay Đổi Email</h4>
                            <div class="widget-toolbar">
                                <a href="javascript:void(0);" data-action="collapse">
                                    <i class="ace-icon fal fa-chevron-down"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <form method="post" action="{{route('admin.tools.thaydoi')}}">
                                    @csrf
                                    <div>
                                        <p class="bolder">Thay đổi cho</p>
                                        <select class="chosen-select" id="chosen-idEMAIL" name="id" required>
                                            <option value=""></option>
                                            @foreach($giasu as $row)
                                                <option value="{{$row->id}}">{{$row->id}} - {{$row->holot}} {{$row->ten}}</option>
                                            @endforeach
                                        </select>

                                        <p class="bolder" style="padding-top: 20px;">Nhập địa chỉ Email mới</p>
                                        <div class="kiemtraEMAIL">
                                            <div class="input-group">
                                                <input class="form-control" style="border: #057bbe 1px solid; color: #057bbe;" type="text" id="email" name="email" placeholder="" class="in_405" maxlength="50" required/>
                                                <span class="input-group-addon" style="border: #057bbe 1px solid; color: #057bbe;"><i class="ace-icon fal fa-at"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="center">
                                        <input type="submit" name="thaydoiEmail" class="btn btn-sm btn-primary" value="Thay đổi"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6" style="float: none; display: block; margin: 0 auto;">
                    <div class="widget-box widget-color-blue">
                        <div class="widget-header">
                            <h4 class="widget-title">Thay Đổi CMND/CCCD</h4>
                            <div class="widget-toolbar">
                                <a href="javascript:void(0);" data-action="collapse">
                                    <i class="ace-icon fal fa-chevron-down"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <form method="post" action="{{route('admin.tools.thaydoi')}}">
                                    @csrf
                                    <div>
                                        <p class="bolder">Thay đổi cho</p>
                                        <select class="chosen-select" id="chosen-idCMND" name="id" required>
                                            <option value=""></option>
                                            @foreach($giasu as $row)
                                                <option value="{{$row->id}}">{{$row->id}} - {{$row->holot}} {{$row->ten}}</option>
                                            @endforeach
                                        </select>

                                        <p class="bolder" style="padding-top: 20px;">Nhập số CMND/CCCD mới</p>
                                        <div class="kiemtraCMND">
                                            <div class="input-group">
                                                <input class="form-control" style="border: #057bbe 1px solid; color: #057bbe;" type="text" id="cmnd" name="cmnd" placeholder="" class="in_405" maxlength="12" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required/>
                                                <span class="input-group-addon" style="border: #057bbe 1px solid; color: #057bbe;"><i class="ace-icon fal fa-portrait"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="center">
                                        <input type="submit" name="thaydoiCMND" class="btn btn-sm btn-primary" value="Thay đổi"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <link rel="stylesheet" href="{{asset('chosen/chosen.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('adm/css/tools.css')}}"/>
    <script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('adm/js/tools.js')}}"></script>
@endsection

