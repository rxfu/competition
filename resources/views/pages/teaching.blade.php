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
            <div class="form-inline row">
                <div class="form-group col-sm-6">
                    <label for="live_score" class="col-form-label mr-4">课堂教学得分</label>
                    <input type="text" name="live_score" id="live_score" placeholder="课堂教学得分" class="form-control form-control-lg text-center" style="font-weight: bold" required autofocus>
                </div>
                <div class="form-group col-sm-6">
                    <label for="reflection_score" class="col-form-label mr-4">课堂反思得分</label>
                    <input type="text" name="reflection_score" id="reflection_score" placeholder="课堂反思得分" class="form-control form-control-lg text-center" style="font-weight: bold" required autofocus>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row justify-content-sm-center">
                <button type="submit" class="btn btn-success" onclick="return window.confirm('请注意：评分提交后将不可以再修改，请仔细检查评分，无误请点击“确定”，否则请点击“取消”！');">
                    <i class="icon fa fa-marker"></i> 提交评分
                </button>
            </div>
        </div>
    </form>
</div>
@stop
