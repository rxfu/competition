@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">选手列表</h3>
    </div>

    <div class="card-body">
        <table id="itemsTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">选手抽签号</th>
                    <th scope="col">课堂教学得分</th>
                    <th scope="col">课堂反思得分</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items->sortBy('document.seq') as $item)
                    @if ($item->document && $item->document->seq)
                        <tr>
                            <td>{{ optional($item->document)->seq }}</td>
                            <td>{{ optional($item->review)->live_score }}</td>
                            <td>{{ optional($item->review)->reflection_score }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
