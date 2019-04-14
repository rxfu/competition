@extends('layouts.app')

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">选手评分</h3>
    </div>

    <form role="form" id="create-form" name="create-form" method="post" action="{{ route('review.store') }}">
        @csrf
        <input type="hidden" name="player_id" value="{{ $item->id }}">
        <div class="card-body">
            <div class="form-group row">
                <label for="live_score" class="col-sm-3 col-form-label">得分</label>
                <div class="col-md-9">
                    <input type="text" name="live_score" id="live_score" class="form-control" placeholder='得分'>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row justify-content-sm-center">
                <button type="submit" class="btn btn-success">
                    <i class="icon fa fa-marker"></i> 确定评分
                </button>
            </div>
        </div>
    </form>
</div>
@stop
