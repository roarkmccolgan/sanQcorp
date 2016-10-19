<template>
    <div class="task">
        <strong>{{task.name}}</strong>
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group input-group-sm" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][quantity]" type="number" class="form-control" placeholder="Size" v-model="size" number @keyup="updateValues | debounce 500" />
                    <span class="input-group-addon">{{unit_of_measure}}</span>
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
                        Rate: <strong>{{total_cost_price/size | currency 'R'}}</strong> /{{unit_of_measure}}
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
        props: ['task','taskKey','option','optionKey','sectionKey','section','properties','setDefaults'],
        data: function() {
            return {
                size: (this.task.pivot && this.task.pivot.total) ? this.task.pivot.total : this.properties.size.value/10,
                unit_of_measure: this.properties.size.uom,
                difficulty: ''
            };
        },
        computed: {
            total_days: function(){
                var days = 0;
                if(this.size){
                    days = this.size/10; //do not round-up
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
                if(this.size){
                    for (var material_type in this.task.materials){
                        if (this.task.materials.hasOwnProperty(material_type)){
                            var taskPrice = Number(this.task.materials[material_type].price);
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
                if(this.size){
                    for (var material_type in this.task.materials){
                        if (this.task.materials.hasOwnProperty(material_type)){
                            switch(material_type){
                                case 'cement':
                                    //have to set both to keep order in order
                                    this.task.materials[material_type].qty = Math.ceil(this.size/9);
                                    if(this.option.selectedTasks[this.task.alias])this.option.selectedTasks[this.task.alias].materials[material_type].qty = Math.ceil(this.size/9);
                                break;
                                case 'sand':
                                    //have to set both to keep them in order
                                    this.task.materials[material_type].qty = Math.ceil(this.size/8);
                                    if(this.option.selectedTasks[this.task.alias])this.option.selectedTasks[this.task.alias].materials[material_type].qty = Math.ceil(this.size/8);
                                break;
                            }
                            this.task.materials[material_type].price = this.task.materials[material_type].qty * this.task.materials[material_type].cost_price;
                            //if(this.option.selectedTasks[this.task.alias]) this.option.selectedTasks[this.task.alias].materials[material_type].price = this.task.materials[material_type].qty * this.task.materials[material_type].cost_price;
                        }
                    }
                }
                this.$dispatch('task-changed',this.optionKey,'screedrepair',this.total_days, this.total_labour_price, this.total_supervisor, this.total_materials, this.total_cost_price);
            }
        },
        ready(){
            this.setDefaults(this.optionKey);
            this.updateValues();
        }
    };
</script>
