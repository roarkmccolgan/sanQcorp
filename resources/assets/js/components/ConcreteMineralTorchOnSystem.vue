<template>
    <form>
    <div class="row">
        <div class="col-md-4">
            <div class="input-group" style="padding-top:14px">
                <input type="number" class="form-control input-lg flat" placeholder="Size" v-model="size" number @keyup="calcMaterial | debounce 500" />
                <span class="input-group-addon">{{option.system.unit}}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group" style="padding-top:14px">
                <input type="number" class="form-control input-lg flat" placeholder="Perimeter" v-model="perimeter" number @keyup="calcMaterial | debounce 500"/>
                <span class="input-group-addon">lm</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <small>Stripping?</small><br/>
                <input type="checkbox" v-switch="stripping" />
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group" style="padding-top:14px">
                <input type="number" class="form-control flat" placeholder="Difficulty %" v-model="wastage" number />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            Labour Cost: <strong>{{total_labour_price | currency 'R'}}</strong> <small>{{total_labour_price/size | currency 'R'}} / {{option.system.unit}}</small><br>
            Supervisor Cost: <strong>{{total_supervisor | currency 'R'}}</strong><br>
            Transport: <strong>{{total_transport | currency 'R'}}</strong>
        </div>
        <div class="col-md-6">
            Total Days: <h4 style="margin:0">{{total_days}}</h4>
            Cost Price: <h4 style="margin:0">{{total_cost_price | currency 'R'}}</h4>
        </div>
            
    </div>
    <div class="clearfix" style="height:20px;"></div>
    <!-- Loop through system materials and show line costings -->
    <div class="row" v-show="size && perimeter" v-for="(material_key, material) in option">
        <div class="col-md-2">
            <strong>{{material.name}}</strong>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <select v-model="material.material" @change="setMaterial(material_key)" class="form-control">
                    <option v-for="dbmaterial in option.system.materials | filterByType material_key" v-bind:value="dbmaterial.id">{{dbmaterial.name}}</option><!--  v-show="dbmaterial.product_type==material_key" -->
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                Quantity: <strong>{{material.qty}}</strong><br/>
                Cost Price: <strong>{{material.price | currency 'R'}}</strong>
            </div>
        </div>
    </div>
    </form>
</template>

<script>
    export default {
        props: ['option','optionKey'],
        data: function() {
            return {
                size: '',
                stripping: false,
                perimeter: false,
                wastage: '',
            };
        },
        computed: {
            stripping_days: function(){
                return this.size && this.stripping ? Math.ceil(this.size/200):0;
            },
            new_size: function(){
                return this.size && this.wastage ? this.size+((this.size / 100) * this.wastage):this.size;
            },
            total_days: function(){
                if(this.size){                    
                    return Math.ceil(this.new_size/80 + this.stripping_days);
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
                    var curMats = this.optionMaterials;
                    
                    for (var key in curMats) {
                        if (curMats.hasOwnProperty(key)) {
                            price += curMats[key].price ? curMats[key].price : 0;
                        }
                    }
                }
                price += this.total_labour_price == 0 ? 0 : this.total_labour_price;
                price += this.total_transport == 0 ? 0 : this.total_transport;
                price += this.total_supervisor == 0 ? 0 : this.total_supervisor;
                return price==0 ? 0: price;
            }
        },
        methods: {
            setDefaults: function(){
                var system_mats = this.option.system.materials;
                for (var key in system_mats) {
                    if (system_mats.hasOwnProperty(key)) {
                        var type = system_mats[key].product_type;
                        console.log(type);
                        if(this.optionMaterials[type].material==''){
                            this.optionMaterials[type].material = system_mats[key].id;
                            this.optionMaterials[type].cost_price = Number(system_mats[key].price);
                            this.optionMaterials[type].pack_size = Number(system_mats[key].pack_size);
                            this.optionMaterials[type].unit_of_measure = system_mats[key].unit_of_measure;
                            this.optionMaterials[type].stock = system_mats[key].stock;
                        }
                    }
                }
            },
            setMaterial: function(type){
                var system_mats = this.option.system.materials;
                for (var key in system_mats) {
                    if (system_mats.hasOwnProperty(key)) {
                        if(system_mats[key].id == this.optionMaterials[type].material){
                            //this.optionMaterials[type].material = system_mats[key].id;
                            this.optionMaterials[type].cost_price = Number(system_mats[key].price);
                            this.optionMaterials[type].pack_size = Number(system_mats[key].pack_size);
                            this.optionMaterials[type].unit_of_measure = system_mats[key].unit_of_measure;
                            this.optionMaterials[type].stock = system_mats[key].stock;
                        }
                    }
                }
                this.calcMaterial;
            },
            calcMaterial: function(){
                var option_mats = this.optionMaterials;
                for (var key in option_mats) {
                    if (option_mats.hasOwnProperty(key)) {
                        var material = key;
                        switch(material){
                            case 'torchon':
                                this.optionMaterials[material].qty = Math.ceil(this.size/9) + Math.ceil((this.new_size-this.size)/9);
                            break;
                            case 'primer':
                                this.optionMaterials[material].qty = Math.ceil((this.size/5)/25);
                            break;
                            case 'gas':
                                this.optionMaterials[material].qty = Math.ceil(this.new_size/80);
                            break;
                            case 'membrane':
                                this.optionMaterials[material].qty = Math.ceil(this.perimeter/20);
                            break;
                            case 'acrylic':
                                this.optionMaterials[material].qty = Math.ceil((this.perimeter*0.2)*1.3/this.optionMaterials[material].pack_size);
                            break;
                        }
                    }
                }
                this.optionMaterials[material].price = this.optionMaterials[material].qty * this.optionMaterials[material].cost_price;
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
