@extends('layouts.app')

@section('content')
    <h3>选手上传材料时间：{{ $setting->begin_at }} 至 {{ $setting->end_at }}</h3>
    @can('user.upload-summary')
        <hr>
        <div class="row">
            <div class="col-6">
                <form role="form" id="summary-form" name="summary-form" method="post" action="{{ route('user.upload-summary') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <label for="upfile" class="col-sm-3 col-form-label text-right">上传初赛总结材料</label>
                        <div class="col-sm-7">
                            <input type="file" name="upfile" id="upfile" class="form-control-file{{ $errors->has('upfile') ? ' is_invalid' : '' }}" required>
                            @if ($errors->has('upfile'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('upfile') }}</strong>
                                </div>
                            @endif
                            @if (!empty(Auth::user()->summary))
                                <div class="form-text text-muted">
                                    <a href="{{ asset(Auth::user()->summary) }}" title="初赛总结材料">初赛总结材料</a>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon fa fa-file-import"></i> 上传材料
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endcan
@endsection
