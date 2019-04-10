@extends('layouts.app')

@section('content')
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
@endpush

@push('scripts')
<!-- Datatable -->
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/responsive/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(function() {
	$('.datatable').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
            'url': "{{ asset('vendor/datatables/lang/Chinese.json') }}"
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
        "order": []
    });

    $('#allItems').change(function () {
        $(':checkbox[name="items[]"]').prop('checked', $(this).is(':checked') ? true : false);
    });
})
</script>
@endpush
