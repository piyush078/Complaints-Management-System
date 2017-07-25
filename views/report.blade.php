@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Employee</th>
					<th>Device ID</th>
					<th>Device Name</th>
					<th>Maintainer</th>
					<th>Done On</th>
					<th>Solved</th>
					<th>Solved On</th>
					<th>Reason for Delay</th>
				</tr>
			</thead>
			<tbody>
			<?php $index = 1 ?>
			@foreach ($complaints as $complaint) 
				<tr
				@if ($complaint->fixed) 
					class="success"
				@else
					class="danger"
				@endif
				>
					<td><?php echo $index++; ?></td>
					<td>{{ $complaint->user->name }}</td>
					<td>{{ $complaint->device->dev_id }}</td>
					<td>{{ $complaint->device->name }}</td>
					<td>{{ $complaint->maintainer->name }}
					<td>{{ $complaint->created_at->format('d/m/Y') }}</td>
					<td>
						<span 
							style="font-size:12px; 
								   background:{{ !$complaint->feedback ? 'skyblue' : ($complaint->fixed ? 'green' : 'red') }};
								   padding: 0 5px; 
								   color:white">
							{{ !$complaint->feedback ? 'No feedback yet' : ($complaint->fixed ? 'Yes' : 'No') }}
						</span>
					</td>
					<td>{{ $complaint->fixed === 1 ? $complaint->updated_at->format('d/m/Y') : '< not repaired yet >' }}</td>
					<td>{{ $complaint->feedback ? $complaint->feedback : '< No Feedback >' }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
    </div>
</div>
@endsection
