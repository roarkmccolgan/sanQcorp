<template>
    <div class="task">
        <strong>{{task.name}}</strong>
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][quantity]" type="number" class="form-control" placeholder="Size" v-model="property" number @keyup="updateValues | debounce 500" />
                    <span class="input-group-addon">{{unit_of_measure}}</span>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Total Days:</label> <h6 style="margin:0">{{total_days}}</h6>
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][days]" type="hidden" v-model="total_days">
                    </div>
                    <div class="col-sm-4">
                        <label>Cost Price:</label> <h6 style="margin:0">{{total_cost_price | currency 'R'}}</h6>
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][total_cost_price]" type="hidden" v-model="total_cost_price">
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][unit_of_measure]" type="hidden" v-model="unit_of_measure">
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][link_to]" type="hidden" v-model="task.link_to">
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][name]" type="hidden" v-model="task.name">
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][description]" type="hidden" v-model="task.description">
                        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][rate]" type="hidden" v-model="task.rate">
                    </div>
                    <div class="col-sm-4">
                        Rate: <strong>{{total_cost_price/property | currency 'R'}}</strong> /{{unit_of_measure}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <small>supervisor: {{total_supervisor | currency 'R'}} | labour: {{total_labour_price | currency 'R'}}<!--  | materials: {{total_materials | currency 'R'}} --></small>
            </div>
        </div>
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][total_labour_price]" type="hidden" v-model="total_labour_price">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][total_supervisor_price]" type="hidden" v-model="total_supervisor">
        <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][order]" type="hidden" v-model="task.order">
    </div>
</template>

<script>
    export default {
        props: ['task','taskKey','option','optionKey','sectionKey','section','properties','setDefaults'],
        data: function() {
            return {
                property: (this.task.pivot && this.task.pivot.total) ? this.task.pivot.total : this.properties[this.task.link_to].value,
                unit_of_measure: this.properties[this.task.link_to].uom,
                material_type: ''
            };
        },
        computed: {
            total_days: function(){
                var days = 0;
                if(this.property){                    
                    //days = Math.ceil(this.property/this.material_type);
                    days = this.property/this.task.rate; //do not round-up
                    days = Number(days.toFixed(2));
                }
                return days;
            },
            total_labour_price: function(){
                return this.total_days ? this.total_days*1645:0; //1200 labour + 245 Driver
            },
            total_supervisor: function(){
                return this.total_days * 681;
            },
            total_materials: function(){
                var price = 0;
                if(this.property && this.task.materials.length > 0){
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
            updateValues: function(){
                if(this.property){
                    /*for (var material_type in this.task.materials){
                        if (this.task.materials.hasOwnProperty(material_type)){
                            switch(material_type){
                                case 'torchon':
                                    this.task.materials[material_type].qty = Math.ceil(this.new_size/9) + Math.ceil((this.new_size-this.property)/9);
                                break;
                                case 'gas':
                                    this.task.materials[material_type].qty = Math.ceil(this.new_size/80);
                                break;
                            }
                            this.task.materials[material_type].price = this.task.materials[material_type].qty * this.task.materials[material_type].cost_price;
                        }
                    }*/
                }
                this.$dispatch('task-changed',this.optionKey,this.task.alias,this.total_days, this.total_labour_price, this.total_supervisor, 0, this.total_cost_price);
            }
        },
        ready(){
            this.setDefaults(this.optionKey);
            this.updateValues();
            this.property = this.properties[this.task.link_to].value;
            this.unit_of_measure = this.properties[this.task.link_to].uom;
        }
    };
</script>
