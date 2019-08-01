@extends('layouts.admin')
@section('title', 'Media Library - ')

@section('nav-content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="{{route('admin')}}">Dashboard</a></li>
            <li style="font-weight:bold;"><a href="{{Route('admin.media')}}">Media Library</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="media"></div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        CKFinder.widget('media', {
            resourceType: 'Storage',
            width: '100%',
            height: '650',
            plugins: ['plugins/StatusBarInfo/StatusBarInfo']
        });
    </script>
@endsection
