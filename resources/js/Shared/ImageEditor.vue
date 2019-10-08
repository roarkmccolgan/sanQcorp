<template>
	<div class="">
		<file-upload @input="resize">Choose Main Image</file-upload>
		<literally-canvas v-if="fileSrc" :background-image="fileSrc" :image-size="imageSize" image-prefix="/lc-assets/img" ></literally-canvas>		
	</div>
</template>

<script>
	import FileUpload from '@/Shared/FileUpload'
	import LiterallyCanvas from '@/Shared/LiterallyCanvas'
	export default {
		props:{
			imageSize: {
				type: Object,
				default: {width: 640, height: 480}
			}
		},
		components: {
			LiterallyCanvas,
			FileUpload
		},
		data () {
			return {
				fileSrc: null,
			}
		},
		methods: {
			resize: function(theFile){
				const fileName = theFile.name;
				const reader = new FileReader();
				reader.readAsDataURL(theFile);
				reader.onload = event => {
					const img = new Image();
					img.src = event.target.result;
					img.onload = () => {
						const scaleFactor = this.imageSize.width / img.width;
						const elem = document.createElement('canvas');
						elem.width = this.imageSize.width;
						elem.height = this.imageSize.height * scaleFactor;
						const ctx = elem.getContext('2d');
						
						ctx.drawImage(img, 0, 0, this.imageSize.width, this.imageSize.height * scaleFactor, 0, 0, this.imageSize.width, this.imageSize.height);
						ctx.canvas.toBlob((blob) => {
							const file = new File([blob], fileName, {
								type: 'image/jpeg',
								lastModified: Date.now()
							});
							this.fileSrc = file;
							console.log(file);
						}, 'image/jpeg', 1);
					},
					reader.onerror = error => console.log(error);
				};
			}
		}
	}
</script>

<style lang="css" scoped>
</style>