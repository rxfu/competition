@extends('layouts.app')

@section('content')
@php
    $action = request()->segment(2);
    $model = is_null($action) ? request()->segment(1) : request()->segment(1) . '.' . $action;
    $components = config('components.' . $model);
@endphp
<div class="row">
	<div class="col-sm-12">
		@if (config('components.' . $model . '.list'))
	        @include('partials.list', ['components' => config('components.' . $model)])
	    @else
	        @include('partials.common', ['components' => config('components.' . $model)])	    	
	    @endif
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
        }],
        'order': [],
        'dom': 'Bfrtip',
        'buttons': ['excel', 'pdf', 'print', 'colvis'],
    });

    $('#allItems').change(function () {
        $(':checkbox[name="items[]"]').prop('checked', $(this).is(':checked') ? true : false);
    });
})
</script>
@endpush
