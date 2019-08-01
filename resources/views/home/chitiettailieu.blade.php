@extends('layouts.home')
@section('title', "$tailieu->tieude - ")
@section('canonical', route('chitiettailieu', $tailieu->slug))

@section('content')
    <div class="pageBody clearfix">
        <div class="pageBodyInner clearfix">
            <div class="col_c">
                <div class="dsgsdk" style="margin-bottom: 10px;">
                    <h1>{{$tailieu->tieude}}</h1>
                </div>
                <div class="f_inner">
                    {!! $tailieu->noidung !!}
                </div>
            </div>
@endsection

@section('footer')
@endsection
