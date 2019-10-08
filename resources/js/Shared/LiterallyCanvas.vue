<template>
	<div ref="canvas"></div>
</template>

<script>
	import LC from "literallycanvas"
	import "literallycanvas/lib/css/literallycanvas.css"

	export default {
		props: {
			imagePrefix: { required: true },
			backgroundImage: { required: false },
			imageSize: { required: true },
			options: {
				default: () => {	},
			}
		},
		mounted() {
			let bgShapes = [];
			if(this.backgroundImage){
				let newImage = new Image(this.imageSize.width, this.imageSize.height);
				newImage.src = this.backgroundImage;
				console.log(newImage);
				bgShapes.push(LC.createShape(
					'Image', {x: 0, y: 0, image: newImage, scale: 1}
				));
			}
			const canvas = LC.init(this.$refs.canvas, {
				imageURLPrefix: this.imagePrefix,
				imageSize: this.imageSize,
				backgroundShapes: bgShapes,
				...this.options
			});
		}
	}
</script>
