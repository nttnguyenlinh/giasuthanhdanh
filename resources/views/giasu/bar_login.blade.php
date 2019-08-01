<div class="box">
    @if(Auth::check())
        <h3 class="bh_b text-uppercase">{{Auth::user()->holot . ' ' . Auth::user()->ten}}</h3>
        <a href="{{route('giasu')}}">
            @if(!empty(Auth::user()->anhthe))
                <img src="{{asset('storage/anhthe/'.Auth::user()->anhthe)}}" alt="{{Auth::user()->holot . ' ' . Auth::user()->ten}}" style="width:98%; height:200px; margin-left:1px;"/>
            @else
                <img src="{{asset('storage/anhthe/no_image.jpg')}}" alt="{{Auth::user()->holot . ' ' . Auth::user()->ten}}" style="width:98%; height:200px; margin-left:1px;"/>
            @endif
        </a>
        <p class="more_g2" style="margin-top:10px;">
            <a href="{{route('logout')}}" style="background: #008DCA!important; color:white; text-decoration: none;"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                @csrf
            </form>
        </p>
    @else
        <h3 class="bh_b">GIA SƯ ĐĂNG NHẬP</h3>
        <ul class="l_list1">
            <li class="login clearfix">
                <form id="login-form" action="{{route('login')}}" method="post">
                    @csrf
                    <div class="clearfix">
                        <input type="text" id="cmnd" class="@error('cmnd') is-invalid @enderror"
                               name="cmnd" value="{{ old('cmnd') }}" required
                               autocomplete="cmnd" placeholder="CMND/CCCD" maxlength="12">
                        @error('cmnd')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div class="clearfix">
                    <div class="clearfix">
                        <input id="password" type="password" class="@error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password"
                               placeholder="Mật khẩu" style="margin-top:5px;">
                        @error('password')
                        <span class="error"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="clearfix">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="width:20px; height:20px; float:left; margin-top:5px;"><p style="padding-top:5px; font-size:10pt; font-style:italic;">Ghi nhớ tôi</p>
                    </div>
                    <div class="clearfix">
                        @if (route::has('password.request'))
                            <a href="{{route('password.request') }}" style="font-style:italic; font-size:10pt; float:right;">Quên mật khẩu?</a>
                        @endif
                    </div>
                    <div class="clearfix">
                        <input type="submit" value="ĐĂNG NHẬP" style="width: 100px !important; background:#008DCA!important; color: white; margin: 15px 20px;" />
                    </div>
                </form>
            </li>
        </ul>
    @endif
</div>
