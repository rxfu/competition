<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="{{ config('setting.keywords') }}">
    <meta name="description" content="{{ config('setting.description') }}">
    <meta name="author" content="{{ config('setting.author') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default') | {{ config('setting.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!---Bootstrap 4 -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            font-family: SimSun;
            font-size: 14pt;
            color: #000 !important;
        }
        h1 {
            font-size: 32pt;
            font-weight: bold;
            line-height: 48pt;
        }
        p {
            text-indent: 2em;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #000 !important;
        }
    </style>
</head>
<body>
    <main class="container">
        <header class="text-center">
            <h1>{{ App\Entities\Setting::find(1)->name }}<br>决赛参赛选手推荐表</h1>
        </header>
        <table class="table table-bordered">
            <tr>
                <th>姓名</th>
                <td>{{ $player->name }}</td>
                <th>性别</th>
                <td>{{ $player->gender->name }}</td>
                <th>职称</th>
                <td>{{ $player->title }}</td>
                <td rowspan="6">
                    <img src="{{ asset($player->portrait) }}" title="照片" width="160" height="320">
                </td>
            </tr>
            <tr>
                <th>最高学历</th>
                <td colspan="2">{{ $player->education->name }}</td>
                <th>最高学位</th>
                <td colspan="2">{{ $player->degree->name }}</td>
            </tr>
            <tr>
                <th>从教学校</th>
                <td width="200">{{ optional($player->department)->name }}广西中医药大学赛恩斯新医药学院</td>
                <th>开始本科教学时间</th>
                <td>{{ $player->teaching_begin_time }}</td>
                <th>本科教学总时间</th>
                <td>{{ $player->teaching_total_time }}</td>
            </tr>
            <tr>
                <th>身份证号码</th>
                <td colspan="2">{{ $player->idnumber }}</td>
                <th>年龄</th>
                <td colspan="2">{{ $player->birthday->diff(now())->format('%y') }}</td>
            </tr>
            <tr>
                <th>联系电话</th>
                <td colspan="2">{{ $player->phone }}</td>
                <th>邮箱</th>
                <td colspan="2">{{ $player->email }}</td>
            </tr>
            <tr>
                <th>参赛学科</th>
                <td colspan="2">{{ $player->subject->name }}</td>
                <th>组别</th>
                <td colspan="2">{{ $player->group->name }}</td>
            </tr>
            <tr>
                <th>参赛课程</th>
                <td colspan="6">{{ $player->course }}</td>
            </tr>
            <tr>
                <th>学习工作经历</th>
                <td colspan="6">{!! $player->experience !!}</td>
            </tr>
            <tr>
                <th>近两年主讲课程情况</th>
                <td colspan="6">{!! $player->teaching !!}</td>
            </tr>
            <tr>
                <th>发表教学论文、著作</th>
                <td colspan="6">{!! $player->thesis !!}</td>
            </tr>
            <tr>
                <th>主持、参与教学改革项目</th>
                <td colspan="6">{!! $player->project !!}</td>
            </tr>
            <tr>
                <th>教学奖励</th>
                <td colspan="6">{!! $player->reward !!}</td>
            </tr>
            <tr>
                <th>所在高校意见</th>
                <td colspan="6">
                    <p>（对该教师近4年是否出现过教学事故、在学校的评教活动中获得的评价、是否同意推荐该教师参赛等情况进行说明）</p>
                    <p>{!! $player->opinion !!}</p>
                    <p></p>
                    <p>盖&nbsp;&nbsp;章</p>
                    <p>{{ now()->format('Y年n月j日') }} </p>
                </td>
            </tr>
        </table>
    </main>
        
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>