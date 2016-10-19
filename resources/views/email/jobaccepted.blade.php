@extends('_layout.email',['preheader'=>'Job has been accepted'])

@section('title', 'Sanika System Notification')

@section('content')
<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #fff; border-radius: 3px;" width="100%">

    <!-- START MAIN CONTENT AREA -->
    <tr>
        <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                <tr>
                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                        <p style="font-family: sans-serif; font-size: 18px; color: #FFFFFF; text-align: center; background-color: #48C9B0; text-transform: uppercase; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                            Job Accepted
                        </p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                            <strong>{{$job->order_number}} - {{$job->name}}</strong><br/><br/>
                            Address: 
                            <a href="https://maps.google.com?q={{$job->address}}, {{$job->suburb}}, {{$job->city}}, {{$job->country}}">
                                {{$job->address}},
                                {{$job->suburb}},
                                {{$job->city}},
                                {{$job->country}}
                            </a><br/>
                            <strong>Monday the 12th September</strong> is the provisional start date.
                        </p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                            @foreach($job->sections as $sectionKey => $section)
                                @if($section->accepted)
                                    Area - <strong>{{$section->name}}</strong><br/>
                                    @foreach($section->options as $optionKey => $option)
                                        @if($option->accepted)
                                            Scope - <strong>{{$option->name}}</strong>
                                            <ol>
                                                <li>
                                                    <strong>Establish site and safe working procedures</strong><!-- <br/>
                                                    Establish site and safe working procedures in accordance with  OSH and client requirements -->
                                                </li>
                                                @foreach($option->tasks as $taskKey => $task)
                                                <li>
                                                    <strong>{{$task->name}}</strong><br/>
                                                    {{$task->description}}
                                                </li>
                                                @endforeach
                                                <li>
                                                    <strong>Clean and de-establish site</strong><!-- <br/>
                                                    Clean and de-establish site -->
                                                </li>
                                            </ol>
                                            @include('email.option.materiallist')
                                        @endif
                                    @endforeach
                                @endif
                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-top: 15px; page-break-before: always; text-align: center">------------------------------------------</p>
                            @endforeach
                        </p>
                        <!-- <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;" width="100%">
                        <tbody>
                        <tr>
                        <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                        <tbody>
                        <tr>
                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;" valign="top" bgcolor="#3498db" align="center"> <a href="http://htmlemail.io" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">View Job</a> </td>
                        </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                        </tbody>
                        </table> -->
                    </td>
                </tr>
            </table>
        </td>
    </tr>

<!-- END MAIN CONTENT AREA -->
</table>
@stop