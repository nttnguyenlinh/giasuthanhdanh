@extends('layouts.home')
@section('title', 'Thay đổi mật khẩu - ')
@section('canonical', route('giasu.dmk'))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="dsgsdk" style="margin-bottom: 10px;">
                    <h1>THAY ĐỔI MẬT KHẨU</h1>
                </div>

                <div class="f_inner clearfix">
                    <div class="formOut clearfix">
                        <form id="frmdmk" method="post" action="{{route('giasu.tdmk')}}">
                            @csrf
                            <div class="formOut_line clearfix">
                                <p class="formOut_lab">Mật khẩu hiện tại(<span>*</span>)</p>
                                <div class="formOut_field">
                                    <input type="password" id="mkht" name="mkht" class="in_405 @error('mkht') is-invalid @enderror"
                                           value="" required autofocus/>
                                    @error('mkht')
                                    <span class="error"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="formOut_line clearfix">
                                <p class="formOut_lab">Mật khẩu mới(<span>*</span>)</p>
                                <div class="formOut_field">
                                    <input type="password" id="mkm" name="mkm" class="in_405 @error('mkm') is-invalid @enderror"
                                           value="" required autofocus/>
                                    @error('mkm')
                                    <span class="error"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="formOut_line clearfix">
                                <p class="formOut_lab">Nhập lại mật khẩu(<span>*</span>)</p>
                                <div class="formOut_field">
                                    <input type="password" id="xnmk" name="xnmk" class="in_405 @error('xnmk') is-invalid @enderror"
                                           value="" required autofocus/>
                                    @error('xnmk')
                                    <span class="error"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <p class="clearfix" style="text-align:center;">
                                <button type="submit" class="btn_s2" style="margin-top:10px; width:150px!important; float:none;">Đổi mật khẩu</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
@endsection

@section('footer')
    <link rel="stylesheet" href="{{asset('css/dangkygiasu.css')}}" type="text/css">
    <script src="{{asset('js/doimatkhau.js')}}"></script>
@endsection