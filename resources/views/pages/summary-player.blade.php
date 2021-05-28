@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">决赛参会人员汇总表</h3>
    </div>

    <div class="card-body">
        <table id="itemsTable" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th scope="col">序号</th>
                    <th scope="col">姓名</th>
                    <th scope="col">性别</th>
                    <th scope="col">出生日期</th>
                    <th scope="col">参赛课程</th>
                    <th scope="col">联系方式</th>
                    <!--th scope="col">身份证号码</th-->
                    <th scope="col">职称</th>
                    <th scope="col">所在院校</th>
                    <th scope="col">开始本科教学时间</th>
                    <th scope="col">本科教学总时间</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items->sortBy('group_id') as $item)
                    <tr>
                        <td>{{ $item->group->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->gender->name }}</td>
                        <td>{{ $item->birthday }}</td>
                        <td>{{ $item->course }}</td>
                        <td>{{ $item->phone }}</td>
                        <!--td>{{ $item->idnumber }}</td-->
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->department->name }}</td>
                        <td>{{ $item->teaching_begin_time }}</td>
                        <td>{{ $item->teaching_total_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@push('styles')
<!-- Datatables -->
<link href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<!-- Datatable -->
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('vendor/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('vendor/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendor/pdfmake/vfs_fonts.js') }}"></script>
<script>
$(function() {
    $('.datatable').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
            'url': "{{ asset('vendor/datatables/lang/Chinese.json') }}",
            'buttons': {
                'excel': '导出Excel',
                'pdf': '导出PDF',
                'print': '打印',
                'colvis': '隐藏列'
            }
        },
        'responsive': {
            'details': {
                'type': "column",
                'target': 0
            }
        },
        'columnDefs': [{
            'orderable': false,
            'targets': 1
        }, {
            'className': 'control',
            'orderable': false,
            'targets': 0
        }, {
            'targets': 6,
            'render': function(data) {
                return '\u200C' + data;
            }
        }],
        'order': [],
        'dom': 'Bfrtip',
        'buttons': ['excel', 'pdf', 'print', 'colvis'],
    });
})
</script>
@endpush