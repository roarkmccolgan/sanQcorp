<template>
	<div class="">
		<div class="w-full flex items-center justify-between" v-if="!show">
			<h4 class="w-full" :class="{'text-red-400 italic' : sectionName == ''}">{{ sectionName ? sectionName : 'Please provide name' }}</h4>
			<div class="flex items-center">
				<button class="rounded border p-1 focus:outline-none cursor-pointer hover:bg-gray-100 m-1" @click="show = !show"><chevron-down-icon class="w-6 h-6"></chevron-down-icon></button>
				<button class="rounded border p-1 focus:outline-none cursor-pointer hover:bg-red-100 m-1" @click.prevent="$emit('deletesection')"><trash-2-icon class="w-6 h-6"></trash-2-icon></button>				
			</div>
		</div>
		<div class="flex flex-wrap" v-else>
			<div class="w-full flex items-center justify-between px-3 my-3">
				<input v-model="sectionName" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="sectionName" placeholder="Section Name" type="text">
				<div class="flex items-center">
					<button class="rounded border p-1 focus:outline-none cursor-pointer hover:bg-gray-100 m-1" @click="show = !show"><chevron-up-icon class="w-6 h-6"></chevron-up-icon></button>
					<button class="rounded border p-1 focus:outline-none cursor-pointer hover:bg-red-100 m-1" @click.prevent="$emit('deletesection')"><trash-2-icon class="w-6 h-6"></trash-2-icon></button>				
				</div>
			</div>
			<div class="w-full px-3 mb-2">
				<div class="relative">
					<select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" @change="setSurvey">
						<option>Select survey</option>
						<option v-for="survey in surveys" :value="survey.survey">{{ survey.survey }}</option>
					</select>
					<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
						<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
					</div>
				</div>
			</div>
			<div class="w-full flex flex-wrap justify-end px-3 mb-2">
				<basic-editor class="w-full" v-model="sectionSurvey"></basic-editor>
				<label class="flex items-center mt-2">
					<input type="checkbox" class="form-checkbox text-teal-600 w-6 h-6" v-model="sectionSaveSurvey">
					<span class="ml-2">Save survey as a template?</span>
				</label>
			</div>
			<div class="flex items-center px-3 cursor-pointer mb-2" @click.prevent="showImages = !showImages">
				<button class="mr-2 focus:outline-none rounded hover:bg-gray-200">
					<chevron-right-icon class="w-4 h-4" v-if="!showImages"></chevron-right-icon>
					<chevron-down-icon class="w-4 h-4" v-else></chevron-down-icon>
				</button>
				<span class="block uppercase tracking-wide text-gray-700 text-xs font-bold">Section Images</span>
			</div>
			<div class="w-full flex flex-wrap my-3" v-show="showImages">
				<div class="w-1/3 px-3" v-for="(image, index) in sectionPhotos">
					<file-upload class="" :value="image" :image-size="sectionImgSize" :show-thumb="true" :classes="['bg-white', 'text-gray-700']" @input="replaceImage($event, index)"></file-upload>
				</div>
				<div class="w-1/3 px-3">
					<file-upload class="flex items-center justify-center rounded border border-dashed w-48 p-2" :multiple="true" :classes="['bg-white', 'text-gray-700']" @input="resizeAndAddImage">
						<image-icon class="text-gray-400 w-12 h-12 mr-2"></image-icon>
						<span class="leading-none">Add Image/s</span>
					</file-upload>
				</div>
			</div>
			<div class="w-full">
				<div class="flex items-center px-3">
					<h3 class="text-2xl font-light mb-1">Options</h3>
					<button class="mx-2 focus:outline-none cursor-pointer rounded border hover:bg-gray-200" @click.prevent="addOption"><plus-icon class="w-6 h-6"></plus-icon></button>
				</div>
				<job-option class="rounded mt-2" v-for="(option, index) in sectionOptions" :key="`opt-${index}`" v-bind.sync="option" :labour="labour" :systems="systems" :section-properties="sectionProperties" @deleteoption="removeOption(index)" @modify-properties="modifyProperties"></job-option>
			</div>
		</div>
	</div>
