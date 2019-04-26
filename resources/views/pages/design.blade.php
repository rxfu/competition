@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">选手列表</h3>
    </div>

    <form role="form" id="mark-form" name="mark-form" method="post" action="{{ route('review.design') }}">
        @csrf
        <div class="card-body">
            <table id="itemsTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">选手编号</th>
                        <th scope="col">教学大纲</th>
                        <th scope="col">教学设计</th>
                        <th scope="col">得分</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                @if (!is_null($item->document))
                                    <a href="{{ asset('vendor/pdfjs/web/viewer.html?file=' . asset($item->document->syllabus)) }}">教学大纲</a>
                                @endif
                            </td>
                            <td>
                                @if (!is_null($item->document))
                                    <a href="{{ asset('vendor/pdfjs/web/viewer.html?file=' . asset($item->document->design)) }}">教学设计</a>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="scores[{{ $item->id }}]" id="scores[{{ $item->id }}]" value="{{ old('scores[' . $item->id . ']', optional($item->review)->design_score) }}" placeholder="教学设计得分" class="form-control" required>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <div class="row justify-content-sm-center">
                <button type="submit" class="btn btn-success">
                    <i class="icon fa fa-marker"></i> 提交评分
                </button>
            </div>
        </div>
    </form>
</div>
@stop
