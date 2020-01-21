<template>
	<div class="flex flex-wrap justify-end">
		<file-upload class="mb-2 block w-full text-center" :value="fileSrc" @input="resize">{{ fileSrc ? 'Change' : 'Choose'}} Main Image</file-upload>
		<literally-canvas class="w-full" v-if="fileSrc" :background-image="fileSrc" :image-size="canvasSizes" image-prefix="/lc-assets/img" :options="options" @input="getImage" :last-change="lastChange"></literally-canvas>
	</div>
</template>

<script>
	import FileUpload from '@/Shared/FileUpload'
	import LiterallyCanvas from '@/Shared/LiterallyCanvas'
	export default {
		props:{
			imageSize: {
				type: Object,
				default: {width: 800, height: 600}
			},
			options: {
				default: () => {	},
			},
			lastChange: {}
		},
		components: {
			LiterallyCanvas,
			FileUpload
		},
		data () {
			return {
				fileSrc: null,
				fileName: null,
				canvasSizes: this.imageSize,
			}
		},
		methods: {
			resize: function(theFile){
				this.fileName = theFile.name;
				const reader = new FileReader();
				reader.readAsDataURL(theFile);
				reader.onload = event => {
					const img = new Image();
					img.src = event.target.result;
					img.onload = () => {
						const scaleFactor = this.imageSize.width / img.width;
						const elem = document.createElement('canvas');
						elem.width = this.imageSize.width;
						elem.height = img.height * scaleFactor;
						this.canvasSizes.height = elem.height
						const ctx = elem.getContext('2d');
						
						ctx.drawImage(img, 0, 0, this.imageSize.width, img.height * scaleFactor);
						ctx.canvas.toBlob((blob) => {
							const file = new File([blob], this.fileName, {
								type: 'image/jpeg',
								lastModified: Date.now()
							});
							this.fileSrc = file;
						}, 'image/jpeg', 1);
					},
					reader.onerror = error => console.log(error);
				};
			},
			getImage: function(theFile){
				this.$emit('input', theFile);
			}
		}
	}
</script>

<style lang="css" scoped>
</style>