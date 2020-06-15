@extends('layouts.dashboard')
@section('title')
	<title>Update Slide</title>
@endsection
@section('content')
	<form action="{{ route('update-slide', ['id' => $slide->id ]) }}" method="POST" role="form" enctype="multipart/form-data">
		<legend>Update Slide {{ $slide->id }}</legend>

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@csrf
		@method('PUT')
	
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="inputDescription" class="form-control" rows="3" required="required">{{ $slide->description }}</textarea>
		</div>

		<div class="form-group">
			<label for="">Status</label>
			<select name="status" id="input" class="form-control" required="required">
				<option value="0" {{ $slide->status == 0 ? 'selected' : '' }}>Old</option>
				<option value="1" {{ $slide->status == 1 ? 'selected' : '' }}>New</option>
				<option value="2" {{ $slide->status == 2 ? 'selected' : '' }}>Coming soon</option>
			</select>
		</div>	
			
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
@stop