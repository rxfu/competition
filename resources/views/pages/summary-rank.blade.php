@extends('layouts.app')

@section('content')
@php
    $colors = ['primary', 'info', 'warning', 'success', 'danger'];
@endphp
<div class="row">
    @foreach ($ranks as $group => $rank)
        <div class="col-sm-12">
            <div class="card card-{{ $colors[$loop->index] }}">
                <div class="card-header">
                    <h3 class="card-title">{{ $rank['title'] }}</h3>
                </div>

                <table id="itemsTable" class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th scope="col">抽签号</th>
                            <th scope="col">姓名</th>
                            <th scope="col">学校</th>
                            <th scope="col">教学设计分</th>
                            <th scope="col">课堂教学及反思分</th>
                            <th scope="col">最终得分</th>
                            <th scope="col">名次</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $preplace = 1;
                            $preitem = null;
                        @endphp
                        @foreach ($rank['items']->sortByDesc('total') as $item)
                            <tr>
                                <td>{{ optional($item->document)->seq }}</td>
                                <td>
                                    <a href="{{ route('summary.detail', $item->id) }}" title="{{ $item->name }}">{{ $item->name }}</a>
                                </td>
                                <td>{{ $item->department->name }}</td>
                                <td>{{ number_format($item->design, 2) }}</td>
                                <td>{{ number_format($item->live, 2) }}</td>
                                <td>{{ number_format($item->total, 2) }}</td>
                                <td>
                                    @if ($item->total == optional($preitem)->total)
                                        {{ $thisplace = $preplace }}
                                    @else
                                        {{ $thisplace = $loop->iteration }}
                                    @endif
                                </td>
                            </tr>
                            @php
                                $preplace = $thisplace;
                                $preitem = $item;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

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
