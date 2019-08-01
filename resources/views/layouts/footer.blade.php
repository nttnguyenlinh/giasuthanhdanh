            <div class="box clearfix">
                <h3 class="bh_b">GIA SƯ TIÊU BIỂU</h3>
                <div class="giasutieubieu">
                    <div class="jcarousel" style="visibility: visible; overflow: hidden; position: relative; height: 360px;">
                        <ul style="margin: 0px; padding: 0px; position: relative; list-style-type: none;">
                            <?php
                                $giasu = \App\GiaSu::select('id', 'holot', 'ten', 'anhthe')->orderBy('id', 'desc')->take(8)->get();
                            ?>
                            @if($giasu->count() > 0)
                                @foreach($giasu as $row)
                                    @if($row->anhthe != null)
                                        <li style='width: 142px; height: 180px;'>
                                            <a href="{{route('danhsachgiasu')}}"><img src="{{asset('storage/anhthe/'.$row->anhthe)}}" title="{{$row->holot}} {{$row->ten}}" style="width:100%; height:98%;"/></a>
                                        </li>
                                    @else
                                        <li style='width: 142px; height: 180px;'>
                                            <a href="{{route('danhsachgiasu')}}"><img src="{{asset('storage/anhthe/no_image.jpg')}}" title="{{$row->holot}} {{$row->ten}}" style="width:100%; height:98%;"/></a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="box clearfix">
                <h3 class="bh_b">TIN TỨC MỚI</h3>
                <div class="jcarousel_tintuc">
                    <?php
                        $tintuc = \App\BaiViet::select('tieude','anhbia')->where('danhmuc', 1, '&and')->where('trangthai', 1)->orderBy('created_at', 'desc')->take(5)->get();
                    ?>
                    <ul class="l_tintuc" style="margin: 0px; padding: 0px; position: relative; list-style-type: none;">
                        @if($tintuc->count() > 0)
                            @foreach($tintuc as $row)
                                <li>
                                    <a href="/tin-tuc">
                                        @if(!empty($row->anhbia))
                                            <img src="{{asset('storage/'.$row->anhbia)}}" alt="Gia sư Thành Danh">
                                        @else
                                            <img src="{{asset('storage/img_3.jpg')}}" alt="Gia sư Thành Danh">
                                        @endif
                                            <br>{{$row->tieude}}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <div class="box clearfix">
                <h3 class="bh_b">FANPAGE</h3>
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fgiasulequydon.net%2F&tabs&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1835120729871081" width="150" height="230" style="border:none;overflow:hidden" scrolling="true" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            </div>

            <div class="box clearfix">
                <h3 class="bh_b">BẢN ĐỒ</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d979.5208831017687!2d106.63050362304949!3d10.881251128977821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529ffde2cb01f%3A0x91c5a4be7f170c09!2zVHLhuqduIFRo4buLIEjDqCwgSGnhu4dwIFRow6BuaCwgUXXhuq1uIDEyLCBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1501506002415" width="100%" height="230" style="border:none;overflow:hidden" allowfullscreen></iframe>
            </div>

            <div class="box clearfix">
                <h3 class="bh_b">BỘ ĐẾM TRUY CẬP</h3>
                <img src="https://counter5.wheredoyoucomefrom.ovh/private/freecounterstat.php?c=j1pqq6kry2sxddfh4qycukypqp8azgdd" alt="{{config('app.name')}}" style="margin: 5px;">
            </div>
        </div>
    </div>

    <div class="footer" style="border: 1px solid #04776f00;">
        <div class="f_inner clearfix">
            <div class="f_inner_l">
                <ul class="f_list" style="border-right: none;width: 100%;">
                    <li>
                        <span class="vp1" style="line-height: 1.5;">Văn phòng gia sư Thành Danh Quận 12</span><br>
                        <span style="line-height: 1.5;">Số 213, đường TCH13, Khu phố 8, phường Tân Chánh Hiệp</span>
                    </li>
                </ul>
            </div>

            <div class="f_inner_r">
                <ul class="f_list" style="border-right: none; width: 100%;">
                    <li>
                        <span class="vp1" style="line-height: 1.5;">Văn phòng gia sư Thành Danh Quận 12</span><br>
                        <span style="line-height: 1.5;"> Số 380, đường HT42, Khu phố 8, phường Hiệp Thành</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<a href="javascript:void(0);" id="scroll" title="Lên đầu trang" style="display: none; margin-bottom: 80px; margin-right: 25px;"><span></span></a>
<script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('js/jcarousellite.min.js')}}"></script>
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/swipe.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/home.js')}}"></script>
<script src="{{asset('js/login.js')}}"></script>
@section('footer')
@show

@if(Session::has('status'))
    <script>
        Swal.fire({
            type: "{!!Session::get('status')!!}",
            title: "",
            text: "{!!Session::get('message')!!}",
            customClass: {
                content: "content-{!!Session::get('status')!!}",
                confirmButton: "btn-{!!Session::get('status')!!}",
            }
        })
    </script>
@endif
</body>
</html>
