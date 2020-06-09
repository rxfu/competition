@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ optional(Auth::user()->group)->name }}选手列表</h3>
    </div>

    <div class="card-body">
        <table id="itemsTable" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th scope="col">姓名</th>
                    <th scope="col">所在学校</th>
                    <th scope="col">节段号</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->department->name }}</td>
                        <td>
                            {{ optional($item->document)->secno }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <div class="row justify-content-sm-center">
            <a href="{{ route('player.draw') }}" class="btn btn-primary btn-lg">开始抽签</a>
        </div>
    </div>
</div>

@stop
