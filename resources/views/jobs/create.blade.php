@extends('_layout.default',['vueView'=>'home-view'])

@section('content')@section('pagetitle', 'Create Job')

@section('head')
@parent
<meta name="description" content="">
@stop




@section('content')
	<form action="{{ url('/jobs/newjob')}}" method="POST" enctype="multipart/form-data" role="form">
	{{ csrf_field() }}
    <div class="row">
    	<legend>Create a new Job</legend>
    	<div class="col-md-2">
			<div class="form-group">
				<label for="order_number">Order Number</label>
				<input type="email" class="form-control" name="order_number" placeholder="SANXXXX-XX">
			</div>
		</div>
		<div class="col-md-6">				
			<div class="form-group">
				<label for="name">Job Name</label>
				<input type="text" class="form-control" name="name">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="client">Client</label>
				<vue-autocomplete
				    name="contact[name]"
				    param="name"
				    url="/api/contacts"
				    anchor="first_name"
				    label="company[name]"
				    model="vModelLike"
				    class="form-control">
				</vue-autocomplete>
			</div>		
		</div>
    </div>
    <div class="row">
    	<div class="col-md-1">
    		<div class="form-group">
				<label for="street_number">Number</label>
				<input type="text" class="form-control" name="street_number" placeholder="">
			</div>
    	</div>
    	<div class="col-md-3">
    		<div class="form-group">
				<label for="street">Street</label>
				<input type="text" class="form-control" name="street" placeholder="">
				<p class="help-block">Including street, avenue etc</p>
			</div>
    	</div>
    	<div class="col-md-2">
    		<div class="form-group">
				<label for="suburb">Suburb</label>
				<input type="text" class="form-control" name="suburb" placeholder="">
			</div>
    	</div>
    	<div class="col-md-2">
    		<div class="form-group">
				<label for="city">City</label>
				<input type="text" class="form-control" name="city" placeholder="">
			</div>
    	</div>
    	<div class="col-md-2">
    		<label class="checkbox" for="checkbox1">
				<input type="checkbox" data-toggle="checkbox" value="" id="is_estate" required>
				is estate?
			</label>
    	</div>
    	<input type="hidden" class="form-control" name="country" disabled="" value="South Africa">
    </div>
    <div class="row">
    	<div class="col-md-3">
    		<div class="form-group">
				<label for="country"> Country</label>
				
			</div>
    	</div>
    	<div class="col-md-3">
    		<div class="form-group">
				<label for="address2"> Address 2</label>
				<input type="text" class="form-control" name="address2" placeholder="Suburb">
			</div>
    	</div>
    	<div class="col-md-3">
    		<div class="form-group">
				<label for="address3"> Address 3</label>
				<input type="text" class="form-control" name="address3" placeholder="Suburb">
			</div>
    	</div>
    	<div class="col-md-3">
    		<div class="form-group">
				<label for="post_code"> Post Code</label>
				<input type="text" class="form-control" name="address3" placeholder="">
			</div>
    	</div>
    </div>
    
			<button type="submit" class="btn btn-primary">Add Job</button>
    </form>
@stop