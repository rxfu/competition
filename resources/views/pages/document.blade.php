@extends('layouts.app')

@section('content')
<div class="row justify-content-sm-center">
	<div class="col-sm-8">
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title">上传材料</h3>
			</div>

		    <form role="form" id="upload-form" name="upload-form" method="post" action="{{ route('document.store') }}" enctype="multipart/form-data">
		        @csrf
				<div class="card-body">
	                <div class="form-group row">
	                    <label for="year" class="col-sm-3 col-form-label">年度</label>
	                    <div class="col-md-9">
	                    	<input type="text" name="year" id="year" class="form-control-plaintext" value="{{ date('Y') }}" readonly>
	                    </div>
	                </div>
	                <input type="hidden" name="user_id" value="{{ $item->id }}">
	                <div class="form-group row">
	                    <label for="name" class="col-sm-3 col-form-label">选手姓名</label>
	                    <div class="col-md-9">
	                    	<input type="text" name="name" id="name" class="form-control-plaintext" value="{{ $item->name }}" readonly>
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="syllabus" class="col-sm-3 col-form-label">教学大纲</label>
	                    <div class="col-md-9">
	                    	<input type="file" name="syllabus" id="syllabus" class="form-control-file{{ $errors->has('syllabus') ? ' is_invalid' : '' }}" required>
	                    	<small class="form-text text-muted">要求文件类型为pdf</small>
	                    	@if (!empty($item->document->syllabus))
	                    		<small class="form-text text-muted">
	                    			<a class="pdf" href="{{ asset('js/vendor/pdfjs/web/viewer.html?file=/' . $item->document->syllabus) }}" title="教学大纲">教学大纲</a>
	                    		</small>
	                    	@endif
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="design" class="col-sm-3 col-form-label">教学设计</label>
	                    <div class="col-md-9">
	                    	<input type="file" name="design" id="design" class="form-control-file{{ $errors->has('design') ? ' is_invalid' : '' }}" required>
	                    	<small class="form-text text-muted">要求文件类型为pdf</small>
	                    	@if (!empty($item->document->design))
	                    		<small class="form-text text-muted">
	                    			<a href="{{ asset($item->document->design) }}" title="教学设计">教学设计</a>
	                    		</small>
	                    	@endif
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="section" class="col-sm-3 col-form-label">教学节段PPT</label>
	                    <div class="col-md-9">
	                    	<input type="file" name="section" id="section" class="form-control-file{{ $errors->has('section') ? ' is_invalid' : '' }}" required>
	                    	<small class="form-text text-muted">要求文件类型为zip或rar</small>
	                    	@if (!empty($item->document->section))
	                    		<small class="form-text text-muted">
	                    			<a href="{{ asset($item->document->section) }}" title="教学节段PPT">教学节段PPT</a>
	                    		</small>
	                    	@endif
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="catalog" class="col-sm-3 col-form-label">教学节段目录</label>
	                    <div class="col-md-9">
	                    	<input type="file" name="catalog" id="catalog" class="form-control-file{{ $errors->has('catalog') ? ' is_invalid' : '' }}" required>
	                    	<small class="form-text text-muted">要求文件类型为pdf</small>
	                    	@if (!empty($item->document->catalog))
	                    		<small class="form-text text-muted">
	                    			<a href="{{ asset($item->document->catalog) }}" title="教学节段目录">教学节段目录</a>
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
