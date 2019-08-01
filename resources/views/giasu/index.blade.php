@extends('layouts.home')
@section('title', 'Gia Sư ' . Auth::user()->holot . ' ' . Auth::user()->ten . ' - ')
@section('canonical', route('giasu'))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="dsgsdk" style="margin-bottom: 10px;">
                    <h1>DANH SÁCH LỚP NHẬN DẠY</h1>
                </div>
                <table class="dsgsdk_table" style="margin-bottom: 10px;">
                    <tbody>
                    <tr>
                        <th>Mã lớp</th>
                        <th>Thông tin lớp</th>
                        <th>Thời gian</th>
                        <th>Lương/Mức phí</th>
                        <th>Trạng thái</th>
                    </tr>

                    @foreach($dslop as $row)
                        <?php
                        switch ($row->trangthai) {
                            case 1:
                                $label = '<span class="label label-sm btn-block status_1">ĐỦ ĐK</span>';
                                break;
                            case 2:
                                $label = '<span class="label label-sm btn-block status_2">ĐANG DẠY</span>';
                                break;
                            case 3:
                                $label = '<span class="label label-sm btn-block status_3">ĐÃ DẠY</span>';
                                break;
                            case 4:
                                $label = '<span class="label label-sm btn-block status_4">NGƯNG DẠY</span>';
                                break;
                            case 5:
                                $label = '<span class="label label-sm btn-block status_4">KHÔNG ĐẠT</span>';
                                break;
                            default:
                                $label = '<span class="label label-sm btn-block status_0">CHỜ DUYỆT</span>';
                        }
                        ?>
                        <tr>
                            <td>
                                <p style="font-weight:bold; color: #365899; text-decoration: none; background:transparent; border:#365899 solid 1px; 	border-radius: 10px; padding: 2px;">{{$row->malop}}</p>
                            </td>
                            <td>
                                <p><b>Loại lớp:</b> {{$row->loailop}}</p>
                                <p><b>Môn:</b> {{$row->monday}}</p>
                                <p><b>Lớp:</b> {{$row->lopday}}</p>
                                <p><b>Thông tin:</b> {{$row->thongtin}}</p>
                                <p><b>Yêu cầu:</b> {{$row->yeucau}}</p>
                            </td>
                            <td>
                                <p><b>Thời gian:</b> {{$row->thoigianhoc}}</p>
                                <p><b>Số buổi:</b> {{$row->sobuoihoc}} <sup>buổi/tuần</sup></p>
                            </td>

                            <td>
                                <p><b>Lương:</b> {{number_format($row->luong,0,'','.')}}<sup>đ</sup></p>
                                <p><b>Mức phí:</b> {{$row->lephi}}%</p>
                                <p><b>Mức phí:</b> {{number_format((((float)$row->luong * (float)$row->lephi)/100), 0, '', '.')}}<sup>đ</sup></p>
                            </td>

                            <td>{!!$label!!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <details open>
                    <summary>
                        <span class="summary-title uppercase">Thông tin cá nhân</span>
                        <div class="summary-chevron-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </summary>
                    <div class="summary-content">
                        <div class="f_inner clearfix">
                            <div class="formOut clearfix">
                                <p><i style="color: red; background: yellow;">Lưu ý: Vì một lý do nào đó nếu bạn muốn thay đổi SĐT, CMND/CCCD hoặc EMAIL thì vui lòng liên hệ với Trung tâm để được hỗ trợ.</i></p>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab"></p>
                                    <div class="formOut_field">
                                        <p class="bg_txt3">Bấm vào đây để <a href="{{route('giasu.tdmk')}}" itle="Đổi mật khẩu">Thay đổi mật khẩu</a></p>
                                    </div>
                                </div>

                                <form id="frmUpdate" method="post" action="{{route('giasu.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Họ lót(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <input type="text" id="frmholot" name="frmholot" class="in_405 @error('frmholot') is-invalid @enderror"
                                               value="{{$giasu->holot}}" autocomplete="frmholot" placeholder="Họ lót" maxlength="30" required autofocus/>
                                        @error('frmholot')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab"> Tên(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <input type="text" id="frmten" name="frmten" class="in_405 @error('frmten') is-invalid @enderror"
                                               value="{{$giasu->ten}}" autocomplete="frmten" placeholder="Tên" maxlength="30" required/>
                                        @error('frmten')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Ngày sinh(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <i class="fal fa-calendar-alt"></i>
                                        <input id="frmngaysinh" name="frmngaysinh" value="{{Carbon\Carbon::parse($giasu->ngaysinh)->format('d-m-Y')}}" class="in_405 @error('frmngaysinh') is-invalid @enderror" autocomplete="frmngaysinh" required readonly/>
                                        @error('frmngaysinh')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <?php
                                $tinhthanh = array("Hồ Chí Minh", "Hà Nội", "An Giang", "Bà Rịa - Vũng Tàu", "Bắc Cạn",
                                    "Bắc Giang", "Bạc Liêu", "Bắc Ninh", "Bến Tre", "Bình Định", "Bình Dương", "Bình Phước",
                                    "Bình Thuận", "Cà Mau", "Cần Thơ", "Cao Bằng", "Đà Nẵng", "Đắc Lắk", "Đắk Nông", "Điện Biên",
                                    "Đồng Nai", "Đồng Tháp", "Gia Lai", "Hà Giang", "Hà Nam", "Hà Tĩnh", "Hải Dương", "Hải Phòng",
                                    "Hậu Giang", "Hòa Bình", "Hưng Yên", "Khánh Hòa", "Kiên Giang", "Kon Tum", "Lai Châu", "Lâm Đồng",
                                    "Lạng Sơn", "Lào Cai", "Long An", "Nam Định", "Nghệ An", "Ninh Bình", "Ninh Thuận", "Phú Thọ", "Phú Yên",
                                    "Quảng Bình", "Quảng Nam", "Quảng Ngãi", "Quảng Ninh", "Quảng Trị", "Sóc Trăng", "Sơn La", "Tây Ninh", "Thái Bình",
                                    "Thái Nguyên", "Thanh Hóa", "Thừa Thiên - Huế", "Tiền Giang", "Trà Vinh", "Tuyên Quang", "Vĩnh Long", "Vĩnh Phúc",
                                    "Yên Bái");
                                ?>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Giới tính(<span>*</span>)</p>
                                    <div class="formOut_field clearfix">
                                        <select name="frmgioitinh" id="frmgioitinh" class="@error('frmgioitinh') is-invalid @enderror" style="width:170px;"  required>
                                            <?php
                                            $gioitinh = array('0' => 'Nữ', '1' => 'Nam');
                                            foreach($gioitinh as $key => $value)
                                                if($giasu->gioitinh == $key)
                                                    echo "<option value='$key' selected='selected'>$value</option>";
                                                else
                                                    echo "<option value='$key'>$value</option>";
                                            ?>
                                        </select>
                                        @error('frmgioitinh')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Nơi sinh(<span>*</span>)</p>
                                    <div class="formOut_field clearfix">
                                        <select name="frmnoisinh" id="frmnoisinh" class="@error('frmnoisinh') is-invalid @enderror" style="width:170px;" required>
                                            @foreach ($tinhthanh as $row)
                                                @if($giasu->noisinh == $row)
                                                    <option value="{{$row}}" checked>{{$row}}</option>
                                                @else
                                                    <option value="{{$row}}" checked>{{$row}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('frmnoisinh')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Địa chỉ(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <input type="text" id="frmdiachi" name="frmdiachi"
                                               class="in_405 @error('frmdiachi') is-invalid @enderror"
                                               value="{{$giasu->diachi}}" autocomplete="frmdiachi"
                                               placeholder="Số nhà, tên đường, phường đang sinh sống" maxlength="50" required/>
                                        @error('frmdiachi')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Quận huyện(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <input type="text" id="frmquanhuyen" name="frmquanhuyen"
                                               class="in_405 @error('frmquanhuyen') is-invalid @enderror"
                                               value="{{$giasu->quanhuyen}}" autocomplete="frmquanhuyen"
                                               placeholder="Quận huyện đang sinh sống" maxlength="50" required/>
                                        @error('frmquanhuyen')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Tỉnh thành(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <select name="frmtinhthanh" id="frmtinhthanh" class="@error('frmtinhthanh') is-invalid @enderror" style="width:100%;" required>
                                            @foreach ($tinhthanh as $row)
                                                @if($giasu->noisinh == $row)
                                                    <option value="{{$row}}" checked>{{$row}}</option>
                                                @else
                                                    <option value="{{$row}}">{{$row}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('frmtinhthanh')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Ảnh của bạn(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <div class="file-container">
                                            <input type="file" id="frmanhthe" name="frmanhthe" accept="image/*" hidden="hidden"/>
                                            <button type="button" id="anhthebtn" class="file-button"><i class="fal fa-cloud-upload"></i></button>
                                            <span id="anhthetext" class="file-text">chưa có ảnh nào được chọn</span>
                                        </div>
                                    </div>
                                    <br><br>
                                    @if(!empty(Auth::user()->anhthe))
                                        <p style="text-align:center;">
                                            <a href="{{asset('storage/anhthe/'.Auth::user()->anhthe)}}" data-lightbox="image">
                                                <img src="{{asset('storage/anhthe/'.Auth::user()->anhthe)}}" style="width:120px; height:160px;"/>
                                            </a>
                                        </p>
                                    @else
                                        <p style="text-align:center;"><img src="{{asset('storage/anhthe/no_image.jpg')}}" style="width:120px; height:160px;"/></p>
                                    @endif
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Mặt trước CMND(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <div class="file-container">
                                            <input type="file" id="frmanhcmnd" name="frmanhcmnd" accept="image/*" hidden="hidden"/>
                                            <button type="button" id="cmndbtn" class="file-button"><i class="fal fa-cloud-upload"></i></button>
                                            <span id="cnmdtext" class="file-text">chưa có ảnh nào được chọn</span>
                                        </div>
                                    </div>
                                    <br><br>
                                    @if(!empty(Auth::user()->anhcmnd))
                                        <p style="text-align:center;">
                                            <a href="{{asset('storage/anhcmnd/'.Auth::user()->anhcmnd)}}" data-lightbox="image">
                                                <img src="{{asset('storage/anhcmnd/'.Auth::user()->anhcmnd)}}" style="width:120px; height:160px;"/>
                                            </a>
                                        </p>
                                    @else
                                        <p style="text-align:center;"><img src="{{asset('storage/anhcmnd/no_image.jpg')}}" style="width:120px; height:160px;"/></p>
                                    @endif
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Trường học(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <input type="text" id="frmtruonghoc" name="frmtruonghoc" placeholder="ví dụ: ĐH sư phạm" class="in_405 @error('frmtruonghoc') is-invalid @enderror"  value="{{$giasu->truonghoc}}" autocomplete="frmtruonghoc" required/>
                                        @error('frmtruonghoc')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Ngành học(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <input type="text" id="frmnganhhoc" name="frmnganhhoc" placeholder="ví dụ: ĐH sư phạm" class="in_405 @error('frmnganhhoc') is-invalid @enderror"  value="{{$giasu->nganhhoc}}" autocomplete="frmnganhhoc" required/>
                                        @error('frmnganhhoc')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Năm TN(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <select name="frmnamtn" id="frmnamtn" class="@error('frmnamtn') is-invalid @enderror" style="width:170px;"  required>
                                            @for($i = (date('Y') + 10); $i >= 1960; $i--)
                                                @if($giasu->namtn == $i)
                                                    <option value='{{$i}}' selected>{{$i}}</option>
                                                @else
                                                    <option value='{{$i}}'>{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        @error('frmnamtn')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                        <p><br><br><br>
                                            <i style="color: red; background: yellow; font-style:italic; font-size:10pt;">
                                                Ví dụ: Niên khóa ĐH/CĐ của bạn là 2015 - 2019. Bạn chọn năm tốt nghiệp là 2019.
                                            </i>
                                        </p>
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Hiện là(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <select name="frmtrinhdo" id="frmtrinhdo" class="@error('frmtrinhdo') is-invalid @enderror" style="width:170px;" required>
                                            <?php
                                            $trinhdo = array("Giáo viên", "Sinh viên", "Sinh viên sư phạm", "Cử nhân", "Cử nhân sư phạm", "Kỹ sư", "Thạc sỹ", "Bằng cấp khác");
                                            ?>
                                            @foreach($trinhdo as $row)
                                                @if($giasu->trinhdo == $row)
                                                    <option value="{{$row}}" selected>{{$row}}</option>
                                                @else
                                                    <option value="{{$row}}">{{$row}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('frmtrinhdo')
                                        <span class="error"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Thông tin thêm</p>
                                    <div class="formOut_field">
                                        <textarea id="frmthongtinkhac" name="frmthongtinkhac" placeholder="Nơi để bạn ghi thêm thông tin chi tiết về bản thân. Kinh nghiệm và thành tích bạn đạt được trong quá trình học tập và dạy kèm." class="area_100" maxlength="250">{{$giasu->thongtinkhac}}</textarea>
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Môn dạy(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <ul class="check_l1 clearfix">
                                            <?php
                                                $monday = explode(",",$giasu->monday);
                                                foreach($monhoc as $mon)
                                                {
                                                    foreach($monday as $row)
                                                        if($row == $mon->id)
                                                        {
                                                            echo "<li><input type='checkbox' name='frmmonday[]' value='$mon->id' checked required/><label>$mon->tenmon</label></li>";
                                                            continue 2;
                                                        }
                                                    echo "<li><input type='checkbox' name='frmmonday[]' value='$mon->id' required/><label>$mon->tenmon</label></li>";

                                                }
                                            ?>
                                        </ul>
                                        <label class="error"></label>
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Lớp dạy(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <ul class="check_l2 clearfix">
                                            <?php
                                                $lopday = explode(",",$giasu->lopday);
                                                foreach($lophoc as $lop)
                                                {
                                                    foreach($lopday as $row)
                                                        if($row == $lop->id)
                                                        {
                                                            echo "<li><input type='checkbox' name='frmlopday[]' value='$lop->id' checked required/><label>$lop->tenlop</label></li>";
                                                            continue 2;
                                                        }
                                                    echo "<li><input type='checkbox' name='frmlopday[]' value='$lop->id' required/><label>$lop->tenlop</label></li>";
                                                }
                                            ?>
                                        </ul>
                                        <label class="error"></label>
                                    </div>
                                </div>

                                <div class="formOut_line clearfix">
                                    <p class="formOut_lab">Khu vực dạy(<span>*</span>)</p>
                                    <div class="formOut_field">
                                        <ul class="check_l3 clearfix">
                                            <?php
                                                $khuvucday = explode(",",$giasu->khuvucday);
                                                foreach($khuvuc as $kv)
                                                {
                                                    foreach($khuvucday as $row)
                                                        if($row == $kv->id)
                                                        {
                                                            echo "<li><input type='checkbox' name='frmkhuvuc[]' value='$kv->id' checked required/><label>$kv->tenkv</label></li>";
                                                            continue 2;
                                                        }
                                                    echo "<li><input type='checkbox' name='frmkhuvuc[]' value='$kv->id' required/><label>$kv->tenkv</label></li>";
                                                }
                                            ?>
                                        </ul>
                                        <label class="error"></label>
                                    </div>
                                </div>

                                <p class="dangky_btn clearfix">
                                    <button type="submit" class="btn_s2" style="float: none;">CẬP NHẬT</button>
                                </p>
                                <p style="margin-top:10px; margin-bottom: -30px;">
                                    <i style="color: red; background: yellow; font-style:italic; font-size:10pt;">Lưu ý: Điền đầy đủ thông tin để tiến trình công việc diễn ra thuận lợi. Xin cảm ơn!</i>
                                </p>
                            </form>
                        </div>
                        </div>
                    </div>
                    <div class="summary-chevron-down">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-up">
                            <polyline points="18 15 12 9 6 15"></polyline>
                        </svg>
                    </div>
                </details>
            </div>
@endsection

@section('footer')
    <link rel="stylesheet" href="{{asset('css/giasu.css')}}" type="text/css">
    <link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
    <link href="{{asset('lightbox/dist/css/lightbox.css')}}" rel="stylesheet" />
    <script src="{{asset('js/datepicker.js')}}"></script>
    <script src="{{asset('js/datepicker.vi-VN.js')}}"></script>
    <script type="text/javascript" src="{{asset('lightbox/dist/js/lightbox.js')}}"></script>
    <script src="{{asset('js/giasu.js')}}"></script>
@endsection