@extends('_layout.default',['vueView'=>'job-build-view'])

@section('pagetitle', 'Build '.$job->order_number.' - '.$job->name)

@section('head')
@parent
<meta name="description" content="">
@stop


@section('header')
	<div class="row">
		<div class="col-md-12">
			<h4 class="page-title">{{$job->order_number.' - '.$job->name}}</h4>
		</div>
	</div>
@stop

@section('content')
	<form action="" method="POST">
    <div class="row">
        <div class="col-md-8">
    		<button class="btn btn-primary pull-right" style="margin-top: 15px;" @click.prevent="addSection"><i class="fui-plus"></i></button>
            <h4>Sections</h4>
            <hr>
            <div class="clearfix"></div>
        
        	<job-section v-for="(key, section) in sections" :section="section" :systems="systems" :key="key" :remove-section="removeSection"></job-section>
        	<div class="form-group">
        		<button type="submit" v-bind:class="{'disabled': !can_save}" @click.prevent="saveJob" class="btn btn-info btn-lg">Save</button>
        	</div>
        </div>
    </div>
    </form>
@stop

@include('_layout.footer')

@section('pagescript')
<script type="text/javascript">
    $("select").select2({dropdownCssClass: 'dropdown-inverse'});
</script>
@stop
