@extends('layouts.home')
@section('title', 'Danh sách gia sư - ')
@section('canonical', route('danhsachlop'))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="newClass">
                    <div class="dsgsdk" style="margin-bottom: 10px;">
                        <h1>DANH SÁCH GIA SƯ</h1>
                    </div>
                    <div class="search clearfix">
                        <form method="post" action="{{route('timkiemgiasu')}}">
                            @csrf
                            <select style="width:100%; margin-right:4px; color:#008DCA;" name="monday">
                                <option value="" disabled selected>Môn dạy</option>
                                @foreach($monhoc as $mon)
                                    <option value="{{$mon->id}}">{{$mon->tenmon}}</option>
                                @endforeach
                            </select>

                            <select style="width:100%; margin-right:4px;  color:#008DCA;" name="lopday">
                                <option value="" disabled selected>Lớp dạy</option>
                                @foreach($lophoc as $lop)
                                    <option value="{{$lop->id}}">{{$lop->tenlop}}</option>
                                @endforeach
                            </select>
                            <select name="quanhuyen" style="margin-right:4px; color:#008DCA;">
                                <option value="" disabled selected>Quận/huyện</option>
                                @foreach($khuvuc as $kv)
                                    <option value="{{$kv->id}}">{{$kv->tenkv}}</option>
                                @endforeach
                            </select>
                            <select style="width:100%; color:#008DCA;" name="trinhdo">
                                <option value="" disabled selected>Trình độ</option>
                                <?php
                                    $trinhdo = array("Giáo viên", "Sinh viên", "Sinh viên sư phạm", "Cử nhân", "Cử nhân sư phạm", "Kỹ sư", "Thạc sỹ", "Bằng cấp khác");
                                ?>
                                @foreach($trinhdo as $row)
                                    <option value="{{$row}}">{{$row}}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="timkiem" value="Tìm kiếm" class="btn_s2" style="float:left; margin-left:10px; background:#008DCA; border: #008DCA 1px solid;"/>
                        </form>
                    </div>

                    <div class="giasu_d">
                        <div class="gs_item_l clearfix">
                            @if($giasu->count() > 0)
                                @foreach($giasu as $row)
                                <div class="gs_item">
                                    <div>
                                        @if($row->anhthe != null)
                                            <a href="{{asset('storage/anhthe/'.$row->anhthe)}}" data-lightbox="image" data-title="Gia sư {{$row->holot}} {{$row->ten}}">
                                                <img src="{{asset('storage/anhthe/'.$row->anhthe)}}" alt="{{config('app.name')}}"/>
                                            </a>
                                        @else
                                            <img src="{{asset('storage/anhthe/no_image.jpg')}}" alt="{{config('app.name')}}"/>
                                        @endif
                                        <p style="margin-top:10px;"></p>
                                        <p style="text-align:center;"><strong style="color:white; text-shadow: 1px 1px 2px black, 0 0 1em blue, 0 0 0.2em darkblue; color: white;">{{$row->holot}} {{$row->ten}}</strong></p>
                                            <p>Hiện là: <strong>{{$row->trinhdo}}</strong></p>
                                            <p>Năm sinh: <span>{{substr($row->ngaysinh, 0, 4)}}</span></p>
                                            <p>Học trường: <span>{{$row->truonghoc}}</span></p>
                                            <p>Chuyên ngành: <span>{{$row->nganhhoc}}</span></p>
                                            <p>Tốt nghiệp: <span>{{$row->namtn}}</span></p>
                                        <?php
                                            $kv = array();
                                            $monday = array();
                                            $lopday = array();

                                            foreach($lophoc as $lop)
                                                foreach(explode(",",$row->lopday) as $item)
                                                    if($item == $lop->id) $lopday[] = $lop->tenlop;

                                            foreach($monhoc as $mon)
                                                foreach(explode(",",$row->monday) as $item)
                                                    if($item == $mon->id) $monday[] = $mon->tenmon;

                                            foreach($khuvuc as $k)
                                                foreach(explode(",",$row->khuvucday) as $item)
                                                    if($item == $k->id) $kv[] = $k->tenkv;
                                        ?>
                                        <p>Lớp dạy: <span>{{implode(', ', $lopday)}}</span></p>
                                        <p>Môn dạy: <span>{{implode(', ', $monday)}}</span></p>
                                        <p>Khu vực: <span>{{implode(', ', $kv)}}</span></p>
                                        <p>Ưu điểm: <span>{{$row->thongtinkhac}}</p>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    <div class="lgs_page clearfix" style="float: right;">{{$giasu->links()}}</div>
                </div>
            </div>
            </div>
@endsection

@section('footer')
    <link href="{{asset('lightbox/dist/css/lightbox.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{asset('lightbox/dist/js/lightbox.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/danhsachgiasu.js')}}"></script>
@endsection