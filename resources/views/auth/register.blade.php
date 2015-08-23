@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>Register</h1>
			<hr>
			{!! Form::open(['url' => 'auth/register']) !!}
				
				@include('errors')

				<div class="form-group">
					{!! Form::label('name', 'Name:')!!}
					{!! Form::text('name', null, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('email', 'Email:')!!}
					{!! Form::email('email', null, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('password', 'Password:')!!}
					{!! Form::password('password', ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('password_confirmation', 'Confirm Password:')!!}
					{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Register', ['class' => 'btn btn-default']) !!}
				</div>
			{!! Form::close()!!}
		</div>
	</div>
@stop