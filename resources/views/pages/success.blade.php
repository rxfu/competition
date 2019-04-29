@extends('layouts.app')

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">成功</h3>
    </div>
    <div class="card-body">
        {{ $message }}
    </div>
</div>

@stop
