@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			{!! Form::open(['url' => 'auth/login']) !!}
				@include('errors')

				<div class="form-group">
					{!! Form::label('email', 'Email:')!!}
					{!! Form::email('email', null, ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('password', 'Password:')!!}
					{!! Form::password('password', ['class' => 'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::checkbox('remember') !!}
					Remember Me
				</div>

				<div class="form-group">
					{!! Form::submit('Login', ['class' => 'btn btn-default']) !!}
				</div>

			{!! Form::close()!!}		
		</div>
	</div>
	
@stop