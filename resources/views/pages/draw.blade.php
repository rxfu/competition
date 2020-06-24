@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <form role="form" id="mark-form" name="mark-form" method="post" action="{{ route('document.seq') }}">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group row">
                <label for="idnumber" class="col-sm-3 col-form-label">身份证号</label>
                <div class="col-md-9">
                    <input type="text" name="idnumber" id="idnumber" class="form-control" placeholder="请输入身份证号">
                </div>
            </div>
                <h1 class="text-center text-primary" style="font-size: 4em">
                    <strong>您的抽签号是</strong>
                </h1>
                <h1 class="text-center text-danger" style="font-size: 12em">
                    <strong>{{ session()->get('seq') }}</strong>
                </h1>
                <div class="row justify-content-sm-center">
                    <div class="turnable">
                        <img src="{{ asset('img/lottery/circle.png') }}" alt="抽签盘" class="img-thumbnail rounded-circle shadow">
                        <div class="center">
                            <span class="number">立即<br>抽签</span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row justify-content-sm-center">
                    <button type="submit" class="btn btn-primary">
                        开始抽签
                    </button>
                </div>
        </div>
    </form>
</div>
@stop
