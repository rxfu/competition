<table>
	<thead>
		<tr>
			<th colspan="26">全区高校青年教师教学竞赛计分表（{{ $group->name }}）</th>
		</tr>
		<tr>
			<th rowspan="2">抽签号</th>
			<th rowspan="2">姓名</th>
			<th rowspan="2">学校</th>
			@foreach($group->markers as $marker)
				<th colspan="3">{{ $marker->name }}</th>
			@endforeach
			<th rowspan="2">总分</th>
			<th rowspan="2">排名</th>
		</tr>
		<tr>
			@foreach($group->markers as $marker)
				<th>教学设计</th>
				<th>课堂教学</th>
				<th>教学反思</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
        @php
            $preplace = 1;
            $preitem = null;
        @endphp
		@foreach($players->sortByDesc('total') as $player)
			<tr>
				<td>{{ optional($player->document)->seq }}</td>
				<td>{{ $player->name }}</td>
				<td>{{ $player->department->name }}</td>
				@foreach($group->markers as $marker)
					<td>{{ optional(App\Entities\Review::whereMarkerId($marker->id)->wherePlayerId($player->id)->first())->design_score }}</td>
					<td>{{ optional(App\Entities\Review::whereMarkerId($marker->id)->wherePlayerId($player->id)->first())->live_score }}</td>
					<td>{{ optional(App\Entities\Review::whereMarkerId($marker->id)->wherePlayerId($player->id)->first())->reflection_score }}</td>
				@endforeach
				<td>{{ number_format($player->total, 2) }}</td>
				<td>
                    @if ($player->total == optional($preitem)->total)
                        {{ $thisplace = $preplace }}
                    @else
                        {{ $thisplace = $loop->iteration }}
                    @endif
				</td>
			</tr>
            @php
                $preplace = $thisplace;
                $preitem = $player;
            @endphp
		@endforeach
	</tbody>
</table>
