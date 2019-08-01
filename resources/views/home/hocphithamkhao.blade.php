@extends('layouts.home')
@section('title', 'Học phí tham khảo - ')
@section('canonical', Route('hocphi'))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="dsgsdk" style="margin-bottom: 10px;">
                    <h1>HỌC PHÍ THAM KHẢO</h1>
                </div>
                {!! $hocphi->noidung !!}
            </div>
@endsection