@extends('layouts.home')
@section('title', 'Đăng ký làm gia sư - ')
@section('canonical', Route('dang-ky-lam-gia-su.index'))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="newClass">
                    <div class="content_choose_class">
                        <div class="dsgsdk" style="margin-bottom: 10px;">
                            <h1>ĐĂNG KÝ LÀM GIA SƯ</h1>
                        </div>
                        <div class="f_inner clearfix">
                                <p style="font-weight:bolder; color: red; margin: 10px; margin-top:-10px; line-height: 1.5; text-align:justify;">
                                    Quý thầy cô và các bạn gia sư vui lòng điền đầy đủ thông tin yêu cầu bên
                                    dưới để hoàn tất việc đăng ký.
                                </p>
                                <div class="formOut clearfix">
                                    <form id="frmReg" method="post"
                                          action="{{route('dang-ky-lam-gia-su.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab">Họ lót(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <input type="text" id="frmholot" name="frmholot" class="in_405 @error('frmholot') is-invalid @enderror"
                                                       value="{{ old('frmholot') }}" autocomplete="frmholot" placeholder="Họ lót" maxlength="30" required autofocus/>
                                                @error('frmholot')
                                                <span class="error"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab"> Tên(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <input type="text" id="frmten" name="frmten" class="in_405 @error('frmten') is-invalid @enderror"
                                                       value="{{ old('frmten') }}" autocomplete="frmten" placeholder="Tên" maxlength="30" required/>
                                                @error('frmten')
                                                <span class="error"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab">Ngày sinh(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <i class="fal fa-calendar-alt"></i>
                                                <input id="frmngaysinh" name="frmngaysinh" class="in_405 @error('frmngaysinh') is-invalid @enderror"
                                                       value="{{ old('frmngaysinh') }}" autocomplete="frmngaysinh" required readonly/>

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
                                                    <option value="" disabled selected>Giới tính</option>
                                                    <option value="0" {{ old('frmgioitinh') ? 'checked' : '' }}>Nữ</option>
                                                    <option value="1" {{ old('frmgioitinh') ? 'checked' : '' }}>Nam</option>
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
                                                    <option value="" disabled selected>Nơi sinh</option>
                                                    @foreach ($tinhthanh as $row)
                                                        <option value="{{$row}}" {{old("frmnoisinh") ? "checked" : ""}}>{{$row}}</option>
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
                                                       value="{{ old('frmdiachi') }}" autocomplete="frmdiachi"
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
                                                       value="{{ old('frmquanhuyen') }}" autocomplete="frmquanhuyen"
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
                                                    <option value="" disabled selected>Tỉnh thành</option>

                                                    @foreach ($tinhthanh as $row)
                                                        <option value="{{$row}}" {{old("frmtinhthanh") ? "checked" : ""}}>{{$row}}</option>
                                                    @endforeach
                                                </select>

                                                @error('frmtinhthanh')
                                                <span class="error"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab">Email(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <i class="fal fa-at"></i>
                                                <input type="email" id="frmemail" name="frmemail" class="in_405 @error('frmemail') is-invalid @enderror"
                                                       value="{{ old('frmemail') }}" autocomplete="frmemail"
                                                       placeholder="Nhập địa chỉ email" maxlength="30" required/>
                                                @error('frmemail')
                                                <span class="error"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab">Số điện thoại(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <i class="fal fa-mobile"></i>
                                                <input type="text" id="frmsdt" name="frmsdt"
                                                       placeholder="090xxxxxxx" class="in_405 @error('frmsdt') is-invalid @enderror"
                                                       value="{{ old('frmsdt') }}" autocomplete="frmsdt"
                                                       maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                       required/>

                                                @error('frmsdt')
                                                <span class="error"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab">CMND/CCCD(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <i class="fal fa-id-card"></i>
                                                <input type="text" id="frmcmnd" name="frmcmnd"
                                                       placeholder="Nhập số cmnd/cccd"
                                                       class="in_405 @error('frmcmnd') is-invalid @enderror"
                                                       value="{{ old('frmcmnd') }}" autocomplete="frmcmnd"
                                                       maxlength="12" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required/>

                                                @error('frmcmnd')
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
                                        </div>

                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab">Trường học(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <input type="text" id="frmtruonghoc" name="frmtruonghoc" placeholder="ví dụ: ĐH sư phạm" class="in_405 @error('frmtruonghoc') is-invalid @enderror"  value="{{ old('frmtruonghoc') }}" autocomplete="frmtruonghoc" required/>
                                                @error('frmtruonghoc')
                                                <span class="error"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab">Ngành học(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <input type="text" id="frmnganhhoc" name="frmnganhhoc" placeholder="ví dụ: ĐH sư phạm" class="in_405 @error('frmnganhhoc') is-invalid @enderror"  value="{{ old('frmnganhhoc') }}" autocomplete="frmnganhhoc" required/>
                                                @error('frmnganhhoc')
                                                <span class="error"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab">Năm TN(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <select name="frmnamtn" id="frmnamtn" class="@error('frmnamtn') is-invalid @enderror" style="width:170px;"  required>
                                                    <option value="" disabled selected>Năm TN</option>
                                                    @for($i = (date('Y') + 10); $i >= 1960; $i--)
                                                        <option value='{{$i}}' {{old('frmnamtn') ? 'checked' : '' }}>{{$i}}</option>
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
                                                    <option value="" disabled selected>Trình độ</option>
                                                    <?php
                                                    $trinhdo = array("Giáo viên", "Sinh viên", "Sinh viên sư phạm", "Cử nhân", "Cử nhân sư phạm", "Kỹ sư", "Thạc sỹ", "Bằng cấp khác");
                                                    ?>
                                                    @foreach($trinhdo as $row)
                                                        <option value="{{$row}}" {{old("frmtrinhdo") ? "checked" : ""}}>{{$row}}</option>
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
                                                <textarea id="frmthongtinkhac" name="frmthongtinkhac" placeholder="Nơi để bạn ghi thêm thông tin chi tiết về bản thân. Kinh nghiệm và thành tích bạn đạt được trong quá trình học tập và dạy kèm." class="area_100" maxlength="250"></textarea>
                                            </div>
                                        </div>

                                        <div class="formOut_line clearfix">
                                            <p class="formOut_lab">Môn dạy(<span>*</span>)</p>
                                            <div class="formOut_field">
                                                <ul class="check_l1 clearfix">
                                                    <?php
                                                    foreach($monhoc as $row)
                                                        echo "<li><input type='checkbox' name='frmmonday[]' value='$row->id' required/><label>$row->tenmon</label></li>";
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
                                                    foreach($lophoc as $row)
                                                        echo "<li><input type='checkbox' name='frmlopday[]' value='$row->id' required/><label>$row->tenlop</label></li>";
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
                                                    foreach($khuvuc as $row)
                                                        echo "<li><input type='checkbox' name='frmkhuvuc[]' value='$row->id' required/><label>$row->tenkv</label></li>";
                                                    ?>
                                                </ul>
                                                <label class="error"></label>
                                            </div>
                                        </div>

                                        <p class="dangky_btn clearfix">
                                            <button type="submit" class="btn_s2" style="float: none;">ĐĂNG KÝ
                                            </button>
                                        </p>
                                        <p style="margin-top:10px; margin-bottom: -30px;">
                                            <i style="color: red; background: yellow; font-style:italic; font-size:10pt;">Lưu ý: Điền đầy đủ thông tin để được xét duyệt. Xin cảm ơn!</i>
                                        </p>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            @endsection

            @section('footer')
                <link rel="stylesheet" href="{{asset('css/dangkygiasu.css')}}" type="text/css">
                <link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
                <script src="{{asset('js/datepicker.js')}}"></script>
                <script src="{{asset('js/datepicker.vi-VN.js')}}"></script>
                <script src="{{asset('js/dangkylamgiasu.js')}}"></script>
            @endsection