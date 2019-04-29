@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">第{{ $item->document->seq }}号选手</h3>
    </div>

    <form role="form" id="mark-form" name="mark-form" method="post" action="{{ route('review.teaching', $item->id) }}">
        @csrf
        <div class="card-body">
            <h6>选手抽签号</h6>
            <h1 class="text-center text-danger" style="font-size: 12em">
                <strong>{{ $item->document->seq }}</strong>
            </h1>
            <input type="text" name="score" id="score" placeholder="课堂教学得分" class="form-control form-control-lg text-center" style="font-weight: bold" required autofocus>
        </div>

        <div class="card-footer">
            <div class="row justify-content-sm-center">
                <button type="submit" class="btn btn-success" onclick="return window.confirm('课堂教学评分提交后将不可以再修改，请仔细检查评分，无误请点击“确定”，否则请点击“取消”！');">
                    <i class="icon fa fa-marker"></i> 提交评分
                </button>
            </div>
        </div>
    </form>
</div>
@stop
