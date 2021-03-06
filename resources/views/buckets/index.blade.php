@extends('_layout.default')

@section('pagetitle', 'Bucket')

@section('head')
@parent
<meta name="description" content="">
@stop


@section('header')
    <h1>Bucket</h1>
@stop

@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <td width="3%">id</td>
            <td width="8%">Name</td>
            <td>Message</td>
            <td width="18%">Reminder</td>
        </tr>
    </thead>
    <tbody>
    @foreach($buckets as $bucket)
        <tr>
            <td>{{$bucket->id}}</td>
            <td>
                <strong>{{$bucket->username}}</strong>
            </td>
            <td>{{$bucket->message}}</td>
            <td>{{$bucket->calendar}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
