@extends('layouts.admin')
@section('title', 'Xem bài viết - ')

@section('nav-content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="{{route('admin')}}">Dashboard</a></li>
            <li><a href="{{Route('admin.baiviet')}}">Bài viết</a></li>
            <li style="font-weight:bold;"><a href="{{Route('admin.baiviet_xem', $baiviet->id)}}">Xem & Sửa</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <form method="post" id="myform" action="{{route('admin.baiviet_xem_luu')}}" role="form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$baiviet->id}}"/>
        <div class="col-md-3">
            <a href="{{route('admin.baiviet')}}" class="btn btn-primary btn-block mb-3">Quay về bài viết</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Trạng thái</h3>
                </div>
                <div class="card-body p-0">
                    <select name="trangthai" class="form-control" style="width:98%; height:50px; margin:3px;" oninvalid="this.setCustomValidity('Vui lòng chọn trạng thái.')" required>
                        <option value="1" {{($baiviet->trangthai == 1)?"selected":""}}>Công khai</option>
                        <option value="0" {{($baiviet->trangthai == 0)?"selected":""}}>Riêng tư</option>
                    </select>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /. box -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh mục</h3>
                </div>
                <div class="card-body p-0">
                    <select name="danhmuc" class="form-control" style="width:98%; height:50px; margin:3px;" oninvalid="this.setCustomValidity('Vui lòng chọn danh mục.')" required>
                        <option value="1" {{($baiviet->danhmuc == 1)?"selected":""}} {{(old('danhmuc') == 1)?"selected":""}}>Tin tức</option>
                        <option value="2" {{($baiviet->danhmuc == 2)?"selected":""}} {{(old('danhmuc') == 2)?"selected":""}}>Tài liệu</option>
                        <option value="3" {{($baiviet->danhmuc == 3)?"selected":""}} {{(old('danhmuc') == 3)?"selected":""}}>Nội quy</option>
                        <option value="4" {{($baiviet->danhmuc == 4)?"selected":""}} {{(old('danhmuc') == 4)?"selected":""}}>Học phí</option>
                        <option value="5" {{($baiviet->danhmuc == 5)?"selected":""}} {{(old('danhmuc') == 5)?"selected":""}}>Giới thiệu</option>
                        <option value="6" {{($baiviet->danhmuc == 6)?"selected":""}} {{(old('danhmuc') == 6)?"selected":""}}>Phụ huynh cần biết</option>
                        <option value="7" {{($baiviet->danhmuc == 7)?"selected":""}} {{(old('danhmuc') == 7)?"selected":""}}>Gia sư cần biết</option>
                        <option value="8" {{($baiviet->danhmuc == 8)?"selected":""}} {{(old('danhmuc') == 8)?"selected":""}}>Các loại lớp học</option>
                        <option value="9" {{($baiviet->danhmuc == 9)?"selected":""}} {{(old('danhmuc') == 9)?"selected":""}}>Liên hệ</option>
                    </select>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ảnh bìa</h3>
                </div>
                <div class="card-body p-0">
                    @if(!empty($baiviet->anhbia))
                        <input type="hidden" id="thumb" name="anhbia" value="{{asset('storage/' . $baiviet->anhbia)}}"/>
                        <input type="button" id="anhbia" class="dropify" data-show-loader="true" data-default-file="{{asset('storage/' . $baiviet->anhbia)}}" value="{{asset('storage/' . $baiviet->anhbia)}}" data-height="90" />
                    @else
                        <input type="hidden" id="thumb" name="anhbia" value=""/>
                        <input type="button" id="anhbia" class="dropify" data-show-loader="true" data-default-file="" value="" data-height="90" />
                    @endif
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Miêu tả</h3>
                </div>
                <div class="card-body p-0">
                    <textarea id="mota" name="mota" class="form-control" placeholder="Viết miêu tả ở đây..." style="width:98%; height:220px; margin:3px;">{{$baiviet->mota}}{{old('mota')}}</textarea>
                </div>
                <!-- /.card-body -->
            </div>

            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="tieude" placeholder="Tiêu đề..." oninvalid="this.setCustomValidity('Vui lòng nhập tiêu đề.')" value="{{$baiviet->tieude}}" {{old('tieude')}} required autofocus>
                    </div>
                    <div class="form-group">
                        <textarea id="noidung" name="noidung" class="form-control noidung" placeholder="Viết nội dung vào đây ...">{!!$baiviet->noidung!!}{!!old('noidung')!!}</textarea>
                        <script>
                            CKEDITOR.replace('noidung', {
                                autoCloseUpload: true,
                                validateSize: 1000,
                                on: {
                                    onAttachmentUpload: function(response) {
                                        attachment_id = $(response).attr('data-id');
                                        if (attachment_id) {
                                            attachment = $(response).html();
                                            $closeButton = $('<span class="attachment-close">').text('x').on('click', closeButtonEvent)
                                            $('.ticket-attachment-container').show()
                                                .append($('<div>', { class: 'ticket-attachment' }).html(attachment).append($closeButton))
                                                .append($('<input>', { type: 'hidden', name: 'attachment_ids[]' }).val(attachment_id)
                                                );
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-success"><i class="fal fa-arrow-square-right"></i> Đăng...</button>
                    </div>
                    <button id="reset" class="btn btn-default"><i class="fa fa-times"></i> Làm sạch</button>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /. box -->
        </div>
        </form>
    </div>
@endsection

@section('footer')
    <link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('adm/css/baiviet.css')}}"/>
    <script src="{{asset('adm/js/thembaiviet.js')}}"></script>
@endsection

