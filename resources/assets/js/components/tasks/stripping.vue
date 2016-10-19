<template>
    <div class="task">
        <strong>Stripping</strong>
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group input-group-sm" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][quantity]" type="number" class="form-control" placeholder="area" v-model="area" number @keyup="updateValues | debounce 500" />
                    <span class="input-group-addon">{{unit_of_measure}}</span>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group" style="padding-top:14px">
                    <select class="form-control input-sm" name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][difficulty]" v-model="material_type" @change="updateValues | debounce 500">
                        <option selected value="300">Loose-Lay</option>
                        <option value="150">Fully-bonded Single</option>
                        <option value="100">Fully-bonded Double</option>
                        <option value="50">Hot-pour</option>
                    </select>
                </div>
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
                        Rate: <strong>{{total_cost_price/area | currency 'R'}}</strong> /{{unit_of_measure}}
                    </div>
                </div>
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
                area: (this.task.pivot && this.task.pivot.total) ? this.task.pivot.total : this.properties.area.value,
                unit_of_measure: this.properties.area.uom,
                material_type: ''
            };
        },
        computed: {
            total_days: function(){
                var days = 0;
                if(this.area){                    
                    //days = Math.ceil(this.area/this.material_type);
                    days = this.area/this.material_type; //do not round-up
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
            total_cost_price: function(){
                var price = 0;
                //price += this.total_materials;
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
                if(this.area){
                    /*for (var material_type in this.task.materials){
                        if (this.task.materials.hasOwnProperty(material_type)){
                            switch(material_type){
                                case 'torchon':
                                    this.task.materials[material_type].qty = Math.ceil(this.new_area/9) + Math.ceil((this.new_area-this.area)/9);
                                break;
                                case 'gas':
                                    this.task.materials[material_type].qty = Math.ceil(this.new_area/80);
                                break;
                            }
                            this.task.materials[material_type].price = this.task.materials[material_type].qty * this.task.materials[material_type].cost_price;
                        }
                    }*/
                }
                this.$dispatch('task-changed',this.optionKey,'stripping',this.total_days, this.total_labour_price, this.total_supervisor, 0, this.total_cost_price);
            }
        },
        ready(){
            this.setDefaults(this.optionKey);
            this.updateValues();
        }
    };
</script>
