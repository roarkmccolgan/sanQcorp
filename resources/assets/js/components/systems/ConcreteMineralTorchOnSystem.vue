<template>
    <div>
        <div class="row">
            <div class="col-sm-3">
                <div class="input-group" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][size]" type="number" class="form-control" placeholder="Size" v-model="size" number @keyup="calcMaterial | debounce 500" />
                    <span class="input-group-addon">{{option.system.unit}}</span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][perimeter]" type="number" class="form-control" placeholder="Perimeter" v-model="perimeter" number @keyup="calcMaterial | debounce 500"/>
                    <span class="input-group-addon">lm</span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <small>Stripping?</small><br/>
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][stripping]" type="checkbox" v-switch="tasks.stripping" data-on-text="Yes" data-off-text="No" />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][difficulty]" type="number" class="form-control" placeholder="Difficulty %" v-model="wastage" number />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="input-group" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][screed]" type="number" class="form-control" placeholder="Screed" v-model="screed" number @keyup="calcMaterial | debounce 500" />
                    <span class="input-group-addon">{{option.system.unit}}</span>
                </div>
            </div>
        </div>
        <div class="clearfix" style="height:20px;"></div>
        <!-- Loop through system materials and show line costings -->
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10%">Type</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th width="23%">Cost Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(task_type, task) in option.system.tasks">
                            <tr v-for="(material_type, material) in task.materials">
                                <td>{{material_type}}</td>
                                <td>
                                    <template v-if="getObjSize(material)>1">
                                        <select name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{task_type}}][materials][{{material_type}}][material_id]" v-model="tasks[task_type][material_type].id" class="form-control" @change="setMaterial(task_type,material_type)">
                                            <option v-for="(material_id, chosen_material) in material" v-bind:value="material_id">{{chosen_material.name}}</option>
                                        </select>
                                    </template>
                                    <template v-else>
                                        <template v-for="(material_id, chosen_material) in material">
                                            <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{task_type}}][materials][{{material_type}}][material_id]" type="hidden" v-model="tasks[task_type][material_type].id">
                                            {{chosen_material.name}}
                                        </template>
                                    </template>
                                </td>
                                <td>
                                    {{tasks[task_type][material_type].qty}}
                                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{task_type}}][materials][{{material_type}}][qty]" type="hidden" v-model="tasks[task_type][material_type].qty">
                                </td>
                                <td>
                                    {{tasks[task_type][material_type].price | currency 'R'}}
                                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{task_type}}][materials][{{material_type}}][price]" type="hidden" v-model="tasks[task_type][material_type].price">
                                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{task_type}}][materials][{{material_type}}][cost_price]" type="hidden" v-model="tasks[task_type][material_type].cost_price">
                                </td>
                            </tr>
                        </template>

                        <tr>
                            <td>Labour</td>
                            <td>Crew of 4</td>
                            <td>{{total_days}}</td>
                            <td>
                                {{total_labour_price | currency 'R'}}
                                <input name="section[{{sectionKey}}][options][{{optionKey}}][labour_cost_price]" type="hidden" v-model="total_labour_price">
                            </td>
                        </tr>
                        <tr>
                            <td>Supervisor</td>
                            <td></td>
                            <td>{{total_days}}</td>
                            <td>
                                {{total_supervisor | currency 'R'}}
                                <input name="section[{{sectionKey}}][options][{{optionKey}}][supervisor_cost_price]" type="hidden" v-model="total_supervisor">
                            </td>
                        </tr>
                        <tr>
                            <td>Transport</td>
                            <td>{{distance}}km</td>
                            <td>{{total_days}}</td>
                            <td>{{total_transport | currency 'R'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    
        <!-- Totals -->
        <div class="row">
            <div class="col-sm-6 col-sm-offset-6">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Total Days:</label> <h5 style="margin:0">{{total_days}}</h5>
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][days]" type="hidden" v-model="total_days">
                    </div>
                    <div class="col-sm-6">
                        <label>Cost Price:</label> <h5 style="margin:0">{{total_cost_price | currency 'R'}}</h5>
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][total_cost_price]" type="hidden" v-model="total_cost_price">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Markup %</label>
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][markup]" type="number" class="form-control" placeholder="Markup %" v-model="markup" number />
                    </div>
                    <div class="col-sm-6">
                        <label>Selling Price:</label> <h5 style="margin:0">{{total_selling_price | currency 'R'}}</h5>
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][selling_price]" type="hidden" v-model="total_selling_price">
                        <small>{{total_selling_price/size | currency 'R'}} /m2</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['option','optionKey','sectionKey'],
        data: function() {
            return {
                size: laravel.job.sections[this.sectionKey].options[this.optionKey].size ? laravel.job.sections[this.sectionKey].options[this.optionKey].size:'',
                screed: laravel.job.sections[this.sectionKey].options[this.optionKey].screed ? laravel.job.sections[this.sectionKey].options[this.optionKey].screed : '',
                distance: laravel.job.distance,
                perimeter: laravel.job.sections[this.sectionKey].options[this.optionKey].perimeter ? laravel.job.sections[this.sectionKey].options[this.optionKey].perimeter : '',
                wastage: laravel.job.sections[this.sectionKey].options[this.optionKey].difficulty ? laravel.job.sections[this.sectionKey].options[this.optionKey].difficulty : '',
                markup: laravel.job.sections[this.sectionKey].options[this.optionKey].markup ? laravel.job.sections[this.sectionKey].options[this.optionKey].markup : 100,
                tasks: {
                    torchmineral: {
                        torchon: {
                            id: '',
                            name: '',
                            qty: '',
                            cost_price: '',
                            price: '',
                            unit_of_measure: '',
                            pack_size: '',
                            stock: '',
                        },
                        gas: {
                            id: '',
                            name: '',
                            qty: '',
                            cost_price: '',
                            price: '',
                            unit_of_measure: '',
                            pack_size: '',
                            stock: '',
                        }
                    },
                    acrylicflashing: {
                        membrane: {
                            id: '',
                            name: '',
                            qty: '',
                            cost_price: '',
                            price: '',
                            unit_of_measure: '',
                            pack_size: '',
                            stock: '',
                        },
                        acrylic: {
                            id: '',
                            name: '',
                            qty: '',
                            cost_price: '',
                            price: '',
                            unit_of_measure: '',
                            pack_size: '',
                            stock: '',
                        }
                    },
                    primetorch: {
                        primer: {
                            id: '',
                            name: '',
                            qty: '',
                            cost_price: '',
                            price: '',
                            unit_of_measure: '',
                            pack_size: '',
                            stock: '',
                        }
                    },
                    screedrepair: {
                        cement: {
                            id: '',
                            name: '',
                            qty: '',
                            cost_price: '',
                            price: '',
                            unit_of_measure: '',
                            pack_size: '',
                            stock: '',
                        },
                        sand: {
                            id: '',
                            name: '',
                            qty: '',
                            cost_price: '',
                            price: '',
                            unit_of_measure: '',
                            pack_size: '',
                            stock: '',
                        }
                    },
                    stripping: laravel.job.sections[this.sectionKey].options[this.optionKey].stripping
                }
            };
        },
        computed: {
            priming_days: function(){
                return this.size ? Math.ceil(this.size/400):0;
            },
            screeding_days: function(){
                return this.screed ? Math.ceil(this.screed/10):0;
            },
            stripping_days: function(){
                return this.size && this.tasks.stripping ? Math.ceil(this.size/200):0;
            },
            new_size: function(){
                return this.size && this.wastage ? this.size+((this.size / 100) * this.wastage):this.size;
            },
            total_days: function(){
                if(this.size){                    
                    return Math.ceil(this.new_size/150 + this.stripping_days + this.screeding_days + this.priming_days);
                }
                return 0;
            },
            total_labour_price: function(){
                return this.total_days ? this.total_days*1645:0; //1200 labour + 245 Driver
            },
            total_transport: function(){
                return ((laravel.job.distance * this.total_days) * 2) * 6.5;
            },
            total_supervisor: function(){
                return this.total_days * 681;
            },
            total_cost_price: function(){
                var price = 0;
                if(this.size){
                    var curTasks = this.tasks;
                    
                    for (var taskType in curTasks) {
                        if (curTasks.hasOwnProperty(taskType)) {
                            for(var material_type in curTasks[taskType]){
                                if (curTasks[taskType].hasOwnProperty(material_type)) {
                                    price += curTasks[taskType][material_type].price ? curTasks[taskType][material_type].price : 0;
                                }
                            }
                        }
                    }
                }
                price += this.total_labour_price == 0 ? 0 : this.total_labour_price;
                price += this.total_transport == 0 ? 0 : this.total_transport;
                price += this.total_supervisor == 0 ? 0 : this.total_supervisor;
                return price==0 ? 0: price;
            },
            total_selling_price: function(){
                return this.total_cost_price+((this.total_cost_price/100)*this.markup);
            }
        },
        methods: {
            setDefaults: function(){
                var system_tasks = this.option.system.tasks;
                for (var task in system_tasks) {
                    if (system_tasks.hasOwnProperty(task)) {
                        //loop through tasks
                        for (var material_type in system_tasks[task]['materials']) {
                            if (system_tasks[task]['materials'].hasOwnProperty(material_type)) {
                                //loop through materials
                                for (var material_id in system_tasks[task]['materials'][material_type]) {
                                    if (system_tasks[task]['materials'][material_type].hasOwnProperty(material_id)) {
                                        if(this.tasks[task][material_type].id==''){
                                            // console.log('setting' + material_type);
                                            var loadedSystem = this.option.selectedMaterials && this.option.selectedTasks ? true : false;
                                            this.tasks[task][material_type].id = loadedSystem ? this.option.selectedMaterials[material_type].id : system_tasks[task]['materials'][material_type][material_id].id;
                                            this.tasks[task][material_type].name = loadedSystem ? this.option.selectedMaterials[material_type].name : system_tasks[task]['materials'][material_type][material_id].name;
                                            this.tasks[task][material_type].cost_price = loadedSystem ? this.option.selectedMaterials[material_type].price : Number(system_tasks[task]['materials'][material_type][material_id].price);
                                            this.tasks[task][material_type].pack_size = loadedSystem ? this.option.selectedMaterials[material_type].pack_size : Number(system_tasks[task]['materials'][material_type][material_id].pack_size);
                                            this.tasks[task][material_type].unit_of_measure = loadedSystem ? this.option.selectedMaterials[material_type].unit_of_measure : system_tasks[task]['materials'][material_type][material_id].unit_of_measure;
                                            this.tasks[task][material_type].stock = loadedSystem ? this.option.selectedMaterials[material_type].stock : system_tasks[task]['materials'][material_type][material_id].stock;
                                        }else{
                                            // console.log('no need to set' + material_type);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                this.calcMaterial();
            },
            setMaterial: function(taskType, matType){
                console.log('Setting Material');
                var system_mat = this.option.system.tasks[taskType]['materials'][matType];

                for (var material_id in system_mat) {
                    if (system_mat.hasOwnProperty(material_id)) {
                        if(this.tasks[taskType][matType].id==material_id){
                            this.tasks[taskType][matType].name = system_mat[material_id].name;
                            this.tasks[taskType][matType].cost_price = Number(system_mat[material_id].price);
                            this.tasks[taskType][matType].pack_size = Number(system_mat[material_id].pack_size);
                            this.tasks[taskType][matType].unit_of_measure = system_mat[material_id].unit_of_measure;
                            this.tasks[taskType][matType].stock = system_mat[material_id].stock;
                        }
                    }
                }
                this.calcMaterial();
            },
            calcMaterial: function(){
                console.log('Calcing Material');
                var tasks = this.tasks;
                for (var task in tasks) {
                    if (tasks.hasOwnProperty(task)) {
                        for (var material_type in tasks[task]){
                            if (tasks[task].hasOwnProperty(material_type)){
                                switch(material_type){
                                    case 'torchon':
                                        this.tasks[task][material_type].qty = Math.ceil(this.new_size/9) + Math.ceil((this.new_size-this.size)/9);
                                    break;
                                    case 'primer':
                                        this.tasks[task][material_type].qty = Math.ceil((this.new_size/5)/25);
                                    break;
                                    case 'gas':
                                        this.tasks[task][material_type].qty = Math.ceil(this.new_size/80);
                                    break;
                                    case 'membrane':
                                        this.tasks[task][material_type].qty = Math.ceil(this.perimeter/20);
                                    break;
                                    case 'acrylic':
                                        this.tasks[task][material_type].qty = Math.ceil((this.perimeter*0.2)*1.5/this.tasks[task][material_type].pack_size);
                                    break;
                                    case 'cement':
                                        this.tasks[task][material_type].qty = Math.ceil((this.screed*1.3)/this.tasks[task][material_type].pack_size);
                                    break;
                                    case 'sand':
                                        this.tasks[task][material_type].qty = Math.ceil(this.screed/10);
                                    break;
                                }
                                //console.log(this.tasks[task][material_type].name, this.tasks[task][material_type].qty, this.tasks[task][material_type].cost_price);
                                this.tasks[task][material_type].price = this.tasks[task][material_type].qty * this.tasks[task][material_type].cost_price;
                            }
                        }
                    }
                }
            },
            getObjSize: function(obj) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                return size;
            }
        },
        filters: {
            filterByType: function(object, product_type){
                var newObject = [];
                for (var key in object) {
                    if (object.hasOwnProperty(key)) {
                        if(object[key].product_type==product_type){
                            newObject.push(object[key]);
                        }
                    }
                }
                return newObject;
            }
        },
        ready(){
            console.log('ready');
            this.setDefaults();
        }
    };
</script>
