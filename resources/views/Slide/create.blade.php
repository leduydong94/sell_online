@extends('layouts.dashboard')
@section('title')
	<title>Create Slide</title>
@endsection
@section('content')
	<form action="{{ route('store-slide') }}" method="POST" role="form" enctype="multipart/form-data">
		<legend>Add New Slide</legend>

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

{{-- 		@if (session('existRole'))
	        <div class="alert alert-danger">{{session('existRole')}}</div>
	    @endif --}}
		@csrf

		<div class="form-group">
			<label for="">Slide</label>
			<input type="file" class="form-control" id="" name="slide" >
		</div>
	
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="inputDescription" class="form-control" rows="3" required="required">{{ old('description') }}</textarea>
		</div>

		<div class="form-group">
			<label for="">Status</label>
			<select name="status" id="input" class="form-control" required="required">
				<option value="0">Old</option>
				<option value="1">New</option>
				<option value="2">Coming soon</option>
			</select>
		</div>	
			
		<button type="submit" class="btn btn-primary">Create</button>
	</form>
@stop