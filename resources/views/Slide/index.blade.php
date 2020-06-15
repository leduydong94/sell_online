@extends('layouts.dashboard')
@section('title')
	<title>Slides</title>
@endsection
@section('content')
	<h1>List Slide</h1>
	@if (session('success'))
	        <div class="alert alert-success">{{session('success')}}</div>
    @endif
	<form action="" method="get" class="form-inline" role="form">
		
		<div class="form-group">
			<label class="sr-only" for="">label</label>
			<input type="text" class="form-control" id="" placeholder="Input Name" name="keyword" value="{{ Request::get('keyword') }}">
		</div>
		&nbsp;&nbsp;
		<button type="submit" class="btn btn-primary">Search</button>
		<div style="float: right; padding-left: 586px"><a href="{{ route('create-slide') }}" class="btn btn-primary">Add New Slide</a></div>
	</form>

	<br>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Slide</th>
				<th>Description</th>
				<th>Status</th>
				<th>Updated At</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($slides as $slide)
				<tr>
					<td>{{ $slide->id }}</td>
					<td><a href="{{ $slide->slide }}" target="blank">{{ $slide->slide }}</a></td>
					<td>
						{{ $slide->description }}
					</td>
					<td>{{ $slide->status }}</td>
					<td>{{ $slide->updated_at }}</td>
					<td>
						<a href="{{ route('edit-slide', ['id' => $slide->id]) }}" class="btn btn-primary">Update</a>
						<form action="{{ route('delete-slide', ['id' => $slide->id]) }}" method="POST" role="form" style="display: inline-block;">
							@csrf
							@method('DELETE')						
							<button type="submit" class="btn btn-danger">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
			
		</tbody>
	</table>
	{{ $slides->appends($_GET) }}
@stop