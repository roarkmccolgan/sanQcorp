<style>
    .task{
        border-bottom: 3px solid #bdc3c7;
        border-top: 2px solid #FFF;
        padding: 5px 0;
    }
</style>

<template>
    <div>
        <div class="row" v-show="!section.show">
            <div class="col-xs-12">
                <!-- <div class="row"> -->
                    <div class="tile" style="padding: 5px 5px 5px 20px; text-align: left">
                        <div class="row">
                            <div class="col-xs-10">
                                <h6 @click.prevent="section.show = !section.show">{{section.name}}</h6>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-default pull-right btn-xs" @click.prevent="section.show = !section.show" style="margin-left: 10px;"><i class="fui-triangle-down-small"></i></button>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>                
        </div>
        <input name="section[{{key}}][id]" type="hidden" v-model="section.id" />

        <div class="row" v-show="section.show">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-9">
                        <div class="form-group">
                            <input name="section[{{key}}][name]" type="text" class="form-control input-lg" placeholder="Section Name " v-model="section.name" />
                            <template v-for="(propKey, property) in properties">
                                <input type="hidden" name="section[{{key}}][{{propKey}}]" value="{{property.value}}">
                            </template>
                        </div>
                    </div>
                    <div class="col-sx-3">
                        <button class="btn btn-default pull-right btn-xs" @click.prevent="section.show = !section.show" style="margin-left: 10px; margin-right: 15px;"><i class="fui-triangle-up-small"></i></button>
                        <button class="btn btn-danger pull-right btn-xs" @click.prevent="removeSection(key)"><i class="fui-cross"></i></button>
                        <br/>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control" @change="setSurvey($event)">
                        <option value="">Select Pre-defined survey</option>
                        <option v-for="survey in surveys" v-bind:value="survey.survey">{{ survey.survey }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea id="section_survey_{{key}}" name="section[{{key}}][survey]" class="form-control" rows="3" placeholder="Site Survey" v-model="section.survey"></textarea>
                    <button class="btn btn-inverse pull-right" @click.prevent="addPhoto('','','sections',key)" style=""><i class="fui-image"></i> Section Images</button>
                    <label class="checkbox">
                        <input type="checkbox" value="true" name="section[{{key}}][save_survey]" data-toggle="checkbox">
                        Save Survey in Templates
                    </label>
                </div>
                <div class="row">
                    <!-- <div class="clearfix" style="border-radius: 5px; border: 1px solid #CCC;padding: 20px 0"> -->
                    <template v-for="(imageKey, image) in section.images">
                        <div class="col-xs-4">
                            <div class="form-group text-center">
                                <div class="uploader clearfix" style="position: relative; display: inline-block;">
                                    <span class="fui-cross-circle text-danger" style="position: absolute; right: -12px; top: 2px; z-index: 1" @click="removePhoto(imageKey,'sections',key)"></span>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-inverse btn-sm btn-embossed btn-file">
                                            <span class="fileinput-new"><span class="fui-upload"></span>&nbsp;&nbsp;Add image</span>
                                            <span class="fileinput-exists"><span class="fui-gear"></span>&nbsp;&nbsp;Change</span>
                                            <input id="fileUploadFile" type="file" @change="bindFile($event,imageKey,key)">
                                            <input type="hidden" v-model="section.images[imageKey].id" name="section[{{key}}][photos][{{imageKey}}][id]">
                                            <input type="hidden" v-model="section.images[imageKey].photo" name="section[{{key}}][photos][{{imageKey}}][photo]">
                                        </span>
                                        <br/><span class="fileinput-filename">{{image.photo}}</span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- </div> -->
                </div>
                <div class="clearfix" style="height: 40px;"></div>
                
                <strong>Options</strong><button class="btn btn-primary btn-sm pull-right clearfix" @click.prevent="addOption" style="margin-left: 10px;"><span class="fui-plus"></span> Option</button>
                <div class="clearfix" style="margin-top: 10px;"></div>
                <div class="tile" style="text-align:left" v-show="section.options" v-for="(optionKey, option) in section.options">
                    <job-option
                        :section="section"
                        :key="key"
                        :systems="systems"
                        :basic-systems="basicSystems"
                        :option="option"
                        :option-key="optionKey"
                        :bind-file="bindFile"
                        :laravel="laravel"
                        :remove-option="removeOption"
                        :add-term="addTerm"
                        :properties="properties"
                        :pandg-total="pandgTotal"
                        :bind-file="bindFile"
                        :systems="systems"
                        @property-changed="propChanged">    
                    </job-option>
                </div>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['section','systems','key','removeSection','bindFile','laravel','basicSystems','addTerm','addPhoto','removePhoto','pandgTotal'],
        data: function() {
            return {
                newTask: false,
                //system_selected: '',
                option_system:'',
                surveys: laravel.surveys,
                checkedTasks:[],
                new_material: '',
            };
        },
        computed: {
        },
        components:{
            VueAutocomplete: require('../vue-autocomplete.vue'),
            JobOption: require('./jobOption.vue'),
        },
        methods:{
            propChanged: function(){
                this.$broadcast('materialChanged');
            },
            addOption: function(){
                this.section.options.push({
                    id:'',
                    name: '',
                    description: '',
                    notes: [],//add Laravel here
                    days: '',
                    total_labour: '',
                    total_materials: '',
                    total_cost_price: '',
                    selling_price: '',
                    markup: 100,
                    tasks: [],
                    materials: [],
                    show: true
                });
            },
            removeOption: function(key){
                this.section.options.splice(key);
            },
            getObjSize: function(obj) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                return size;
            },
            setSurvey: function(surv){
                var that = this;
                this.section.survey = $(surv.target).val();
                //CKEDITOR.instances['section_survey_'+this.key].setData($(surv.target).val());
                $('#section_survey_'+this.key).summernote('code', $(surv.target).val());
            },
            cke:function(el){
                var that = this;
                CKEDITOR.replace(el);
                /*CKEDITOR.instances[el].on('change', function() {
                    that.section.survey = this.document.getBody().getHtml();
                });*/
            },
            smn:function(el){
            //console.log(summernote);
                var that = this;
                $('#'+el).summernote({
                    callbacks: {
                        onChange: function(contents) {
                            that.section.survey = contents;
                        }
                    }
                });
            }
            
        },
        ready(){
            if(this.section.options=='') this.addOption();
            /*if(this.section.photos.length > 0){
                for (var i = this.section.photos.length - 1; i >= 0; i--) {
                    console.log('dude!',this.section.photos[i].id,this.section.photos[i].photo);
                    this.addPhoto(this.section.photos[i].id,this.section.photos[i].photo,'sections',this.key);
                }
            }*/
            //this.cke('section_survey_'+this.key);
            this.smn('section_survey_'+this.key);
        }
    };
</script>
