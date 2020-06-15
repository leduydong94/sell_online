@extends('layouts.dashboard')
@section('title')
	<title>Update Type</title>
@endsection
@section('content')
	<form action="{{ route('update-type', ['id' => $type->id]) }}" method="POST" role="form">
		<legend>Update Type {{$type->name}}</legend>

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if (session('existRole'))
	        <div class="alert alert-danger">{{session('existRole')}}</div>
	    @endif
		@csrf
		@method('PUT')
	
		<div class="form-group">
			<label for="">Type Name</label>
			<input type="text" class="form-control" id="" placeholder="Input Type Name" name="name" value="{{ $type->name }}">
		</div>	

		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="inputDescription" class="form-control" rows="3" required="required">{{ $type->description }}</textarea>
		</div>	
			
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
@stop