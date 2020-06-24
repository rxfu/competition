@extends('layouts.app')

@section('content')
@php
	$model = request()->segment(1);
	$components = config('components.' . $model)
@endphp
<div class="row justify-content-sm-center">
	<div class="col-sm-8">
		<div class="card card-warning">
			<div class="card-header">
				<h3 class="card-title">上传{{ __($model . '.module') }}推荐表</h3>
			</div>

		    <form role="form" id="recommend-form" name="recommend-form" method="post" action="{{ route($model . '.recommend', $item->id) }}" enctype="multipart/form-data">
		        @csrf
				<div class="card-body">
	                <div class="form-group row">
	                    <label for="upfile" class="col-sm-3 col-form-label">上传文件</label>
	                    <div class="col-md-9">
	                    	<input type="file" name="upfile" id="upfile" class="form-control-file{{ $errors->has('upfile') ? ' is_invalid' : '' }}" required>
							@if ($errors->has('upfile'))
								<div class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('upfile') }}</strong>
								</div>
							@endif
							@if (!empty($item->recommend))
								<small class="form-text text-muted">
									<a href="{{ asset($item->recommend) }}" title="{{ __($model . '.module') }}推荐表">{{ __($model . '.module') }}推荐表</a>
								</small>
							@endif
	                    </div>
	                </div>
				</div>

				<div class="card-footer">
					<div class="row justify-content-sm-center">
				        <button type="submit" class="btn btn-warning">
				            <i class="icon fa fa-file-import"></i> 上传
				        </button>
				    </div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
