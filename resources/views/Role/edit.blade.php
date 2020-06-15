@extends('layouts.dashboard')
@section('title')
	<title>Update Role</title>
@endsection
@section('content')
	<form action="{{ route('update-role', ['id' => $role->id]) }}" method="POST" role="form">
		<legend>Update Role {{$role->name}}</legend>

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
			<label for="">Role Name</label>
			<input type="text" class="form-control" id="" placeholder="Input Role Name" name="name" value="{{ $role->name }}">
		</div>	
			
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
@stop