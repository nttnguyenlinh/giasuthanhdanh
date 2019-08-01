@extends('layouts.home')
@section('title', "$tintuc->tieude - ")
@section('canonical', route('chitiettintuc', $tintuc->slug))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="dsgsdk" style="margin-bottom: 10px;">
                    <h1>{{$tintuc->tieude}}</h1>
                </div>
                <div class="f_inner">
                    {!! $tintuc->noidung !!}
                </div>
            </div>
@endsection

@section('footer')
@endsection