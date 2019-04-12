@extends('layouts.app')

@section('content')
<div class="row justify-content-sm-center">
	<div class="col-sm-8">
		<div class="card card-warning">
			<div class="card-header">
				<h3 class="card-title">分配权限给“{{ $role->name }}”</h3>
			</div>

		    <form role="form" id="assign-form" name="assign-form" method="post" action="{{ route('role.assign', $role->id) }}">
		        @csrf
				<div class="card-body">
	                <div class="form-group row">
	                    <label for="permissions[]" class="col-sm-3 col-form-label">权限</label>
	                    <div class="col-md-9">
				            	@foreach ($items as $item)
			                    	<div class="form-check">
			                    		<input type="checkbox" name="permissions[]" id="permission{{ $loop->index }}" class="form-check-input{{ $errors->has('permissions[]') ? ' is_invalid' : '' }}" value="{{ $item->id }}"{{ in_array($item->id, $permissions) ? ' checked' : '' }}>
			                    		<label class="form-check-label" for="permission{{ $loop->index }}">{{ $item->name }}</label>
			                    	</div>
				            	@endforeach
	                        @if ($errors->has('permissions[]'))
		                        <div class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('permissions[]') }}</strong>
		                        </div>
	                        @endif
	                    </div>
	                </div>
				</div>

				<div class="card-footer">
					<div class="row justify-content-sm-center">
				        <button type="submit" class="btn btn-warning">
				            <i class="icon fa fa-save"></i> 确定
				        </button>
				    </div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
