@extends('_layout.default')

@section('pagetitle', 'Jobs')

@section('head')
@parent
<meta name="description" content="">
@stop


@section('header', '<h4 class="pull-left page-title">Job</h4>')

@section('content')
    <a href="/jobs/newjob" class="btn btn-inverse pull-right"><i class="fui-plus"></i> New Job</a>
    <div class="clearfix"></div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td width="12%">Order Number</td>
                <td width="20%">Client</td>
                <td>Name</td>
                <td width="10%" class="text-right">Status</td>
            </tr>
        </thead>
        <tbody>
        @foreach($jobs as $job)
            <tr>
                <td>{{$job->id}}</td>
                <td>
                    <strong>{{$job->username}}</strong>
                </td>
                <td>{{$job->message}}</td>
                <td>{{$job->calendar}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
