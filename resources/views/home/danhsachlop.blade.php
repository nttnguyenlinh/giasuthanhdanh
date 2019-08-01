@extends('layouts.home')
@section('title', 'Danh sách lớp cần gia sư - ')
@section('canonical', route('danhsachlop'))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="newClass">
                    <div class="dsgsdk" style="margin-bottom: 10px;">
                        <h1>DANH SÁCH LỚP - CẬP NHẬT NGÀY {{date("d-m-Y")}}</h1>
                    </div>
                    <div class="search clearfix">
                        <form method="post" action="{{route('timkiemlop')}}">
                            @csrf
                            <input type="text" name="tukhoa" placeholder="Nhập mã lớp hoặc tên môn dạy" class="in_search" style="color: #008DCA; border:#008DCA 1px solid; width:40%; float:left; margin-right:4px;" autofocus>

                            <select name="quanhuyen" style="margin-right:4px; color:#008DCA;">
                                <option value="" disabled selected>Quận/huyện</option>
                                @foreach($khuvuc as $kv)
                                    <option value="{{$kv->id}}">{{$kv->tenkv}}</option>
                                @endforeach
                            </select>

                            <select style="width:100%; color:#008DCA;" name="lopday">
                                <option value="" disabled selected>Lớp dạy</option>
                                @foreach($lophoc as $lop)
                                    <option value="{{$lop->id}}">{{$lop->tenlop}}</option>
                                @endforeach
                            </select>

                            <input type="submit" name="timkiem" value="Tìm kiếm" class="btn_s2" style="background:#008DCA; border: #008DCA 1px solid;"/>
                        </form>
                    </div>

                    <div class="class_list clearfix">
                        @if($dslop->count() > 0)
                            @foreach($dslop as $row)
                            <div class="item_c">
                                <div class="c_ttl">LỚP CHƯA GIAO
                                    <p class="c_ms">Mã lớp<br>{{$row->malop}}</p>
                                </div>
                                <div class="c_content" style="height: 350px; line-height: 1.75; font-size:13pt;">
                                    <p>Môn dạy: <span style="color: #008DCA; font-weight: bold;">{{$row->monday}}</span></p>
                                    <p>Lớp dạy: <span style="color: #008DCA; font-weight: bold;">{{$row->lopday}}</span></p>
                                    <p>Loại lớp: <span style="color: #008DCA; font-weight: bold;">{{$row->loailop}}</span></p>
                                    <p>Địa chỉ: <a onclick="window.open('https://www.google.com/maps/place/{{urlencode("$row->diachi")}}');" style="border: #008DCA solid 1px; padding: 1px; color: #008DCA; cursor: pointer;" title="Bấm vào để xem bản đồ">{{$row->diachi}}</a></p>
                                    <p>Dạy: <span style="color: #008DCA;">{{$row->sobuoihoc}} buổi/tuần</span></p>
                                    <p>Giờ học: <span style="color: #008DCA;">{{$row->thoigianhoc}}</span></p>
                                    <p>Lương: <span style="color: #008DCA;">{{number_format($row->luong,0,"",".")}} <sup>đ</sup>/tháng</span></p>
                                    <p>Thông tin: <span style="color: #008DCA;">{{$row->thongtin}}</span></p>
                                    <p>Yêu cầu: <span style="color: #008DCA;">{{$row->yeucau}}</span></p>
                                </div>
                                <div class="clearfix">
                                    <p class="more_y" style="margin-left:100px; font-weight:bold;"><a href="{{route('chitietlop', $row->slug)}}">ĐĂNG KÝ DẠY</a></p>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="lgs_page clearfix" style="float: right;">{{$dslop->links()}}</div>
                </div>
            </div>
@endsection

@section('footer')
    <script src="{{asset('js/danhsachlop.js')}}"></script>
@endsection