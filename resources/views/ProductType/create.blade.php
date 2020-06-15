@extends('layouts.dashboard')
@section('title')
	<title>Create Type</title>
@endsection
@section('content')
	<form action="{{ route('store-type') }}" method="POST" role="form">
		<legend>Add New Type</legend>

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
	
		<div class="form-group">
			<label for="">Type Name</label>
			<input type="text" class="form-control" id="" placeholder="Input Type Name" name="name" value="{{ old('name') }}">
		</div>

		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="inputDescription" class="form-control" rows="3" required="required">{{ old('description') }}</textarea>
		</div>	
			
		<button type="submit" class="btn btn-primary">Create</button>
	</form>
@stop