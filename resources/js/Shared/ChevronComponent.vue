<template>
	<div class="">
		<chevron-down-icon class="w-4 h-4" v-if="show"></chevron-down-icon>
		<chevron-right-icon class="w-4 h-4" v-else></chevron-right-icon>
	</div>
</template>

<script>
import { ChevronDownIcon, ChevronRightIcon } from 'vue-feather-icons'
export default {
	name: 'ChevronComponent',
	props: ['show'],
	data () {
		return {

		}
	},
	components: {
		ChevronDownIcon,
		ChevronRightIcon
	}
}
</script>

<style lang="css" scoped>
</style>
