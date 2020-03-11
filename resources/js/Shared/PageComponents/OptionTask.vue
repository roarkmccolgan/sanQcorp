<template>
	<div class="p-3 rounded border shadow mb-4">
		<h3 class="mb-3 font-medium">{{ task.name }}</h3>
		<div class="flex flex-wrap">
			<div class="w-1/4">
				<div class="flex items-center">
					<input v-model="property.value" class="appearance-none block bg-gray-200 text-gray-700 border border-gray-200 rounded-l py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="" type="number">
					<div class="bg-gray-300 text-gray-700 border border-gray-200 rounded-r py-3 px-4 leading-tight">
						{{ property.uom }}
					</div>
					
				</div>
				<span class="text-gray-600 text-sm">{{ property.alias }}</span>
			</div>
			<div class="w-3/4 flex flex-wrap items-start">
				<div class="w-1/3" v-if="Object.keys(task.variables).length" v-for="variableType in task.variables">
					<div class="relative">
						<select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="variable" v-model="selectedVariable">
							<option :value="null">{{ `Default (${task.rate})` }}</option>
							<option v-for="variable in variableType" :value="variable.id">{{ variable.label }}({{ variable.rate }})</option>
						</select>
						<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
						</div>
					</div>
					<span class="text-gray-600 text-sm">{{ variableType[Object.keys(variableType)[0]].name }}</span>	
				</div>				
			</div>
			<div class="w-1/2 mt-4" v-if="systems[optionSystem.id].tasks[task.alias] && Object.keys(systems[optionSystem.id].tasks[task.alias].materials).length">
				<div class="mx-1 bg-gray-100 p-2 rounded">
					<div class="flex items-center py-1 text-xs">
						<h5 class="w-2/12 uppercase tracking-wide text-gray-700 font-bold mb-1">Materials</h5>
						<div class="w-7/12"></div>
						<div class="w-1/12">qty</div>
						<div class="w-2/12">price</div>
					</div>
					<div class="flex items-center py-1 text-sm" v-for="(material, index) in materials" v-if="materials.length">
						<div class="w-2/12">{{ material.product_type | capitalize }} {{ material.product_type }}</div>
						<div class="w-8/12" v-if="Object.keys(groupedMaterials[material.product_type]).length > 1">
							<div class="relative w-full md:w-1/2">
								<select v-model="chosenMaterials[material.product_type]" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" @change="addMaterial(chosenMaterials[material.product_type])">
									<option v-for="taskMaterial in groupedMaterials[material.product_type]" :value="taskMaterial">{{ taskMaterial.name }}</option>
								</select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
								</div>
							</div>
						</div>
						<div class="w-7/12" v-else>
							{{ material.name }}
						</div>
						<div class="w-1/12">
							{{ material.qty }}
						</div>
						<div class="w-2/12">
							{{ material.price | toCurrency }}
						</div>
					</div>					
				</div>
			</div>
			<div class="w-1/2 mt-4">
				<div class="mx-1 bg-gray-100 p-2 rounded">
					<div class="flex items-center py-1 text-xs">
						<h5 class="w-1/3 uppercase tracking-wide text-gray-700 font-bold mb-1">Totals</h5>
						<div class="w-1/3">cost</div>
						<div class="w-1/3">rate</div>
					</div>
					<div class="flex items-center py-1 text-sm">
						<div class="w-1/3">
							{{ total_days }} days
						</div>
						<div class="w-1/3">
							{{ total_cost_price | toCurrency }}
						</div>
						<div class="w-1/3">
							{{ total_cost_price/property.value | toCurrency }} / {{ property.uom }}
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import debounce from 'just-debounce-it';
	export default {

		name: 'OptionTask',

		props: ['task', 'optionProperties', 'optionSystem','systems'],

		data () {
			return {
				property: {value:null},
				selectedVariable: null,
				difficulty: '',
				chosenMaterials: {},
				materials: [],
			}
		},
		watch: {
			'property.value': function(newValue, oldValue){
                console.log(newValue, oldValue);
                if(oldValue !== undefined ){

                    this.debounceUpdate();
                }


			},
            selectedVariable: function(newValue, oldValue){
                //console.log('selectedVariable');
                this.updateValues();
            }
		},
		computed: {
			total_days: function(){
				var days = 0;
				if(this.property.value){                    
                    days = this.property.value/this.rate; //do not round-up
                    days = days.toFixed(2);
                }
                return Number(days);
            },
            total_labour_price: function(){
            	var tot = 0;
            	if(this.property.value){
            		for (var i = 0; i < this.optionSystem.labour.length; i++) {
                        if(this.optionSystem.labour[i].type != 'Driver' && this.optionSystem.labour[i].type != 'Supervisor') {
                            var qty = this.optionSystem.labour[i].pivot ? this.optionSystem.labour[i].pivot.qty : (this.optionSystem.labour[i].qty ? this.optionSystem.labour[i].qty:0);
                            var val = this.optionSystem.labour[i].day_rate * qty;
                            tot+=val;
                        }
                    }
            	}
            	return this.total_days ? this.total_days*tot:0;
            },
            total_driver_price: function(){
                var tot = 0;
                if(this.property.value){
                    for (var i = 0; i < this.optionSystem.labour.length; i++) {
                        if(this.optionSystem.labour[i].type == 'Driver') {
                            var qty = this.optionSystem.labour[i].pivot ? this.optionSystem.labour[i].pivot.qty : (this.optionSystem.labour[i].qty ? this.optionSystem.labour[i].qty:0);
                            var val = this.optionSystem.labour[i].day_rate * qty;
                            tot+=val;
                        }
                    }
                }
                return this.total_days ? this.total_days*tot:0;
            },
            total_supervisor_price: function(){
                var tot = 0;
                if(this.property.value){
                    for (var i = 0; i < this.optionSystem.labour.length; i++) {
                        if(this.optionSystem.labour[i].type == 'Supervisor') {
                            var qty = this.optionSystem.labour[i].pivot ? this.optionSystem.labour[i].pivot.qty : (this.optionSystem.labour[i].qty ? this.optionSystem.labour[i].qty:0);
                            var val = this.optionSystem.labour[i].day_rate * qty;
                            tot+=val;
                        }
                    }
                }
                return this.total_days ? this.total_days*tot:0;
            },
            total_materials: function(){
            	var price = 0;
            	if(this.property.value){
            		for (var i = 0; i < this.materials.length; i++) {
            			var matPrice = Number(this.materials[i].price);
            			price += matPrice;
            		}
            	}
            	return price;
            },
            total_cost_price: function(){
            	var price = 0;
            	if(this.property.value){
            		price += this.total_materials;
            		price += this.total_labour_price == 0 ? 0 : this.total_labour_price;
                    price += this.total_driver_price == 0 ? 0 : this.total_driver_price;
                    price += this.total_supervisor_price == 0 ? 0 : this.total_supervisor_price;
            	}
            	return price;
            },
            rate: function(){
            	if(!this.selectedVariable) {
            		return this.task.rate;
            	}
            	let theRate = this.task.rate;
            	let theTypes = this.task.variables;
            	for (let key in theTypes) {
            		if (theTypes.hasOwnProperty(key)) {
            			let filtered  = theTypes[key].filter(theType => {
            				return theType.id == this.selectedVariable;
            			});
            			if(filtered.length){
            				theRate = filtered[0].rate;
            			}
            		}
            	}
            	return theRate;
            },
            totals: function(){
                return {
                    alias: this.task.alias,
                    days: this.total_days,
                    labour_price: this.total_labour_price,
                    driver_price: this.total_driver_price,
                    supervisor_price: this.total_supervisor_price,
                    materials_price: this.total_materials,
                    cost_price: this.total_cost_price,
                    materials: this.materials,
                    variable_id: this.selectedVariable,
                    property_value: this.property.value,
                };
            },
            groupedMaterials: function(){
                return this.systems[this.optionSystem.id].tasks[this.task.alias].materials;
            }
        },
        methods: {
        	addMaterial: function(material){
        		let materialOftypeIndex = this.materials.map(mat => mat.product_type).indexOf(material.product_type);

        		let newMaterial = {
        			id: material.id,
        			name: material.name,
        			product_type: material.product_type,
        			coverage: material.pivot && material.pivot.coverage ? material.pivot.coverage : material.coverage,
        			pack_size: material.pack_size,
        			qty: null,
        			price: null,
        			cost_price: material.cost_price,
        			stock: material.stock,
        			unit_of_measure: material.unit_of_measure,
        			task: this.task.alias,
        			areaconversion: material.pivot && material.pivot.area ? material.pivot.area : false
        		}

        		if(materialOftypeIndex === -1){
        			this.materials.push(newMaterial);
        		}else{
        			this.materials.splice(materialOftypeIndex, 1, newMaterial);
        		}
        		this.updateValues();
        	},
        	// setMaterialOfType: function(event, matType){
        	// 	if(this.chosenMaterials[matType] !== event.target.value){
        	// 		//this.$set(this.chosenMaterials, matType, event.target.value);
        	// 		this.addMaterial(event.target.value, matType);
        	// 	}
        	// },
        	updateValues: function(){
        		if(this.property){
        			var newProp = false;
        			let property = this.property.value || 0;
        			this.materials.forEach((material, key) => {
        				if(material.areaconversion){
        					var strprop = property.toString();
        					var conversion = material.areaconversion.toString();
        					var bracket = conversion.indexOf("(") !== -1 ? '(':'';

        					property = eval(bracket + strprop + conversion);
        					newProp = property;
        				}
        				material.qty = Math.ceil((property/material.coverage));
        				material.price = material.qty * material.cost_price;
        			});

                    //re-do any other materials according to new property
                    if(newProp!==false){
                    	this.materials.forEach((material, key) => {
                    		if(material.areaconversion==false){
                    			material.qty = Math.ceil((newProp/material.coverage));
                    			material.price = material.qty * material.cost_price;
                    		}
                    	});
                    }
                }
                this.$emit('updatevalues', this.totals);
            }
        },
        filters: {
        	capitalize: function (value) {
        		if (!value) return ''
        			value = value.toString()
        		return value.charAt(0).toUpperCase() + value.slice(1)
        	}
        },
        created: function(){
        	this.debounceUpdate = debounce( () => {
                console.log('debouncing');
        		this.updateValues();
        	}, 500);
            //console.log(this.optionProperties);
        	let prop =  this.optionProperties.filter(opProp => opProp.alias == this.task.link_to);
            if(!prop[0].value){
                prop[0].value = prop[0].pivot && prop[0].pivot.value ? prop[0].pivot.value : null;                
            }

            this.property = { ...prop[0] };


         //    console.log('fok ',prop);
        	if(this.task.pivot){
        		if(this.task.pivot.property_value && this.task.pivot.property_value != this.property.value ){
        			this.property.value = this.task.pivot.property_value;					
        		}
        		if(this.task.pivot.variable_id){
        			this.selectedVariable =  this.task.pivot.variable_id;
        		}
        	}
            let systemTaskMaterials = {};
            if(this.systems[this.optionSystem.id].tasks[this.task.alias]){
            	systemTaskMaterials = this.systems[this.optionSystem.id].tasks[this.task.alias].materials;
            }else{
                systemTaskMaterials = this.task.materials;
            }
            
            Object.keys(systemTaskMaterials).forEach(matAlias => {

                Object.keys(systemTaskMaterials[matAlias]).forEach(matKey => {
                    let filteredMats = this.materials.filter(mat => mat.product_type == systemTaskMaterials[matAlias][matKey].product_type);
                    if(!filteredMats.length){
                        this.addMaterial(systemTaskMaterials[matAlias][matKey]);
                        this.chosenMaterials[systemTaskMaterials[matAlias][matKey].product_type] = systemTaskMaterials[matAlias][matKey];
                    }
                });
            });

        	

        },
        mounted: function(){
			//this.updateValues();
		}
	}
</script>

<style lang="css" scoped>
</style>