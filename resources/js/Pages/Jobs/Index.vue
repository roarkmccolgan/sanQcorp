<template>
	<div>
		<div class="flex items-center justify-between pb-3 mb-3 border-b">
			<h1 class="text-2xl font-semibold">Jobs</h1>
			<button class="flex items-center bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
				<plus-icon class="mr-2"></plus-icon> New Job
			</button>
		</div>
		<table class="">
			<tbody>
				<tr v-for="job in jobs">
					<td class="w-2/12 font-semibold">{{ job.order_number }}</td>
					<td class="w-4/12">
						{{ job.name }}
						<div class="mt-2 py-2 rounded-lg shadow-xl" v-if="job.sections.length">
							<a href="#" class="block px-4 py-2 text-gray-800 hover:bg-teal-800 hover:text-white" v-for="section in job.sections">{{ section.name }}</a>
						</div>
					</td>
					<td class="w-2/12">{{ job.contacts[0].company.name }}</td>
					<td class="w-2/12 text-sm">
						<a class="px-2 py-1 bg-gray-200 rounded-full" :class="{ 'bg-purple-600': job.status == 'pending', 'bg-teal-600': job.status == 'accepted' }" :disabled="job.status == 'build'">{{ job.status }}</a>
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
		layout: (h, page) => h(Layout, [page]),
		components: {
			PlusIcon
		},
		props: {
			jobs: Array
		},
	}
</script>
