@extends('_layout.default',['vueView'=>'job-list-view'])

@section('pagetitle', 'Jobs')

@section('head')
@parent
<meta name="description" content="">
@stop


@section('header', '<h4 class="pull-left page-title">Jobs</h4>')

@section('content')
    <modal-job-status></modal-job-status>
    <a href="/jobs/new" class="btn btn-inverse pull-right"><i class="fui-plus"></i> New Job</a>
    <div class="clearfix"></div>
    @include('_layout.form_errors')
    <table class="table">
        <!-- <thead>
            <tr>
                <td width="12%">Ref Number</td>
                <td width="10%">Client</td>
                <td>Name</td>
                <td width="8%" class="text-center">Status</td>
                <td width="20%" class="text-center">Action</td>
            </tr>
        </thead> -->
        <tbody>
        @if(!$jobs->isEmpty())
            @foreach($jobs as $job)
                <tr>
                    <td width="15%"><strong>{{$job->order_number}}</strong></td>
                    <td>
                        <span @click="showSections('{{$job->id}}')"><strong>{{$job->name}} <span :class="{ 'fui-triangle-up-small': jobs['{{$job->id}}'].show, 'fui-triangle-down-small': !jobs['{{$job->id}}'].show }" v-if="jobs['{{$job->id}}'].sections>0"></span></strong></span>
                        @foreach($job->sections as $section)
                        <div v-if="jobs['{{$job->id}}'].show" style="margin-left: 10px; margin-top: 5px;">
                            {{$section->name}}
                            <ol>
                                @foreach($section->options as $option)
                                    <li>{{$option->name}} - <span class="{{$option->accepted ? 'text-primary':'text-muted'}}">{{$option->accepted ? 'Accepted':'Pending'}}</span></li>
                                @endforeach
                            </ol>
                        @endforeach
                    </td>
                    <td width="15%">{{$job->contacts->first()->company->name}}</td>
                    <td width="10%" class="text-center"><button class="btn btn-xs {{$job->status=='build'?'btn-default':($job->status=='pending'?'btn-info':'btn-primary')}}" {!!$job->status=='build'?'': '@click="$root.$broadcast(\'modal-job-status:open\', '.$job->id.','.$job->name.')")'!!}>{{$job->status}}</button></td>
                    <td width="13%" class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a href="{{ url('/jobs/'.$job->id.'/build') }}" class="btn btn-xs btn-embossed btn-inverse" data-toggle="tooltip" data-placement="bottom" title="Add Job Tasks"><span class="fui-list" style="margin-top: 0;"></span></a>
                            <a class="btn btn-xs btn-embossed btn-default" data-toggle="tooltip" data-placement="bottom" title="Edit Job Details"><span class="fui-new" style="margin-top: 0;"></span></a>
                            <a class="btn btn-xs btn-embossed btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Job"><span class="fui-cross" style="margin-top: 0;"></span></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop

@include('_layout.footer')

@section('pagescript')

<script type="text/javascript">
    $(function() {
        $('[data-toggle=tooltip]').tooltip();
    });
</script>
@stop
