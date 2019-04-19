@extends('layouts.app')

@section('content')
<div class="row justify-content-sm-center">
	<div class="col-sm-8">
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title">导入用户</h3>
			</div>

		    <form role="form" id="upload-form" name="upload-form" method="post" action="{{ route('user.import') }}" enctype="multipart/form-data">
		        @csrf
				<div class="card-body">
	                <div class="form-group row">
	                    <label for="year" class="col-sm-3 col-form-label">年度</label>
	                    <div class="col-md-9">
	                    	<input type="text" name="year" id="year" class="form-control-plaintext" value="{{ date('Y') }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="upfile" class="col-sm-3 col-form-label">导入文件</label>
	                    <div class="col-md-9">
	                    	<input type="file" name="upfile" id="upfile" class="form-control-file{{ $errors->has('upfile') ? ' is_invalid' : '' }}" required>
	                    	<small class="form-text text-muted">要求文件类型为excel</small>
	                    	@if (!empty($item->document->upfile))
	                    		<small class="form-text text-muted">
	                    			<a href="{{ asset('js/vendor/pdfjs/web/viewer.html?file=/' . $item->document->upfile) }}" title="教学大纲">教学大纲</a>
	                    		</small>
	                    	@endif
	                    </div>
	                </div>
				</div>

				<div class="card-footer">
					<div class="row justify-content-sm-center">
				        <button type="submit" class="btn btn-success">
				            <i class="icon fa fa-upload"></i> 上传
				        </button>
				    </div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop

@push('styles')
<!-- DateTimePicker -->
<link href="{{ asset('vendor/datetimepicker/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<!-- DateTimePicker -->
<script src="{{ asset('vendor/moment/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('vendor/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script>
$(function() {
    $('.datetimepicker').datetimepicker({
    	locale: 'zh-cn',
    	icons: {
    		time: 'far fa-clock',
    		date: 'far fa-calendar-alt',
    		up: 'fas fa-arrow-up',
    		down: 'fas fa-arrow-down'
    	}
	});
});
</script>
@endpush
