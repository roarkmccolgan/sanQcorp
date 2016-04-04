@extends('_layout.default',['vueView'=>'job-build-view'])

@section('pagetitle', 'Build '.$job->order_number.' - '.$job->name)

@section('head')
@parent
<meta name="description" content="">
@stop


@section('header', '<h4 class="pull-left page-title">'.$job->order_number.' - '.$job->name.'</h4>')

@section('content')
    <div class="row">
        <div class="col-md-6">
        	<button class="btn btn-primary pull-right" style="margin-top: 15px;"><i class="fui-plus"></i></button>
            <h4>Sections</h4>
            <hr>
            <div class="clearfix"></div>
            <job-section v-for="section in sections" :section="section"></job-section>
        </div>

    </div>
@stop

@include('_layout.footer')
