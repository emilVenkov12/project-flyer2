@extends('layout')

@section('content')
	<h1>Selling your home?</h1>
	
	<hr>

	{!! Form::open([
			'route' => 'flyers.store', 
			'enctype' => 'multipart/form-data'
		])
	!!}
		@include('errors')

		@include('flyers.form')
	{!! Form::close() !!}


@stop