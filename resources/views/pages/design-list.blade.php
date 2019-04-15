@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">选手列表</h3>
    </div>

    <div class="card-body">
        <table id="itemsTable" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th scope="col">选手编号</th>
                    <th scope="col">教学大纲</th>
                    <th scope="col">教学设计</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="{{ asset('vendor/pdfjs/web/viewer.html?file=' . asset($item->document->syllabus)) }}">教学大纲</a>
                        </td>
                        <td>
                            <a href="{{ asset('vendor/pdfjs/web/viewer.html?file=' . asset($item->document->design)) }}">教学设计</a>
                        </td>
                        <td>
                            <a href="{{ route('marker.design', $item->getKey()) }}" class="btn btn-success btn-flat btn-sm" title="评分">
                                <i class="icon fa fa-marker"></i> 评分
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
