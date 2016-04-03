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
                <td width="10%" class="text-center">Status</td>
                <td width="10%" class="text-center">Action</td>
            </tr>
        </thead>
        <tbody>
        @if(!$jobs->isEmpty())
            @foreach($jobs as $job)
                <tr>
                    <td>{{$job->order_number}}</td>
                    <td>{{$job->contacts[0]->company->name}}</td>
                    <td>
                        <strong>{{$job->name}}</strong>
                    </td>
                    <td class="text-center"><span class="label {{$job->status=='build'?'label-default':'label-primary'}}">{{$job->status}}</span></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a class="btn btn-xs btn-embossed btn-inverse" ><i class="fui-list"></i></a>
                            <a class="btn btn-xs btn-embossed btn-default" ><i class="fui-new"></i></a>
                            <a class="btn btn-xs btn-embossed btn-danger" ><i class="fui-cross"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop