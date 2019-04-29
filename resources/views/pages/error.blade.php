@extends('layouts.app')

@section('content')
<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">错误</h3>
    </div>
    <div class="card-body">
        {{ $message }}
    </div>
</div>

@stop
