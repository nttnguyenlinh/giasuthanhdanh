@extends('layouts.admin')
@section('title', 'Bài viết - ')

@section('nav-content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="{{route('admin')}}">Dashboard</a></li>
            <li style="font-weight:bold;"><a href="{{Route('admin.baiviet')}}">Bài viết</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <a href="{{route('admin.baiviet_them')}}" class="btn btn-default" style="float:right;">
        <i class="ace-con fal fa-file-plus"></i> Thêm bài viết
    </a>

    <div class="clearfix" style="margin-bottom: 10px;"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">
                        <i class="fas fa-atom-alt"></i>
                        Danh sách bài viết
                    </h3>
                </div>
                <div class="card-body pad table-responsive">
                    <table id="tb_baiviet" class="table table-striped table-hover table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th width="20">ID</th>
                            <th width="50">Danh mục</th>
                            <th>Tiêu đề</th>
                            <th>Mô tả</th>
                            <th width="50"><i class="fal fa-image"></i></th>
                            <th width="60">Trạng thái</th>
                            <th width="180">#</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <link rel="stylesheet" href="{{asset('adm/css/baiviet.css')}}"/>
    <script src="{{asset('adm/js/baiviet.js')}}"></script>
@endsection

