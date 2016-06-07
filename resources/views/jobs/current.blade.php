@extends('_layout.default')

@section('pagetitle', 'Jobs')

@section('head')
@parent
<meta name="description" content="">
@stop


@section('header', '<h4 class="pull-left page-title">Jobs</h4>')

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th width="18%">Ref Number</th>
                <th width="10%">Client</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
        @if(!$jobs->isEmpty())
            @foreach($jobs as $job)
                <tr>
                    <td>{{$job->order_number}}</td>
                    <td>{{$job->contacts[0]->company->name}}</td>
                    <td>
                       <a href="{{ url('jobs/current/'.$job->id) }}">{{$job->name}}</a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop

@section('pagescript')

<script type="text/javascript">
    $(function() {
        $('[data-toggle=tooltip]').tooltip();
    });
</script>
@stop
