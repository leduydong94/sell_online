@extends('layouts.dashboard')
@section('title')
	<title>Create User</title>
@endsection
@section('content')
	<form action="{{ route('store-user') }}" method="POST" role="form">
		<legend>Add New User</legend>

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if (session('existEmail'))
	        <div class="alert alert-danger">{{session('existEmail')}}</div>
	    @endif

		@csrf
	
		<div class="form-group">
			<label for="">Full Name</label>
			<input type="text" class="form-control" id="" placeholder="Input Full Name" name="fullname" value="{{ old('fullname') }}">
		</div>	
	
		<div class="form-group">
			<label for="">Email</label>
			<input type="email" class="form-control" id="" placeholder="Input Email" name="email" value="{{ old('email') }}">
		</div>	
	
		<div class="form-group">
			<label for="">Password</label>
			<input type="text" class="form-control" id="" placeholder="Input Password" name="password" value="{{ old('password') }}">
		</div>	
	
		<div class="form-group">
			<label for="">Roles</label>
			<select name="roles[]" id="inputRole" class="form-control select2" required="required" multiple="multiple">
				@foreach ($roles as $role)
					<option value="{{ $role->id }}">{{ $role->name }}</option>
				@endforeach
				
			</select>
		</div>
	
		
		<button type="submit" class="btn btn-primary">Create</button>
	</form>
	<script>
		jQuery(document).ready(function($) {
			$(".select2").select2();
		});
	</script>
@stop