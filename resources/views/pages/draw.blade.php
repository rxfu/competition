@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <form role="form" id="mark-form" name="mark-form" method="post" action="">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group row">
                <label for="idnumber" class="col-sm-3 col-form-label">手机号</label>
                <div class="col-md-9">
                    <input type="text" name="idnumber" id="idnumber" class="form-control" placeholder="请输入手机号" onkeydown="if (event.keyCode == 13) return false" autofocus>
                </div>
            </div>
            <div class="items"></div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-sm-center">
                <button type="button" class="btn btn-primary btn-lg" id="draw">
                    开始抽签
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-labelledby="dialogTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h1 class="text-danger" style="font-size: 20rem">
              <strong id="number"></strong>
          </h1>
        </div>
      </div>
    </div>
  </div>
@stop

@push('styles')
<style>
div.items {
    float:left;
    padding:15px;
    padding-left:35px;
    width:100%;
    font-family:'\5FAE\8F6F\96C5\9ED1';
}
div.item {
    /* margin-bottom:8px;
    margin-left:8px; */
    display: inline-block;
    /* float:left; */
    vertical-align:middle;
    font-size:30px;
    text-align:center;
    /* background:rgba(0,170,210,.8);
    border:solid 1px rgba(0,170,210,.1);
    color:#fff; */
}
@media (min-width:900px) {
    div.item {
        width:40px;
        line-height:40px;
        height:40px;
    }
}
@media (min-width:1200px) {
    div.item {
        width:60px;
        line-height:60px;
        height:60px;
    }
}
@media (min-width:1440px) {
    div.item {
        width:60px;
        line-height:60px;
        height:60px;
    }
}
@media (min-width:1500px) {
    div.item {
        width:80px;
        line-height:80px;
        height:80px;
        font-size: 40px;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.pulsate.min.js') }}"></script>
<script type="text/javascript">
    //参与抽奖人数初始值
    var itemCount = {{ $players->count() }};
    //默认跑马灯频率
    var frequency = 50;
    //是否正在运行跑马灯
    var isRun = false;
    //跑马灯循环
    var tx;
    // 已抽过签号
    var drawedItems = [{{ implode(',', $seqs) }}];
    // 当前值
    var current = 0;

    $(function() {
        for (var i = 1; i <= itemCount; i++) {
            var color;
            if ($.inArray(i, drawedItems) >= 0) {
                color = 'bg-danger';
            } else {
                color = 'bg-primary';
            }

            $('div.items').append('<div class="' + color + ' m-3 img-circle shadow item i' + i + '"><strong>' + i + '</strong></div>')
        }

        $('#draw').click(function() {
            if ($('#idnumber').val() == '') {
                alert('手机号为空，请重新输入手机号!');
                return false;
            } else{
                if (isRun) {
                    $('#idnumber').removeAttr('readonly');
                    isRun = false;
                    $(this).removeClass('btn-danger').addClass('btn-primary').text('开始抽签');
                    $(".item.bg-warning").removeClass("bg-warning").addClass('bg-primary');
                    $('div.item').eq(current - 1).removeClass('bg-primary').addClass("bg-danger");
                    $('.item.bg-danger').pulsate({
                        color: '#dc3545',
                        repeat: 5
                    });
                    $('#dialog').on('show.bs.modal', function(e) {
                        var modal = $(this);
                        modal.find('.modal-body #number').text(current);
                    }).modal('show');
                } else {
                    $('#idnumber').attr('readonly', 'readonly');
                    $.ajax({
                        async: false,
                        type: 'post',
                        url: "{{ route('document.seq') }}",
                        dataType: 'json',
                        data: {
                            _method: 'put',
                            _token: '{{ csrf_token() }}',
                            idnumber: $('#idnumber').val()
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.is_drawed == true) {
                                alert('您已经抽过签了，您的抽签号是' + data.seq);
                                $('#idnumber').removeAttr('readonly');
                            } else {
                                isRun = true;
                                start();
                                $('#draw').removeClass('btn-primary').addClass('btn-danger').text('停止抽签');
                                current = data.seq;
                            }
                        },
                        error: function(e) {
                            console.log(e.status);
                            console.log(e.responseText);
                            alert(e.responseText);
                            $('#idnumber').removeAttr('readonly');
                        }
                    });
                }
            }
        });

        return false;
    });

    function start() {
        //产生随机数临时变量
        var rand = 0;
        //存储上一次随机数的临时变量
        var prenum;
        tx = setInterval(function() {
            if(isRun) {
                while(true) {
                    rand = Math.floor(Math.random() * ( $("div.item:not(.bg-danger)").length));
                    if(rand == 0 || rand != prenum) {
                        break;
                    }
                }
                prenum = rand;
                $(".item.bg-warning").removeClass("bg-warning").addClass('bg-primary');
                $("div.item:not(.bg-danger):not(.bg-warning)").eq(rand).removeClass('bg-primary').addClass("bg-warning");
            }
        }, frequency);
    }
</script>
@endpush
