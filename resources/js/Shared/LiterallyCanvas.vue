<template>
	<div ref="wrapper"><div ref="canvas"></div></div>
	
</template>

<script>
	import LC from "literallycanvas"
	import "literallycanvas/lib/css/literallycanvas.css"

	export default {
		props: {
			filename: { default: 'EditedImage' },
			imagePrefix: { required: true },
			backgroundImage: { required: false },
			imageSize: { required: true },
			options: {
				default: () => {	},
			},
			lastChange: {}
		},
		data () {
			return {
				canvas: null,
				onupdate: null,
				imageBounds: {
					x: 0,
					y: 0,
					width: this.imageSize.width,
					height: this.imageSize.height
				},
				editedImage: null,
			}
		},
		watch: {
			backgroundImage: function () {
				this.reloadCanvas();
			},
			lastChange: function(value){
				window.dispatchEvent(new Event('resize'));
			}
		},
		methods: {
			intitCanvas: function(){
				let bgShapes = [];
				let that = this;
				if(this.backgroundImage){
					let newImage = new Image(this.imageSize.width, this.imageSize.height);
					let url = URL.createObjectURL(this.backgroundImage);
					newImage.onload = function() {
						URL.revokeObjectURL(url);
					};
					newImage.src = url;
					//document.body.appendChild(newImage);
					//console.log(newImage);
					bgShapes.push(LC.createShape(
						'Image', {x: 0, y: 0, image: newImage, scale: 1}
					));
				}
				this.canvas = LC.init(this.$refs.canvas, {
					imageURLPrefix: this.imagePrefix,
					imageSize: this.imageSize,
					backgroundShapes: bgShapes,
					tools: [LC.tools.Polygon,LC.tools.Pencil,LC.tools.Eraser,LC.tools.Line,LC.tools.Rectangle,LC.tools.Text,LC.tools.Pan,LC.tools.Eyedropper],
					...this.options
				});
				setTimeout(() => {
					this.canvas.repaintAllLayers();
					this.getDrawing();
				}, 500);

				this.onupdate = this.canvas.on('drawingChange', function() {
					that.getDrawing();
				});
			},
			reloadCanvas: function(){
				this.canvas.teardown();
				this.onupdate();
				this.intitCanvas();
			},
			getDrawing: function(){
				this.canvas.getImage({rect: this.imageBounds}).toBlob((blob) => {
					const file = new File([blob], this.filename, {
						type: 'image/png',
						lastModified: Date.now()
					});
					this.editedImage = file;
					this.$emit('input', this.editedImage);
				}, 'image/png');
			}
		},
		mounted() {
			this.intitCanvas()
		}
	}
</script>
