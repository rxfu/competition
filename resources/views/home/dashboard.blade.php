@extends('layouts.app')

@section('content')
    <h2>选手上传材料时间：{{ $setting->begin_at }} 至 {{ $setting->end_at }}</h2>
@endsection
