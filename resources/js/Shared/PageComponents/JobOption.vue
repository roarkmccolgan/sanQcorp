<template>
	<div class="">
		<div class="mx-3 pl-3 mb-2 flex items-center justify-between rounded border border-teal-400" v-show="!show">
			<h4 class="flex-1" :class="{'text-red-400 italic' : optionName == ''}">{{ optionName ? optionName : 'Please provide name' }}</h4>
			<div class="flex items-center">
				<button class="rounded border p-1 focus:outline-none cursor-pointer hover:bg-gray-100 m-1" @click.prevent="show = !show"><chevron-down-icon class="w-6 h-6"></chevron-down-icon></button>
				<button class="rounded border p-1 focus:outline-none cursor-pointer hover:bg-red-100 m-1" @click.prevent="$emit('deleteoption')"><trash-2-icon class="w-6 h-6"></trash-2-icon></button>				
			</div>
		</div>
		<div class="flex flex-wrap" v-show="show">
			<div class="w-full mx-3 mb-2" v-show="optionSystem">
				<div class="flex items-center justify-between">
					<input v-model="optionName" class="appearance-none w-full block bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="optionName" placeholder="Option Name" type="text">
					<div class="flex items-center">
						<button class="rounded border p-1 focus:outline-none cursor-pointer hover:bg-gray-100 m-1" @click.prevent="show = !show"><chevron-up-icon class="w-6 h-6"></chevron-up-icon></button>
						<button class="rounded border p-1 focus:outline-none cursor-pointer hover:bg-red-100 m-1" @click.prevent="$emit('deleteoption')"><trash-2-icon class="w-6 h-6"></trash-2-icon></button>				
					</div>
				</div>
			</div>
			<div class="w-full mx-3 mb-2">
				<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="typeOfWork">Type of work</label>
				<div class="relative">
					<select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="typeOfWork" v-model="optionSystem">
						<option></option>
						<option v-for="(system, id) in systems" :value="system">{{ system.name }}</option>
					</select>
					<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
						<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
					</div>
				</div>
			</div>
			<div class="w-full mx-3 my-2" v-show="optionSystem">
				<basic-editor class="w-full my-2" v-model="optionDescription"></basic-editor>
			</div>
			<div class="w-full flex flex-wrap mx-3 my-2">
				<h5 class="block w-full uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Parameters</h5>
				<div class="w-1/3" v-for="(prop, index) in optionProperties">
					<div class="flex items-center">
						<input v-model="prop.value" class="appearance-none block bg-gray-200 text-gray-700 border border-gray-200 rounded-l py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="" type="number">
						<div class="bg-gray-300 text-gray-700 border border-gray-200 rounded-r py-3 px-4 leading-tight">
							{{ prop.uom }}
						</div>
					</div>
					<span class="text-gray-600 text-sm">{{ prop.alias }}</span>
				</div>
			</div>
			<div class="w-full mx-3 my-2" v-show="orderedOptionSystemTasks.length">
				<div class="flex items-center justify-between mb-2">
					<h3 class="text-2xl font-light mb-1">Tasks</h3>
					<div class="flex items-center">
						<span class="">{{ showNewTask ? 'Hide': '' }} Custom Task</span>
						<button class="mx-2 focus:outline-none cursor-pointer rounded border hover:bg-gray-200" @click.prevent="showNewTask = !showNewTask">
							<plus-icon class="w-6 h-6" v-if="!showNewTask"></plus-icon>
							<minus-icon class="w-6 h-6" v-else></minus-icon>
						</button>
					</div>					
				</div>
				<div class="p-2 bg-blue-100 rounded" v-if="showNewTask">
					<label class="items-start cursor-pointer inline-flex">
						<input type="checkbox" v-model="newTaskFromExisting" class="form-checkbox border-gray-400 text-teal-400 w-6 h-6">
						<div class="font-medium ml-2">Select from existing</div>
					</label>
					<div v-if="newTaskFromExisting">
						<div class="">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="customproperty">Property</label>
							<div class="relative">
								<select ref="custom-existing-task" class="block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="customproperty" >
									<template v-for="(system, id) in systems">
									<optgroup :label="system.name">
										<option v-for="(task, alias) in system.tasks" :value="task.id">{{ task.name }}</option>
									</optgroup>
									</template>
								</select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
								</div>
							</div>
						</div>
					</div>
					<div v-else>
						<div class="flex flex-wrap mt-2 -mx-2">
							<div class="w-3/6 px-2">
								<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="custom-name">Task name</label>
								<input ref="custom-name" class="w-full appearance-none block text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="Remove Biddem" name="custom-name" id="custom-name" placeholder="" type="text">
							</div>
							<div class="w-1/6 px-2">
								<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="custom-property">Property</label>
								<div class="relative">
									<select ref="custom-property" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="custom-property" >
										<option v-for="(property, index) in allProperties" :value="index">{{ property.name }}</option>
									</select>
									<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
										<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
									</div>
								</div>
							</div>
							<div class="w-1/6 px-2">
								<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="custom-capability">Capability</label>
								<input ref="custom-capability" class="w-full appearance-none block text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="200" name="custom-capability" id="custom-capability" placeholder="" type="text">
							</div>
							<div class="w-1/6 px-2">
								<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="custom-order">Order</label>
								<div class="relative">
									<select ref="custom-order" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="custom-order" >
										<option selected v-for="task in orderedOptionSystemTasks" :value="task.pivot ? task.pivot.order : task.order">{{task.pivot ? task.pivot.order : task.order}}</option>
										<option :value="orderedOptionSystemTasks[orderedOptionSystemTasks.length - 1].pivot.order + 1">{{ orderedOptionSystemTasks[orderedOptionSystemTasks.length - 1].pivot.order + 1 }}</option>
									</select>
									<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
										<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
									</div>
								</div>
							</div>
							<div class="w-full px-2 mt-2">
								<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="custom-description">Description</label>
								<textarea ref="custom-description" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="custom-description" >Remove existing biddem blah blah blah blah blah blah blah blah</textarea>
							</div>
							<div class="flex items-center px-2 mt-2">
								<span class="">Add Material</span>
								<button class="mx-2 focus:outline-none cursor-pointer rounded border hover:bg-gray-200" @click.prevent="addCustomMaterial"><plus-icon class="w-6 h-6"></plus-icon></button>
							</div>
							<div class="w-full mt-2" v-for="(material, matType) in customMaterials">
								<div class="flex">
									<div class="px-2">
										<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="`custom-material-name-${matType}`">Name</label>
										<input class="w-full appearance-none block text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="material.name" :name="`custom-material-name-${matType}`" :id="`custom-material-name-${matType}`" placeholder="" type="text">
									</div>
									<div class="px-2">
										<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="`custom-material-uom-${matType}`">Unit of measure</label>
										<input class="w-full appearance-none block text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="material.unit_of_measure" :name="`custom-material-uom-${matType}`" :id="`custom-material-uom-${matType}`" placeholder="" type="text">
									</div>
									<div class="px-2">
										<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="`custom-material-packsize-${matType}`">Pack size</label>
										<input class="w-full appearance-none block text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="material.pack_size" :name="`custom-material-packsize-${matType}`" :id="`custom-material-packsize-${matType}`" placeholder="" type="text">
									</div>
									<div class="px-2">
										<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="`custom-material-coverage-${matType}`">Coverage (per pack)</label>
										<input class="w-full appearance-none block text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="material.coverage" :name="`custom-material-coverage-${matType}`" :id="`custom-material-coverage-${matType}`" placeholder="" type="text">
									</div>
									<div class="px-2">
										<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="`custom-material-cost-${matType}`">Cost Price</label>
										<input class="w-full appearance-none block text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="material.cost_price" :name="`custom-material-cost-${matType}`" :id="`custom-material-cost-${matType}`" placeholder="" type="text">
									</div>
									<div class="self-center">
										<button class="focus:outline-none cursor-pointer rounded border hover:bg-gray-200 p-1 mt-1 mr-1 text-red-400" @click.prevent="removeCustomMaterial(matType)"><trash-2-icon class="w-4 h-4"></trash-2-icon></button>										
									</div>
								</div>
							</div>
						</div>
						<div class="flex items-center justify-end px-2 mt-2">
							<button class="flex items-center cursor-pointer focus:outline-none mb-2 inline-block text-center text-white rounded bg-teal-500 px-4 py-2" @click.prevent="customTask">
								<plus-icon class="w-6 h-6"></plus-icon>
								<span>Add Task</span>
							</button>
						</div>
					</div>
				</div>
				<div class="flex flex-wrap items-center mb-2" v-for="(task, index) in orderedOptionSystemTasks">
					<label class="flex items-start mt-2 cursor-pointer">
						<input type="checkbox" :checked="optionTasks.filter((o) => o.alias == task.alias ).length" class="form-checkbox border-gray-400 text-teal-400 w-6 h-6 mt-1" @change="modifyTask($event, task)">
						<div class="ml-4 flex items-start">
							<div class="font-light mr-2 text-gray-500 flex items-center justify-center">
								{{ task.pivot.order }}
							</div>
							<div class="">
								<span class="font-medium">{{ task.name }}</span>
								<div class="text-sm">
									{{ task.description }}
								</div>								
							</div>
						</div>
					</label>
				</div>
			</div>
			<div class="w-full mx-3 my-2" v-show="orderedCheckedTasks.length">
				<div v-for="task in orderedCheckedTasks">
					<option-task :key="task.alias" :task="task" :option-properties="optionProperties" :option-system="optionSystem" :option-materials="optionMaterials" :systems="systems" @updatevalues="updateTotals"></option-task>
				</div>
			</div>
			<div class="w-full p-3">
				<div class="flex items-center">
					<h5 class="uppercase tracking-wide text-gray-700 text-xs font-bold">Notes</h5>
					<button class="mx-2 focus:outline-none cursor-pointer rounded border hover:bg-gray-200" @click.prevent="addNote({note:''})"><plus-icon class="w-6 h-6"></plus-icon></button>
				</div>
				<div class="mr-10 relative" v-for="(note, i) in optionNotes">
					<basic-editor class="w-full my-2" v-model="note.note"></basic-editor>
					<button class="absolute rounded border p-1 focus:outline-none cursor-pointer hover:bg-red-100 m-1" style="right: -40px; top: 0px;" @click.prevent="removeNote(i)"><trash-2-icon class="w-4 h-4"></trash-2-icon></button>
				</div>
			</div>
			<div class="w-full mx-3 my-2 pr-8">
				<h3 class="text-2xl font-light mb-1">Complete Material List</h3>
				<table class="table-fixed text-left w-full">
					<thead v-if="allMaterials.length">
						<tr class="text-xs">
							<th class="px-2 py-1 w-1/6">Type</th>
							<th class="px-2 py-1 w-3/6">Product</th>
							<th class="px-2 py-1 w-1/6">Qty</th>
							<th class="px-2 py-1 w-1/6">Cost Price</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="material in optionMaterials">
							<td class="border px-2 py-1">{{ material.product_type }}</td>
							<td class="border px-2 py-1">{{ material.name }}</td>
							<td class="border px-2 py-1">{{ material.qty }}</td>
							<td class="border px-2 py-1">{{ material.cost_price * material.qty | toCurrency }}</td>
						</tr>
						<tr v-for="(material, i) in extraMaterials">
							<td class="border px-2 py-1">{{ material.product_type }}</td>
							<td class="border px-2 py-1">{{ material.name }}</td>
							<td class="border px-2 py-1">
								<input v-model="material.qty" @change="updateExtraMaterialPrice(material,$event)" class="appearance-none w-full block bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="qty" type="number">
							</td>
							<td class="border px-2 py-1 relative">
								{{ material.cost_price * material.qty | toCurrency }}
								<button class="absolute rounded border p-1 focus:outline-none cursor-pointer hover:bg-red-100 m-1" style="right: -40px; top: 0px;" @click.prevent="removeExtraMaterial(i)"><trash-2-icon class="w-4 h-4"></trash-2-icon></button>
							</td>
						</tr>
						<tr class="bg-gray-200">
							<td class="border px-2 py-1 w-1/6">Extra Material</td>
							<td class="border px-2 py-1" colspan="3">
								<div class="flex items-center w-full">
									<auto-complete class="flex-1" v-model="selectedDataMaterial" @input="addExtraMaterial" :options="dataMaterials" :search="searchText" @search="newSearchText => searchText = newSearchText"/>									
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="w-full mt-2">
				<div class="p-3" v-show="tasks.length">
					<h3 class="text-2xl font-light mb-1">Option Details</h3>
					<div class="flex items-center flex-wrap">
						<div class="p-2">
							<label class="items-start cursor-pointer flex items-center">
								<input type="checkbox" v-model="changeNightShift" class="form-checkbox border-gray-400 text-teal-400 w-6 h-6">
								<div class="font-medium ml-2">Nightshift</div>
							</label>
						</div>
						<template v-if="changeNightShift">
							<div class="w-full">
								<div class="flex p-2">
									<label class="items-start cursor-pointer flex items-center border border-gray-400 rounded pl-2">
										<div class="mr-2">Nights</div>
										<input type="number" v-model="optionNightshift.nights" class="appearance-none block w-12 bg-gray-200 text-gray-700 border border-gray-200 rounded-r py-2 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
									</label>
								</div>
							</div>
							<div class="w-full flex flex-wrap items-center">
								<div class="p-2" v-for="labours in nightshift.labours">
									<label class="items-start cursor-pointer flex items-center border border-gray-400 rounded pl-2">
										<div class="mr-2">{{ labours.type }}</div>
										<input type="number" v-model="labours.qty" class="appearance-none block w-12 bg-gray-200 text-gray-700 border border-gray-200 rounded-r py-2 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
									</label>
								</div>
								
							</div>							
						</template>
						<hr class="border-1 w-full my-2">
						<h4 class="font-medium mt-1 ml-2 w-full">Number of round trips the driver makes</h4>
						<div class="flex p-2">
							<label class="items-start cursor-pointer flex items-center border border-gray-400 rounded pl-2">
								<div class="mr-2">Driver days</div>
								<input type="number" v-model="driverDaysOverride" class="appearance-none block w-12 bg-gray-200 text-gray-700 border border-gray-200 rounded-r py-2 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
							</label>
						</div>
					</div>
				</div>
				<div class="flex justify-between items-center border-t bg-gray-200">
					<div class="flex flex-wrap items-center">
						<div class="p-6">
							<h5 class="uppercase tracking-wide text-gray-700 text-xs font-bold">Days</h5>
							<div class="text-2xl font-light">
								{{ totalDays }}
							</div>
						</div>
						<div class="p-6">
							<h5 class="uppercase tracking-wide text-gray-700 text-xs font-bold">Labour</h5>
							<div class="text-2xl font-light">
								{{ totalLabour | toCurrency }}
							</div>
						</div>
						<div class="p-6">
							<h5 class="uppercase tracking-wide text-gray-700 text-xs font-bold">Supervisor</h5>
							<div class="text-2xl font-light">
								{{ totalSupervisor | toCurrency }}
							</div>
						</div>
						<div class="p-6">
							<h5 class="uppercase tracking-wide text-gray-700 text-xs font-bold">Materials</h5>
							<div class="text-2xl font-light">
								{{ totalMaterials | toCurrency }}
							</div>
						</div>
						<div class="p-6" v-if="totalNightShift">
							<h5 class="uppercase tracking-wide text-gray-700 text-xs font-bold">Nightshift Total</h5>
							<div class="text-2xl font-light">
								{{ totalNightShift | toCurrency }}
							</div>
						</div>
						<div class="p-6">
							<h5 class="uppercase tracking-wide text-gray-700 text-xs font-bold">Total Cost Price</h5>
							<div class="text-2xl font-light">
								{{ totalCostPrice | toCurrency }}
							</div>
						</div>
					</div>
					<div class="flex items-center justify-end">

						<div class="p-6">
							<label class="uppercase tracking-wide text-gray-700 text-xs font-bold" for="sellingPrice">Markup %</label>
							<input type="number" v-model="optionMarkup" id="sellingPrice" class="appearance-none block w-16 text-gray-700 border border-gray-200 rounded py-2 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
						</div>
						<div class="p-6">
							<h5 class="uppercase tracking-wide text-gray-700 text-xs font-bold">Total Selling Price</h5>
							<div class="text-2xl font-light">
								{{ sellingPrice | toCurrency }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import debounce from 'just-debounce-it';
	import clone from 'just-clone';
	import merge from "just-merge";
	//import map from 'just-map-values';
	//import filter from 'just-filter-object';
	//import reduce from 'just-reduce-object';

	import BasicEditor from '@/Shared/BasicEditor'
	import OptionTask from '@/Shared/PageComponents/OptionTask'
	import AutoComplete from '@/Shared/AutoComplete'

	export default {
		name: 'JobOption',

		props: [
			'id',
			'name',
			'description',
			'system',
			'system_id',
			'notes',
			'days',
			'total_labour',
			'total_supervisor',
			'total_materials',
			'total_cost_price',
			'total_selling_price',
			'markup',
			'selectedTasks',
			'tasks',
			'nightshift',
			'orderedTasks',
			'materials',
			'images',
			'systems',
			'labour',
			'properties',

			'sectionProperties',
		],

		data () {
			return {
				show: true,

				optionTasks: clone(this.tasks),
				optionMaterials: [],
				optionSystem: clone(this.system),
				customMaterials: {},
				extraMaterials: [],
				showNewTask: false,
				newTaskFromExisting: false,
				searchText: '',
				dataMaterials: [],
				selectedDataMaterial: null,
				changeNightShift: this.nightshift.nights ? true : false,
				//nightshiftNights: 1,
				driverDaysOverride: 0,
			}
		},
		components:{
			BasicEditor,
			OptionTask,
			AutoComplete
		},
		watch: {
			searchText: function(value) {
				if(String(value).trim() === ''){
					return;
				}
				this.debounceSearch.call(this, value);	
			},
			// driverDaysOverride: function(value, oldValue) {
			// 	if(value < this.totalDays){
			// 		this.driverDaysOverride = this.totalDays;
			// 	}
			// },
			optionSystem: function(system, oldValue){
				console.log('watch triggered system');
				this.optionName =  system.name;
				this.optionDescription = system.description;
				this.optionSystemId = system.id;
				this.optionTasks = [];
				this.optionMaterials = [];
				this.updateNightShiftLabour();
				this.loadUniqueProps();
			},
			changeNightShift: function (newVal, oldVal){
				if(newVal && newVal != oldVal){
					this.optionNightshift.nights = 1;
				}else{
					this.optionNightshift.nights = null;
				}
				this.updateOption();
     		},
			'optionNightshift.nights': function(newValue,oldValue){
				if(newValue > this.totalDays){
					this.optionNightshift.nights = oldValue;
				}
				this.updateOption();
			},
			totalDays: function(newValue,oldValue){
				this.driverDaysOverride = newValue;
				this.updateOption();
			}
		},
		computed: {
			orderedOptionSystemTasks: function(){
				if(!this.optionSystem) return [];
				let tasksArr = Object.entries(this.optionSystem.tasks).map((arr, index) =>{ 
					return arr[1];
				}).sort((a, b) => a.pivot.order - b.pivot.order);
				//tasksArr = map(tasksArr, (value, key) => value[1]); 
				return tasksArr;
			},
			orderedCheckedTasks: function(){
				return this.optionTasks.sort((a, b) => {
					return a.pivot.order - b.pivot.order;
				});
			},
			allMaterials: function(){
				// let merged = [];
				// this.optionMaterials.forEach((material, key) => {
				// 	let materialOfIdIndex = merged.findIndex(mat => mat.id == material.id);
					
				// 	if(materialOfIdIndex === -1){
				// 		merged.push(clone(material));
				// 	} else {
				// 		console.log(merged[materialOfIdIndex].qty, material.qty);
				// 		merged[materialOfIdIndex].qty += material.qty;
				// 		merged[materialOfIdIndex].price = merged[materialOfIdIndex].qty * merged[materialOfIdIndex].cost_price;
				// 	}
				// });
				// return merged;
				return this.optionMaterials.concat(this.extraMaterials);
			},
			allProperties: function(){
				let props = [];
				let systems = Object.entries(this.systems);
				systems.forEach((systemArr, id) => {
					let tasks = Object.entries(systemArr[1].tasks);
					tasks.forEach((taskArr, alias) => {
						let properties = taskArr[1].properties;
						properties.forEach(property => {
							let isUnique = props.filter((value, index, self) => value.id == property.id);
							if(!isUnique.length){
								let newProp = {
									id: property.id,
									alias: property.alias,
									name: property.name,
									uom: property.uom,
								};
								props.push(newProp);
							}
						});
					});
				});
				return props;
			},
			totalDays: function(){
				let days = 0;
				this.optionTasks.forEach(task => days+= task.pivot.days);
				if(this.optionNightshift.nights && this.totalNightShift){
					days-= this.optionNightshift.nights/2;
				}
				return Math.ceil(days);
			},
			driverDays: function() {
				if(this.driverDaysOverride != this.totalDays){
					return this.driverDaysOverride
				}
				return this.totalDays;
			},
			totalLabour: function(){
				let labour = 0;
				this.optionTasks.forEach(task => {
					labour+= task.pivot.total_labour_price;
				});
				return labour;
			},
			totalDriver: function(){
				return this.labour.filter(labour => labour.type == 'Driver')[0].day_rate * this.driverDays;
			},
			totalSupervisor: function(){
				let supervisor = 0;
				this.optionTasks.forEach(task => {
					supervisor+= task.pivot.total_supervisor_price;
				});
				return supervisor;
			},
			totalCostPrice: function(){
				let cost = 0;
				cost+= this.totalLabour;
				cost+= this.totalDriver;
				cost+= this.totalSupervisor;
				cost+= this.totalMaterials;
				if(this.optionNightshift.nights){
					cost+= this.totalNightShift;
				}
				return cost;
			},
			totalMaterials: function(){
				let materials = 0;
				//this.optionTasks.forEach(task => materials+= task.pivot.total_materials_price);
				this.allMaterials.forEach(mat => materials+= mat.cost_price * mat.qty);
				return materials;
			},
			totalNightShift: function(){
				if(!this.optionNightshift.nights) return 0;
				let tot = 0;
				this.optionNightshift.labours.forEach(labour => {
					let qty = labour.qty ? labour.qty : labour.pivot.qty;
					tot+= (labour.day_rate * qty) * this.optionNightshift.nights
				});
				return tot;
			},
			sellingPrice: function(){
				return this.totalCostPrice+((this.totalCostPrice/100)*this.optionMarkup);
			},
			optionName: {
				get() { return this.name },
				set(newValue){
					this.$emit('update:name', newValue);
				}
			},
			optionMarkup: {
				get() { return this.markup },
				set(newValue){
					this.$emit('update:markup', newValue);
				}
			},
			optionDescription: {
				get() { return this.description },
				set(newValue){
					this.$emit('update:description', newValue)
				}
			},
			optionSystemId: {
				get() { return this.system_id },
				set(newValue){
					this.$emit('update:system_id', newValue)
				}
			},
			optionProperties: {
				get() { return this.properties },
				set(newValue){
					this.$emit('update:properties', newValue)
				}
			},
			optionNotes: {
				get() { return this.notes },
				set(newValue){
					this.$emit('update:notes', newValue)
				}
			},
			optionNightshift: {
				get() {
					return this.nightshift
				},
				set(newValue){
					this.$emit('update:nightshift', newValue)
				}
			},
		},
		methods: {
			setSystem: function(system){
				this.optionSystem = system;
				//this.optionSystemId = this.optionSystem.id;
				// this.$nextTick(function () {
				// 	this.optionName =  this.systems[this.optionSystem.id].name;
				// 	this.optionDescription = this.systems[this.optionSystem.id].description;
				// 	this.optionTasks = [];
				// 	this.optionMaterials = [];
				// 	this.updateNightShiftLabour();
				// 	this.loadUniqueProps();
				// })
			},
			updateNightShiftLabour: function(){
				this.optionSystem.labour.forEach((labour, index) => {
					let newLabour = {
						id: labour.id,
						qty: labour.pivot.qty,
						type: labour.type,
						day_rate: labour.day_rate * 1.5,
					};
					this.nightshift.labours.push(newLabour);
				});
			},
			loadUniqueProps: function(){
				let props = [];
				if(!this.optionSystem) return props;
				let tasks = Object.values(this.optionSystem.tasks);
				tasks.forEach(task => {
					task.properties.forEach(property => {
						let propIndex = props.findIndex(prop => prop.id == property.id);
						if(propIndex === -1){
							property.value = null;
							let existingOptionPropIndex = this.optionProperties.findIndex((prop) => prop.id == property.id);
							if(existingOptionPropIndex  !== -1){
								let existProp = this.optionProperties[existingOptionPropIndex];
								property.value = existProp.value ? existProp.value : (existProp.pivot.value ? existProp.pivot.value : null);
							}
							props.push(property);
						}
					});
				});
				// for (var i = 0; i < tasks.length; i++) {Å
				// 	let properties = tasks[i][1].properties;
				// 	if (Object.keys(properties).length){
				// 		let propertiesArr = Object.entries(properties);
				// 		for (var j = 0; j < propertiesArr.length; j++) {
				// 			let isUnique = props.filter((value, index, self) => value.id == propertiesArr[j][1].id);
				// 			if(!isUnique.length){
				// 				let newProp = {
				// 					id: propertiesArr[j][1].id,
				// 					alias: propertiesArr[j][1].alias,
				// 					name: propertiesArr[j][1].name,
				// 					uom: propertiesArr[j][1].uom,
				// 					value: '',
				// 					// show: true,
				// 					// count: 1,
				// 				};
				// 				let existingOptionProp = this.optionProperties.filter((value) => value.id == newProp.id);
				// 				if(existingOptionProp.length){
				// 					newProp.value = existingOptionProp[0].pivot.value;
				// 				}
				// 				props.push(newProp);
				// 			}
				// 		}
				// 	}
				// }
				this.optionProperties = props;
				this.$nextTick(function(){
					this.$emit('modify-properties', this.optionProperties);
				});
			},
			async searchMaterials(value){
				this.$http.get(`/materials?q=${value}`).then( result => {
					this.dataMaterials = result.data.materials;
				});
			},
			modifyTask: function(event, task){
				if(event.target.checked){
					let newTask = clone(task);
					//newTask.materials = [];
					let propIndex = Object.values(this.optionProperties).findIndex(prop => {
						return prop.alias == newTask.link_to;
					});
					console.log(propIndex);

					let pivot = {
						'order': newTask.pivot.order,
						'days': null,
						'difficulty': null,
						'total_labour_price': null,
						'total_driver_price': null,
						'total_supervisor_price': null,
						'total_materials_price': null,
						'total_cost_price': null,
						'total': null,
						'done': null,
						'complete': 0,
						'variable_id': null,
						'property_value': this.optionProperties[propIndex].value,
					}
					newTask.pivot = pivot;
					this.optionTasks.push(newTask);
				}else{
					let updatedTasks = this.optionTasks.filter(function( obj ) {
					    return obj.id !== task.id;
					});
					this.optionTasks = updatedTasks;
				}
			},
			updateTotals: function(totals){
				totals.materials.forEach(material => {
					this.addOrUpdateMaterial(material);
				});
				let taskIndex = this.optionTasks.findIndex(existingTask => existingTask.alias == totals.alias);
				if(taskIndex !== -1){
					this.optionTasks[taskIndex].pivot.days = totals.days;
					this.optionTasks[taskIndex].pivot.total_labour_price = totals.labour_price;
					this.optionTasks[taskIndex].pivot.total_driver_price = totals.driver_price;
					this.optionTasks[taskIndex].pivot.total_supervisor_price = totals.supervisor_price;
					this.optionTasks[taskIndex].pivot.total_materials_price = totals.materials_price;
					this.optionTasks[taskIndex].pivot.total_cost_price = totals.cost_price;
					this.optionTasks[taskIndex].pivot.property_value = totals.property_value;
					this.optionTasks[taskIndex].variable_id = totals.variable_id;
				}
				this.driverDaysOverride = this.totalDays;
				this.updateOption();
			},
			addOrUpdateMaterial: function(material){
				let materialOfTypeIndex = this.optionMaterials.findIndex(mat => (mat.id == material.id && mat.task == material.task));

				if(materialOfTypeIndex === -1){
					let materialOfTaskIndex = this.optionMaterials.findIndex(mat => (mat.product_type == material.product_type && mat.task == material.task));
					if(materialOfTaskIndex === -1){
						this.optionMaterials.push(material);
					}else{
						this.$set(this.optionMaterials, materialOfTaskIndex, material);
					}
				}else{
					this.$set(this.optionMaterials[materialOfTypeIndex], 'qty', material.qty);

					this.$set(this.optionMaterials[materialOfTypeIndex], 'price', this.optionMaterials[materialOfTypeIndex]['qty'] * this.optionMaterials[materialOfTypeIndex]['cost_price']);
				}
			},
			addNote: function(note){
				let newNote = {
					id: note.hasOwnProperty('id') ? note.id: '',
					note: note.note,
				}
				this.optionNotes.push(note);
			},
			removeNote: function(key){
				this.optionNotes.splice(key,1);
			},
			removeOption: function(key){
				this.optionNotes.splice(key);
			},
			addExtraMaterial: function(material){
                let mat = {
					id: material.id,
					cost_price: material.cost_price,
					coverage: material.coverage,
					product_type: material.product_type,
					name: material.name,
					pack_size: material.pack_size,
					price: material.cost_price,
					qty: 1,
					stock: material.stock,
					task: "extra",
					unit_of_measure: material.unit_of_measure,
                    // pivot: {
                    // 	qty: 1,
	                   //  cost_price: material.cost_price,
	                   //  task: 'extra'
                    // }
                };
                this.extraMaterials.push(mat);
                this.updateOption();
            },
            removeExtraMaterial: function(key){
                this.extraMaterials.splice(key,1);
                this.updateOption();
            },
            updateExtraMaterialPrice: function(material, event){
            	let newValue = event.target.value;
            	if(newValue >=1) {
            		material.price = material.cost_price * newValue;
            	}else{
            		material.qty = 1;
            		material.price = material.cost_price;
            	}
            },
            removeMaterial: function(matKey,optionKey){
                this.option.materials.splice(matKey,1);
                //this.taskChange();
            },
			addCustomMaterial: function(){
				let tot = Object.keys(this.customMaterials).length;
            	
	           	let mat = {
	           		id: 0,
		           	name: 'Biddem',
		           	product_type: 'biddem',
		           	unit_of_measure: 'm2',
		           	pack_size: '20',
		           	coverage: '20',
		           	cost_price: '240'
	           	}
	           	this.$set(this.customMaterials, 'cus'+tot, mat);	           	
            },
            removeCustomMaterial: function(matKey){
            	this.$delete(this.customMaterials,matKey);
            },
            customTask: function(optionKey){
            	let tasksEmpty = this.optionTasks.length;
                let systemTasks = this.optionSystem.tasks;
                if(!this.newTaskFromExisting){
                	let name = this.$refs['custom-name'].value;
	                let alias = 'custom-'+name.replace(" ", "").toLowerCase();
	                let description = this.$refs['custom-description'].value;
	                let link_to = this.allProperties[this.$refs['custom-property'].value].alias;
	                let unit_of_measure = this.allProperties[this.$refs['custom-property'].value].uom;
	                let rate = this.$refs['custom-capability'].value;
	                let order = Number(this.$refs['custom-order'].value);
                    let task = {
                    	id: 0,
                        alias: alias,
                        unit_of_measure: unit_of_measure,
                        name: name,
                        description: description,
                        properties: [this.allProperties[this.$refs['custom-property'].value]],
                        link_to: link_to,
                        rate: rate,
                        pivot: {
                        	order: order
                        },
                        materials: {},
                        system_id: ''
                    };
                    let newTasks = {};
                    let shiftOrder = false;

                    for (var taskKey in systemTasks){
                        if(systemTasks.hasOwnProperty(taskKey)){
                            if((systemTasks[taskKey].pivot && systemTasks[taskKey].pivot.order===order) || systemTasks[taskKey].order===order){
                                shiftOrder = true;
                            }
                            if(shiftOrder){
                            	systemTasks[taskKey].pivot ? systemTasks[taskKey].pivot.order++ : systemTasks[taskKey].order++;
                            }
                            newTasks[taskKey] = systemTasks[taskKey];
                        }
                    }
                    newTasks[alias] = task;
                    if(Object.keys(this.customMaterials).length>0){
                    	let cusMaterials = {};
                    	for (let matKey in this.customMaterials){
                    		if(cusMaterials.hasOwnProperty(this.customMaterials[matKey]['product_type'])){
                    			let tot = 0;
                    			for(let lastKey in cusMaterials[this.customMaterials[matKey]['product_type']]){
					           		tot++;
					           	}
                    			cusMaterials[this.customMaterials[matKey]['product_type']][tot] = this.customMaterials[matKey];
                    		}else{
                    			cusMaterials[this.customMaterials[matKey]['product_type']] = {
                    				0: this.customMaterials[matKey]
                    			}
                    		}
                    	}
                    	newTasks[alias].materials = cusMaterials;
                    	this.customMaterials = {};
                    }
                    this.$set(this.optionSystem, 'tasks', newTasks);
                    this.showNewTask = false;
                }else{
                	let existing = $('#custom-task-existing').val();
                	let existingOrder = $('#custom-task-existing-order').val() ? Number($('#custom-task-existing-order').val()) : Object.keys(systemTasks).length +1;
                	let sysTask = existing.split('|');
                	let newTasks = {};
                    let shiftOrder = false;
                    let correctOrder = false;
                    let currentOrder = Object.keys(systemTasks).length;
                    let task = this.systems[sysTask[0]]['tasks'][sysTask[1]];
                    if(!tasksEmpty){
	                	for (let taskKey in systemTasks){
	                        if(systemTasks.hasOwnProperty(taskKey)){
	                        	let order = systemTasks[taskKey].pivot ? systemTasks[taskKey].pivot.order : systemTasks[taskKey].order;
	                        	correctOrder = order != currentOrder+1 ? true: false;
	                        	console.log(correctOrder, currentOrder);
	                        	if(correctOrder) {
	                        		console.log('correctOrder');
	                        		task.pivot ? task.pivot.order = currentOrder+1 : task.order = currentOrder+1;
	                        		correctOrder = false;
	                        	}
	                            if(order===existingOrder){
	                                shiftOrder = true;
	                            }
	                            if(shiftOrder){
	                            	systemTasks[taskKey].pivot ? systemTasks[taskKey].pivot.order++ : systemTasks[taskKey].order++;
	                            }
	                            newTasks[taskKey] = systemTasks[taskKey];
	                            currentOrder+=1;
	                        }
	                    }
	                }else{
	                	//first task in system
	                	if(task.pivot) task.pivot.order = 1;
	                	newTasks[sysTask[1]] = task;
	                	currentOrder=1;
	                }
	                newTasks[sysTask[1]] = task;
                    systemTasks = Object.assign({}, newTasks);
                }
                //set any properties to visible that come from new / existing custom task
                for (let key in systemTasks) {
                	let filteredProps = this.properties.filter((value, index, self) => value.alias == systemTasks[key].link_to);
                	filteredProps.forEach((prop) => prop.show = true );
			    }
			    //this.taskChange();
            },
            updateOption(){
            	this.$emit('update:days', this.totalDays);
            	this.$emit('update:total_cost_price', this.totalCostPrice);
				this.$emit('update:total_labour', this.totalLabour);
				this.$emit('update:total_materials', this.totalMaterials);
				this.$emit('update:total_selling_price', this.sellingPrice);
				this.$emit('update:total_supervisor', this.totalSupervisor);
            	let update = {
            		materials: this.allMaterials,
            		driverDays: this.driverDays,
            		tasks: this.optionTasks,
            		system: this.optionSystem,
            		properties: this.optionProperties,
            	}
            	this.$emit('update:tasks', this.optionTasks);
            	this.$emit('update:materials', this.allMaterials);
            	// if(this.changeNightShift){		
            	// 	this.$emit('update:nightshift', this.optionNightshift);
            	// }
            }
		},
		created: function(){
			this.debounceValue = debounce((prop, newValue) => this.$emit(`update:${prop}`, newValue), 500);
			this.debounceSearch = debounce(term => this.searchMaterials(term), 400);
			if(!this.optionProperties.length){
				console.log('no option props from db');
				this.setSystem(this.systems[5]);
				this.$nextTick(function(){
					let props = clone(this.optionProperties);
					props.forEach((p) => p.value=200 );
					this.optionProperties = props;
					this.$nextTick(function(){
						this.$emit('modify-properties', this.optionProperties);
					});
				});
				//this.updateNightShiftLabour();
			}else{
				this.loadUniqueProps();
			}
			if(this.optionTasks.length){
				this.optionTasks.forEach((task, index) => {
					let obj = task.materials.reduce((acc, cur, i) => {
						if(acc.hasOwnProperty(cur.product_type)){
							acc[cur.product_type][cur.id] = cur;
						}else{
							acc[cur.product_type] = {[cur.id]:cur};
						}
						return acc;
					}, {});
					
					this.$set(this.optionTasks[index], 'materials', obj);
				});
				if(this.optionNightshift.labours.length){
					this.optionNightshift.labours.forEach(labour => {
						if(labour.pivot.qty){
							labour.qty = labour.pivot.qty;
						}
					});
				}

				let extraMaterials = this.materials.filter(material => material.pivot.task == 'extra');
				if(extraMaterials.length){
					extraMaterials.forEach(material => {
						material.qty = material.pivot.qty;
						material.task = material.pivot.task;
						material.price = material.cost_price * material.pivot.qty;
						this.extraMaterials.push(material);
					});
					this.updateOption();
				}
			}
			// if(this.optionTasks.length){
			// 	var obj = this.optionTasks.reduce((acc, cur, i) => {
			// 		acc[cur.alias] = cur;
			// 		acc[cur.alias]['materials'] = cur.materials.reduce((macc, mcur, mi) => {
			// 			if(macc.hasOwnProperty(mcur.product_type)){
			// 				macc[mcur.product_type][mcur.id] = mcur;
			// 			}else{
			// 				macc[mcur.product_type] = {[mcur.id]:mcur};
			// 			}
			// 			return macc;
			// 		}, {});
			// 		return acc;
			// 	}, {});
			// 	console.log(obj);
			// 	this.optionTasks = Object.assign({}, this.optionTasks, obj);
			// }
			

		},
		// mounted: function(){
		// 	console.log('mounted');
		// 	this.$refs['checkbox[]'].forEach(el => {
		// 		console.log(el.checked);
		// 	});
		// }
	}
</script>

<style lang="css" scoped>
</style>