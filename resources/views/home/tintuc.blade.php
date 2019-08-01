@extends('layouts.home')
@section('title', 'Tin tức - ')
@section('canonical', Route('tintuc'))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="dsgsdk" style="margin-bottom: 10px;">
                    <h1>TIN TỨC</h1>
                </div>
                <div class="f_inner">
                    @if($tintuc->count() > 0)
                        @foreach($tintuc as $row)
                            <div class="article-wrapper">
                                <article>
                                    <a href="{{route('chitiettintuc', $row->slug)}}">
                                    <div class="img-wrapper">
                                            @if(!empty($row->anhbia))
                                                <img src="{{asset('storage/'.$row->anhbia)}}" style="width:150px; height:150px;" alt="Gia sư Thành Danh">
                                            @else
                                                <img src="{{asset('storage/img_3.jpg')}}" style="width:150px; height:150px;" alt="Gia sư Thành Danh">
                                            @endif
                                    </div>
                                    <h1>{{$row->tieude}}</h1>
                                    <p>{{substr($row->mota,0,190)}}...</p>
                                    </a>
                                </article>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
@endsection

@section('footer')
    <link rel="stylesheet" href="{{asset('css/tintuc.css')}}">
@endsection