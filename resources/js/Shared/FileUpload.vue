<template>
	<label class="cursor-pointer focus:outline-none" :class="classes">
		<div v-if="showThumb">
			<img ref="thumbnail" :src="imageSrc" alt="">
		</div>
		<template v-else>
			<slot>Select file</slot>
			<span v-if="value && showName">Selected File: {{value.name}}</span>
		</template>
		<input type="file" class="hidden" @change="handleFileChange" :multiple="multiple" />			
	</label>
</template>

<script>
	export default {
		props: {
			value: File,
			imageSize: Object,
			showName:  {
				type: Boolean,
				default: false,
			},
			multiple:  {
				type: Boolean,
				default: false,
			},
			showThumb:  {
				type: Boolean,
				default: false,
			},
			classes:  {
				type: Array,
				default () {
					return ['text-white', 'rounded','bg-teal-500','px-4','py-2']
				}
			}
		},
		data () {
			return {
				
			}
		},
		computed: {
			imageSrc: function () {
				let newImage = new Image(this.imageSize.width, this.imageSize.height);
				let url = URL.createObjectURL(this.value);
				newImage.onload = function() {
					URL.revokeObjectURL(url);
				};
				return url;
				//this.$refs.thumbnail.src = url;
			}
		},
		methods: {
			handleFileChange(e) {
				let singleOrMultiple = this.multiple ? e.target.files : e.target.files[0]
				this.$emit('input', singleOrMultiple)
			}
		}
	}
</script>