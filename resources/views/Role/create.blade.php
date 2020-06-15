@extends('layouts.dashboard')
@section('title')
	<title>Create Role</title>
@endsection
@section('content')
	<form action="{{ route('store-role') }}" method="POST" role="form">
		<legend>Add New Role</legend>

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
	
		<div class="form-group">
			<label for="">Role Name</label>
			<input type="text" class="form-control" id="" placeholder="Input Role Name" name="name" value="{{ old('name') }}">
		</div>	
			
		<button type="submit" class="btn btn-primary">Create</button>
	</form>
@stop