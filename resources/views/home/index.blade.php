@extends('layouts.home')
@section('title', '')
@section('canonical', Route('home'))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="gioithieu clearfix">
                    <div class="gt_l">
                        <img src="{{asset('/images/img_3.jpg')}}" style="width:95%; border: 2px solid #80BAB5; margin-top:60px;" alt="{{config('app.name')}}"/>
                    </div>
                    <div class="gt_r">
                        <img src="{{asset('/images/img_2_footer.png')}}" alt="{{config('app.name')}}" width="100%"/>
                        <p style="text-indent: 30px;">Hãy đến với <a href="{{route('home')}}" class="uppercase">{{config('app.name')}}</a> để có được sự lựa chọn đúng đắn.
                            Với sứ mệnh mang lại niềm hạnh phúc cho quý phụ huynh trước sự tiến bộ của con em trong học
                            tập.
                        </p>
                    </div>
                </div>
                <br>
                <details open>
                    <summary>
                        <span class="summary-title uppercase">Giới thiệu</span>
                        <div class="summary-chevron-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </summary>
                    <div class="summary-content">
                        {!! $gioithieu->noidung !!}
                    </div>
                    <div class="summary-chevron-down">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </details>
                <details>
                    <summary>
                        <span class="summary-title uppercase">Quý phụ huynh cần biết</span>
                        <div class="summary-chevron-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </summary>
                    <div class="summary-content">
                        {!! $phuhuynhcb->noidung !!}
                    </div>
                    <div class="summary-chevron-down">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </details>
                <details>
                    <summary>
                        <span class="summary-title uppercase">Gia sư cần biết</span>
                        <div class="summary-chevron-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </summary>
                    <div class="summary-content">
                        {!! $giasucb->noidung !!}

                    </div>
                    <div class="summary-chevron-down">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </details>
                <details>
                    <summary>
                        <span class="summary-title uppercase">Các loại lớp học</span>
                        <div class="summary-chevron-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </summary>
                    <div class="summary-content">
                        {!! $cacloailop->noidung !!}
                    </div>
                    <div class="summary-chevron-down">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </details>
            </div>
@endsection

@section('footer')
    <script type="text/javascript" src="{{asset('js/faq.js')}}"></script>
@endsection