@extends('layouts.app')

@section('content')
    欢迎使用Laravel Admin管理系统
    <h2>系统开放上传时间：{{ $setting->begin_at }} 至 {{ $setting->end_at }}</h2>
@endsection
