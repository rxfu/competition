@extends('layouts.app')

@section('content')
@php
	$model = request()->segment(1);
	$components = config('components.' . $model)
@endphp
<div class="row justify-content-sm-center">
	<div class="col-sm-8">
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">导入{{ __($model . '.module') }}</h3>
			</div>

		    <form role="form" id="upload-form" name="upload-form" method="post" action="{{ route($model . '.import') }}" enctype="multipart/form-data">
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
	                    </div>
	                </div>
                    @if ($errors->has('upfile'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('upfile') }}</strong>
                        </div>
                    @endif
				</div>

				<div class="card-footer">
					<div class="row justify-content-sm-center">
				        <button type="submit" class="btn btn-secondary">
				            <i class="icon fa fa-file-import"></i> 导入
				        </button>
				    </div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
