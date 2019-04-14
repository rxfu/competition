@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">决赛参会人员汇总表</h3>
    </div>

    <div class="card-body">
        <table id="itemsTable" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">姓名</th>
                    <th scope="col">性别</th>
                    <th scope="col">出生日期</th>
                    <th scope="col">参赛课程</th>
                    <th scope="col">联系方式</th>
                    <th scope="col">身份证号码</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->group->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->gender->name }}</td>
                        <td>{{ $item->birthday }}</td>
                        <td>{{ $item->course }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->idnumber }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
