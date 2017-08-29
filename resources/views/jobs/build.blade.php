@extends('_layout.default',['vueView'=>'job-build-view'])

@section('pagetitle', 'Build '.$job->order_number.' - '.$job->name)

@section('head')
@parent
<meta name="description" content="">
@stop

@section('afterbody')
<div class="cssload-container" id="pageLoader">
    <div class="cssload-whirlpool"></div>
</div>
@stop


@section('header')
	<div class="row">
		<div class="col-md-8">
			<h4 class="page-title">{{$job->order_number.' - '.$job->name}}</h4>
		</div>
        <div class="col-md-4 text-right">
            <form name="myform" action="/pdf" method="post" target="_blank">
                {{ csrf_field() }}
                <input type="hidden" name="name" value="@{{filename}}">
                <input type="hidden" name="html" value="">
                <a href="#" class="btn btn-default" @click.prevent="showproposal=!showproposal">
                    <span class="fui-document"></span>
                    <span v-show="!showproposal">Preview</span>
                    <span v-show="showproposal">Hide</span>
                </a>
                <button class="btn btn-primary" type="submit" @click="loadproposal"><span class="fui-clip"></span> Download</button>
            </form>
        </div>
	</div>
@stop

@section('content')
	<form action="{{url('/jobs/'.$job->id.'/build/')}}" method="POST" enctype="" id="saveBuildForm" v-on:submit="onSubmit">
    {{ csrf_field() }}
    <input type="hidden" name="job_id" value="{{$job->id}}">
    <input type="hidden" id="proposal_html" name="html" value="">
    <div class="row">
        <div v-bind:class="{ 'col-md-6': showproposal, 'col-md-12': !showproposal }">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Sales Rep</label>
                        <select name="user_id" v-model="user_id" class="form-control">
                            <option v-for="user in users" v-bind:value="user.id">@{{user.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Proposal Title 1</label>
                        <select v-model="proposaltitle1" class="form-control" name="title1">
                            <option v-for="title in proposaltitle1options" v-bind:value="title">@{{title}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Proposal Title 2</label>
                        <select v-model="proposaltitle2" class="form-control" name="title2">
                            <option v-for="title in proposaltitle2options" v-bind:value="title">@{{title}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Custom Title</label>
                        <input type="text" name="title" v-model="customproposal" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group text-center">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-primary btn-embossed btn-file">
                                <span class="fileinput-new"><span class="fui-upload"></span>&nbsp;&nbsp;Main Image</span>
                                <span class="fileinput-exists"><span class="fui-gear"></span>&nbsp;&nbsp;Change</span>
                                <input id="fileUploadFile" type="file" @change="bindFile($event,'main')" >
                                <input type="hidden" v-model="mainImage.id" name="mainPhoto[id]" >
                                <input type="hidden" v-model="mainImage.photo" name="mainPhoto[photo]" >
                            </span>
                            <span class="fileinput-filename">@{{mainImage.photo}}</span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                            <button class="btn btn-inverse pull-right" @click.prevent="addPhoto()" style=""><i class="fui-image"></i>&nbsp;&nbsp;Extra Images</button>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-12 lc">
                    <!-- Literally Canvas  Do not delete-->
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <template v-for="(imageKey, image) in images">
                            <div class="col-sm-4">
                                <div class="form-group text-center">
                                    <div class="uploader clearfix" style="position: relative; display: inline-block;">
                                        <span class="fui-cross-circle text-danger" style="position: absolute; right: -12px; top: 2px; z-index: 1" @click="removePhoto(imageKey)"></span>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn btn-inverse btn-sm btn-embossed btn-file">
                                                <span class="fileinput-new"><span class="fui-upload"></span>&nbsp;&nbsp;Add image</span>
                                                <span class="fileinput-exists"><span class="fui-gear"></span>&nbsp;&nbsp;Change</span>
                                                <input id="fileUploadFile" type="file" @change="bindFile($event,imageKey)">
                                                <input type="hidden" v-model="image.id" name="photos[@{{imageKey}}][id]" >
                                                <input type="hidden" v-model="image.photo" name="photos[@{{imageKey}}][photo]" >
                                            </span>
                                            <br/><span class="fileinput-filename">@{{image.photo}}</span>
                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="area">
                        <div class="row">
                            <div class="col-md-12" style="margin: 10px 0; padding-bottom: 10px;">
                                <strong>Sections</strong>
                                <button class="btn btn-primary pull-right clearfix" @click.prevent="addSection" style=""><i class="fui-plus"></i> Area</button>  
                            </div>
                        </div>
                        <div v-for="(key, section) in sections">
                            <job-section
                                :laravel="laravel"
                                :section="section"
                                :systems="systems"
                                :key="key"
                                :remove-section="removeSection"
                                :bind-file="bindFile"
                                :load-materials="loadMaterials"
                                :add-term="addTerm"
                                :add-photo="addPhoto"
                                :pandg-total="pandgTotal"
                                :remove-photo="removePhoto"
                                :materials="materials"
                                :basic-systems="basicSystems"
                                :terms="terms">
                            </job-section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            Are there any <strong>P's &amp; G's</strong>?
                        </div>
                        <div class="col-md-7">
                            <input v-switch:hello="showpandg" type="checkbox" data-on-text="Yes" data-off-text="No" {{isset($job->pandg) && !empty($job->pandg) > 0 ? "checked":""}} />
                        </div>
                    </div>
                    <div class="row" v-if="showpandg">
                        <div class="clearfix" style="height: 20px;"></div>
                        <div class="col-md-12">
                            <form id="newtaskForm">
                                <div class="row">
                                    <div class="col-xs-12 form-group">
                                        <input type="text" class="form-control" placeholder="Name" id="new-pandg-name" />
                                    </div>
                                    <div class="col-xs-3 form-group">
                                        <select class="form-control" id="new-pandg-period">
                                            <option value="fixed">Fixed</option>
                                            <option value="daily">Daily</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3 form-group">
                                        <input type="text" class="form-control" placeholder="Rate" id="new-pandg-rate" />
                                    </div>
                                    <div class="col-xs-3 form-group">
                                        <input type="text" class="form-control" placeholder="Qty" id="new-pandg-qty" />
                                    </div>
                                    <div class="col-xs-3 form-group">
                                        <button class="btn btn-primary" @click.prevent="addPandG($event)">Add P &amp; G</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <strong>P's &amp; G's</strong>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Term</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(pandgKey, pandg) in jobpsandgs">
                                            <td>@{{pandg.name}}</td>
                                            <td>@{{pandg.period}}</td>
                                            <td>@{{pandg.rate | currency 'R'}}</td>
                                            <td>@{{pandg.qty}}</td>
                                            <td>
                                                @{{pandg.rate*pandg.qty | currency 'R'}} <span class="fui-cross-circle text-danger" @click="removePandG(pandgKey)"></span>
                                                <input type="hidden" name="psandgs[@{{pandgKey}}][id]" value="@{{pandg.id}}">
                                                <input type="hidden" name="psandgs[@{{pandgKey}}][name]" value="@{{pandg.name}}">
                                                <input type="hidden" name="psandgs[@{{pandgKey}}][period]" value="@{{pandg.period}}">
                                                <input type="hidden" name="psandgs[@{{pandgKey}}][rate]" value="@{{pandg.rate}}">
                                                <input type="hidden" name="psandgs[@{{pandgKey}}][qty]" value="@{{pandg.qty}}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Terms -->
            <div class="row">
                <div class="col-sm-12" style="border-top: 1px solid #bdc3c7; margin-top: 20px; padding-top: 10px;">
                    <div class="row">
                        <div class="col-xs-10">
                            <strong @click.prevent="showTerms = !showTerms">Terms and Conditions</strong>
                        </div>
                        <div class="col-xs-2">
                            <button class="btn btn-default pull-right btn-xs" v-show="!showTerms" @click.prevent="showTerms = !showTerms" style="margin-left: 10px;"><i class="fui-triangle-down-small"></i></button>
                            <button class="btn btn-default pull-right btn-xs" v-show="showTerms" @click.prevent="showTerms = !showTerms" style="margin-left: 10px;"><i class="fui-triangle-up-small"></i></button>
                        </div>
                    </div>
                    <table class="table table-condensed table-bordered terms" v-show="showTerms">
                        <tbody>
                            <tr v-for="(termKey, term) in terms">
                                <td class="text-center" v-bind:class="{ 'selected': checkedTerms.indexOf(term.id)!=-1 }">
                                    <label class="checkbox no-label">
                                        <input type="checkbox" id="@{{term.id}}" name="terms[]" data-toggle="checkbox" v-model="checkedTerms" style="margin-left: 0;" value="@{{term.id}}" number>
                                    </label>
                                </td>
                                <td v-bind:class="{ 'selected': checkedTerms.indexOf(term.id)!=-1 }">@{{term.term}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" v-bind:class="{'disabled': !can_save}" class="btn btn-info btn-lg">Save</button> <!-- @click.prevent="saveJob" -->
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <small v-if="revisions.length > 0">
                        Restore Proposal to a previous revision:<br/>
                        <a v-for="revision in revisions" href="{{url('api/revision')}}/@{{revision.id}}" class="btn btn-xs btn-inverse" @click="confirmRevise($event)">@{{revision.id}}:@{{revision.created_at | moment 'DDMMYY'}}</a>
                    </small>
                </div>
            </div>
        </div>
        <div v-bind:class="{ 'col-md-6': showproposal, 'hidden': !showproposal }">
            <div class="" style="width: 100%; overflow: scroll; -webkit-box-shadow: 0px 0px 17px 0px rgba(0,0,0,0.47);-moz-box-shadow: 0px 0px 17px 0px rgba(0,0,0,0.47);box-shadow: 0px 0px 17px 0px rgba(0,0,0,0.47);zoom: 0.65;-moz-transform: scale(0.65);">
                @include('proposal.'.$job->type)
            </div>
        </div>
    </div>
    </form>
@stop
@include('_layout.footer')

@section('pagescript')
<script src="//cdnjs.cloudflare.com/ajax/libs/react/0.13.3/react-with-addons.js"></script>
<script src="{{asset('js/vendor/literallycanvas.js')}}"></script>
<script src="{{asset('js/vendor/summernote/summernote.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
@stop
