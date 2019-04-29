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
                    <th scope="col">得分</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items->sortBy('document.seq') as $item)
                    <tr>
                        <td>{{ $item->document->seq }}</td>
                        <td>
                            {{ optional($item->review)->live_score }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
