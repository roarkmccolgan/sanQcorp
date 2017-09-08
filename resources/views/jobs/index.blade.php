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
                <tr id="job-{{$job->id}}">
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
                    <td width="10%" class="text-center">
                        <button class="btn btn-xs {{$job->status=='build'?'btn-default':($job->status=='pending'?'btn-info':'btn-primary')}}" {!!$job->status=='build' ? '' : '@click="$root.$broadcast(\'modal-job-status:open\', '.$job->id.',\''.$job->name.'\')")'!!} {{$job->status=='build'?'disabled':''}}>
                            {{$job->status}}
                        </button></td>
                    <td width="10%" class="text-center">
                        @if(file_exists(public_path().'/uploads/job/'.$job->order_number.'/'.$job->order_number.'-'.$job->name.'.pdf'))
                            <a href="{{'/uploads/job/'.$job->order_number.'/'.$job->order_number.'-'.$job->name.'.pdf'}}" class="fui-clip" target="_blank" title="PDF" style="margin-top: -20px"></a>
                        @endif
                    </td>
                    <td width="20%" class="text-right" style="padding-right:0">
                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                            <a href="{{ url('/jobs/'.$job->id.'/build') }}" class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="bottom" title="Add Job Tasks">build</a>
                            <a class="btn btn-xs btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Job Details">edit</a>
                            <a class="btn btn-xs btn-link" href="{{url('api/job/delete/')}}" data-toggle="tooltip" data-placement="bottom" title="Delete Job" @click.prevent="deleteJob('{{$job->name}}',{{$job->id}}, $event)"><span class="text-danger">delete</span></a>
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
