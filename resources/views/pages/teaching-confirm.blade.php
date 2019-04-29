@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">评委信息确认</h3>
    </div>
    <div class="card-body">
        <h1 class="text-center">
            请评委{{ Auth::user()->name }}老师确认是自己评分!
        </h1>
    </div>

    <div class="card-footer">
        <div class="row justify-content-sm-center">
            <a href="{{ route('marker.teaching', $item->user_id) }}" class="btn btn-success">
                <i class="icon fa fa-check"></i> 确认信息
            </a>
        </div>
    </div>
</div>

@stop
