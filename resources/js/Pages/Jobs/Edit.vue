<template>
	<div class="w-full mx-auto p-4 flex flex-wrap max-w-6xl" :class="{'active': !showdesign}">
		<div :class="showdesign ? 'w-full sm:w-1/2' : 'w-full'">
			<div class="flex items-start justify-between pb-3 mb-3">
				<h1 class="text-2xl font-semibold">{{ `${job.order_number} ${job.name}` }}</h1>
				<div class="flex items-center">
					<button class="flex items-center hover:bg-gray-200 text-gray-800 py-1 px-2 rounded" @click="showHide">
						<file-text-icon class="mr-2"></file-text-icon> {{ showdesign ? 'hide' : 'preview'}}
					</button>
					<a href="" class="flex items-center hover:bg-gray-200 text-gray-800 py-1 px-2 rounded">
						<paperclip-icon class="mr-2"></paperclip-icon> download
					</a>
				</div>
			</div>
			<div>
				<form @submit.prevent="submit">
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="">
								Sales Rep
							</label>
							<div class="relative">
								<select v-model="form.user" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
									<option>Select</option>
									<option v-for="(user, id) in users" :value="user">{{ user.name }}</option>
								</select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
								</div>
							</div>
						</div>
					</div>
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="">
								Proposal title 1
							</label>
							<div class="relative">
								<select v-model="form.title1" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
									<option>Select</option>
									<option v-for="title in proposaltitle1options" :value="title">{{ title }}</option>
								</select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
								</div>
							</div>
						</div>
						<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="">
								Proposal title 2
							</label>
							<div class="relative">
								<select v-model="form.title2" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
									<option>Select</option>
									<option v-for="title in proposaltitle2options" :value="title">{{ title }}</option>
								</select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
								</div>
							</div>
						</div>
					</div>
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full px-3">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="">
								Custom Title
							</label>
							<input v-model="form.title" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="title" type="text">
							<!-- <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p> -->
						</div>
					</div>
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full px-3">
							<image-editor :imageprefix="'/lc-assets/img'" :last-change="lastChange" :image-size="mainImgSize" :options="{primaryColor: 'rgb(215, 0, 0)', secondaryColor: 'rgba(215, 0, 0, 0.5)', defaultStrokeWidth: 2}" @input="getMainImage"></image-editor>
						</div>
					</div>
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-1/3 px-3" v-for="(image, index) in form.photos">
							<file-upload class="" :value="image" :image-size="subImgSize" :show-thumb="true" :classes="['bg-white', 'text-gray-700']" @input="replaceImage($event, index)"></file-upload>
						</div>
						<div class="w-1/3 px-3">
							<file-upload class="flex flex-col items-center justify-center rounded border border-dashed h-48 w-48 p-6" :multiple="true" :classes="['bg-white', 'text-gray-700']" @input="resizeAndAddImage">
								<image-icon class="text-gray-400 w-12 h-12"></image-icon>
								<span class="">Add Image/s</span>
							</file-upload>
						</div>
					</div>
					<div class="-mx-3 mb-6">
						<div class="flex items-center px-3">
							<h3 class="text-2xl font-light mb-1">Sections</h3>
							<button class="mx-2 focus:outline-none cursor-pointer rounded border hover:bg-gray-200" @click.prevent="addSection"><plus-icon class="w-6 h-6"></plus-icon></button>
						</div>
						<job-section class="border rounded mt-2" v-for="(section, index) in form.sections" :key="`sec-${index}`" v-bind.sync="section" :labour="labour" :systems="systems" :surveys="surveys" @deletesection="removeSection(index)"></job-section>
					</div>
					<div class="-mx-3">
						<div class="flex items-center">
							<h3 class="text-2xl font-light mb-1">P's & G's</h3>
							<button class="mx-2 focus:outline-none cursor-pointer rounded border hover:bg-gray-200" @click.prevent="showpsandgs = !showpsandgs">
								<plus-icon class="w-6 h-6" v-if="!showpsandgs"></plus-icon>
								<minus-icon class="w-6 h-6" v-else></minus-icon>
							</button>
						</div>
						<div class="" v-if="showpsandgs">
							<div class="flex items-center">
								<div class="flex-1">
									<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="">
										Description
									</label>
									<input ref="new-pandg-name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
								</div>
								<div class="mx-1">
									<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="">
										Rate per day
									</label>
									<input ref="new-pandg-amount" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number">
								</div>
								<div class="mx-1">
									<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="">
										Qty
									</label>
									<input ref="new-pandg-qty" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number">
								</div>
								<button class="mx-1 mt-3 px-4 py-2 rounded bg-teal-500 focus:outline-none text-white" @click.prevent="addPandG">Add</button>
							</div>
						</div>
					</div>
					<div class="-mx-3 pb-6 pr-8 border-b">
						<table class="table-fixed text-left w-full">
							<thead v-if="form.jobpsandgs.length">
								<tr class="text-xs">
									<th class="px-2 py-1 w-3/6">description</th>
									<th class="px-2 py-1 w-1/6">qty</th>
									<th class="px-2 py-1 w-1/6">rate</th>
									<th class="px-2 py-1 w-1/6">total</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(pandg, i) in form.jobpsandgs">
									<td class="border px-2 py-1">{{ pandg.name }}</td>
									<td class="border px-2 py-1">{{ pandg.qty }}</td>
									<td class="border px-2 py-1">{{ pandg.rate }}</td>
									<td class="border px-2 py-1 relative">
										{{ pandg.qty * pandg.rate | toCurrency }}
										<button class="absolute rounded border p-1 focus:outline-none cursor-pointer hover:bg-red-100 m-1" style="right: -40px; top: 0px;" @click.prevent="removePandG(i)"><trash-2-icon class="w-4 h-4"></trash-2-icon></button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="-mx-3 py-6 border-b">
						<div class="flex items-center cursor-pointer mb-2" @click.prevent="showTerms = !showTerms">
							<h3 class="text-2xl font-light mb-1">Terms and Conditions</h3>
							<button class="mx-2 focus:outline-none cursor-pointer rounded border hover:bg-gray-200">
								<chevron-right-icon class="w-6 h-6" v-if="!showTerms"></chevron-right-icon>
								<chevron-down-icon class="w-6 h-6" v-else></chevron-down-icon>
							</button>
						</div>
						<div class="" v-if="showTerms">
							<table class="table-fixed text-left w-full">
								<tbody>
									<tr v-for="term in form.jobterms">
										<td class="w-10 border px-2 py-1">
											<input type="checkbox" class="form-checkbox text-teal-600 w-6 h-6" v-model="term.checked" v-if="term.editable">
										</td>
										<td class="border px-2 py-1">{{ term.term }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="-mx-3 py-6">
						<div class="flex items-center cursor-pointer mb-2" @click.prevent="showIncludes = !showIncludes">
							<h3 class="text-2xl font-light mb-1">Includes / Excludes</h3>
							<button class="mx-2 focus:outline-none cursor-pointer rounded border hover:bg-gray-200">
								<chevron-right-icon class="w-6 h-6" v-if="!showIncludes"></chevron-right-icon>
								<chevron-down-icon class="w-6 h-6" v-else></chevron-down-icon>
							</button>
						</div>
						<div class="flex" v-if="showIncludes">
							<table class="text-left w-full mx-2">
								<thead>
									<tr>
										<th colspan="2" class="font-bold">Includes</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="include in form.jobincludes">
										<td class="w-10 border px-2 py-1">
											<input type="checkbox" class="form-checkbox text-teal-600 w-6 h-6" v-model="include.checked">
										</td>
										<td class="border px-2 py-1">{{ include.item }}</td>
									</tr>
								</tbody>
							</table>
							<table class="text-left w-full mx-2">
								<thead>
									<tr>
										<th colspan="2" class="font-bold">Excludes</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="exclude in form.jobexcludes">
										<td class="w-10 border px-2 py-1">
											<input type="checkbox" class="form-checkbox text-teal-600 w-6 h-6" v-model="exclude.checked">
										</td>
										<td class="border px-2 py-1">{{ exclude.item }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<loading-button :loading="sending" class="btn-teal text-lg" type="submit">Submit</loading-button>
				</form>
			</div>
		</div>
		<div  :class="showdesign ? 'w-full sm:w-1/2' : ''" v-show="showdesign">
			<div class="p-4">
				<proposal ref="proposal" :form="form" :systems="systems" @input="proposalChanged"></proposal>
			</div>
		</div>
	</div>
</template>

<script>
	import objectToFormData from 'object-to-formdata';
	import clone from 'just-clone';
	import filter from "just-filter-object";
	import Layout from '@/Shared/Layout'
	import LoadingButton from '@/Shared/LoadingButton'
	import Proposal from '@/Shared/Proposal'
	import FileUpload from '@/Shared/FileUpload'
	import LiterallyCanvas from '@/Shared/LiterallyCanvas'
	import ImageEditor from '@/Shared/ImageEditor'
	import JobSection from '@/Shared/PageComponents/JobSection'
	import { PaperclipIcon, FileTextIcon } from 'vue-feather-icons'

	export default {
		metaInfo: { title: 'Job Build' },
		layout: (h, page) => h(Layout, [page]),
		components: {
			PaperclipIcon,
			FileTextIcon,
			LiterallyCanvas,
			FileUpload,
			ImageEditor,
			Proposal,
			JobSection,
			LoadingButton
		},
		props: {
			job: Object,
			auth: Object,
			systems: Object,
			guarantees: Array,
			labour: Array,
			terms: Array,
			includes: Array,
			surveys: Array,
			basic_systems: Object,
			pandg: Array,
			users: Object,
			fuel: Object,
		},
		remember: 'form',
		data() {
			return {
				sending: false,
				showdesign: false,
				lastChange: null,
				sending: false,
				mainImgSize: {width: 960, height: 720},
				subImgSize: {width: 480, height: 360},
				form: {
					user: undefined,
					job: this.job,
					title1: this.job.title1,
					title2: this.job.title2,
					title: this.job.title,
					mainPhoto: this.job.mainPhoto,
					photos: this.job.photos,
					sections: [],
					jobpsandgs: this.pandg,
					jobterms: this.terms,
					jobincludes: [],
					jobexcludes: [],
					proposalHtml: null,
				},

				proposaltitle1options: [
					'Waterproofing of',
					'Crack Repair of',
					'Various repairs of',
					'For the Supply only of',
				],
				proposaltitle2options: [
					'at the below site address',
					'for the below site address',
					'Using Kryton\'s crack repair system'
				],
				showpsandgs: false,
				showTerms: false,
				showIncludes: false,
			}
		},
		computed: {
			propImages: function(){
				return this.form.photos.push()
			},
			pandgTotal: function(){
				var total=0;
				this.form.jobpsandgs.forEach(p => total += p.rate * p.qty);
				return total;
			},
		},
		methods: {
			showHide: function(){
				this.showdesign=!this.showdesign;
				this.lastChange = new Date().getTime();
			},
			submit() {
				// for (const [key, prop] of Object.entries(this.form)) {
				// 	if (Array.isArray(this.form[key])) {
				// 		if(!this.form[key].length){
				// 			console.log(key);
				// 		}
				// 	}
				// }
				// return;
				this.form.proposalHtml = this.$refs.proposal.$refs.theHtml.innerHTML;
				let submition = objectToFormData(this.form,{
					indices: true,
					nullsAsUndefineds: true,
				});
				this.sending = true;
				// for (var pair of submition.entries()) {
				// 	console.log(pair[0]+ ', ' + pair[1]); 
				// }
				// return;
				this.$inertia.post(`/jobs/${this.job.id}/details`, submition)
				.then(() => this.sending = false)
			},
			getMainImage: function(theImage){
				//this.form.mainPhoto = URL.createObjectURL(theImage);
				this.form.mainPhoto = theImage;
			},
			// addImage() {
			// 	if (this.newId === "" || this.newItem === "") return;
			// 	this.items.push({
			// 		id: this.newId,
			// 		item: this.newItem
			// 	});
			// 	this.newId = "";
			// 	this.newItem = "";
			// },
			replaceImage(theImage, index) {
				this.loadImage(theImage).then((newFile) => this.form.photos.splice(index, 1, newFile));
			},
			deleteImage(index) {
				this.form.photos.splice(index, 1);
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
							const scaleFactor = this.subImgSize.width / img.width;
							const elem = document.createElement('canvas');
							elem.width = this.subImgSize.width;
							elem.height = img.height * scaleFactor;
							//this.canvasSizes.height = elem.height
							const ctx = elem.getContext('2d');
							
							ctx.drawImage(img, 0, 0, this.subImgSize.width, img.height * scaleFactor);
							ctx.canvas.toBlob((blob) => {
								const file = new File([blob], fileName, {
									type: 'image/png',
									lastModified: Date.now()
								});
								newFile = file;
								resolve(newFile);
							}, 'image/png', 1);
						},
						reader.onerror = error => reject;
					};
				});
					
			},
			resizeAndAddImage: function(theFiles){
				for (var i = 0, theFile; theFile = theFiles[i]; i++) {
					if (!theFile.type.match('image.*')) {
						continue;
					}
					this.loadImage(theFile).then((newFile) => {
						this.form.photos.push(newFile)
					});
				}
			},
			addSection: function(){
				this.form.sections.push({
					id: '',
					job_id: this.job.id,
					name: '',
					survey: '',
					properties: [],
					options: [],
					photos: [],
                    saveSurvey: false,
				});
			},
			removeSection: function(key){
				console.log(key);
				this.form.sections.splice(key,1);
			},
			addPandG: function(e){
            	if(this.$refs['new-pandg-name'].value && this.$refs['new-pandg-amount'].value && this.$refs['new-pandg-qty'].value){
            		this.form.jobpsandgs.push({
						id: '',
						name: this.$refs['new-pandg-name'].value,
						rate: this.$refs['new-pandg-amount'].value,
						qty: this.$refs['new-pandg-qty'].value
					});
					this.$refs['new-pandg-name'].value = null;
					this.$refs['new-pandg-amount'].value = null;
					this.$refs['new-pandg-qty'].value = null;
					this.showpsandgs = false;
            	}else{
            		alert('Please complete all fields');
            	}
            },
            removePandG: function(key){
            	this.form.jobpsandgs.splice(key,1);
            },
            proposalChanged: function(payload){
            	this.form.proposalHtml = payload;
            }
		},
		created: function(){
			if(this.job.sections.length){
				this.job.sections.forEach(s => this.form.sections.push(clone(s)))
			}else{
				this.addSection();
			}
			
			for (var user in this.users) {
			    if (this.users.hasOwnProperty(user) && this.users[user].id == this.auth.user.id) {
			        this.form.user = this.users[user];
			    }
			}
			this.form.jobterms.forEach((t,i) => this.$set(this.form.jobterms[i], 'checked', t.default));
			this.includes.forEach(i => {
				let inex = i;
				inex.checked = i.default;
				let exists = this.job.jobincludes.filter(i => i.id == inex.id);
				if(exists.length){
					inex.checked = true;
				}
				this.form['job'+i.type].push(inex);
			})
			
		},
	}
</script>
