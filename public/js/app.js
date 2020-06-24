//大奖开始停止
function start() {
    if ($("#btntxt").hasClass("btn_none")) {
        alert("误操作，请先确认名单！");
        return false;
    } /************判断开始按钮是否可用************/
    var zjnum = $('.list').find('p');
    if (zjnum.length == pdnum) {
        alert('无法抽奖');
    } else {
        if (runing) {
            runing = false;
            $('#btntxt').removeClass('start').addClass('stop');
            $('#btntxt').html('停止');
            startNum();
            $(".turntable .img").css("animation", "5s linear 0s normal none infinite rotate");
            $(".turntable .img").css("animation-play-state", "running");
        } else {
            runing = true;
            $('#btntxt').removeClass('stop').addClass('start');
            $('#btntxt').html('抽奖');
            stop();
            bzd(); //中奖函数
            $('#btnqx').css('display', 'block');
            $('.lucknum').css('display', 'none');
            $(".turntable .img").css("animation-play-state", "paused");
        }
    }
}

//循环参加名单
function startNum() {
    num = Math.floor(Math.random() * pcount);
    var i_num = 0,
        hasNum = false;
    for (var a = 0; a < pcount; a++) {
        if (xinm[a] != "") {
            hasNum = true;
            break;
        }
    }
    if (!hasNum) {
        alert("奖池号码已使用完毕！");
        return false;
    }
    while (xinm[num] == "") {
        num = Math.floor(Math.random() * pcount);
    }
    nametxt.html(xinm[num]);
    phonetxt.html(phone[num]);
    t = setTimeout(startNum, 0);
}

//停止跳动
function stop() {
    clearInterval(t);
    t = 0;
}
