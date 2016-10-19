@extends('_layout.default',['vueView'=>'job-progress-view'])<!--  -->

@section('pagetitle', $job->order_number.' - '.$job->name.' Progress')

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
	<form action="{{url('/jobs/'.$job->id.'/build/')}}" method="POST" enctype="">
    {{ csrf_field() }}
    <input type="hidden" name="job_id" value="{{$job->id}}">
    <div class="row">
        <div class="col-xs-12">
            <div v-for="(key, section) in sections">
                <job-task :section="section" :systems="systems" :key="key" :employees="employees"></job-task>
            </div>
        </div>
    </div>
    </form>
@stop

@include('_layout.footer')

@section('pagescript')
<script type="text/javascript">
    //$("select").select2({dropdownCssClass: 'dropdown-inverse'});
</script>
@stop
