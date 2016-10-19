<template>
    <div class="task">
        <strong>Acrylic Flashing</strong>
        <div class="row">
            <div class="col-sm-4">
                <div class="input-group input-group-sm" style="padding-top:14px">
                    <input name="section[{{sectionKey}}][options][{{optionKey}}][tasks][{{taskKey}}][quantity]" type="number" class="form-control" placeholder="Perimeter" v-model="perimeter" number @keyup="updateValues | debounce 500" />
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
                        Rate: <strong>{{total_cost_price/perimeter | currency 'R'}}</strong> /{{unit_of_measure}}
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
                perimeter: (this.task.pivot && this.task.pivot.total) ? this.task.pivot.total : this.properties.perimeter.value,
                unit_of_measure: this.properties.perimeter.uom,
                difficulty: ''
            };
        },
        computed: {
            total_days: function(){
                var days = 0;
                if(this.perimeter){
                    days = this.perimeter/150; //do not round-up
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
                if(this.perimeter){
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
            getObjsize: function(obj) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                return perimeter;
            },
            updateValues: function(){
                //console.log('updateprops');
                if(this.perimeter){
                    for (var material_type in this.task.materials){
                        if (this.task.materials.hasOwnProperty(material_type)){
                            switch(material_type){
                                case 'membrane':
                                    this.task.materials[material_type].qty = Math.ceil(this.perimeter/20);
                                    if(this.option.selectedTasks[this.task.alias]) this.option.selectedTasks[this.task.alias].materials[material_type].qty = Math.ceil(this.perimeter/20);
                                break;
                                case 'acrylic':
                                    this.task.materials[material_type].qty = Math.ceil((this.perimeter*0.2)*1.5/this.task.materials[material_type].pack_size);
                                    if(this.option.selectedTasks[this.task.alias]) this.option.selectedTasks[this.task.alias].materials[material_type].qty = Math.ceil((this.perimeter*0.2)*1.5/this.task.materials[material_type].pack_size);
                                break;
                            }
                            this.task.materials[material_type].price = this.task.materials[material_type].qty * this.task.materials[material_type].cost_price;
                        }
                    }
                }
                this.$dispatch('task-changed',this.optionKey,'acrylicflashing', this.total_days, this.total_labour_price, this.total_supervisor, this.total_materials, this.total_cost_price);
            }
        },
        ready(){
            this.setDefaults(this.optionKey);
            this.updateValues();
            this.perimeter = this.properties.perimeter.value;
            this.unit_of_measure = this.properties.perimeter.uom;
        }
    };
</script>
