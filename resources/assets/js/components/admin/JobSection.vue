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
                    <div class="col-md-12">
                        <button class="btn btn-default pull-right btn-xs" @click.prevent="section.show = !section.show" style="margin-left: 10px;"><i class="fui-triangle-up-small"></i></button>
                        <button class="btn btn-danger pull-right btn-xs" @click.prevent="removeSection(key)"><i class="fui-cross"></i></button>
                        <br/>
                        <!-- <h6 style="margin: 0">{{section.name}}</h6> -->
                        <div class="form-group">
                            <input name="section[{{key}}][name]" type="text" class="form-control input-lg" placeholder="Section Name" v-model="section.name" />
                            <template v-for="(propKey, property) in properties">
                                <input type="hidden" name="section[{{key}}][{{propKey}}]" value="{{property.value}}">
                            </template>
                        </div>
                        <div class="form-group">
                            <select class="form-control" @change="setSurvey($event)">
                                <option value="">Select</option>
                                <option v-for="survey in surveys" v-bind:value="survey">{{ survey }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="section[{{key}}][survey]" class="form-control" rows="3" placeholder="Site Survey" v-model="section.survey"></textarea>
                        </div>
                        <div class="row">
                            <template v-for="(imageKey, image) in images">
                                <div class="col-sm-4" v-if="imageKey!='main'">
                                    <div class="form-group text-center">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn btn-inverse btn-sm btn-embossed btn-file">
                                                <span class="fileinput-new"><span class="fui-upload"></span>&nbsp;&nbsp;Add image</span>
                                                <span class="fileinput-exists"><span class="fui-gear"></span>&nbsp;&nbsp;Change</span>
                                                <input name="section[{{key}}][photos][{{imageKey}}]" id="fileUploadFile" type="file" @change="bindFile($event,imageKey)">
                                            </span>
                                            <span class="fileinput-filename">{{image}}</span>
                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="clearfix"></div>
                        <strong>Options</strong><button class="btn btn-primary btn-sm" @click.prevent="addOption" style="margin-left: 10px;"><span class="fui-plus"></span></button>
                    </div>
                </div>
                <div class="clearfix" style="margin-top: 10px;"></div>
                <div class="tile" style="text-align:left" v-show="section.options" v-for="(optionKey, option) in section.options">
                    <input name="section[{{key}}][options][{{optionKey}}][id]" type="hidden" v-model="option.id" />
                    <div class="row">
                        <template v-if="option.system">
                            <input type="hidden" name="section[{{key}}][options][{{optionKey}}][system]" value="{{option.system.id}}">
                            <div class="col-md-12">
                                <button class="btn btn-danger btn-xs pull-right" style="z-index:1" @click.prevent="removeOption(optionKey)"><i class="fui-cross"></i></button><br>
                                <div class="form-group">
                                    <input name="section[{{key}}][options][{{optionKey}}][name]" type="text" class="form-control" placeholder="Option #" v-model="option.name" value="{{option.system.alias}}" />
                                </div>
                                <div class="form-group">
                                    <textarea name="section[{{key}}][options][{{optionKey}}][description]" class="form-control" rows="2" placeholder="Explanation / description" v-model="option.description">{{option.system.description}}</textarea>
                                </div>
                            </div>
                        </template>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="system">Select System</label>
                                <select v-model="option.system" class="form-control">
                                    <option value=""></option>
                                    <option v-for="system in systems" v-bind:value="system">{{system.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="option.system">
                            <div class="row" style="margin-bottom:14px">
                                <div class="col-xs-12">
                                    <strong>Parameters</strong>
                                </div>
                                <div class="col-xs-4" v-for="(propKey, property) in properties">
                                    <div class="input-group">
                                        <input name="section[{{key}}][options][{{optionKey}}][properties][{{propKey}}]" type="number" class="form-control" placeholder="{{propKey}}" v-model="property.value" number @keyup="setProperty | debounce 500" />
                                        <span class="input-group-addon">{{property.uom}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12" v-if="option.system">
                            <div style="margin-bottm: 5px;">
                                <button class="btn btn-primary pull-right btn-sm" @click.prevent="newTask=!newTask">New Task</button>
                                <strong>Tasks:</strong>
                            </div>
                            <div class="clearfix"></div>
                            <div class="" v-show="newTask">
                                <form id="newtaskForm">
                                    <div class="row">
                                        <div class="col-xs-4 form-group">
                                            <input type="text" class="form-control" placeholder="Name" id="custom-task-name" />
                                        </div>
                                        <div class="col-xs-8 form-group">
                                            <textarea class="form-control" rows="1" placeholder="Description" id="custom-task-description"></textarea>
                                        </div>
                                        <div class="col-xs-12 form-group">
                                            <select class="form-control" data-toggle="select" id="custom-task-existing">
                                                <option value="">Select from Existing</option>
                                                <template v-for="system in systems">
                                                    <optgroup label="{{system.name}}">
                                                        <option v-for="(taskKey, task) in system.tasks" v-if="!option.system.tasks.hasOwnProperty(taskKey)" value="{{task}}">{{task.name}}</option>
                                                    </optgroup>
                                                </template>
                                            </select>
                                        </div>
                                        <div class="col-xs-4 form-group">
                                            <select class="form-control" data-toggle="select" id="custom-task-property">
                                                <option>Property</option>
                                                <option v-for="(propertyKey, property) in properties" value="{{propertyKey}}">{{propertyKey}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-3 form-group">
                                            <input type="text" class="form-control" placeholder="Rate/day/crew of 4" id="custom-task-rate" />
                                        </div>
                                        <div class="col-xs-2 form-group">
                                            <select class="form-control" data-toggle="select" id="custom-task-order">
                                                <option>Position</option>
                                                <option v-for="task in option.system.tasks" value="{{task.pivot ? task.pivot.order : task.order}}">{{task.pivot ? task.pivot.order : task.order}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-3 form-group">
                                            <button class="btn btn-primary" @click.prevent="customTask(optionKey)">Add Task</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <table class="table table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="20px"><label class="checkbox no-label toggle-all" for="checkbox-table-1"><input type="checkbox" value="" id="checkbox-table-1" data-toggle="checkbox" style="margin-left: 0;"></label></th>
                                        <th style="padding: 5px 5px;">&nbsp;</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(taskKey, task) in option.system.tasks" data-order="{{task.pivot ? task.pivot.order : task.order}}"><!-- systems[option.system.id].tasks -->
                                        <td class="text-center">
                                            <label class="checkbox no-label" for="{{task.name}}">
                                                <input type="checkbox" id="{{taskKey}}" name="section[{{key}}][options][{{optionKey}}][tasks][{{taskKey}}][id]" value="{{task.id}}" data-toggle="checkbox" v-model="checkedTasks" @click="addTask($event,optionKey,task)" style="margin-left: 0;">
                                            </label>
                                        </td>
                                        <td style="padding: 5px 5px;">{{task.pivot ? task.pivot.order : task.order}}</td>
                                        <td><strong class="text-primary">{{task.name}}</strong><br/>{{task.description}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                            <div style="margin-bottm: 5px;">
                                <button class="btn btn-primary pull-right btn-sm" @click.prevent="addNote(optionKey)">add Note</button>
                                <strong>Notes:</strong>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" v-for="(noteKey, note) in option.notes">
                                <input type="hidden" name="section[{{key}}][options][{{optionKey}}][notes][{{note.id}}][id]" value="{{note.id}}">
                                <button class="btn btn-danger btn-xs pull-right" style="z-index:1" @click.prevent="removeNote(noteKey,optionKey)"><i class="fui-cross"></i></button><br>
                                <textarea name="section[{{key}}][options][{{optionKey}}][notes][{{note.id}}][note]" class="form-control" rows="3" placeholder="" v-model="note.note"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="option.orderedTasks">
                            <!-- <component v-for="(taskKey, task) in option.tasks" :is="task.alias" :task="task" :task-key="taskKey" :option="option" :option-key="optionKey" :section-key="key"></component> -->
                            <template v-for="task in option.orderedTasks | orderBy 'order'">
                                <component
                                    :is="task.component"
                                    :task="task"
                                    :task-key="task.alias"
                                    :option="option"
                                    :option-key="optionKey"
                                    :section="section"
                                    :section-key="key"
                                    :properties="properties"
                                    :set-defaults="setDefaults"
                                    @task-changed="taskChange"></component>
                            </template>

                            <!--materials -->
                            <div class="panel panel-default" style="margin-top: 20px;">
                            <!-- Default panel contents -->
                                <div class="panel-heading">
                                    Material List
                                </div>
                                <!-- Table -->
                                <table class="table table-condensed table-bordered">
                                    <!-- <thead>
                                        <tr>
                                            <th width="10%">Type</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th width="23%">Cost Price</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        <template v-for="(taskKey, task) in option.selectedTasks">
                                            <tr v-for="(material_type, material) in systems[option.system.id].tasks[taskKey].materials">
                                                <td>{{material_type}}</td>
                                                <td>
                                                    <template v-if="getObjSize(material)>1">
                                                        <select name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][material_id]" v-model="option.selectedTasks[taskKey].materials[material_type].id" class="form-control input-sm"  @change="setMaterial(optionKey,taskKey,material_type)">
                                                            <option v-for="(material_id, chosen_material) in material" v-bind:value="material_id">{{chosen_material.name}}</option>
                                                        </select>
                                                    </template>
                                                    <template v-else>
                                                        <template v-for="(material_id, chosen_material) in material">
                                                            <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][material_id]" type="hidden" v-model="option.selectedTasks[taskKey].materials[material_type].id">
                                                            {{chosen_material.name}}
                                                        </template>
                                                    </template>
                                                </td>
                                                <td>
                                                    {{option.selectedTasks[taskKey].materials[material_type].qty}}
                                                    <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][qty]" type="hidden" v-model="option.selectedTasks[taskKey].materials[material_type].qty">
                                                </td>
                                                <td>
                                                    {{option.selectedTasks[taskKey].materials[material_type].price | currency 'R'}}
                                                    <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][price]" type="hidden" v-model="option.selectedTasks[taskKey].materials[material_type].price">
                                                    <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][cost_price]" type="hidden" v-model="option.selectedTasks[taskKey].materials[material_type].cost_price">
                                                </td>
                                            </tr>
                                        </template>
                                        <tr v-for="(matKey, material) in option.materials">
                                            <td colspan="2">
                                                {{material.name}}
                                            </td>
                                            <td>
                                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{material.material_type}}][qty]" type="text" class="form-control input-sm" v-model="option.materials[matKey].qty">
                                            </td>
                                            <td>
                                                {{material.price | currency 'R'}}
                                                <button class="btn btn-danger btn-xs pull-right" style="z-index:1" @click.prevent="removeMaterial(matKey,optionKey)"><i class="fui-cross"></i></button><br>
                                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][price]" type="hidden" v-model="option.materials[matKey].price">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="margin: 5px;">
                                    <vue-autocomplete
                                        name="new_material"
                                        param="name"
                                        url="/api/materials"
                                        anchor="name"
                                        placeholder="Add New Material"
                                        label="Material"
                                        limit="5"
                                        model="new_material"
                                        class="form-control input-sm">
                                    </vue-autocomplete>
                                </div>
                            </div>
                            <!-- Travel -->
                            <div class="panel panel-default">
                            <!-- Default panel contents -->
                                <div class="panel-heading">Travel Costs</div>
                                <!-- Table -->
                                <input type="hidden" name="section[{{key}}][options][{{optionKey}}][travel][total_distance]" value="{{(laravel.job.distance*2)*option.days}}">
                                <input type="hidden" name="section[{{key}}][options][{{optionKey}}][travel][total_price]" value="{{((laravel.job.distance*2)*option.days)*5 | currency 'R'}}">
                                <table class="table table-condensed table-bordered">
                                    <!-- <thead>
                                        <tr>
                                            <th width="10%">Type</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th width="23%">Cost Price</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        <tr>
                                            <td>{{laravel.job.distance*2}}km</td>
                                            <td>{{option.days}}days</td>
                                            <td>{{(laravel.job.distance*2)*option.days}}km</td>
                                            <td>{{((laravel.job.distance*2)*option.days)*5 | currency 'R'}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- row -->
                    <!-- Totals -->
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Total Days:</label> <h6 style="margin:0">{{option.days}}</h6>
                                    <input name="section[{{key}}][options][{{optionKey}}][days]" type="hidden" v-model="option.days">
                                </div>
                                <div class="col-sm-8">
                                    <label>Labour Cost Price:</label> <h6 style="margin:0">{{option.total_labour | currency 'R'}}</h6>
                                    <input name="section[{{key}}][options][{{optionKey}}][total_labour]" type="hidden" v-model="option.total_labour">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <label>Supervisor Cost Price:</label> <h6 style="margin:0">{{option.total_supervisor | currency 'R'}}</h6>
                                    <input name="section[{{key}}][options][{{optionKey}}][total_supervisor]" type="hidden" v-model="option.total_supervisor">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <label>Material Cost Price:</label> <h6 style="margin:0">{{option.total_materials | currency 'R'}}</h6>
                                    <input name="section[{{key}}][options][{{optionKey}}][total_materials]" type="hidden" v-model="option.total_materials">
                                </div>
                            </div>
                            <div class="row" style="border-bottom: 1px solid #bdc3c7">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <label>Cost Price:</label> <h5 style="margin:0">{{option.total_cost_price | currency 'R'}}</h5>
                                    <input name="section[{{key}}][options][{{optionKey}}][total_cost_price]" type="hidden" v-model="option.total_cost_price">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Markup %</label>
                                    <input name="section[{{key}}][options][{{optionKey}}][markup]" type="number" class="form-control" placeholder="Markup %" v-model="option.markup" number />
                                </div>
                                <div class="col-sm-8">
                                    <label>Selling Price:</label> <h3 style="margin:0">{{option.total_cost_price+((option.total_cost_price/100)*option.markup) | currency 'R'}}</h3>
                                    <input name="section[{{key}}][options][{{optionKey}}][selling_price]" type="hidden" v-model="option.total_selling_price">
                                    <small>{{(option.total_cost_price+((option.total_cost_price/100)*option.markup))/properties.size.value | currency 'R'}} /m2</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['section','systems','key','removeSection','bindFile','images','laravel'],
        data: function() {
            return {
                newTask: false,
                //system_selected: '',
                option_system:'',
                properties:{
                    size: {value: this.section.size ? this.section.size:0, uom: 'm2'},
                    perimeter: {value: this.section.perimeter ? this.section.perimeter:0, uom: 'lm'},
                },
                surveys: [
                    'After conducting an intensive survey of the aforementioned site, we discovered a number various water penetration points.',
                    'We have based the below quoation on the issues you discussed with yourselves telephonically',
                    'The Site is bad'
                ],
                checkedTasks:[],
                new_material: ''
            };
        },
        computed: {
        },
        components:{
            VueAutocomplete: require('../vue-autocomplete.vue'),
            ConcreteMineralTorchOnSystem: require('../systems/ConcreteMineralTorchOnSystem.vue'),
            SanikaBoardedMineralTorchOnSystem: require('../systems/SanikaBoardedMineralTorchOnSystem.vue'),
            //tasks
            stripping: require('../tasks/stripping.vue'),
            screedrepair: require('../tasks/screedrepair.vue'),
            primetorch: require('../tasks/primetorch.vue'),
            torchmineral: require('../tasks/torchmineral.vue'),
            torchplain: require('../tasks/torchplain.vue'),
            acrylicflashing: require('../tasks/acrylicflashing.vue'),
            custom: require('../tasks/custom.vue'),
        },
        events:{
            'autocomplete-new_material:selected': function(data){
                console.log(data);
            }
        },
        methods:{
            taskChange: function(optionKey,taskType,days,labour,supervisor,materials,price){
                //console.log(optionKey,taskType,days,labour,supervisor,materials,price);
                //console.log(taskType,materials);
                var total_days = 0;
                var total_labour = 0;
                var total_supervisor = 0;
                var total_materials = 0;
                var total_days = 0;
                var total_price = 0;
                if(this.section.options[optionKey].selectedTasks[taskType]){
                    this.section.options[optionKey].selectedTasks[taskType].days = days;
                    this.section.options[optionKey].selectedTasks[taskType].total_labour = labour;
                    this.section.options[optionKey].selectedTasks[taskType].total_supervisor = supervisor;
                    this.section.options[optionKey].selectedTasks[taskType].total_materials = materials;
                    this.section.options[optionKey].selectedTasks[taskType].total_cost_price = price;
                }
                for (var key in this.section.options[optionKey].selectedTasks) {
                    if (this.section.options[optionKey].selectedTasks.hasOwnProperty(key)){
                        total_days+=Number(this.section.options[optionKey].selectedTasks[key].days);
                        total_labour+=Number(this.section.options[optionKey].selectedTasks[key].total_labour);
                        total_supervisor+=Number(this.section.options[optionKey].selectedTasks[key].total_supervisor);
                        total_materials+=Number(this.section.options[optionKey].selectedTasks[key].total_materials);
                        total_price+=Number(this.section.options[optionKey].selectedTasks[key].total_cost_price);
                    };
                }
                this.section.options[optionKey].days = Math.ceil(total_days);
                this.section.options[optionKey].total_labour = total_labour;
                this.section.options[optionKey].total_supervisor = total_supervisor;
                this.section.options[optionKey].total_materials = total_materials;
                this.section.options[optionKey].total_cost_price = total_price+(((laravel.job.distance*2)*total_days)*5);
                this.section.options[optionKey].total_selling_price = this.section.options[optionKey].total_cost_price+((this.section.options[optionKey].total_cost_price/100)*this.section.options[optionKey].markup);
            },
            addOption: function(){
                this.section.options.push({
                    id:'',
                    name: '',
                    description: '',
                    notes: [],//add Laravel here
                    days: '',
                    total_labour: '',
                    total_supervisor: '',
                    total_materials: '',
                    total_cost_price: '',
                    total_selling_price: '',
                    markup: 100,
                    selectedTasks: {},
                    orderedTasks: [],
                    materials: []
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
            addTask: function(e,optionKey,task){
                if(e.target.checked){
                    //console.log(task);
                    var newMaterials = {};
                    for (var key in task.materials) {
                        if (task.materials.hasOwnProperty(key)) {
                            newMaterials[key] = {
                                id: '',
                                name: '',
                                qty: '',
                                cost_price: '',
                                price: '',
                                unit_of_measure: '',
                                pack_size: '',
                                stock: ''
                            }
                        };
                    }
                    var shiftOrder = false;
                    var order = task.pivot ? task.pivot.order: task.order;
                    if(!$.isEmptyObject(this.section.options[optionKey].selectedTasks)){
                        for (var taskKey in this.section.options[optionKey].selectedTasks){
                            if(this.section.options[optionKey].selectedTasks.hasOwnProperty(taskKey)){
                                this.section.options[optionKey].selectedTasks[taskKey].order = this.section.options[optionKey].system.tasks[taskKey].pivot ? this.section.options[optionKey].system.tasks[taskKey].pivot.order : this.section.options[optionKey].system.tasks[taskKey].order;
                            }
                        }
                    }
                    var newTask = {
                        [task.alias]:{
                            id: task.id,
                            alias: task.alias,
                            rate: task.rate,
                            component: task.component ? task.component : task.alias,
                            name: task.name,
                            description: task.description,
                            link_to: task.link_to,
                            order: order,
                            days: '',
                            total_labour_cost_price: '',
                            total_supervisor_price: '',
                            total_material_cost_price: '',
                            total_cost_price: '',
                            materials: newMaterials
                        }
                    };
                    this.section.options[optionKey].selectedTasks = Object.assign({}, this.section.options[optionKey].selectedTasks, newTask);
                    this.section.options[optionKey].orderedTasks = $.map(this.section.options[optionKey].selectedTasks, function(value, index) {
                        return [value];
                    });
                    //this.$set(''+this.section.options[optionKey].selectedTasks[task.alias]+'', newTask);
                }else{
                    var updatedTasks = this.section.options[optionKey].selectedTasks;
                    delete updatedTasks[task.alias];
                    this.section.options[optionKey].selectedTasks = Object.assign({}, this.section.options[optionKey].selectedTasks, updatedTasks);
                    this.section.options[optionKey].orderedTasks = $.map(this.section.options[optionKey].selectedTasks, function(value, index) {
                        return [value];
                    });
                    this.$broadcast('materialChanged');
                }                
            },
            customTask: function(optionKey){
                var existing = $('#custom-task-existing').val();
                var name = $('#custom-task-name').val();
                var component = 'custom';
                var alias = 'custom-'+name.replace(" ", "").toLowerCase();
                var description = $('#custom-task-description').val();
                var link_to = $('#custom-task-property').val();
                var rate = $('#custom-task-rate').val();
                var order = Number($('#custom-task-order').val());
                if(existing==''){
                    var task = {
                        alias: alias,
                        component: component,
                        id: 0,
                        name: name,
                        description: description,
                        link_to: link_to,
                        rate: rate,
                        order: order
                    };
                    var newTasks = {};
                    var shiftOrder = false;
                    for (var taskKey in this.section.options[optionKey].system.tasks){
                        if(this.section.options[optionKey].system.tasks.hasOwnProperty(taskKey)){
                            if((this.section.options[optionKey].system.tasks[taskKey].pivot && this.section.options[optionKey].system.tasks[taskKey].pivot.order===order) || this.section.options[optionKey].system.tasks[taskKey].order===order){
                                newTasks[alias] = task;
                                shiftOrder = true;
                            }
                            if(shiftOrder) this.section.options[optionKey].system.tasks[taskKey].pivot.order++;
                            newTasks[taskKey] = this.section.options[optionKey].system.tasks[taskKey];
                        }
                    }
                    this.section.options[optionKey].system.tasks = Object.assign({}, newTasks);
                    this.newTask = false;
                }else{

                }

            },
            setSurvey: function(surv){
                this.section.survey = $(surv.target).val();
            },
            addNote: function(optionKey){
                this.section.options[optionKey].notes.push({
                    id: '',
                    note: ''
                });
            },
            removeNote: function(noteKey,optionKey){
                this.section.options[optionKey].notes.splice(noteKey);
            },
            addMaterial: function(optionKey){
                this.section.options[optionKey].materials.push({
                    id: '',
                    material_type: '',
                    qty: '',
                    price: ''
                });
            },
            removeMaterial: function(matKey,optionKey){
                this.section.options[optionKey].materials.splice(matKey);
            },
            setProperty: function(){
                this.$broadcast('materialChanged');
            },
            setMaterial: function(optionKey,taskType, matType){
                console.log('Setting Material',taskType,matType);
                var system_mat = this.systems[this.section.options[optionKey].system.id].tasks[taskType].materials[matType];
                var activeMaterial = this.section.options[optionKey].selectedTasks[taskType].materials[matType];

                for (var material_id in system_mat) {
                    if (system_mat.hasOwnProperty(material_id)) {
                        if(material_id==activeMaterial.id){
                            activeMaterial.name = system_mat[material_id].name;
                            activeMaterial.cost_price = Number(system_mat[material_id].cost_price);
                            activeMaterial.pack_size = Number(system_mat[material_id].pack_size);
                            activeMaterial.unit_of_measure = system_mat[material_id].unit_of_measure;
                            activeMaterial.stock = system_mat[material_id].stock;
                            for (var i = 0; i < this.section.options[optionKey].orderedTasks.length; i++) {
                                var orderedTask = this.section.options[optionKey].orderedTasks[i];
                                for (var key in orderedTask.materials) {
                                    if (orderedTask.materials.hasOwnProperty(key)) {
                                        if(orderedTask.materials[key].product_type==matType){
                                            orderedTask.materials[key] = activeMaterial;
                                        }
                                        
                                    }
                                }
                            }
                        }
                    }
                }
                this.$broadcast('materialChanged');
                //this.calcMaterial();
            },
            setDefaults: function(optionKey){
                var selectedTasks = this.section.options[optionKey].selectedTasks;
                //console.log('setting Default');
                for (var task in selectedTasks) {
                    if (selectedTasks.hasOwnProperty(task)) {
                        //loop through tasks
                        for (var material_type in selectedTasks[task].materials) {
                            if (selectedTasks[task]['materials'].hasOwnProperty(material_type)) {
                                //loop through system materials
                                for (var material_id in this.systems[this.section.options[optionKey].system.id].tasks[task].materials[material_type]) {
                                    if (this.systems[this.section.options[optionKey].system.id].tasks[task].materials[material_type].hasOwnProperty(material_id)) {
                                        //console.log(this.systems[this.section.options[optionKey].system.id].tasks[task].materials[material_type][material_id]);
                                        var systemMaterial = this.systems[this.section.options[optionKey].system.id].tasks[task].materials[material_type][material_id];
                                        var activeTasks = selectedTasks[task]['materials'][material_type];
                                        if(activeTasks.id==''){
                                            // console.log('setting' + material_type);
                                            activeTasks.id = systemMaterial.id
                                            activeTasks.name = systemMaterial.name
                                            activeTasks.cost_price = systemMaterial.cost_price
                                            activeTasks.pack_size = systemMaterial.pack_size
                                            activeTasks.unit_of_measure = systemMaterial.unit_of_measure
                                            activeTasks.stock = systemMaterial.stock
                                        }else{
                                            //console.log('no need for: '+task+" "+material_type);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        },
        ready(){
            if(this.section.options=='') this.addOption();
            if(this.section.photos.length > 0){
                for (var i = 0; i < this.section.photos.length; i++) {
                    this.images[this.section.photos[i].meta.type] = this.section.photos[i].photo;
                }
            }
            if(this.section.id!=0){
                for (var i = 0; i < this.section.options.length; i++) {
                    for (var task in this.section.options[i].selectedTasks) {
                        if (this.section.options[i].selectedTasks.hasOwnProperty(task)) {
                            this.checkedTasks.push(this.section.options[i].selectedTasks[task].id.toString());
                        }
                    }
                }
            }
        }
    };
</script>
