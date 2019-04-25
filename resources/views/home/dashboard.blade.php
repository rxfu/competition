@extends('layouts.app')

@section('content')
    <h2>系统开放上传时间：{{ $setting->begin_at }} 至 {{ $setting->end_at }}</h2>
@endsection
