@inject('countries', 'App\Http\Utilities\Country')
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{!! Form::label('street', 'Street:')!!}
			{!! Form::text('street', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('city', 'City:')!!}
			{!! Form::text('city', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('zip', 'Zip/Postal Code:')!!}
			{!! Form::text('zip', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('country', 'Country:')!!}
			{!! Form::select('country', $countries::all(), [], ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('state', 'State:')!!}
			{!! Form::text('state', null, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			{!! Form::label('price', 'Sale Price:')!!}
			{!! Form::text('price', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('description', 'Home Description:')!!}
			{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
		</div>

	</div>
	
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::submit('Create Flyer', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>