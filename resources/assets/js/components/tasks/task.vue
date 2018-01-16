<template>
    <div class="task">
        <strong>{{task.name}}</strong>
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][name]" type="hidden" v-model="task.name">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][description]" type="hidden" v-model="task.description">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][unit_of_measure]" type="hidden" v-model="unit_of_measure">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][link_to]" type="hidden" v-model="task.link_to">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][rate]" type="hidden" v-model="rate">
        <div class="row">
            <div class="col-sm-4">
                <label for="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][quantity]">{{task.link_to}}</label>
                <div class="input-group input-group-sm">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][quantity]" type="number" class="form-control" placeholder="Area" v-model="property" number @keyup="updateValues | debounce 500" />
                    <span class="input-group-addon">{{unit_of_measure}}</span>
                </div>
            </div>
            <template v-if="variables">
                <div class="col-sm-4" v-for="(varType, variable) in variables">
                    <label for="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][variables][{{varType}}][id]">
                        {{varType}}
                    </label>
                    <select name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][variables][{{varType}}][id]" v-model="selectedVariable" class="form-control input-sm" @change="setVariable()">
                        <option value="">Default ({{task.rate}})</option>
                        <option v-for="(varKey, varOpt) in variable" v-bind:value="varOpt.id">{{varOpt.label}} ({{varOpt.rate}})</option>
                    </select>
                </div>
            </template>
        </div>
        <div class="row" v-if="task.materials.length>0">
            <div class="col-sm-12">
                <!-- Table -->
                <table class="table table-condensed table-bordered" style="background-color: white">
                    <caption>Materials</caption>
                    <tbody>
                        <tr v-for="(matKey, material) in task.materials">
                            <td>{{material.product_type}}</td>
                            <td>
                                <template v-if="materialOptions[material.product_type]">
                                    <select name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][id]" v-model="chosenMaterials[material.product_type]" class="form-control input-sm" @change="setMaterial(material.product_type)">
                                        <option v-for="(material_id, chosen_material) in materialOptions[material.product_type]" v-bind:value="chosen_material.id">{{chosen_material.name}}</option>
                                    </select>
                                </template>
                                <template v-else>
                                    <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][id]" type="hidden" v-model="material.id">
                                        {{material.name}}
                                </template>
                            </td>
                            <td>
                                {{material.qty}}
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][qty]" type="hidden" v-model="material.qty">
                            </td>
                            <td>
                                {{material.price | currency 'R'}}
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][price]" type="hidden" v-model="material.price">
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][cost_price]" type="hidden" v-model="material.cost_price">
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][task]" type="hidden" v-model="task.alias">
                                <!-- Needed for newley added materials for custom tasks -->
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][name]" type="hidden" v-model="material.name">
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][pack_size]" type="hidden" v-model="material.pack_size">
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][unit_of_measure]" type="hidden" v-model="material.unit_of_measure">
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][product_type]" type="hidden" v-model="material.product_type">
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][{{material.product_type}}][coverage]" type="hidden" v-model="material.coverage">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        Days: <strong style="margin:0">{{total_days}}</strong>
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][days]" type="hidden" v-model="total_days">
                    </div>
                    <div class="col-sm-4">
                        Cost: <strong style="margin:0">{{total_cost_price | currency 'R'}}</strong>
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][total_cost_price]" type="hidden" v-model="total_cost_price">
                    </div>
                    <div class="col-sm-4">
                        Rate: <strong>{{total_cost_price/property | currency 'R'}}</strong> /{{unit_of_measure}}
                    </div>
                </div>
            </div>
        </div>
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][total_labour_price]" type="hidden" v-model="total_labour_price">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][total_materials_price]" type="hidden" v-model="total_materials">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][order]" type="hidden" v-model="task.order">
        <!-- materials: {{total_materials | currency 'R'}} -->
    </div>
</template>

<script>
    export default {
        props: ['key','task','taskKey','option','optionKey','sectionKey','section','properties','systemTask'],
        data: function() {
            return {
                property: (this.task.pivot && this.task.pivot.total) ? this.task.pivot.total : this.properties[this.task.link_to].value,
                unit_of_measure: this.properties[this.task.link_to].uom,
                variables: this.systemTask && this.systemTask.variables && this.getObjSize(this.systemTask.variables) > 0 ? this.systemTask.variables:{},
                selectedVariable: this.option.pivot && this.option.pivot.variable_id ? this.option.pivot.variable_id : '',
                rate: this.task.variable ? this.task.variable.rate:this.task.rate,
                difficulty: '',
                materialOptions:{},
                chosenMaterials: {}
            };
        },
        computed: {
            total_days: function(){
                var days = 0;
                if(this.property){                    
                    days = this.property/this.rate; //do not round-up
                    days = days.toFixed(2);
                }
                return Number(days);
            },
            total_labour_price: function(){
                var tot = 0;
                for (var i = 0; i < this.option.system.labour.length; i++) {
                    var qty = this.option.system.labour[i].pivot ? this.option.system.labour[i].pivot.qty : (this.option.system.labour[i].qty ? this.option.system.labour[i].qty:0);
                    var val = this.option.system.labour[i].day_rate * qty;
                    tot+=val;
                }
                return this.total_days ? this.total_days*tot:0;
            },
            total_materials: function(){
                var price = 0;
                if(this.property){
                    for (var i = 0; i < this.task.materials.length; i++) {
                        var matPrice = Number(this.task.materials[i].price);
                        price += matPrice;
                    }
                }
                return price;
            },
            total_cost_price: function(){
                var price = 0;
                price += this.total_materials;
                price += this.total_labour_price == 0 ? 0 : this.total_labour_price;
                return price;
            }
        },
        events: {
            materialChanged: function(){
                this.updateValues();
            }
        },
        methods: {
            getObjSize: function(obj) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                return size;
            },
            addMaterial: function(material, product_type){
                this.task.materials.push({
                    id: material.id,
                    name: material.name,
                    product_type: material.product_type,
                    coverage: material.pivot && material.pivot['coverage'] ? material.pivot['coverage'] : material.coverage,
                    pack_size: material.pack_size,
                    cost_price: material.cost_price,
                    qty: '',
                    price: '',
                    stock: material.stock,
                    unit_of_measure: material.unit_of_measure,
                    task: this.task.alias,
                    areaconversion: material.pivot && material.pivot['area'] ? material.pivot['area'] : false
                });
            },
            setMaterial: function(product_type){
                var index = -1
                for (var i = 0; i < this.task.materials.length; i++) {
                    if(this.task.materials[i].product_type==product_type){
                        index = i;
                    }
                }
                if(index!=-1){
                    this.task.materials.splice(index,1);
                    this.addMaterial(this.systemTask.materials[product_type][this.chosenMaterials[product_type]],product_type);
                    this.updateValues();
                }
            },
            setVariable: function(){
                if(this.getObjSize(this.variables) > 0){
                    if(this.selectedVariable!=''){
                        for(var varKey in this.variables){
                            if(this.variables.hasOwnProperty(varKey)){
                                for(var key in this.variables[varKey]){
                                    if(this.variables[varKey].hasOwnProperty(key)){
                                        if(this.variables[varKey][key].id==this.selectedVariable){
                                            this.rate = this.variables[varKey][key].rate;
                                            this.updateValues();
                                        }
                                    }
                                } 
                            }
                        }
                    }else{
                        this.rate = this.task.rate;
                        this.updateValues();
                    }
                }
            },
            updateValues: function(){                
                if(this.property){
                    var newProp = false;
                    for (var i = 0; i < this.task.materials.length; i++) {
                        var property = this.property;
                        if(this.task.materials[i].areaconversion){
                            var strprop = this.property.toString();
                            var conversion = this.task.materials[i].areaconversion.toString();

                            var bracket = conversion.indexOf("(") !== -1 ? '(':'';
                            property = eval(bracket + strprop + conversion);
                            newProp = property;
                        }  
                        this.task.materials[i].qty = Math.ceil((property/this.task.materials[i].coverage));
                        this.task.materials[i].price = this.task.materials[i].qty * this.task.materials[i].cost_price;
                    }
                    //re-do any other materials according to new property
                    if(newProp!==false){
                        for (var i = 0; i < this.task.materials.length; i++) {
                            if(this.task.materials[i].areaconversion==false){
                                this.task.materials[i].qty = Math.ceil((newProp/this.task.materials[i].coverage));
                                this.task.materials[i].price = this.task.materials[i].qty * this.task.materials[i].cost_price;
                            }
                        }
                    }
                }
                this.task.days = this.total_days;
                this.task.total_labour = this.total_labour_price;
                this.task.total_materials = this.total_materials;
                this.task.total_cost_price = this.total_cost_price;

                
                this.$dispatch('task-changed',this.optionKey,this.taskKey,this.total_days, this.total_labour_price, this.total_materials, this.total_cost_price);
            }
        },
        created(){
            if(this.systemTask && this.option.id==''){
                for(var matType in this.systemTask.materials){
                    if(this.systemTask.materials.hasOwnProperty(matType)){
                        if(this.getObjSize(this.systemTask.materials[matType])>1){

                            var setOne = false;
                            var mats = {}
                            if(!this.chosenMaterials[matType]){
                                this.chosenMaterials[matType] = '';
                            }
                            for(var matId in this.systemTask.materials[matType]){
                                mats[matId] = this.systemTask.materials[matType][matId];
                                if(!setOne){
                                    this.addMaterial(this.systemTask.materials[matType][matId],matType);
                                    this.chosenMaterials[matType] = matId;
                                    setOne = true;
                                }
                            }
                            this.materialOptions[matType] = mats;
                        }else{
                            this.addMaterial(this.systemTask.materials[matType][Object.keys(this.systemTask.materials[matType])[0]],matType);
                        }
                        // if(!this.selectedmaterials.hasOwnProperty(matType)){
                        //     this.selectedmaterials[matType] = {};
                        // }
                    }
                }
            }else{
                for(var matType in this.systemTask.materials){
                    if(this.systemTask.materials.hasOwnProperty(matType)){
                        if(this.getObjSize(this.systemTask.materials[matType])>1){
                            var setOne = false;
                            var mats = {}
                            if(!this.chosenMaterials[matType]){
                                this.chosenMaterials[matType] = '';
                            }
                            for(var matId in this.systemTask.materials[matType]){
                                mats[matId] = this.systemTask.materials[matType][matId];
                                if(!setOne){
                                    for (var i = 0; i < this.option.materials.length; i++) {
                                        if(this.option.materials[i].pivot.task==this.systemTask.alias && this.option.materials[i].product_type == matType){
                                            this.chosenMaterials[matType] = this.option.materials[i].id;
                                            setOne = true;
                                        }
                                    }
                                }
                            }
                            this.materialOptions[matType] = mats;
                        }
                    }
                }
            }
        },
        ready(){
            this.updateValues();
        }
    };
</script>
