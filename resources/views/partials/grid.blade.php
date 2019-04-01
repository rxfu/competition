<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">{{ $modname ?? '' }}列表</h3>
	</div>

	<div class="card-body">
		<table id="itemsTable" class="table table-bordered table-striped datatable">
			<thead>
				<tr>
					@foreach ($components as $component)
						@if (!empty($component['list']))
							<th scope="col" class="{{ isset($component['responsive']) ? $component['responsive'] : 'desktop' }}">{{ __($model . '.' . $component['field']) }}</th>
						@endif
					@endforeach
					<th scope="col" class="all"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($items as $item)
					<tr>
						@foreach ($components as $component)
							@if (!empty($component['list']))
								<td>
									@if (!empty($component['presenter']))
										{{ $item->present()->{Illuminate\Support\Str::camel($component['field'])} }}
									@else
										{{ $item->{$component['field']} }}
									@endif
								</td>
							@endif
						@endforeach
						<td></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
