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
    <div class="row">
        <div class="col-md-8">
    		<button class="btn btn-primary pull-right" style="margin-top: 15px;" @click="add_section=true"><i class="fui-plus"></i></button>
            <h4>Sections</h4>
            <hr>
            <div class="clearfix"></div>
			<div class="panel panel-default" v-show="add_section">
				<div class="panel-heading">
					<button type="button" class="close" aria-label="Close" @click="add_section=''"><span aria-hidden="true">&times;</span></button>
					<h3 class="panel-title">Add Section</h3>
				</div>
				<div class="panel-body">
					<form>
						<div class="col-md-12">
							<label for="section_name">Name</label>
							<input type="text" class="form-control" name="section_name" v-model="new_section.name">
						</div>
						<div class="col-md-12">
							<label for="section_survey">Survey</label>
							<textarea class="form-control" rows="3" name="section_survey" v-model="new_section.survey"></textarea>
						</div>

						<div class="col-md-12">
							<br/><button type="submit" class="btn btn-primary btn-wide" @click.prevent="addSection">Add</button>
						</div>
					</form>
				</div>
			</div>
            <job-section v-show="sections" v-for="section in sections" :section="section" :systems="systems"></job-section>
        	
        	<!-- <div class="row" v-if="sections">
        		<button class="btn btn-primary pull-right" style="margin-top: 15px;"><i class="fui-plus"></i></button>
	            <h4>Tasks</h4>
	            <hr>
	            <div class="clearfix"></div>
	            <job-section v-for="section in sections" :section="section"></job-section>
        	</div> -->
        </div>
    </div>
@stop

@include('_layout.footer')

@section('pagescript')
<script type="text/javascript">
    $("select").select2({dropdownCssClass: 'dropdown-inverse'});
</script>
@stop
