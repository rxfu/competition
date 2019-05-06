@extends('layouts.app')

@section('content')
@php
    $colors = ['primary', 'success', 'info', 'warning'];
@endphp
<div class="row">
    @foreach ($ranks as $group => $rank)
        <div class="col-sm-6">
            <div class="card card-{{ $colors[$loop->index] }}">
                <div class="card-header">
                    <h3 class="card-title">{{ $rank['title'] }}</h3>
                </div>

                <div class="card-body">
                    <table id="itemsTable" class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th scope="col">抽签号</th>
                                <th scope="col">姓名</th>
                                <th scope="col">学校</th>
                                <th scope="col">得分</th>
                                <th scope="col">名次</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $preitem = null
                            @endphp
                            @foreach ($rank['items']->sortByDesc('total') as $item)
                                <tr>
                                    <td>{{ optional($item->document)->seq }}</td>
                                    <td>
                                        <a href="{{ route('summary.detail', $item->id) }}" title="{{ $item->name }}">{{ $item->name }}</a>
                                    </td>
                                    <td>{{ $item->department->name }}</td>
                                    <td>{{ number_format($item->total, 2) }}</td>
                                    <td>
                                        @if ($item->total == optional($preitem)->total)
                                            {{ $loop->iteration - 1 }}
                                        @else
                                            {{ $loop->iteration }}
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $preitem = $item
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{ route('summary.export', $group) }}">导出{{ $rank['title'] }}计分表</a>
                    </div>                    
                </div>
            </div>
        </div>
    @endforeach
</div>
@stop
