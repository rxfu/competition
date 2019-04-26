@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">选手细分</h3>
            </div>

            <div class="card-body">
                <table id="itemsTable" class="table table-bordered table-striped datatable">
                    <thead>
                        <tr>
                            <th scope="col">编号</th>
                            <th scope="col">评委姓名</th>
                            <th scope="col">选手姓名</th>
                            <th scope="col">教学设计分数</th>
                            <th scope="col">课堂教学分数</th>
                            <th scope="col">总分</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->marker->name }}</td>
                                <td>{{ $item->player->name }}</td>
                                <td>{{ $item->design_score }}</td>
                                <td>{{ $item->live_score }}</td>
                                <td>{{ number_format($item->present()->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
