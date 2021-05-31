@extends('layouts.app')

@section('content')
<div class="row justify-content-sm-center">
	<div class="col-sm-8">
		<div class="card card-success">
			<div class="card-header">
				<h3 class="card-title">上传材料</h3>
			</div>

		    <form role="form" id="upload-form" name="upload-form" method="post" action="{{ route('document.store') }}" enctype="multipart/form-data" onsubmit="return showProgress();">
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
	                    	<input type="file" name="syllabus" id="syllabus" class="form-control-file{{ $errors->has('syllabus') ? ' is_invalid' : '' }}"{{ empty($item->document->syllabus) ? ' required' : '' }}>
	                    	<small class="form-text text-muted">要求文件类型为pdf</small>
	                        @if ($errors->has('syllabus'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('syllabus') }}</strong>
		                        </div>
	                        @endif
	                    	@if (!empty($item->document->syllabus))
	                    		<small class="form-text text-muted">
	                    			<a class="pdf" href="{{ asset($item->document->syllabus) }}" title="教学大纲">教学大纲</a>
	                    		</small>
	                    	@endif
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="design" class="col-sm-3 col-form-label">教学设计</label>
	                    <div class="col-md-9">
	                    	<input type="file" name="design" id="design" class="form-control-file{{ $errors->has('design') ? ' is_invalid' : '' }}"{{ empty($item->document->design) ? ' required' : '' }}>
	                    	<small class="form-text text-muted">要求文件类型为pdf</small>
	                        @if ($errors->has('design'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('design') }}</strong>
		                        </div>
	                        @endif
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
	                    	<input type="file" name="section" id="section" class="form-control-file{{ $errors->has('section') ? ' is_invalid' : '' }}"{{ empty($item->document->section) ? ' required' : '' }}>
	                    	<small class="form-text text-muted">要求文件类型为zip或rar，文件大小不超过2GB</small>
	                        @if ($errors->has('section'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('section') }}</strong>
		                        </div>
	                        @endif
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
	                    	<input type="file" name="catalog" id="catalog" class="form-control-file{{ $errors->has('catalog') ? ' is_invalid' : '' }}"{{ empty($item->document->catalog) ? ' required' : '' }}>
	                    	<small class="form-text text-muted">要求文件类型为pdf</small>
	                        @if ($errors->has('catalog'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('catalog') }}</strong>
		                        </div>
	                        @endif
	                    	@if (!empty($item->document->catalog))
	                    		<small class="form-text text-muted">
	                    			<a href="{{ asset($item->document->catalog) }}" title="教学节段目录">教学节段目录</a>
	                    		</small>
	                    	@endif
	                    </div>
	                </div>
	                <div class="form-group row">
	                    <label for="application" class="col-sm-3 col-form-label">特殊软件安装申请</label>
	                    <div class="col-md-9">
	                    	<textarea name="application" id="application" rows="5" class="form-control{{ $errors->has('application') ? ' is_invalid' : '' }}" placeholder="因竞赛场地硬件升级，电脑系统版本为win10专业版。除广西高校青年教师教学竞赛承办方在QQ群提及的应用软件，原则上不另行安装选手提供的其他软件，如确有需要，在提交竞赛材料时，填写申请说明，并备注电话，经技术人员同意后方可安装。">{{ old('application', optional($item->document)->application) }}</textarea>
	                        @if ($errors->has('application'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('application') }}</strong>
		                        </div>
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

@include('shared.dialog')
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

function showProgress() {
	$('#progressDialog').modal({
		'backdrop': 'static',
		'keyboard': false
	});
}
</script>
@endpush
