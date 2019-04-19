@extends('layouts.app')

@section('content')
@php
    $colors = ['primary', 'success', 'info', 'warning'];
@endphp
<div class="row">
    @foreach ($ranks as $rank)
        <div class="col-sm-3">
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
                                <th scope="col">得分</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rank['items'] as $item)
                                <tr>
                                    <td>{{ $item->seq }}</td>
                                    <td>
                                        <a href="{{ route('summary.detail', $item->id) }}" title="{{ $item->name }}">{{ $item->name }}</a>
                                    </td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@stop
