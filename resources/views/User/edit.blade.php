@extends('layouts.dashboard')
@section('title')
	<title>Update User</title>
@endsection
@section('content')
	<form action="{{ route('update-user', ['id' => $user->id]) }}" method="POST" role="form">
		<legend>Update User {{ $user->full_name }}</legend>

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
			<label for="">Full Name</label>
			<input type="text" class="form-control" id="" placeholder="Input Full Name" name="fullname" value="{{ $user->full_name }}">
		</div>	
	
		<div class="form-group">
			<label for="">Roles</label>
			@php
				  $roleIds = $user->roles->pluck('id')->toArray();
			@endphp
			<select name="roles[]" id="inputRole" class="form-control select2" required="required" multiple="multiple">
				@foreach ($roles as $role)
					<option {{ in_array($role->id, $roleIds) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
				@endforeach
				
			</select>
		</div>
	
		
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
	<script>
		jQuery(document).ready(function($) {
			$(".select2").select2();
		});
	</script>
@stop