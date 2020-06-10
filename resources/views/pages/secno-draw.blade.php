@extends('layouts.app')

@section('content')
<div class="card card-success">
    <form role="form" id="secno-form" name="secno-form" method="post" action="{{ route('document.secno') }}">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group row">
                <label for="idnumber" class="col-sm-3 col-form-label">身份证号</label>
                <div class="col-md-9">
                    <input type="text" name="idnumber" id="idnumber" class="form-control" placeholder="请输入身份证号">
                </div>
            </div>
            @if (session()->has('secno'))
                @if (session('drawed') == false)
                    <h1 class="text-center text-success" style="font-size: 4em">
                        <strong>您已抽取过节段，您所抽取的节段号是</strong>
                    </h1>
                @endif
                <h1 class="text-center text-primary" style="font-size: 12em">
                    <strong>{{ session()->get('secno') }}</strong>
                </h1>
            @endif
        </div>

        <div class="card-footer">
            <div class="row justify-content-sm-center">
                <button type="submit" class="btn btn-success">
                    <i class="icon fa fa-check"></i> 抽节段
                </button>
            </div>
        </div>
    </form>
</div>
@stop
