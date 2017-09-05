<template>
	<div>
		<input name="section[{{key}}][options][{{optionKey}}][id]" type="hidden" v-model="option.id" />
		<div class="row" v-show="!option.show">
	        <div class="col-xs-12">
	            <div class="row">
	                <div class="col-xs-10">
	                    <strong @click.prevent="option.show = !option.show">{{option.name}}</strong>
	                </div>
	                <div class="col-xs-2">
	                    <button class="btn btn-default pull-right btn-xs" @click.prevent="option.show = !option.show" style="margin-left: 10px;"><i class="fui-triangle-down-small"></i></button>
	                </div>
	            </div>
	        </div>                
	    </div>
		<div class="row" v-show="option.show">
			<template v-if="option.system">
				<input type="hidden" name="section[{{key}}][options][{{optionKey}}][system]" value="{{option.system.id}}">
				<template v-for="(propKey, property) in properties">
                    <input type="hidden" name="section[{{key}}][options][{{optionKey}}][{{propKey}}]" value="{{property.value}}">
                </template>
				<div class="col-md-12">
					<div class="row">
						<div class="col-xs-9">
							<div class="form-group">
								<input name="section[{{key}}][options][{{optionKey}}][name]" type="text" class="form-control" placeholder="Option Name" v-model="option.name" value="{{option.system.alias}}" />
							</div>
						</div>
						<div class="col-xs-3">
							<button class="btn btn-default pull-right btn-xs" @click.prevent="option.show = !option.show" style="margin-left: 10px;"><i class="fui-triangle-up-small"></i></button>
			                <button class="btn btn-danger pull-right btn-xs" @click.prevent="removeOption(optionKey)"><i class="fui-cross"></i></button>
			                <div class="clearfix"></div>
						</div>
					</div>
					<div class="form-group">
						<textarea id="option_description_{{optionKey}}" name="section[{{key}}][options][{{optionKey}}][description]" class="form-control" rows="2" placeholder="Explanation / description" v-model="option.description"></textarea>
					</div>
				</div>
			</template>
			<div class="col-md-12">
				<div class="form-group">
					<label for="system">Select System</label>
					<select v-model="option.system" class="form-control" @change="setSystem">
						<option value=""></option>
						<option v-for="system in systems" v-bind:value="system">{{system.name}}</option>
					</select>
				</div>
			</div>
			<div class="col-md-12" v-if="option.system">
				<div class="row" style="margin-bottom:14px">
                    <div class="col-xs-12">
                        <strong>Parameters</strong>
                    </div>
                    <template v-for="(propKey, property) in properties">
                        <div class="col-xs-4" v-if="property.show">
                            <label for="section[{{key}}][{{propKey}}]">{{propKey}}</label>
                            <div class="input-group input-group-sm">
                                <input name="section[{{key}}][{{propKey}}]" type="number" class="form-control" placeholder="{{propKey}}" v-model="property.value" number @keyup="setProperty | debounce 500" />
                                <span class="input-group-addon">{{property.uom}}</span>
                            </div>
                        </div>
                    </template>
                </div>
				<div style="margin-bottom: 25px;">
					<button class="btn btn-inverse pull-right" @click.prevent="newTask=!newTask">
						<span v-if="!newTask">Custom Task</span><span v-else>Close Custom Task</span>
					</button>
					<strong>Tasks:</strong>
				</div>
				<div class="clearfix"></div>
				<div class="" v-show="newTask">
					<form id="newtaskForm">
						<div class="row" v-if="!newTaskExisting">
							<div class="col-xs-6 form-group">
								<input type="text" class="form-control" placeholder="Name" id="custom-task-name" value="" />
							</div>
							<div class="col-xs-2 form-group">
								<select class="form-control" data-toggle="select" id="custom-task-property">
									<!-- <option>Property</option> -->
									<option v-for="(propertyKey, property) in properties" value="{{propertyKey}}">{{propertyKey}}</option>
								</select>
							</div>
							<div class="col-xs-2 form-group">
								<input type="text" class="form-control" placeholder="Capability" id="custom-task-rate" value="" />
							</div>
							<div class="col-xs-2 form-group">
								<select class="form-control" data-toggle="select" id="custom-task-order">
									<!-- <option>Position</option> -->
									<option v-for="task in option.system.tasks" value="{{task.pivot ? task.pivot.order : task.order}}">{{task.pivot ? task.pivot.order : task.order}}</option>
								</select>
							</div>
						</div>
						<div class="row" v-if="!newTaskExisting">
							<div class="col-xs-12 form-group">
								<textarea class="form-control" rows="1" placeholder="Description" id="custom-task-description"></textarea>
							</div>
						</div>
						<div class="row" v-if="!newTaskExisting">
							<div class="col-xs-6 clearfix">
		                        <a class="label text-primary" href="#" @click.prevent="addCustomMaterial()" style=""><i class="fui-plus-circle"></i> Add Material</a>
		                    </div>
						</div>
						<!-- Custom Task Materials -->
						<div class="row" v-if="!newTaskExisting">
							<div class="col-xs-12" v-for="(matType, material) in customMaterials">
								<div class="clearfix" style="border-radius: 5px; background-color: #bdc3c7; padding-top: 20px; margin-bottom: 15px; margin-top: 5px;">
									<span class="fui-cross-circle text-danger" style="position: absolute; right: -12px; top: 2px; z-index: 1" @click="removeCustomMaterial(matType)"></span>
									<div class="col-xs-3 form-group">
										<input type="text" class="form-control" placeholder="Name" id="custom-task-mat-name-{{matType}}" v-model="material.name" />
									</div>
									<div class="col-xs-2 form-group">
										<input type="text" class="form-control" placeholder="Unit of Measure" id="custom-task-mat-measure-{{matType}}" v-model="material.unit_of_measure" />
									</div>
									<div class="col-xs-2 form-group">
										<input type="text" class="form-control" placeholder="Pack Size" id="custom-task-mat-pack-size-{{matType}}" v-model="material.pack_size" />
									</div>
									<div class="col-xs-2 form-group">
										<input type="text" class="form-control" placeholder="Coverage per pack" id="custom-task-coverage-{{matType}}" v-model="material.coverage" />
									</div>
									<div class="col-xs-3 form-group">
										<input type="text" class="form-control" placeholder="Cost Price" id="custom-task-mat-price-{{matType}}" v-model="material.cost_price" />
									</div>
								</div>
							</div>
						</div>
						<!-- End Custom Material -->
						<div class="row" v-if="newTaskExisting">
							<div class="col-xs-8 form-group">
								<select class="form-control" data-toggle="select" id="custom-task-existing">
									<option value="">Select from Existing</option>
									<template v-for="system in systems">
										<optgroup label="{{system.name}}">
											<template v-for="(taskKey, task) in system.tasks">
												<template v-if="!option.system.tasks.hasOwnProperty(taskKey)">
													<option value="{{system.id}}|{{taskKey}}">{{task.name}}</option>
												</template>
											</template>
										</optgroup>
									</template>
								</select>
							</div>
							<div class="col-xs-2 form-group">
								<select class="form-control" data-toggle="select" id="custom-task-existing-order">
									<option>Position</option>
									<option v-for="task in option.system.tasks" value="{{task.pivot ? task.pivot.order : task.order}}">{{task.pivot ? task.pivot.order : task.order}}</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-2 col-xs-offset-10 form-group text-right">
								<button class="btn btn-primary" @click.prevent="customTask(optionKey)">Add Task</button>
							</div>
						</div>
					</form>
				</div>

				<table class="table table-condensed table-bordered">
					<thead>
						<tr>
							<th class="text-center" width="20px"></th>
							<th style="padding: 5px 5px;">&nbsp;</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(taskKey, task) in option.system.tasks" data-order="{{task.pivot ? task.pivot.order : task.order}}"><!-- systems[option.system.id].tasks -->
							<td class="text-center">
								<label class="checkbox no-label" for="{{task.name}}">
									<input type="checkbox" id="{{taskKey}}" name="section[{{key}}][options][{{optionKey}}][tasks][{{taskKey}}][id]" value="{{task.id}}" data-toggle="checkbox" v-model="checkedTasks" @click="addTask($event,task)" style="margin-left: 0;">
								</label>
							</td>
							<td style="padding: 5px 5px;">{{task.pivot ? task.pivot.order : task.order}}</td>
							<td><strong class="text-primary">{{task.name}}</strong><br/>{{task.description}}</td>
						</tr>
					</tbody>
				</table>
				<div class="clearfix"></div>
				<div style="margin-bottm: 5px;">
					<button class="btn btn-primary pull-right btn-sm" @click.prevent="addNote(optionKey)">add Note</button>
					<strong>Notes:</strong>
				</div>
				<div class="clearfix"></div>
				<div class="form-group" v-for="(noteKey, note) in option.notes">
					<input type="hidden" name="section[{{key}}][options][{{optionKey}}][notes][{{noteKey}}][id]" value="{{note.id}}">
					<button class="btn btn-danger btn-xs pull-right" style="z-index:1" @click.prevent="removeNote(noteKey,optionKey)"><i class="fui-cross"></i></button><br>
					<textarea name="section[{{key}}][options][{{optionKey}}][notes][{{noteKey}}][note]" class="form-control" rows="3" placeholder="" v-model="note.note"></textarea>
				</div>
			</div>
			<div class="col-md-12" v-if="option.tasks">
				<!-- <component v-for="(taskKey, task) in option.tasks" :is="task.alias" :task="task" :task-key="taskKey" :option="option" :option-key="optionKey" :section-key="key"></component> -->
				<template v-for="task in option.tasks | orderBy 'order'">
					<task
						:key="key"
						:task-index="$index"
						:task="task"
						:task-key="task.alias"
						:option="option"
						:option-key="optionKey"
						:section="section"
						:section-key="key"
						:properties="properties"
						:system-task="systems[task.system_id] ? systems[task.system_id].tasks[task.alias]:option.system.tasks[task.alias]"
						@task-changed="taskChange"></task>
				</template>

				<!--materials -->
				<div class="panel panel-default" style="margin-top: 20px;">
				<!-- Default panel contents -->
					<div class="panel-heading">
						Complete Material List
					</div>
					<!-- Table -->
					<table class="table table-condensed table-bordered">
						<thead>
							<tr>
								<th width="10%">Type</th>
								<th>Product</th>
								<th width="15%">Qty</th>
								<th width="23%">Cost Price</th>
							</tr>
						</thead>
						<tbody>
							
								<tr v-for="(matKey, material) in all_materials">
									<td> {{material.product_type}}</td>
									<td>
										{{material.name}}
										<!-- <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][id]" type="hidden" v-model="material.id"> -->
									</td>
									<td>
										{{material.qty}}
										<!-- <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][qty]" type="hidden" v-model="material.qty"> -->
									</td>
									<td>
										{{material.price | currency 'R'}}
										<!-- <input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][price]" type="hidden" v-model="material.price">
										<input name="section[{{key}}][options][{{optionKey}}][materials][{{task.alias}}][cost_price]" type="hidden" v-model="material.cost_price"> -->
									</td>
								</tr>
							
							<tr v-if="option.materials">
								<th colspan="4">Extra Materials</th>
							</tr>
							<tr v-for="(matKey, material) in option.materials">
								<template v-if="material.pivot.task=='extra'">
									<td colspan="2">
										{{material.name}}
										<input name="section[{{key}}][options][{{optionKey}}][materials][extra][{{material.product_type+matKey}}][id]" type="hidden" v-model="material.id">
									</td>
									<td>
										<input name="section[{{key}}][options][{{optionKey}}][materials][extra][{{material.product_type+matKey}}][qty]" type="text" class="form-control input-sm" v-model="option.materials[matKey].pivot.qty" value="{{material.pivot.qty}}" @keyup="taskChange | debounce 500">
									</td>
									<td>
										{{material.pivot.cost_price*material.pivot.qty | currency 'R'}}
										<button class="btn btn-danger pull-right btn-xs" @click.prevent="removeMaterial(matKey,optionKey)"><i class="fui-cross" style="margin-top:0"></i></button>
										<input name="section[{{key}}][options][{{optionKey}}][materials][extra][{{material.product_type+matKey}}][cost_price]" type="hidden" v-model="material.pivot.cost_price">
										<input name="section[{{key}}][options][{{optionKey}}][materials][extra][{{material.product_type+matKey}}][price]" type="hidden" value="{{material.pivot.cost_price*material.pivot.qty}}">
										<input name="section[{{key}}][options][{{optionKey}}][materials][extra][{{material.product_type+matKey}}][product_type]" type="hidden" value="{{material.product_type+matKey}}">
										<input name="section[{{key}}][options][{{optionKey}}][materials][extra][{{material.product_type+matKey}}][task]" type="hidden" value="extra">
									</td>
								</template>
							</tr>
						</tbody>
					</table>
					<div style="margin: 5px;">
						<vue-autocomplete
							id="newMaterial"
							name="new_material"
							param="name"
							url="/api/materials"
							anchor="name"
							placeholder="Add Extra Material"
							delay="500"
							label="Material"
							limit="5"
							model="new_material"
							class="form-control input-sm">
						</vue-autocomplete>
					</div>
				</div>
				<!-- Travel -->
				<div class="panel panel-default">
				<!-- Default panel contents -->
					<div class="panel-heading">Travel Costs</div>
					<!-- Table -->
					<input type="hidden" name="section[{{key}}][options][{{optionKey}}][travel][total_distance]" value="{{(laravel.job.distance*2)*option.days}}">
					<input type="hidden" name="section[{{key}}][options][{{optionKey}}][travel][total_price]" value="{{((laravel.job.distance*2)*option.days)*5 | currency 'R'}}">
					<table class="table table-condensed table-bordered">
						<tbody>
							<tr>
								<td>{{laravel.job.distance*2}}km</td>
								<td>{{option.days}}days</td>
								<td>{{(laravel.job.distance*2)*option.days}}km</td>
								<td>{{((laravel.job.distance*2)*option.days)*6.5 | currency 'R'}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- Totals -->
			<div class="col-sm-9 col-sm-offset-3">
				<div class="row">
					<div class="col-sm-4">
						<label>Total Days:</label> <h6 style="margin:0">{{option.days}}</h6>
						<input name="section[{{key}}][options][{{optionKey}}][days]" type="hidden" v-model="option.days">
					</div>
					<div class="col-sm-8">
						<label>Labour Cost Price:</label> <h6 style="margin:0">{{option.total_labour | currency 'R'}}</h6>
						<input name="section[{{key}}][options][{{optionKey}}][total_labour]" type="hidden" v-model="option.total_labour">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 col-sm-offset-4">
						<label>Supervisor Cost Price:</label> <h6 style="margin:0">{{option.total_supervisor | currency 'R'}}</h6>
						<input name="section[{{key}}][options][{{optionKey}}][total_supervisor]" type="hidden" v-model="option.total_supervisor">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 col-sm-offset-4">
						<label>Material Cost Price:</label> <h6 style="margin:0">{{option.total_materials | currency 'R'}}</h6>
						<input name="section[{{key}}][options][{{optionKey}}][total_materials]" type="hidden" v-model="option.total_materials">
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #bdc3c7">
					<div class="col-sm-8 col-sm-offset-4">
						<label>Cost Price:</label> <h5 style="margin:0">{{option.total_cost_price | currency 'R'}}</h5>
						<input name="section[{{key}}][options][{{optionKey}}][total_cost_price]" type="hidden" v-model="option.total_cost_price">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Markup %</label>
						<input name="section[{{key}}][options][{{optionKey}}][markup]" type="number" class="form-control" placeholder="Markup %" v-model="option.markup" number />
					</div>
					<div class="col-sm-4">
						<label>Selling Price:</label> <h3 style="margin:0">{{option.total_cost_price+((option.total_cost_price/100)*option.markup) | currency 'R'}}</h3>
						<input name="section[{{key}}][options][{{optionKey}}][selling_price]" type="hidden" v-model="option.selling_price">
						<small><!-- {{(option.total_cost_price+((option.total_cost_price/100)*option.markup))/properties.size.value | currency 'R'}} /m2 --></small>
					</div>
					<div class="col-sm-4">
						<label class="text-muted">Rate / m2:</label> <h3 class="text-muted" style="margin:0">{{(option.total_cost_price+((option.total_cost_price/100)*option.markup)) / properties.area.value | currency 'R'}}</h3>
					</div>
				</div>
				<div class="row" v-if="pandgTotal">
					<div class="col-sm-8 col-sm-offset-4">
						<label>+ P's and G's:</label> <h6 style="margin:0">{{pandgTotal | currency 'R'}}</h6>
						<input name="section[{{key}}][options][{{optionKey}}][pandg_total]" type="hidden" v-model="pandgTotal">
					</div>
				</div>
			</div>
		</div> <!-- row -->
	</div>
</template>
<script>
	export default{
		props: ['section','key','option','optionKey','images','laravel','removeOption','bindFile','systems','basicSystems','addTerm','pandgTotal'],
		data: function() {
			return {
				newTask: false,
				newTaskExisting: false,
				new_material: '',
				customMaterials: {},
				markup: this.option.markup,
				system: this.option.system,
				tasks: this.option.tasks,
				checkedTasks:[],
				optionDescription: {
                    ops: [
                    	{ insert: this.option.description },
                    ],
                },
                properties:{
                    area: {value: 0, uom: 'm2', show:false},
                    perimeter: {value: 0, uom: 'lm', show:false},
                    crosslaps: {value: 0, uom: 'lm', show:false},
                    /*width: {value: 0, uom: 'lm',show:false},
                    length: {value: 0, uom: 'lm',show:false},*/
                    volume: {value: 0, uom: 'm3',show:false},
                    ridge: {value: 0, uom: 'lm',show:false},
                    sidewall: {value: 0, uom: 'lm',show:false},
                    valleys: {value: 0, uom: 'lm',show:false},
                    honeycomb: {value: 0, uom: 'm2',show:false},
                    crack: {value: 0, uom: 'lm',show:false},
                    plug: {value: 0, uom: 'lm',show:false},
                    /*height: {value: 0, uom: 'm',show:false}*/
                }
			};
		},
		computed:{
			total_extra_materials: function(){
				var total = 0;
				for (var i = 0; i < this.option.materials.length; i++) {
					if(this.option.materials[i].pivot.task=='extra'){
						var cost_price = this.option.materials[i].pivot.cost_price;
						var qty = this.option.materials[i].pivot.qty;
						total+= cost_price * qty
					}
				}
				return total;
			},
			all_materials: function(){
				var mats = [];
				for (var i = 0; i < this.option.tasks.length; i++) {
					for (var j = 0; j < this.option.tasks[i]['materials'].length; j++) {
						mats.push(this.option.tasks[i]['materials'][j]);
					}
				}
				mats  = JSON.parse(JSON.stringify(mats));
				var output = [];

				mats.forEach(function(value) {
					var existing = output.filter(function(v, i) {
						return v.id == value.id;
					});
					if (existing.length) {
						var existingIndex = output.indexOf(existing[0]);
						output[existingIndex].qty += value.qty;
					} else {
						output.push(value);
					}
				});
				return output;
			}
		},
		components:{
			VueAutocomplete: require('../vue-autocomplete.vue'),
			ConcreteMineralTorchOnSystem: require('../systems/ConcreteMineralTorchOnSystem.vue'),
			SanikaBoardedMineralTorchOnSystem: require('../systems/SanikaBoardedMineralTorchOnSystem.vue'),
			//tasks
			task: require('../tasks/task.vue'),
		},
        events:{
            'autocomplete-new_material:selected': function(data){
                this.addMaterial(data);
            },
            priceUpdate: function(){
                this.taskChange();
            }
        },
		methods: {
			setProperty: function(){
				this.$dispatch('property-changed');
			},
			getObjSize: function(obj) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                return size;
            },
            setSystem: function(){
            	if(this.option.system){
	            	this.option.name = this.option.system.name;
	            	this.option.description = this.option.system.description;
	            	for (var i = this.option.system.terms.length - 1; i >= 0; i--) {
	            		this.addTerm(this.option.system.terms[i].id, this.option.system.terms[i].term, true);
	            	}
	            	for (var key in this.properties) {
	            		this.properties[key].show = false;
	            	}
	            	for (var key in this.option.system.tasks) {
				        if (this.option.system.tasks.hasOwnProperty(key)) {
				        	this.properties[this.option.system.tasks[key].link_to].show = true;
				        }
				    }
			var that = this;
	            	var el = 'option_description_'+this.optionKey;
	            	$('#'+el).summernote({
	            		callbacks: {
	            			onChange: function(contents) {
	            				that.option.description = contents;
	            			}
	            		}
	            	});
	            	$('#'+el).summernote('code', this.option.description);
	            }
            },
            taskChange: function(){
                var total_days = 0;
                var total_labour = 0;
                var total_supervisor = 0;
                var total_materials = 0;
                var total_days = 0;
                var total_price = 0;
                
                for (var key in this.tasks) {
                    if (this.tasks.hasOwnProperty(key)){
                        total_days+=Number(this.tasks[key].days);
                        total_labour+=Number(this.tasks[key].total_labour);
                        total_supervisor+=Number(this.tasks[key].total_supervisor);
                        total_materials+=Number(this.tasks[key].total_materials);
                        total_price+=Number(this.tasks[key].total_cost_price);
                    };
                }

                this.option.days = Math.ceil(total_days);
                this.option.total_labour = total_labour;
                this.option.total_supervisor = total_supervisor;
                this.option.total_materials = total_materials+this.total_extra_materials;

                this.option.total_cost_price = total_price+(((laravel.job.distance*2)*total_days)*5);
                this.option.selling_price = this.option.total_cost_price+((this.option.total_cost_price/100)*this.option.markup);
                
            },
            addTask: function(e,task){
            	if(e.target.checked){
            		this.tasks.push({
            			id: task.id,
            			alias: task.alias,
            			name: task.name,
            			description: task.description,
            			link_to: task.link_to,
            			rate: task.rate,
            			order: task.pivot ? task.pivot.order : task.order,
            			materials: [],
            			system_id: task.pivot ? task.pivot.system_id : 0,
            			days: 0,
            			total_labour: 0,
            			total_supervisor: 0,
            			total_materials: 0,
            			total_cost_price: 0
            		});
            	}else{
            		var index = -1
	                for (var i = 0; i < this.tasks.length; i++) {
	                    if(this.tasks[i].alias==task.alias){
	                        index = i;
	                    }
	                }
	                if(index!=-1){
	                    this.tasks.splice(index,1);
	                }
            		//this.$broadcast('materialChanged');
            	}
            	this.taskChange();
            },
            
            customTask: function(optionKey){
                var existing = $('#custom-task-existing').val();
                var name = $('#custom-task-name').val();
                var alias = 'custom-'+name.replace(" ", "").toLowerCase();
                var description = $('#custom-task-description').val();
                var link_to = $('#custom-task-property').val();
                var rate = $('#custom-task-rate').val();
                var order = Number($('#custom-task-order').val());
                var existingOrder = Number($('#custom-task-existing-order').val());
                if(existing==''){
                    var task = {
                    	id: 0,
                        alias: alias,
                        name: name,
                        description: description,
                        link_to: link_to,
                        rate: rate,
                        order: order,
                        materials: [],
                        system_id: ''
                    };
                    var newTasks = {};
                    var shiftOrder = false;
                    for (var taskKey in this.option.system.tasks){
                        if(this.option.system.tasks.hasOwnProperty(taskKey)){
                            if((this.option.system.tasks[taskKey].pivot && this.option.system.tasks[taskKey].pivot.order===order) || this.option.system.tasks[taskKey].order===order){
                                newTasks[alias] = task;
                                shiftOrder = true;
                            }
                            if(shiftOrder){
                            	this.option.system.tasks[taskKey].pivot ? this.option.system.tasks[taskKey].pivot.order++ : this.option.system.tasks[taskKey].order++;
                            }
                            newTasks[taskKey] = this.option.system.tasks[taskKey];
                        }
                    }
                    this.option.system.tasks = Object.assign({}, newTasks);
                    if(Object.keys(this.customMaterials).length>0){
                    	var cusMaterials = {};
                    	for (var matKey in this.customMaterials){
                    		if(cusMaterials.hasOwnProperty(this.customMaterials[matKey]['product_type'])){
                    			var tot = 0;
                    			for(var lastKey in cusMaterials[this.customMaterials[matKey]['product_type']]){
					           		tot++;
					           	}
                    			cusMaterials[this.customMaterials[matKey]['product_type']][tot] = this.customMaterials[matKey];
                    		}else{
                    			cusMaterials[this.customMaterials[matKey]['product_type']] = {
                    				0: this.customMaterials[matKey]
                    			}
                    		}
                    	}
                    	this.option.system.tasks[alias].materials = cusMaterials;
                    	this.customMaterials = {};
                    }
                    this.newTask = false;

                }else{
                	var sysTask = existing.split('|');
                	var newTasks = {};
                    var shiftOrder = false;
                	for (var taskKey in this.option.system.tasks){
                        if(this.option.system.tasks.hasOwnProperty(taskKey)){
                            if((this.option.system.tasks[taskKey].pivot && this.option.system.tasks[taskKey].pivot.order===existingOrder) || this.option.system.tasks[taskKey].order===existingOrder){
                                newTasks[sysTask[1]] = this.systems[sysTask[0]]['tasks'][sysTask[1]];
                                shiftOrder = true;
                            }
                            if(shiftOrder){
                            	this.option.system.tasks[taskKey].pivot ? this.option.system.tasks[taskKey].pivot.order++ : this.option.system.tasks[taskKey].order++;
                            }
                            newTasks[taskKey] = this.option.system.tasks[taskKey];
                        }
                    }
                    this.option.system.tasks = Object.assign({}, newTasks);
                }

            },
            addMaterial: function(material){
                this.option.materials.push({
                    id: material.id,
                    name: material.name,
                    product_type: material.product_type,
                    pivot: {
                    	qty: 1,
	                    cost_price: material.cost_price,
	                    task: 'extra'
                    }
                });
                $('#newMaterial').val('');
                this.taskChange();
            },
            removeMaterial: function(matKey,optionKey){
                this.option.materials.splice(matKey,1);
                this.taskChange();
            },
            addCustomMaterial: function(){
            	var tot = 0;
	           	for(var cusKey in this.customMaterials){
	           		if (this.customMaterials.hasOwnProperty(cusKey)) {
	           			tot++;
	           		}
	           	}
	           	var mat = {}
				mat['cus'+tot] = {
					id: 0,
		           	name: 'Biddem',
		           	product_type: 'biddem',
		           	unit_of_measure: 'm2',
		           	pack_size: '20',
		           	coverage: '20',
		           	cost_price: '240'
	           	}
	           	this.customMaterials = Object.assign({}, this.customMaterials, mat);
	           	
            },
            removeCustomMaterial: function(matKey){
            	var updatedCustomMaterials = {};
            	for(var cusKey in this.customMaterials){
	           		if (!cusKey== matKey) {
	           			updatedCustomMaterials[cusKey] = this.customMaterials[cusKey];
	           		}else{
	           			delete this.customMaterials[matKey];
	           		}
	           	}
                this.customMaterials = Object.assign({}, this.customMaterials, updatedCustomMaterials);
            },
            addNote: function(optionKey){
                this.option.notes.push({
                    id: '',
                    note: ''
                });
            },
            removeNote: function(noteKey,optionKey){
                this.option.notes.splice(noteKey);
            },
            setMaterial: function(optionKey,taskKey, matType){
                var system_mat = this.systems[this.option.system.id].tasks[taskType].materials[matType];
                var activeMaterial = this.option.tasks[taskKey].materials[matType];

                for (var material_id in system_mat) {
                    if (system_mat.hasOwnProperty(material_id)) {
                        if(material_id==activeMaterial.id){
                            activeMaterial.name = system_mat[material_id].name;
                            activeMaterial.cost_price = Number(system_mat[material_id].cost_price);
                            activeMaterial.pack_size = Number(system_mat[material_id].pack_size);
                            activeMaterial.unit_of_measure = system_mat[material_id].unit_of_measure;
                            activeMaterial.stock = system_mat[material_id].stock;
                            for (var i = 0; i < this.section.options[optionKey].orderedTasks.length; i++) {
                                var orderedTask = this.section.options[optionKey].orderedTasks[i];
                                for (var key in orderedTask.materials) {
                                    if (orderedTask.materials.hasOwnProperty(key)) {
                                        if(orderedTask.materials[key].product_type==matType){
                                            orderedTask.materials[key] = activeMaterial;
                                        }
                                        
                                    }
                                }
                            }
                        }
                    }
                }
                this.$broadcast('materialChanged');
                //this.calcMaterial();
            },
            setDescription: function(){
            	//var markupStr = $('#description-'+this.optionKey).summernote('code');
            	//this.option.description = markupStr;
            },
            /*cke:function(el){
            	var that = this;
            	CKEDITOR.replace(el, {
				    customConfig: '',
				    uiColor: '#eff0f2',
				    toolbar: [
						{ name: 'clipboard', items: ['Undo', 'Redo' ] },
						{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
						{ name: 'editing', items: [ 'Scayt' ] },
						{ name: 'insert', items: [ 'Table', 'SpecialChar' ] },
						{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
						{ name: 'document', items: [ 'Source' ] },
						{ name: 'tools', items: [ 'Maximize' ] },
					]
				});
				CKEDITOR.instances[el].on('change', function() {
                    that.option.description = this.document.getBody().getHtml();
                });
            }*/
            smn:function(el,key){
                var that = this;
                $('#'+el).summernote({
                	callbacks: {
                		onChange: function(contents) {
                			that.option.description = contents;
                		}
                	}
                });
                $('#'+el).summernote('code', that.option.description);
            }
		},
		ready(){
            if(this.section.id!=0){
                for (var task in this.option.tasks) {
                    if (this.option.tasks.hasOwnProperty(task)) {
                        this.checkedTasks.push(this.option.tasks[task].id.toString());
                    }
                }
            }
            if(this.option.system){
            	//this.cke('option_description_'+this.optionKey);
            	this.smn('option_description_'+this.optionKey,this.optionKey);
            }
		}
	}
</script>