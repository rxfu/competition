@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">评审委员会专家推荐汇总表</h3>
    </div>

    <div class="card-body">
        <table id="itemsTable" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th scope="col">学校</th>
                    <th scope="col">学科</th>
                    <th scope="col">专业</th>
                    <th scope="col">研究方向</th>
                    <th scope="col">组别</th>
                    <th scope="col">姓名</th>
                    <th scope="col">性别</th>
                    <th scope="col">职称/职务</th>
                    <th scope="col">手机号码</th>
                    <th scope="col">邮箱</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items->sortBy('group_id') as $item)
                    <tr>
                        <td>{{ $item->department->name }}</td>
                        <td>{{ $item->subject->name }}</td>
                        <td>{{ $item->major }}</td>
                        <td>{{ $item->direction }}</td>
                        <td>{{ $item->group->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->gender->name }}</td>
                        <td>{{ $item->position }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
