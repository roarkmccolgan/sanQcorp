<template>
	<div>
		<div class="flex items-center justify-between pb-3 mb-3">
			<h1 class="text-2xl font-semibold">{{ `${job.order_number} ${job.name}` }}</h1>
			<div class="flex items-center">
				<a href="" class="flex items-center hover:bg-gray-200 text-gray-800 py-1 px-2 rounded">
					<file-text-icon class="mr-2"></file-text-icon> preview
				</a>
				<a href="" class="flex items-center hover:bg-gray-200 text-gray-800 py-1 px-2 rounded">
					<paperclip-icon class="mr-2"></paperclip-icon> download
				</a>
			</div>
		</div>
		<div>
			<form @submit.prevent="submit">
				<div class="flex flex-wrap -mx-3 mb-6">
					<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
						<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
							Sales Rep
						</label>
						<div class="relative">
							<select v-model="form.user_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
								<option>Select</option>
								<option v-for="(user, id) in users" :value="user.id">{{ user.name }}</option>
							</select>
							<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
								<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
							</div>
						</div>
					</div>
				</div>
				<div class="flex flex-wrap -mx-3 mb-6">
					<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
						<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
							Proposal title 1
						</label>
						<div class="relative">
							<select v-model="form.title1" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
								<option>Select</option>
								<option v-for="title in proposaltitle1options" :value="title">{{ title }}</option>
							</select>
							<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
								<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
							</div>
						</div>
					</div>
					<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
						<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
							Proposal title 2
						</label>
						<div class="relative">
							<select v-model="form.title2" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
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
						<image-editor :imageprefix="'/lc-assets/img'" :image-size="{width: 640, height: 480}"></image-editor>
					</div>
				</div>
				<button type="submit">Submit</button>
			</form>
		</div>
	</div>
</template>

<script>
	import Layout from '@/Shared/Layout'
	import FileUpload from '@/Shared/FileUpload'
	import LiterallyCanvas from '@/Shared/LiterallyCanvas'
	import ImageEditor from '@/Shared/ImageEditor'
	import { PaperclipIcon, FileTextIcon } from 'vue-feather-icons'

	export default {
		layout: (h, page) => h(Layout, [page]),
		components: {
			PaperclipIcon,
			FileTextIcon,
			LiterallyCanvas,
			FileUpload,
			ImageEditor
		},
		props: {
			job: Object,
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
				form: {
					user_id: this.job.user_id,
					title1: this.job.title1,
					title2: this.job.title2,
					title: this.job.title,
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
			}
		},
		methods: {
			submit() {
				this.sending = true
				this.$inertia.post(this.route('contacts.store'), this.form)
				.then(() => this.sending = false)
			},
		}
	}
</script>
