@extends('layouts.home')
@section('title', 'Thông tin liên hệ - ')
@section('canonical', Route('lienhe'))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="dsgsdk" style="margin-bottom: 10px;">
                    <h1>THÔNG TIN LIÊN HỆ</h1>
                </div>
                {!! $gioithieu->noidung !!}
            </div>
@endsection