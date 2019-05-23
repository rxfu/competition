<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{ __($model . '.module') }}列表</h3>
	</div>

	@can($model . '.delete')
	    <form id="delete-form" action="{{ route($model . '.delete') }}" method="post">
	    	@csrf
	        @method('delete')
	@endcan
		<div class="card-body">
			<table id="itemsTable" class="table table-bordered table-striped datatable">
				<thead>
					<tr>
						<th scope="col"></th>
						@can($model . '.delete')
							<th scope="col" class="all">
	                            <div class="form-check">
	                                <input type="checkbox" id="allItems" name="allItems" value="all">
	                            </div>
	                        </th>
	                    @endcan
						@foreach ($components as $component)
							@if (!empty($component['list']))
								<th scope="col" class="{{ isset($component['responsive']) ? $component['responsive'] : 'desktop' }}">{{ __($model . '.' . $component['field']) }}</th>
							@endif
						@endforeach
						<th scope="col" class="all">操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($items as $item)
						<tr>
							<td></td>
							@can($model . '.delete')
								<td>
	                                <div class="form-check">
	                                    <input type="checkbox" name="items[]" value="{{ $item->id }}">
	                                </div>
	                            </td>
	                        @endcan
							@foreach ($components as $component)
								@if (!empty($component['list']))
									<td>
										@if (!empty($component['presenter']))
											{{ $item->present()->{Illuminate\Support\Str::camel($component['field'])} }}
										@elseif (!empty($component['relation']) && (!is_null($item->{$component['relation']})))
											@if (isset($component['prop']))
												@if (false === stripos(optional($item->{$component['relation']})->{$component['prop']}, 'storage/'))
													{{ optional($item->{$component['relation']})->{$component['prop']} }}
												@else
													<a href="{{ asset(optional($item->{$component['relation']})->{$component['prop']}) }}">下载</a>
												@endif
											@else
												{{ optional($item->{$component['relation']})->name }}
											@endif
										@elseif (!empty($component['relations']) && (!is_null($item->{$component['relations']})))
											{{ optional($item->{$component['relations']})->implode('name', ', ') }}
										@else
											{{ $item->{$component['field']} }}
										@endif
									</td>
								@endif
							@endforeach
	                        <td>
	                        	@can($model . '.edit')
		                            <a href="{{ route($model . '.edit', $item->getKey()) }}" class="btn btn-info btn-flat btn-sm" title="编辑">
		                                <i class="icon fa fa-edit"></i> 编辑
		                            </a>
		                        @endcan
								
	                        	@can('password.reset')
		                            @if (config('components.' . $model . '.reset'))
								    	<a href="{{ route('password.reset', $item->getKey()) }}" class="btn btn-secondary btn-flat btn-sm" title="重置密码">
									        <i class="icon fa fa-key"></i> 重置密码
									    </a>
									@endif
								@endcan

	                        	@can($model . '.assign')
									@if (config('components.' . $model . '.assign'))
								    	<a href="{{ route('role.permission', $item->getKey()) }}" class="btn btn-warning btn-flat btn-sm" title="分配权限">
									        <i class="icon fa fa-key"></i> 分配权限
									    </a>
									@endif
								@endcan

	                        	@can($model . '.audit')
									@if (config('components.' . $model . '.audit'))
										@if (\App\Entities\User::whereId($item->id)->whereIsPassed(false)->exists())
									    	<a href="{{ route('marker.audit', $item->getKey()) }}" class="btn btn-success btn-flat btn-sm" title="审核通过">
										        <i class="icon fa fa-unlock"></i> 审核通过
										    </a>
										@else
									    	<a href="{{ route('marker.unaudit', $item->getKey()) }}" class="btn btn-warning btn-flat btn-sm" title="取消审核">
										        <i class="icon fa fa-lock"></i> 取消审核
										    </a>
										@endif
									@endif
								@endcan

	                        	@can('player.document')
									@if (config('components.' . $model . '.document'))
								    	<a href="{{ route('player.document', $item->getKey()) }}" class="btn btn-primary btn-flat btn-sm" title="上传材料">
									        <i class="icon fa fa-upload"></i> 上传材料
									    </a>
									@endif
								@endcan
	                        </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		
		<div class="card-footer">
			<div class="row">
				@can($model . '.delete')
					<div class="col">
				        <button type="submit" class="btn btn-danger" onclick="return window.confirm('请问确定要删除这些{{ __($model . '.module') }}吗？')">
				            <i class="icon fa fa-trash"></i> 删除所选
				        </button>
				    </div>
				@endcan
			    <div class="col text-right">
			    	@can($model . '.upload')
				    	<a href="{{ route($model . '.upload') }}" class="btn btn-secondary">
				    		<i class="icon fa fa-user-plus"></i> 导入{{ __($model . '.module') ?: '' }}
				    	</a>
				    @endcan
					@can($model . '.create')
				    	<a href="{{ route($model . '.create') }}" class="btn btn-success">
				    		<i class="icon fa fa-plus"></i> 创建{{ __($model . '.module') ?: '' }}
				    	</a>
					@endcan
			    </div>
			</div>
		</div>
	</form>
</div>
