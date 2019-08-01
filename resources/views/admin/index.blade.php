@extends('layouts.admin')
@section('title', 'Dashboard - ')

@section('nav-content')
@endsection

@section('content')
    <div class="row" style="float: none; display: block; margin: 0 auto;">

        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="panel-primary">
                <div class="panel-heading" style="margin-bottom: 10px; color: #337ab7; background-color:#f4fffc; border: 0px solid #337ab7;">
                    <div class="row">
                        <div class="col-xs-5" style="margin-left: 10px; padding-top: 20px;">
                            <i class="fal fa-chalkboard-teacher fa-10x"></i>
                        </div>
                        <div class="col-xs-5 text-right">
                            <div style="font-size: 40pt; margin-right: -50px;">{{\App\GiaSu::where('trangthai', 0) ->count()}}</div>
                            <div style="font-size: 20pt; margin-right: -50px;">GIA SƯ MỚI</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="panel-success">
                <div class="panel-heading" style="margin-bottom: 10px; background-color:#f4fffc; border: 0px solid #337ab7;">
                    <div class="row">
                        <div class="col-xs-5" style="margin-left: 10px; padding-top: 20px;">
                            <i class="fal fa-layer-plus fa-10x"></i>
                        </div>
                        <div class="col-xs-5 text-right">
                            <div style="font-size: 40pt; margin-right: -50px;">{{\App\PhieuDangKy::where('trangthai', 0) ->count()}}</div>
                            <div style="font-size: 20pt; margin-right: -50px;">ĐĂNG KÝ MỚI</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="panel-info">
                <div class="panel-heading" style="margin-bottom: 10px; color: #ffbf61; background-color:#f4fffc; border: 0px solid #337ab7;">
                    <div class="row">
                        <div class="col-xs-5" style="margin-left: 10px; padding-top: 20px;">
                            <i class="fal fa-list-alt fa-10x"></i>
                        </div>
                        <div class="col-xs-5 text-right">
                            <div style="font-size: 40pt; margin-right: -50px;">{{\App\PhieuMoLop::where('trangthai', 0) ->count()}}</div>
                            <div style="font-size: 20pt; margin-right: -50px;">LỚP CHƯA DẠY</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="panel-danger">
                <div class="panel-heading" style="margin-bottom: 10px; color: #80367e; background-color:#f4fffc; border: 0px solid #337ab7;">
                    <div class="row">
                        <div class="col-xs-5" style="margin-left: 10px; padding-top: 20px;">
                            <i class="fal fa-list-ol fa-10x"></i>
                        </div>
                        <div class="col-xs-5 text-right">
                            <div style="font-size: 40pt; margin-right: -50px;">{{\App\PhieuNhanLop::where('trangthai', 0) ->count()}}</div>
                            <div style="font-size: 20pt; margin-right: -50px;">NHẬN DẠY MỚI</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection

