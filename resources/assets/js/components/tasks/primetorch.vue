<template>
    <div class="task">
        <strong>{{task.name}}</strong>
        <div class="row">
            <div class="col-sm-4">
                <label for="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][quantity]">{{task.link_to}}</label>
                <div class="input-group input-group-sm">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][quantity]" type="number" class="form-control" placeholder="Area" v-model="property" number @keyup="updateValues | debounce 500" />
                    <span class="input-group-addon">{{unit_of_measure}}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <!-- Table -->
                <table class="table table-condensed table-bordered">
                    <caption>Materials</caption>
                    <tbody>
                        <tr v-for="(matKey, material) in task.materials">
                            <td>{{material.material_type}}</td>
                            <td>
                                <!-- <template v-if="getObjSize(material)>1">
                                    <select name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][material_id]" v-model="selectedmaterials[material_type].id" class="form-control input-sm"  @change="setMaterial(optionKey,taskKey,material_type)">
                                        <option v-for="(material_id, chosen_material) in material" v-bind:value="chosen_material.id">{{chosen_material.name}}</option>
                                    </select>
                                </template>
                                <template v-else>
                                    <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][material_id]" type="hidden" v-model="material.name">
                                        {{material.name}}
                                </template> -->
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][material_id]" type="hidden" v-model="material.name">
                                        {{material.name}}
                            </td>
                            <td>
                                {{material.qty}}
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][qty]" type="hidden" v-model="material.qty">
                            </td>
                            <td>
                                {{material.price | currency 'R'}}
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][price]" type="hidden" v-model="material.price">
                                <input name="section[{{key}}][options][{{optionKey}}][materials][{{material_type}}][cost_price]" type="hidden" v-model="material.cost_price">
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
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][total_supervisor_price]" type="hidden" v-model="total_supervisor">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][total_materials_price]" type="hidden" v-model="total_materials">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][order]" type="hidden" v-model="task.order">
        <!-- materials: {{total_materials | currency 'R'}} -->
    </div>
</template>

<script>
    export default {
        props: ['task','taskKey','option','optionKey','sectionKey','section','properties','setDefaults','systemTask'],
        data: function() {
            return {
                property: (this.task.pivot && this.task.pivot.total) ? this.task.pivot.total : this.properties[this.task.link_to].value,
                unit_of_measure: this.properties[this.task.link_to].uom,
                difficulty: '',
                materialOptions:{},
            };
        },
        computed: {
            total_days: function(){
                var days = 0;
                if(this.property){                    
                    days = this.property/this.task.rate; //do not round-up
                    days = days.toFixed(2);
                }
                return Number(days);
            },
            total_labour_price: function(){
                return this.total_days ? this.total_days*1645:0; //1200 labour + 245 Driver
            },
            total_supervisor: function(){
                return this.total_days * 681;
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
                //console.log(this.total_materials, this.total_labour_price, this.total_supervisor);
                price += this.total_materials;
                price += this.total_labour_price == 0 ? 0 : this.total_labour_price;
                price += this.total_supervisor == 0 ? 0 : this.total_supervisor;
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
            addMaterial: function(material, material_type){
                this.task.materials.push({
                    id: material.id,
                    name: material.name,
                    material_type: material.material_type,
                    coverage: material.coverage,
                    pack_size: material.pack_size,
                    cost_price: material.cost_price,
                    qty: '',
                    price: '',
                    stock: material.stock,
                    unit_of_measure: material.unit_of_measure,
                    task: this.task.alias,
                    material_type: material_type
                });
            },
            updateValues: function(){
                //console.log('updateValues');
                if(this.property){
                    for (var i = 0; i < this.task.materials.length; i++) {
                        this.task.materials[i].qty = Math.ceil(this.property/this.task.materials[i].coverage);
                        this.task.materials[i].price = this.task.materials[i].qty * this.task.materials[i].cost_price;
                    }
                }
                this.task.days = this.total_days;
                this.task.total_labour = this.total_labour_price;
                this.task.total_supervisor = this.total_supervisor;
                this.task.total_materials = this.total_materials;
                this.task.total_cost_price = this.total_cost_price;

                this.$dispatch('task-changed',this.optionKey,this.taskKey,this.total_days, this.total_labour_price, this.total_supervisor, this.total_materials, this.total_cost_price);
            }
        },
        created(){
            for(var matType in this.systemTask.materials){
                if(this.systemTask.materials.hasOwnProperty(matType)){
                    if(this.getObjSize(this.systemTask.materials[matType])>1){
                        var setOne = false;
                        var mats = {}
                        for(var matId in this.systemTask.materials[matType]){
                            mats[matId] = this.systemTask.materials[matType][matId];
                            if(!setOne) this.addMaterial(this.systemTask.materials[matType][matId],matType);
                            setOne = true;
                        }
                        this.materialOptions.matType = mats;
                    }else{
                        this.addMaterial(this.systemTask.materials[matType][Object.keys(this.systemTask.materials[matType])[0]],matType);
                    }
                    // if(!this.selectedmaterials.hasOwnProperty(matType)){
                    //     this.selectedmaterials[matType] = {};
                    // }
                }
            }
        },
        ready(){
            //console.log('ready');
            this.setDefaults(this.optionKey);
            this.updateValues();
        }
    };
</script>
