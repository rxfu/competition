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
        <!--
            <div class="bg">
                <span id="message">点击抽奖</span>
                <div class="lotterybg">
                    <canvas id="myCanvas" width="285px" height="170px"></canvas>
                    <img src="{{ asset('img/lottery/lighting.png') }}" class="lighting"/>
                </div>
            </div>
            <img src="{{ asset('img/lottery/start-btn.png') }}" id="start" onclick="play()"/>
            <div class="award"><span id="awardBall"></span></div>
            <img src="{{ asset('img/lottery/1.png') }}" id="ball1" class="imgSrc">
            <img src="{{ asset('img/lottery/2.png') }}" id="ball2" class="imgSrc">
            <img src="{{ asset('img/lottery/3.png') }}" id="ball3" class="imgSrc">
            <img src="{{ asset('img/lottery/4.png') }}" id="ball4" class="imgSrc">
        -->
        
            <div class="capsule">
                <!--机器-->
                <div class="base">
                    <div class="go"></div>
                </div>
                
                <!--球-->
                <div class="dan_gund">
                    <span  class="qiu_1 diaol_1"></span>
                    <span  class="qiu_2 diaol_2"> </span>
                    <span  class="qiu_3 diaol_3"></span>
                    
                    <span  class="qiu_4 diaol_4"></span>
                    <span  class="qiu_5 diaol_5"></span>
                    <span  class="qiu_6 diaol_6"></span>>
                    
                    <span  class="qiu_7 diaol_7"></span>
                    <span  class="qiu_8 diaol_8"></span>
                    
                    
                    <span  class="qiu_9 diaol_9"></span>
                    <span  class="qiu_10 diaol_10"></span> 
                    <span  class="qiu_11 diaol_11"></span>   
                        
                </div>

                <!--中奖掉落-->
                <div class="medon"><img src="{{ asset('img/capsule/mendong.png') }}"></div>
                <div class="zjdl ">
                    <span></span>
                </div>
            </div>
            <img src="{{ asset('img/capsule/1.png') }}" class="imgSrc" id="ball1">
            <img src="{{ asset('img/capsule/2.png') }}" class="imgSrc" id="ball2">
            <img src="{{ asset('img/capsule/3.png') }}" class="imgSrc" id="ball3">
            <img src="{{ asset('img/capsule/4.png') }}" class="imgSrc" id="ball4">
        </div>
    </form>
</div>
@stop

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/capsule.css') }}">
@endpush

@push('scripts')
<!--script type="text/javascript">
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
</script-->
<script type="text/javascript">
    $(function(e) {
        //一等奖 关闭
        $("#jianpin_one em img").click(function(){
            $("#jianpin_one").hide();
            }
        );		
        //二等奖 关闭
        $("#jianpin_two em img").click(function(){
            $("#jianpin_two").hide();
            }
        );		
        //三等奖 关闭
        $("#jianpin_three em img").click(function(){
            $("#jianpin_three").hide();
            }
        );			
        //没有中奖 关闭
        $("#jianpin_kong em img").click(function(){
            $("#jianpin_kong").hide();
            }
        );			
        //积分不足 关闭
        $("#no_jifeng em img").click(function(){
            $("#no_jifeng").hide();
            }
        );		
            
    var score=470;
    $(".wdjifen").html(score);


    $(".go").click(function(){
        score-=100;
            if(score<0){
                for(i=1;i<=11;i++){
                    $(".qiu_"+i).removeClass("wieyi_"+i);
                }
                $("#no_jifeng").show();
                }else{
                    draw()
                    }
            });
        
        
    function draw(){
        var number =Math.floor(4*Math.random()+1);  

        for(i=1;i<=11;i++){
                $(".qiu_"+i).removeClass("diaol_"+i);
                $(".qiu_"+i).addClass("wieyi_"+i);
            };
                
        setTimeout(function (){
            for(i=1;i<=11;i++){
            $(".qiu_"+i).removeClass("wieyi_"+i);
            }
        },1100);	
        setTimeout(function(){
            switch(number){
                case 1:$(".zjdl").children("span").addClass("diaL_one");break;
                case 2:$(".zjdl").children("span").addClass("diaL_two");break;
                case 3:$(".zjdl").children("span").addClass("diaL_three");break;
                case 4:$(".zjdl").children("span").addClass("diaL_four");break;
            }
            $(".zjdl").removeClass("none").addClass("dila_Y");
                    setTimeout(function (){
                    switch(number){
                        case 1:$("#jianpin_one").show();break;
                        case 2:$("#jianpin_two").show();break;
                        case 3:$("#jianpin_three").show();break;
                        case 4:$("#jianpin_kong").show();break;
                    }
                },900);
            },1100)
        
        //取消动画
        setTimeout(function (){
                $(".zjdl").addClass("none").removeClass("dila_Y");
                $(".wdjifen").html(score);
                $(".zjdl").children("span").removeAttr('class');
                
            },2500)
                
    }	
    });
</script>
@endpush
