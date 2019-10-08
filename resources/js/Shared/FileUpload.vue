<template>
	<label class="file-select">
		<div class="text-center text-white rounded bg-teal-400 px-4 py-2 cursor-pointer focus:outline-none">
			<slot>Select file</slot>
			<span v-if="value">Selected File: {{value.name}}</span>
		</div>
		<input type="file" class="hidden" @change="handleFileChange"/>
	</label>
</template>

<script>
	export default {
		props: {
			value: File
		},

		methods: {
			handleFileChange(e) {
				this.$emit('input', e.target.files[0])
			}
		}
	}
</script>