</template>

<script>
	import FileUpload from '@/Shared/FileUpload'
	import JobOption from '@/Shared/PageComponents/JobOption'
	import BasicEditor from '@/Shared/BasicEditor'
	import debounce from 'just-debounce-it';
	export default {

		name: 'JobSection',

		props: [
			'name',
			'job_id',
			'options',
			'properties',
			'photos',
			'systems',
			'survey',
			'saveSurvey',
			'surveys',
			'labour',
		],

		data () {
			return {
				show: true,
				sectionImgSize: {width: 480, height: 360},
				showImages: false,
				sectionOptions: this.options,
				sectionPhotos: this.photos,
			}
		},
		computed: {
			sectionName: {
				get() { return this.name; },
				set(newValue) {
					this.debounceValue.call(this, 'name', newValue);
				}
			},
			sectionSurvey: {
				get() { return this.survey; },
				set(newValue) {
					this.$emit('update:survey', newValue)
				}
			},
			sectionSaveSurvey: {
				get() { return this.saveSurvey; },
				set(newValue) {
					this.debounceValue.call(this, 'saveSurvey', newValue);
				}
			},
			sectionProperties: {
				get() { return this.properties; },
				set(newValue) {
					this.$emit('update:properties', newValue)
				}
			},
		},
		components: {
			BasicEditor,
			FileUpload,
			JobOption
		},
		methods: {
			setSurvey: function(event){
				if(event.target.options.selectedIndex !== 0){
					let value = event.target.options[event.target.options.selectedIndex].value;
					this.sectionSurvey = value;
					event.target.selectedIndex = 0;
				}
			},
			addOption: function(){
				this.sectionOptions.push({
					id:'',
					name: '',
					description: '',
					system_id: '',
					system: null,
					notes: [],
					days: '',
					total_labour: '',
					total_supervisor: '',
					total_materials: '',
					total_cost_price: '',
					total_selling_price: '',
					markup: 100,
					tasks: [],
					selectedTasks: [],
					properties: [],
					orderedTasks: [],
					materials: []
				});
			},
			removeOption: function(key){
				this.sectionOptions.splice(key);
			},
			resizeAndAddImage: function(theFiles){
				for (var i = 0, theFile; theFile = theFiles[i]; i++) {
					if (!theFile.type.match('image.*')) {
						continue;
					}
					this.loadImage(theFile).then((newFile) => this.sectionPhotos.push(newFile));
				}
			},
			replaceImage(theImage, index) {
				this.loadImage(theImage).then((newFile) => this.sectionPhotos.splice(index, 1, newFile));
			},
			loadImage: function(theFile){
				return new Promise((resolve, reject) => {
				    let fileName = theFile.name;
					let reader = new FileReader();
					let newFile = null;
					reader.readAsDataURL(theFile);
					reader.onload = event => {
						const img = new Image();
						img.src = event.target.result;
						img.onload = () => {
							const scaleFactor = this.sectionImgSize.width / img.width;
							const elem = document.createElement('canvas');
							elem.width = this.sectionImgSize.width;
							elem.height = img.height * scaleFactor;
							//this.canvasSizes.height = elem.height
							const ctx = elem.getContext('2d');
							
							ctx.drawImage(img, 0, 0, this.sectionImgSize.width, img.height * scaleFactor);
							ctx.canvas.toBlob((blob) => {
								const file = new File([blob], fileName, {
									type: 'image/jpeg',
									lastModified: Date.now()
								});
								newFile = file;
								resolve(newFile);
							}, 'image/jpeg', 1);
						},
						reader.onerror = error => reject;
					};
				});
					
			},
			modifyProperties: function(properties){
				this.sectionProperties = properties;
			},
			updateOption: function(update){
				//console.log(update);
			}
		},
		created: function(){
			this.debounceValue = debounce((prop, newValue) => this.$emit(`update:${prop}`, newValue), 500);
			if(!this.options.length){
				console.log('no option, adding...');
				this.addOption();
				this.sectionName = "Main garage";
				this.sectionSurvey = "We checked everything";
			}
		}
	}
</script>

<style lang="css" scoped>
</style>