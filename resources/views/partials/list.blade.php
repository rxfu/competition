<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{ __($model . '.module') }}列表</h3>
	</div>

	<div class="card-body">
		<table id="itemsTable" class="table table-bordered table-striped datatable">
			<thead>
				<tr>
					<th scope="col"></th>
					@foreach ($components as $component)
						@if (!empty($component['list']))
							<th scope="col" class="{{ $component['responsive'] ?? 'desktop' }}">{{ trans($model . '.' . $component['field']) }}</th>
						@endif
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach ($items as $item)
					<tr>
						<td></td>
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
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
