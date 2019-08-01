@extends('layouts.home')
@section('title', 'Đăng ký tìm gia sư - ')
@section('canonical', Route('dang-ky-tim-gia-su.index'))

@section('content')

    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="newClass">
                    <div class="content_choose_class">
                        <div class="dsgsdk" style="margin-bottom: 10px;">
                            <h1>ĐĂNG KÝ TÌM GIA SƯ</h1>
                        </div>
                        <div class="box_contact box_tc">
                            <div class="content-box_contact">
                                <div class="f_inner clearfix">
                                    <div class="f_inner">
                                        <p style="text-align:justify; color: #04776f; margin: 5px; margin-top:-10px; text-indent: 30px; line-height: 1.5;">
                                            Quý phụ huynh, các bạn học sinh có nhu cầu đăng ký học vui lòng điền đầy đủ thông tin (đặc biệt là các mục có đánh dấu <span style="color:red;">*</span>).
                                        </p>

                                        <p style="text-align:justify; color: #04776f; margin: 5px; text-indent: 30px; line-height: 1.5;">
                                            Chúng tôi sẽ liên lạc lại trong ngày để trao đổi thêm các thông tin. Thông thường chúng tôi sẽ liên hệ lại sau giờ hành chính (19h - 21h) để tiện cho Quý phụ huynh. Hoặc, Quý phụ huynh cũng có thể điện thoại trực tiếp đến thầy Thiên - 0947.582.586 để được tư vấn và chọn gia sư dạy phù hợp.
                                        </p>

                                        <p style="text-align:justify; color: #04776f; margin: 5px; text-indent: 30px; line-height: 1.5;">
                                            Chân thành cảm ơn sự tin tưởng và lựa chọn <span class="uppercase">{{config('app.name')}}</span> để gửi trao tương lai của con em bạn!
                                        </p>
                                        <div class="formOut clearfix">
                                            <form id="frmReg" method="post"
                                                  action="{{route('dang-ky-tim-gia-su.store')}}">
                                                @csrf
                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Họ và tên(<span>*</span>)</p>
                                                    <div class="formOut_field">
                                                        <input type="text" id="hoten" name="frmhoten"
                                                               class="in_405 @error('frmhoten') is-invalid @enderror"
                                                               value="{{ old('frmhoten') }}" autocomplete="frmhoten"
                                                               placeholder="Họ và tên"
                                                               maxlength="30" required autofocus/>
                                                        @error('frmhoten')
                                                        <span class="error"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Địa chỉ<span>*</span>)</p>
                                                    <div class="formOut_field">
                                                        <input type="text" id="diachi" name="frmdiachi"
                                                               class="in_405 @error('frmdiachi') is-invalid @enderror"
                                                               value="{{ old('frmdiachi') }}" autocomplete="frmdiachi"
                                                               placeholder="Địa chỉ" maxlength="50" required/>
                                                        @error('frmdiachi')
                                                        <span class="error"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Email</p>
                                                    <div class="formOut_field">
                                                        <input type="email" id="email" name="frmemail" class="in_405"
                                                               value="{{ old('frmemail') }}" autocomplete="frmemail"
                                                               placeholder="Nhập địa chỉ email" maxlength="30"/>
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Số điện thoại(<span>*</span>)</p>
                                                    <div class="formOut_field">
                                                        <input type="text" id="sdt" name="frmsdt"
                                                               placeholder="090xxxxxxx"
                                                               class="in_405 @error('frmsdt') is-invalid @enderror"
                                                               value="{{ old('frmsdt') }}" autocomplete="frmsdt"
                                                               maxlength="10"
                                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                               required/>

                                                        @error('frmsdt')
                                                        <span class="error"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Chọn lớp(<span>*</span>)</p>
                                                    <div class="formOut_field">
                                                        <span class="w160">
                                                            <select id="lophoc" name="frmlophoc"
                                                                    class="@error('frmlophoc') is-invalid @enderror"
                                                                    required>
                                                                @foreach($lophoc as $row)
                                                                    <option value="{{$row->tenlop}}" {{ old('frmlophoc') ? 'checked' : '' }}>{{$row->tenlop}}</option>
                                                                @endforeach
                                                            </select>
                                                        </span>

                                                        <p class="formOut_lab" style="margin-left:20px;">Loại lớp(<span>*</span>)
                                                        </p>
                                                        <span class="w160">
                                                            <select id="loailop" name="frmloailop"
                                                                    class="@error('frmloailop') is-invalid @enderror"
                                                                    required>
                                                               <option value="1" {{ old('frmloailop') ? 'checked' : '' }}>Lớp thường</option>
                                                                <option value="2" {{ old('frmloailop') ? 'checked' : '' }}>Lớp chất lượng cao</option>
                                                                <option value="3" {{ old('frmloailop') ? 'checked' : '' }}>Lớp đảm bảo</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <div class="formOut_field" style="margin-left:150px;">
                                                        @error('frmlophoc')
                                                        <span class="error"> {{ $message }}</span>
                                                        @enderror
                                                        <span style="margin:0 20px;"></span>
                                                        @error('frmloailop')
                                                        <span class="error"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Môn học(<span>*</span>)</p>
                                                    <div class="formOut_field">
                                                        <input type="text" id="monhoc" name="frmmonhoc"
                                                               placeholder="Toán, lý, hóa"
                                                               class="in_405 @error('frmmonhoc') is-invalid @enderror"
                                                               value="{{ old('frmmonhoc') }}" autocomplete="frmmonhoc"
                                                               maxlength="100" required/>

                                                        @error('frmmonhoc')
                                                        <span class="error"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Số học sinh</p>
                                                    <div class="formOut_field">
                                                        <input type="text" id="sohocsinh" name="frmsohocsinh"
                                                               class="in_405" placeholder="ví dụ: 1 học sinh"
                                                               value="{{ old('frmsohocsinh') }}"
                                                               autocomplete="frmsohocsinh" maxlength="30"/>
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Học lực hiện tại</p>
                                                    <div class="formOut_field">
                                                        <input type="text" id="hocluc" name="frmhocluc" class="in_405"
                                                               value="{{ old('frmhocluc') }}" autocomplete="frmhocluc"
                                                               placeholder="Ví dụ: trung bình" maxlength="30"/>
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Số buổi học(<span>*</span>)</p>
                                                    <div class="formOut_field clearfix">
                                                        <span class="w160">
                                                            <select name="frmsobuoihoc" id="sobuoihoc"
                                                                    class="@error('frmsobuoihoc') is-invalid @enderror"
                                                                    required>
                                                                <option value="2" {{ old('frmsobuoihoc') ? 'checked' : '' }}>2 buổi/tuần</option>
                                                                <option value="3" {{ old('frmsobuoihoc') ? 'checked' : '' }}>3 buổi/tuần</option>
                                                                <option value="4" {{ old('frmsobuoihoc') ? 'checked' : '' }}>4 buổi/tuần</option>
                                                                <option value="5" {{ old('frmsobuoihoc') ? 'checked' : '' }}>5 buổi/tuần</option>
                                                            </select>
                                                        </span>

                                                        <p class="formOut_lab" style="margin-left:20px;">Yêu
                                                            cầu(<span>*</span>)</p>
                                                        <span class="w160">
                                                            <select name="frmyeucau" id="yeucau"
                                                                    class="@error('frmyeucau') is-invalid @enderror"
                                                                    required>
                                                                <option value="Giáo viên" {{ old('frmyeucau') ? 'checked' : '' }}>Giáo viên</option>
                                                                <option value="Sinh viên" {{ old('frmyeucau') ? 'checked' : '' }}>Sinh Viên</option>
                                                                <option value="Sinh viên sư phạm" {{ old('frmyeucau') ? 'checked' : '' }}>Sinh viên sư phạm</option>
                                                                <option value="Cử nhân" {{ old('frmyeucau') ? 'checked' : '' }}>Cử nhân</option>
                                                                 <option value="Cử nhân sư phạm" {{ old('frmyeucau') ? 'checked' : '' }}>Cử nhân sư phạm</option>
                                                                <option value="Kỹ sư" {{ old('frmyeucau') ? 'checked' : '' }}>Kỹ sư</option>
                                                                <option value="Thạc sỹ" {{ old('frmyeucau') ? 'checked' : '' }}>Thạc sỹ</option>
                                                                <option value="Khác" {{ old('frmyeucau') ? 'checked' : '' }}>Khác</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <div class="formOut_field" style="margin-left:150px;">
                                                        @error('frmsobuoi')
                                                        <span class="error"> {{ $message }}</span>
                                                        @enderror
                                                        <span style="margin:0 20px;"></span>
                                                        @error('frmyeucau')
                                                        <span class="error"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Thời gian học(<span>*</span>)</p>
                                                    <div class="formOut_field">
                                                        <input type="text" id="thoigianhoc" name="frmthoigianhoc"
                                                               placeholder="Ví dụ: Thứ 2 - thứ 4; 17h - 19h"
                                                               value="{{ old('frmthoigianhoc') }}"
                                                               class="in_405 @error('frmthoigianhoc') is-invalid @enderror"
                                                               maxlength="30" required/>

                                                        @error('frmthoigianhoc')
                                                        <span class="error"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="formOut_line clearfix">
                                                    <p class="formOut_lab">Yêu cầu khác</p>
                                                    <div class="formOut_field">
                                                        <textarea id="yeucaukhac" name="frmyeucaukhac" class="area_100"
                                                                  style="resize: vertical; height: auto;"
                                                                  maxlength="100" autocomplete="frmyeucaukhac"
                                                                  rows="5">{{ old('frmyeucaukhac') }}</textarea>
                                                    </div>
                                                </div>

                                                <p class="dangky_btn clearfix">
                                                    <button type="submit" class="btn_s2" style="float: none;">ĐĂNG KÝ
                                                    </button>
                                                </p>
                                                <p style="margin-top:10px; margin-bottom: -30px;"><span
                                                            style="color: red; background: yellow;">Lưu ý: Điền đầy đủ thông tin để được xét duyệt. Xin cảm ơn!</span>
                                                </p>
                                            </form>
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
    <link rel="stylesheet" href="{{asset('css/dangkyhoc.css')}}" type="text/css">
    <script type="text/javascript" src="{{asset('js/dangkyhoc.js')}}"></script>
@endsection