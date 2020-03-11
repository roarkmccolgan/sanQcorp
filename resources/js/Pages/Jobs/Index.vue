<template>
	<div>
		<div class="flex items-center justify-between py-3 mb-3 border-b">
			<h1 class="text-2xl font-semibold">Jobs</h1>
			<button class="flex items-center bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
				<plus-icon class="mr-2"></plus-icon> New Job
			</button>
		</div>
		<table class="">
			<tbody>
				<tr v-for="job in jobs">
					<td class="w-2/12 font-semibold">{{ job.order_number }}</td>
					<td class="w-4/12 relative">
						<button class="focus:outline-none flex items-center" @click="showSections[job.id] = !showSections[job.id]"><chevron-component class="mr-2" :show="showSections[job.id]"></chevron-component>{{ job.name }}</button>
						<button class="fixed inset-0 w-full h-full cursor-default" v-if="showSections[job.id]" @click="showSections[job.id] = false"></button>
						<div class="mt-2 py-2 px-4 rounded-lg shadow-lg absolute" v-if="job.sections.length && showSections[job.id]">
							<span class="block text-sm font-bold">Sections</span>
							<a href="#" class="block py-2 text-gray-800 underline hover:no-underline" v-for="section in job.sections">{{ section.name }}</a>
						</div>
					</td>
					<td class="w-2/12">{{ job.contacts[0].company.name }}</td>
					<td class="w-2/12 text-sm">
						<a class="px-2 py-1 bg-gray-200 rounded-full" :class="{ 'bg-purple-600 text-white': job.status == 'pending', 'bg-teal-600': job.status == 'accepted' }" :disabled="job.status == 'build'">{{ job.status }}</a>
					</td>
					<td width="w-1/12">
                        <a href="#" class="" target="_blank" title="PDF" style="margin-top: -20px" v-if="job.proposal">Download PDF</a>
                    </td>
					<td class="w-1/12 text-sm">
						<div class="inline-flex">
							<inertia-link class="bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded-l focus:outline-none" :href="`/jobs/${job.id}/details`">build</inertia-link>
							<a href="" class="bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2">
								edit
							</a>
							<a href="" class="bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded-r">
								delete
							</a>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	import Layout from '@/Shared/Layout'
	import { PlusIcon } from 'vue-feather-icons'

	export default {
		metaInfo: { title: 'Job Listing' },
		layout: (h, page) => h(Layout, [page]),
		components: {
			PlusIcon
		},
		props: {
			jobs: Array
		},
		data() {
			return {
				showSections:{}
			}
		},
		created: function(){
			this.jobs.forEach(job => {
				this.$set(this.showSections,job.id, false);
			});
			const eascapeHandler = (e) => {
				if(e.key === 'Esc' || e.key === 'Escape'){
					this.jobs.forEach(job => {
						this.$set(this.showSections,job.id, false);
					});
				}
			}

			document.addEventListener('keydown', eascapeHandler);

			this.$once('hook:beforeDestroy', () => {
				document.removeEventListener('keydown', eascapeHandler);
			})
		}
	}
</script>
