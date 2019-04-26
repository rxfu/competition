@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">选手列表</h3>
    </div>

    <form role="form" id="mark-form" name="mark-form" method="post" action="{{ route('review.teaching') }}">
        @csrf
        <div class="card-body">
            <table id="itemsTable" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th scope="col">选手抽签号</th>
                        <th scope="col">得分</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items->sortBy('document.seq') as $item)
                        <tr>
                            <td>{{ optional($item->document)->seq }}</td>
                            <td>
                                <input type="text" name="scores[{{ $item->id }}]" id="scores[{{ $item->id }}]" value="{{ old('scores[' . $item->id . ']', optional($item->review)->live_score) }}" placeholder="课堂教学得分" class="form-control" required>
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
