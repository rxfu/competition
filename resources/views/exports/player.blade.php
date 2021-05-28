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

        <title>选手推荐表 | {{ config('setting.name', 'Laravel') }}</title>

        <style>
            body {
                font-family: SimSun;
                font-size: 14pt;
                color: #000 !important;
            }
            h1 {
                font-size: 24pt;
                font-weight: bold;
                padding-top: 24pt;
            }
            p {
                text-indent: 2em;
            }
            table {
                table-layout: fixed;
            }
            table th, table td {
                border: 1px solid #000 !important;
                word-wrap: break-word;
                word-break: break-all;
                text-align: center;
                padding: 10px;
            }
            table, tr, td, th, tbody, thead, tfoot {
                page-break-inside: avoid !important;
            }
            @page {
                margin: 50px 0;
            }
            .text-center {
                text-align: center;
            }
            .text-left {
                text-align: left;
            }
            .text-right {
                text-align: right;
            }
            .inscribe {
                margin-top: 80px !important;
            }
            .inscribe p {
                position: relative;
                left: 200px;
            }
        </style>
    </head>
    <body>
        <main>
            <header class="text-center">
                <h1>{{ App\Entities\Setting::find(1)->name }}<br>决赛参赛选手推荐表</h1>
            </header>
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <th width="14%">姓名</th>
                    <td width="12.5%">{{ $player->name }}</td>
                    <th width="11%">性别</th>
                    <td width="12.5%">{{ $player->gender->name }}</td>
                    <th width="12.5%">职称</th>
                    <td width="12.5%">{{ $player->title }}</td>
                    <td width="25%" colspan="2" rowspan="4">
                        <img src="{{ asset($player->portrait) }}" title="照片" width="120" height="160">
                    </td>
                </tr>
                <tr>
                    <th>最高学历</th>
                    <td colspan="2">{{ $player->education->name }}</td>
                    <th>最高学位</th>
                    <td colspan="2">{{ $player->degree->name }}</td>
                </tr>
                <tr>
                    <th>出生年月</th>
                    <td colspan="2">{{ Carbon\Carbon::parse($player->birthday)->format('Y-m') }}</td>
                    <th>年龄</th>
                    <td colspan="2">{{ Carbon\Carbon::parse($player->birthday)->diff(now())->format('%y') }}</td>
                </tr>
                <tr>
                    <th>联系电话</th>
                    <td colspan="2">{{ $player->phone }}</td>
                    <th>邮箱</th>
                    <td colspan="2">{{ $player->email }}</td>
                </tr>
                <tr>
                    <th>从教学校</th>
                    <td colspan="2">{{ optional($player->department)->name }}</td>
                    <th>开始本科教学时间</th>
                    <td colspan="2">{{ $player->teaching_begin_time }}</td>
                    <th>本科教学总时间</th>
                    <td>{{ $player->teaching_total_time }}</td>
                </tr>
                <tr>
                    <th>参赛学科</th>
                    <td colspan="3">{{ $player->subject->name }}</td>
                    <th>组别</th>
                    <td colspan="3">{{ $player->group->name }}</td>
                </tr>
                <tr>
                    <th>参赛课程</th>
                    <td colspan="7">{{ $player->course }}</td>
                </tr>
                <tr>
                    <th>学习工作经历（大学开始）</th>
                    <td colspan="7" class="text-left">{!! nl2br($player->experience) !!}</td>
                </tr>
                <tr>
                    <th>近两年主讲课程情况</th>
                    <td colspan="7" class="text-left">{!! nl2br($player->teaching) !!}</td>
                </tr>
                <tr>
                    <th>发表教学论文、著作</th>
                    <td colspan="7" class="text-left">{!! nl2br($player->thesis) !!}</td>
                </tr>
                <tr>
                    <th>主持、参与教学改革项目</th>
                    <td colspan="7" class="text-left">{!! nl2br($player->project) !!}</td>
                </tr>
                <tr>
                    <th>教学奖励</th>
                    <td colspan="7" class="text-left">{!! nl2br($player->reward) !!}</td>
                </tr>
                <tr>
                    <th>所在高校意见</th>
                    <td colspan="7" class="text-left">
                        <p>（对该教师近4年是否出现过教学事故、在学校的评教活动中获得的评价、是否同意推荐该教师参赛等情况进行说明）</p>
                        <p>{!! nl2br($player->opinion) !!}</p>
                        <div class="text-center inscribe">
                            <p>盖&nbsp;章&nbsp;</p>
                            <p>{{ now()->format('Y年n月j日') }}&nbsp;</p>
                        </div>
                    </td>
                </tr>
            </table>
        </main>
    </body>
</html>