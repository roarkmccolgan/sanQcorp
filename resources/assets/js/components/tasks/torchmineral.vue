<template>
    <div>
        <strong>Torch Mineral</strong>
        <div class="row">
            <!-- <div class="col-sm-3">
                <div class="input-group" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][quantity]" type="number" class="form-control" placeholder="Size" v-model="properties.size" number @keyup="updateValues | debounce 500" />
                    <span class="input-group-addon">{{unit_of_measure}}</span>
                </div>
            </div> -->
            <div class="col-sm-3">
                <div class="form-group" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][difficulty]" type="number" class="form-control" placeholder="Difficulty %" v-model="difficulty" number />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Total Days:</label> <h6 style="margin:0">{{total_days}}</h6>
                        <!-- <input name="section[{{sectionKey}}][options][{{optionKey}}][days]" type="hidden" v-model="total_days"> -->
                    </div>
                    <div class="col-sm-6">
                        <label>Cost Price:</label> <h6 style="margin:0">{{total_cost_price | currency 'R'}}</h6>
                        <!-- <input name="section[{{sectionKey}}][options][{{optionKey}}][total_cost_price]" type="hidden" v-model="total_cost_price"> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <small>supervisor: {{total_supervisor | currency 'R'}} | labour: {{total_labour_price | currency 'R'}} | materials: {{total_materials | currency 'R'}}</small>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['task','taskKey','option','optionKey','sectionKey','section','properties','setDefaults'],
        data: function() {
            return {
                unit_of_measure: 'm2',
                difficulty: ''
            };
        },
        computed: {
            new_size: function(){
                return this.properties.size && this.difficulty ? this.properties.size+((this.properties.size / 100) * this.difficulty):this.properties.size;
            },
            total_days: function(){
                var days = 0;
                if(this.properties.size){                    
                    days = Math.ceil(this.new_size/150);
                    days = this.new_size/150; //do not round-up
                    days = days.toFixed(2);
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
                if(this.properties.size){
                    for (var material_type in this.task.materials){
                        if (this.task.materials.hasOwnProperty(material_type)){
                            var taskPrice = this.task.materials[material_type].price;
                            price += taskPrice!='' ? taskPrice:0;
                        }
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
                console.log('updateprops');
                if(this.properties.size){
                    for (var material_type in this.task.materials){
                        if (this.task.materials.hasOwnProperty(material_type)){
                            switch(material_type){
                                case 'torchon':
                                    this.task.materials[material_type].qty = Math.ceil(this.new_size/9) + Math.ceil((this.new_size-this.properties.size)/9);
                                break;
                                case 'gas':
                                    this.task.materials[material_type].qty = Math.ceil(this.new_size/80);
                                break;
                            }
                            this.task.materials[material_type].price = this.task.materials[material_type].qty * this.task.materials[material_type].cost_price;
                        }
                    }
                }
                this.$dispatch('task-changed',this.optionKey,'torchmineral',this.total_days, this.total_cost_price);
            }
        },
        ready(){
            this.setDefaults(this.optionKey);
            this.updateValues();
        }
    };
</script>
