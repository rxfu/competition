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
            <!--
            <h1 class="text-center text-primary" style="font-size: 4em">
                <strong>您的抽签号是</strong>
            </h1>
            <h1 class="text-center text-danger" style="font-size: 12em">
                <strong>{{ session()->get('seq') }}</strong>
            </h1>
            <div class="row justify-content-sm-center">
                <div class="turntable">
                    <img src="{{ asset('img/lottery/circle.png') }}" alt="抽签盘" class="img-thumbnail rounded-circle shadow">
                    <div class="center">
                        <span id="number" class="number">00</span>
                    </div>
                </div>
            </div>
            <br>
            <div class="row justify-content-sm-center">
                <button type="submit" class="btn btn-primary">
                    开始抽签
                </button>
            </div>
        -->
        <div class="bg">
            <span id="message">点击抽奖</span>
            <div class="lotterybg">
                <canvas id="myCanvas" width="285px" height="170px"></canvas>
                <img src="img/lighting.png" class="lighting"/>
            </div>
        </div>
        <img src="img/start-btn.png" id="start" onclick="play()"/>
        <div class="award"><span id="awardBall"></span></div>
        <img src="img/1.png" id="ball1" class="imgSrc">
        <img src="img/2.png" id="ball2" class="imgSrc">
        <img src="img/3.png" id="ball3" class="imgSrc">
        <img src="img/4.png" id="ball4" class="imgSrc">
        </div>
    </form>
</div>
@stop

@push('scripts')
<script type="text/javascript">
    function fontSize(){
        // var deviceWidth = document.documentElement.clientWidth > 760 ? 76 : document.documentElement.clientWidth;
        var deviceWidth = document.documentElement.clientWidth / 10 * 3;
        document.getElementById('number').style.fontSize = (deviceWidth / 76) + "rem";
    }
    fontSize();
    window.onresize = fontSize;

    var running = false;
    var t;

    function turnNumbers() {
        var numbers = Array.from(new Array(40).keys()).slice(1);
        var n = Math.floor(Math.random() * 40);
        $('#number').text(numbers[n]);
        t = setTimeout(turnNumbers, 0);
    }

    function stop() {
        clearInterval(t);
        t = 0;
    }
    
    $('form').submit(function(e) {
        e.preventDefault();

        if (running == true) {
            running = false;
            stop();
            $('#number').text('25');
            $('.btn').removeClass('btn-danger').addClass('btn-primary').text('开始抽签');
            $(".turntable .img-thumbnail").css("animation-play-state", "paused");
        } else {
            running = true;
            turnNumbers();
            $('.btn').removeClass('btn-primary').addClass('btn-danger').text('停止抽签');
            $(".turntable .img-thumbnail").css("animation", "5s linear 0s normal none infinite rotate");
            $(".turntable .img-thumbnail").css("animation-play-state", "running");
        } 
    })
</script>
@endpush
