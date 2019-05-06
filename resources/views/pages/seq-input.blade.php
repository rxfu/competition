@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">选手列表</h3>
    </div>

    <form role="form" id="mark-form" name="mark-form" method="post" action="{{ route('document.seq') }}">
        @csrf
        @method('put')
        <div class="card-body">
            <table id="itemsTable" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th scope="col">组别</th>
                        <th scope="col">姓名</th>
                        <th scope="col">抽签号</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->group->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <input type="text" name="seq[{{ $item->id }}]" value="{{ optional($item->document)->seq }}" placeholder="{{ $item->name }}抽签号" class="form-control">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <div class="row justify-content-sm-center">
                <button type="submit" class="btn btn-primary">
                    <i class="icon fa fa-save"></i> 保存
                </button>
            </div>
        </div>
    </form>
</div>

@stop
