@extends('layouts.admin')
@section('title', 'Gia sư - ')

@section('nav-content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="{{route('admin')}}">Dashboard</a></li>
            <li style="font-weight:bold;"><a href="{{Route('admin.giasu')}}">Gia sư</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">
                        <i class="fas fa-chalkboard-teacher"></i>
                        Danh sách gia sư
                    </h3>
                </div>
                <div class="table-responsive">
                    <table id="tb_giasu" class="table table-striped table-hover table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>CMND/CCCD</th>
                            <th>Họ lót</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>T.Độ</th>
                            <th>Q.Huyện</th>
                            <th>KV dạy</th>
                            <th>T.Thái</th>
                            <th width="160">#</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="div_view" class="modal fade">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="widget-box">
                <div class="widget-header text-uppercase">
                    <h4 class="widget-title" id="vhoten"></h4>
                    <span class="close" style="font-size: 12pt; padding-top: 10px; padding-right: 10px; color: #ff4871;" data-dismiss="modal">×</span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3">
                                <div class="text-center">
                                    <figure>
                                        <a data-lightbox="image_anhthe" id="aanhthe">
                                            <img id="vanhthe" class="thumbnail inline" style="width: 100%; height: 200px; padding: 0px; margin-bottom: 0px;"/>
                                        </a>
                                        <figcaption>Ảnh đại diện</figcaption>
                                    </figure>

                                </div><br>
                                <div class="text-center">
                                    <figure>
                                        <a data-lightbox="image_anhcmnd" id="aanhcmnd">
                                            <img id="vanhcmnd" class="thumbnail inline" style="width: 100%; height: 200px; padding: 0px; margin-bottom: 0px;"/>
                                        </a>
                                        <figcaption>Ảnh CMND/CCCD</figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                <div class="space visible-xs"></div>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="Table" role="grid">
                                        <div class="Heading" role="columnheader">
                                            <div class="Cell">
                                                <p>Quê quán / Địa chỉ</p>
                                            </div>
                                            <div class="Cell" role="columnheader">
                                                <p>Trình độ / Học vấn</p>
                                            </div>
                                            <div class="Cell" role="columnheader">
                                                <p>Nhận dạy</p>
                                            </div>
                                        </div>
                                        <div class="Row" role="row">
                                            <div class="Cell" role="gridcell">
                                                <p><b>Quê Quán:</b> <span id="vquequan"></span></p>
                                                <p><b>Nơi ở:</b> <span id="vnoio"></span></p>
                                            </div>
                                            <div class="Cell" role="gridcell">
                                                <p><b>Trường ĐT:</b> <span id="vtruonghoc"></span></p>
                                                <p><b>Ngành học:</b> <span id="vnganhhoc"></span></p>
                                                <p><b>Niên khoá:</b> <span id="vnienkhoa"></span>
                                                <p><b>Trình độ:</b> <span id="vtrinhdo"></span></p>
                                            </div>
                                            <div class="Cell" role="gridcell">
                                                <p><b>Môn dạy: </b><span id="vmonday"></span></p>
                                                <p><b>Lớp dạy: </b><span id="vlopday"></span></p>
                                                <p><b>Nơi dạy:</b><span id="vnoiday"></span></p>
                                                <p><b>Ưu điểm:</b><span id="vuudiem"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <link href="{{asset('lightbox/dist/css/lightbox.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{asset('lightbox/dist/js/lightbox.js')}}"></script>
    <script src="{{asset('adm/js/giasu.js')}}"></script>
@endsection

