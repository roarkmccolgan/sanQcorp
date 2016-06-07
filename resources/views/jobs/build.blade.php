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
    <form name="myform" action="/pdf" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="name" value="@{{filename}}">
        <input type="hidden" name="html" value="">
        <button type="submit" @click="loadproposal">Download Proposal</button>
    </form>
	<form action="{{url('/jobs/'.$job->id.'/build/')}}" method="POST" enctype="">
    {{ csrf_field() }}
    <input type="hidden" name="job_id" value="{{$job->id}}">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <span class="btn btn-primary btn-embossed btn-file">
                        <span class="fileinput-new"><span class="fui-upload"></span>&nbsp;&nbsp;Add Area Diagram</span>
                        <span class="fileinput-exists"><span class="fui-gear"></span>&nbsp;&nbsp;Change</span>
                        <input id="fileUploadFile" type="file" @change="bindFile">
                    </span>
                    <span class="fileinput-filename"></span>
                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                </div>
            </div>
            <!-- <div class="literally">

            </div> -->
    		<button class="btn btn-primary pull-right" style="margin-top: 15px;" @click.prevent="addSection"><i class="fui-plus"></i></button>
            <h4>Area</h4>
            <hr>
            <div class="clearfix"></div>
            <div v-for="(key, section) in sections">
                <job-section :section="section" :systems="systems" :key="key" :remove-section="removeSection"></job-section>
            </div>
        	<div class="form-group">
        		<button type="submit" v-bind:class="{'disabled': !can_save}" class="btn btn-info btn-lg">Save</button> <!-- @click.prevent="saveJob" -->
        	</div>
        </div>
        <div class="col-md-4">
            @include('proposal.proposal')
        </div>
    </div>
    </form>
@stop

@include('_layout.footer')

@section('pagescript')
<script type="text/javascript">
    //$("select").select2({dropdownCssClass: 'dropdown-inverse'});
    /*$(document).ready(function() {
            var lc = LC.init(
                document.getElementsByClassName('literally')[0]);
            
            var newImage = new Image()
            newImage.src = '/test.png';
            console.log(LC);
            lc.saveShape(LC.createShape('Image', {x: 10, y: 10, image: newImage}));
          });*/
</script>
@stop
