@extends('layouts.master')
@section('title')
	<title>Change Password</title>
@endsection
@section('content')
	<div class="container">
		<div id="content">
			
			<form action="{{ route('change-password', ['id' => $user->id]) }}" method="POST" role="form">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4><b>Change Password</b></h4>
						<div class="space20">&nbsp;</div>
						<br>
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif

						@if (session('danger'))
							<div class="alert alert-danger">
								{{ session('danger') }}
							</div>
						@endif

						
						@if (session('notmatch'))
							<div class="alert alert-danger">
								{{ session('notmatch') }}
							</div>
						@endif

{{-- 						@if (session('duplicate'))
							<div class="alert alert-danger">
								{{ session('duplicate') }}
							</div>
						@endif --}}

						@csrf
						@method('PUT')

			
				<div class="form-group">
					<label for="">Old Password</label>
					<input type="password" class="form-control" id="" placeholder="******" name="oldPassword" value="">
				</div>
			
				<div class="form-group">
					<label for="">New Password</label>
					<input type="text" class="form-control" id="" placeholder="******" name="newPassword" value="">
				</div>
			
			
				<div class="form-group">
					<label for="">Retype New Password</label>
					<input type="text" class="form-control" id="" placeholder="******" name="reNewPassword" value="">
				</div>
			
				
			
				<button type="submit" class="btn btn-primary">Change</button>
				</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->

@stop