@extends('_layout.default',['vueView'=>'new-job-view'])

@section('content')@section('pagetitle', 'Create Job')

@section('head')
@parent
<meta name="description" content="">
@stop




@section('content')
	@include('_layout.form_errors')
	<form action="{{ url('/jobs')}}" method="POST" enctype="multipart/form-data" role="form">
	{{ csrf_field() }}
    <div class="row">
    	<legend>Create a new Job</legend>
    	<!-- <div class="col-md-2">
			<div class="form-group">
				<label for="order_number">SAN Ref Number</label>
				<input type="text" class="form-control" name="order_number" placeholder="SANXXXX-XX" value="{{ old('order_number') }}">
			</div>
		</div> -->
		<div class="col-md-6">				
			<div class="form-group">
				<label for="name">Job Name</label>
				<input type="text" class="form-control" name="name" value="{{ old('name') }}">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="company_name">Company</label>
				<vue-autocomplete
				    name="company_name"
				    param="name"
				    url="/api/company"
				    anchor="name"
				    label="address3"
				    model="vModelLike"
				    class="form-control">
				</vue-autocomplete>
				<input type="hidden" class="form-control" name="company_id" v-model="selected_company">
				<input type="hidden" class="form-control" name="company_name" v-model="vModelLike">
			</div>		
		</div>
    </div>
    <div class="row">
    	<div class="col-md-4">
    		<div class="form-group">
				<label for="address">Site Number and Street *</label>
				<input type="text" class="form-control" name="address" placeholder="" v-model="address" @blur="getDistance" value="{{ old('address') }}">
			</div>
    	</div>
    	<div class="col-md-2" v-show="!is_estate">
    		<div class="form-group">
				<label for="suburb">Site Suburb *</label>
				<input type="text" class="form-control" name="suburb" placeholder="" v-model="suburb" @blur="getDistance" value="{{ old('suburb') }}">
			</div>
    	</div>
    	<div class="col-md-2" v-show="!is_estate">
    		<div class="form-group">
				<label for="city">Site City *</label>
				<input type="text" class="form-control" name="city" placeholder="" v-model="city" @blur="getDistance($event,true)" value="{{ old('city') }}">
			</div>
    	</div>
    	<div class="col-md-2" v-bind:class="{ 'col-md-offset-4': is_estate}">
    		<div class="form-group" v-bind:class="{ 'has-error': distance_problem}">
                <label for="distance">Distance to site</label>
                <input type="text" class="form-control" placeholder="" v-model="distance" value="{{ old('distance') }}">
                    <input type="hidden" name="distance" v-model="distance" value="{{ old('distance') }}">
            </div>
    	</div>
    	<div class="col-md-2">
    		<!-- <div class="clearfix" style="height:10px;"></div> -->
    		<label>Site in an Estate?</label>
    		<label class="checkbox" for="checkbox1">
				<input type="checkbox" data-toggle="checkbox" name="is_estate" v-model="is_estate" @click="distance='' {{ old('is_estate') ? 'checked' : '' }}">
				yes
			</label>
			
    	</div>
    	<input type="hidden" class="form-control" name="country" value="South Africa">
    </div>
    <div class="row" v-show="is_estate">
    	<div class="col-md-4">
    		<div class="form-group">
				<label for="estate">Estate Name</label>
				<input type="text" class="form-control" name="estate" placeholder="" v-model="estate" value="{{ old('estate') }}">
			</div>
    	</div>
    	<div class="col-md-3">
    		<div class="form-group">
				<label for="estate_address">Estate Number and Street</label>
				<input type="text" class="form-control" name="estate_address" placeholder="" v-model="estate_address" value="{{ old('estate_address') }}">
			</div>
    	</div>
    	<div class="col-md-3">
    		<div class="form-group">
				<label for="estate_suburb">Estate Suburb</label>
				<input type="text" class="form-control" name="estate_suburb" placeholder="" v-model="estate_suburb" value="{{ old('estate_suburb') }}">
				<!-- <p class="help-block">Including street, avenue etc</p> -->
			</div>
    	</div>
    	<div class="col-md-2">
    		<div class="form-group">
				<label for="estate_city">Estate City</label>
				<input type="text" class="form-control" name="estate_city" placeholder="" v-model="estate_city" @blur="getDistance" value="{{ old('estate_city') }}">
			</div>
    	</div>
    </div>
    <div class="row" v-show=!selected_company>
    	<div class="col-md-12">
    		<label for="">Company Details</label>
	    	<div class="row">
	    		<div class="tile form">
	    			<div class="row">
				    	<div class="col-md-4">
				    		<div class="form-group">
								<label for="company_address1">Number and Street</label>
								<input type="text" class="form-control" name="company_address1" placeholder="" value="{{ old('company_address1') }}">
							</div>
				    	</div>
				    	<div class="col-md-2">
				    		<div class="form-group">
								<label for="company_address2">Suburb</label>
								<input type="text" class="form-control" name="company_address2" placeholder="" value="{{ old('company_address2') }}">
							</div>
				    	</div>
				    	<div class="col-md-2">
				    		<div class="form-group">
								<label for="company_address2">City</label>
								<input type="text" class="form-control" name="company_address3" placeholder="" value="{{ old('company_address3') }}">
							</div>
				    	</div>
				    	<div class="col-md-2">
				    		<div class="form-group">
								<label for="company_post_code">Post Code</label>
								<input type="text" class="form-control" name="company_post_code" placeholder="" value="{{ old('company_post_code') }}">
							</div>
				    	</div>
				    	<div class="col-md-2">
				    		<div class="form-group">
								<label for="company_vat">VAT</label>
								<input type="text" class="form-control" name="company_vat" placeholder="" value="{{ old('company_vat') }}">
							</div>
				    	</div>
				    </div>
	    		</div><!-- close tile  -->
    			<div class="clearfix"></div>
	    	</div>
    	</div>
    </div>
    <div class="row" v-show="contacts">
		<div class="col-md-12">
			<button class="btn btn-embossed btn-primary pull-right" style="margin: 0 0 10px 30px;" @click.prevent="addContact"><i class="fui-plus"></i></button>
			<label v-if="vModelLike!=='Private'">Contacts</label>
			<div class="row" v-if="vModelLike=='Private'">
				<div class="col-md-3">
					<div class="form-group">
						<label for="contact[]">Existing Contact</label>
						<vue-autocomplete
						    name="existing_contact[]"
						    :param="contactParam"
						    url="/api/contacts"
						    anchor="name"
						    label="email"
						    model="vModelPrivateLike"
						    class="form-control">
						</vue-autocomplete>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
			<company-contacts v-for="(contactKey, contact) in contacts" :contact="contact" :contact-key="$index"></company-contacts>
			<div class="clearfix"></div>
			<template v-for="new_contact in new_contacts">
				<div class="tile form" style="position: relative; padding-top: 30px">
					<button class="btn btn-embossed btn-danger" style="position: absolute; right: 15px; top: 10px; z-index: 1;" @click.prevent="removeContact(new_contact)"><i class="fui-cross"></i></button>
			    	<div class="row">
			            <div class="col-md-3">
			                <div class="form-group">
			                    <label for="new_contact[@{{$index}}][first_name]">First Name</label>
			                    <input type="text" class="form-control" name="new_contact[@{{$index}}][first_name]" placeholder="" v-model="new_contact.first_name">
			                </div>
			            </div>
			            <div class="col-md-3">
			                <div class="form-group">
			                    <label for="new_contact[@{{$index}}][last_name]">Last Name</label>
			                    <input type="text" class="form-control" name="new_contact[@{{$index}}][last_name]" placeholder="" v-model="new_contact.last_name">
			                </div>
			            </div>
			            <div class="col-md-2">
			                <div class="form-group">
			                    <label for="new_contact[@{{$index}}][job_title]">Job Title</label>
			                    <input type="text" class="form-control" name="new_contact[@{{$index}}][job_title]" placeholder="" v-model="new_contact.job_title">
			                </div>
			            </div>
			            <div class="col-md-2">
			                <div class="form-group">
			                    <label for="new_contact[@{{$index}}][department]">Department</label>
			                    <input type="text" class="form-control" name="new_contact[@{{$index}}][department]" placeholder="" v-model="new_contact.department">
			                </div>
			            </div>
			            <div class="col-md-2">
			                <div class="form-group">
			                    <label for="new_contact[@{{$index}}][region]">Region</label>
			                    <input type="text" class="form-control" name="new_contact[@{{$index}}][region]" placeholder="Johannesburg" v-model="new_contact.region">
			                    <!-- <p class="help-block">Johannesburg, Capetown etc</p> -->
			                </div>
			                <input type="hidden" name="new_contact[@{{$index}}][country]" value="South Africa">
			            </div>
			            <div class="clearfix"></div>
			        </div>
			        <div class="row">
			            <div class="col-md-3">
			                <div class="form-group">
			                    <label for="new_contact[@{{$index}}][email]">Email Address</label>
			                    <input type="email" class="form-control" name="new_contact[@{{$index}}][email]" placeholder="" v-model="new_contact.email">
			                </div>
			            </div>
			            <div class="col-md-3">
			                <div class="form-group">
			                    <label for="new_contact[@{{$index}}][contact1]">Tel / Cell 1</label>
			                    <div class="input-group">
                                    <div class="input-group-addon">+27 (0)</div>
                                    <input type="text" class="form-control" name="new_contact[@{{$index}}][contact1]" placeholder="" v-model="new_contact.contact1">
                                </div>
			                </div>
			            </div>
			            <div class="col-md-3">
			                <div class="form-group">
			                    <label for="new_contact[@{{$index}}][contact2]">Tel / Cell 2</label>
			                    <div class="input-group">
                                    <div class="input-group-addon">+27 (0)</div>
                                    <input type="text" class="form-control" name="new_contact[@{{$index}}][contact2]" placeholder="" v-model="new_contact.contact2">
                                </div>
			                </div>
			            </div>
			            <div class="col-md-3">
			                <div class="form-group">
			                    <label for="new_contact[@{{$index}}][contact3]">Tel / Cell 3</label>
			                    <div class="input-group">
                                    <div class="input-group-addon">+27 (0)</div>
                                    <input type="text" class="form-control" name="new_contact[@{{$index}}][contact3]" placeholder="" v-model="new_contact.contact3">
                                </div>
			                </div>
			            </div>
				    </div>
				</div>
			</template>
			</div>
		</div>
    </div>
    <button type="submit" class="btn btn-primary">Add Job</button>
    </form>
@stop

@include('_layout.footer')

@section('pagescript')
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpm3ahzK4j9tvdJT5juuy-0BZiol3qtIg">
</script>
<!-- &callback=initMap -->
<script type="text/javascript">
    $(function() {
        $(':checkbox').radiocheck();
        if($('[data-toggle="switch"]').length){
        	$('[data-toggle="switch"]').bootstrapSwitch();
        }
    });
</script>
@stop