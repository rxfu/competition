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

        <title>专家推荐表 | {{ config('setting.name', 'Laravel') }}</title>

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
                <h1>{{ App\Entities\Setting::find(1)->name }}<br>评审委员会专家推荐表</h1>
            </header>
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <th width="14%">姓名</th>
                    <td width="12.5%">{{ $marker->name }}</td>
                    <th width="11%">性别</th>
                    <td width="12.5%">{{ $marker->gender->name }}</td>
                    <th width="12.5%">出生日期</th>
                    <td width="12.5%">{{ $marker->birthday }}</td>
                    <td width="25%" colspan="2" rowspan="4">
                        <img src="{{ asset($marker->portrait) }}" title="照片" width="120" height="160">
                    </td>
                </tr>
                <tr>
                    <th>最后学历</th>
                    <td colspan="2">{{ $marker->education->name }}</td>
                    <th>最高学位</th>
                    <td colspan="2">{{ $marker->degree->name }}</td>
                </tr>
                <tr>
                    <th>职称</th>
                    <td colspan="2">{{ $marker->title }}</td>
                    <th>职务</th>
                    <td colspan="2">{{ $marker->position }}</td>
                </tr>
                <tr>
                    <th>工作单位</th>
                    <td colspan="2">{{ optional($marker->department)->name }}</td>
                    <th>学科</th>
                    <td colspan="2">{{ $marker->subject->name }}</td>
                </tr>
                <tr>
                    <th>专业</th>
                    <td colspan="3">{{ $marker->major }}</td>
                    <th>研究方向</th>
                    <td colspan="3">{{ $marker->direction }}</td>
                </tr>
                <tr>
                    <th>所报组别</th>
                    <td colspan="3">{{ $marker->group->name }}</td>
                    <th>联系电话</th>
                    <td colspan="3">{{ $marker->phone }}</td>
                </tr>
                <tr>
                    <th>是否教学名师</th>
                    <td colspan="3">{{ $marker->is_famous ? '是' : '否' }}</td>
                    <th>邮箱</th>
                    <td colspan="3">{{ $marker->email }}</td>
                </tr>
                <tr>
                    <th>与教学竞赛评审相关的经历</th>
                    <td colspan="7" class="text-left">{!! nl2br($marker->experience) !!}</td>
                </tr>
                <tr>
                    <th>发表教学著作、论文</th>
                    <td colspan="7" class="text-left">{!! nl2br($marker->thesis) !!}</td>
                </tr>
                <tr>
                    <th>主持教学改革项目</th>
                    <td colspan="7" class="text-left">{!! nl2br($marker->project) !!}</td>
                </tr>
                <tr>
                    <th>主要科研成果</th>
                    <td colspan="7" class="text-left">{!! nl2br($marker->achievement) !!}</td>
                </tr>
                <tr>
                    <th>所获荣誉和奖励</th>
                    <td colspan="7" class="text-left">{!! nl2br($marker->reward) !!}</td>
                </tr>
                <tr>
                    <th>所在高校意见</th>
                    <td colspan="7" class="text-left">
                        <p>{!! nl2br($marker->opinion) !!}</p>
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