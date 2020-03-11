<template>
	<div ref="wrapper"><div ref="canvas"></div></div>
	
</template>

<script>
	import LC from "literallycanvas"
	import debounce from 'just-debounce-it';

	export default {
		props: {
			filename: { default: 'EditedImage' },
			imagePrefix: { required: true },
			backgroundImage: { required: false },
			imageSize: { required: true },
			options: {
				default: () => {	},
			},
			lastChange: {},
			existingSnapShot: { required: false }
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
				snapShot: this.existingSnapShot
			}
		},
		watch: {
			backgroundImage: function () {
				this.reloadCanvas();
			},
			lastChange: function(value){
				window.dispatchEvent(new Event('resize'));
			},
		},
		computed: {
			lcObject: function(){
				return {
					edited: this.editedImage,
					original: this.backgroundImage,
					snapShot: this.snapShot
				};
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
				this.canvas.on('drawingChange', () => {
				 	console.log('drawing Changed going to wait a fe');
					this.debounceGetDrawing();
				});
				if(this.existingSnapShot){
					console.log('loading snapShot');
					this.canvas.loadSnapshot(JSON.parse(this.existingSnapShot));						
				}
				setTimeout(() => {
					console.log('repainting');
					this.canvas.repaintAllLayers();
					//this.getDrawing();
				}, 500);
			},
			reloadCanvas: function(){
				this.canvas.teardown();
				this.onupdate();
				this.intitCanvas();
			},
			getDrawing: function(){
				console.log('getting drawing');
				this.canvas.getImage({rect: this.imageBounds}).toBlob((blob) => {
					const file = new File([blob], this.filename, {
						type: 'image/png',
						lastModified: Date.now()
					});
					this.editedImage = file;
					this.snapShot = JSON.stringify(this.canvas.getSnapshot(['shapes', 'imageSize', 'colors', 'position', 'scale']));
					this.$emit('input', this.lcObject);
				}, 'image/png');
			}
		},
		mounted() {
			this.debounceGetDrawing = debounce(() => {
				console.log('running now');
				this.getDrawing();
			}, 1000);
			console.log('initing canvas');
			this.intitCanvas();
		}
	}
</script>
<style>
	.literally .button-style-1{border:2px solid transparent;border-radius:3px}.literally .button-style-1{text-decoration:none;cursor:pointer}.literally .button-style-1.selected:not(.disabled){background-color:#a1d9fe}.literally .button-style-1:hover:not(.disabled){border-color:#a1d9fe}.literally .button-style-1.disabled{cursor:default;opacity:0.3}.literally.toolbar-at-top .lc-drawing{bottom:0;top:31px}.literally.toolbar-at-top .lc-options{top:0;border-bottom:1px solid #555}.literally.toolbar-at-bottom .lc-drawing{bottom:31px;top:0}.literally.toolbar-at-bottom .lc-options{bottom:0;border-top:1px solid #555}.literally.toolbar-hidden .lc-drawing{left:0;right:0;bottom:0;top:0}.literally.toolbar-hidden .lc-options,.literally.toolbar-hidden .lc-picker{display:none}.literally{position:relative;background-color:#ddd;min-height:400px;-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;-ms-touch-action:none;user-select:none}.literally,.literally *{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}.literally>*{position:absolute}.literally .lc-picker{top:0;left:0;bottom:0;width:61px;background-color:#e6e6e6}.literally .lc-drawing{right:0;left:0;bottom:0;left:0}.literally .lc-drawing>*{position:absolute;top:0;right:0;bottom:0;left:0}.literally .lc-drawing.with-gui{right:0;left:61px;cursor:default}.literally .lc-drawing.with-gui .polygon-toolbar{top:auto;height:31px}.literally .lc-drawing.with-gui .polygon-toolbar .polygon-toolbar-button{float:left}.literally .lc-drawing.with-gui .text-tool-input:focus{outline:none}.literally .lc-picker{z-index:1001;border-right:1px solid #555}.literally .lc-picker .toolbar-button{width:26px;height:26px;line-height:26px;margin:2px;padding:0;cursor:pointer;text-align:center;border:2px solid transparent;border-radius:3px}.literally .lc-picker .toolbar-button{text-decoration:none;cursor:pointer}.literally .lc-picker .toolbar-button.selected:not(.disabled){background-color:#a1d9fe}.literally .lc-picker .toolbar-button:hover:not(.disabled){border-color:#a1d9fe}.literally .lc-picker .toolbar-button.disabled{cursor:default;opacity:0.3}.literally .lc-picker .thin-button{cursor:pointer;float:left;position:relative}.literally .lc-picker .fat-button{clear:both;width:56px}.literally .lc-picker .lc-pick-tool,.literally .lc-picker .lc-undo,.literally .lc-picker .lc-redo,.literally .lc-picker .lc-zoom-in,.literally .lc-picker .lc-zoom-out{background-size:100% auto;background-repeat:no-repeat;background-position:center center}.literally .color-well{font-size:10px;float:left;width:60px}.literally .color-well.open{background-color:#a1d9fe}.literally .color-well-color-container{border:2px solid transparent;border-radius:3px;border:1px solid #aaa;position:relative;width:28px;height:28px;margin:1px auto;overflow:visible}.literally .color-well-color-container{text-decoration:none;cursor:pointer}.literally .color-well-color-container.selected:not(.disabled){background-color:#a1d9fe}.literally .color-well-color-container:hover:not(.disabled){border-color:#a1d9fe}.literally .color-well-color-container.disabled{cursor:default;opacity:0.3}.literally .color-well-color-container .color-well-checker{position:absolute;width:50%;height:50%;background-color:black}.literally .color-well-color-container .color-well-checker-top-left{border-top-left-radius:3px}.literally .color-well-color-container .color-well-checker-bottom-right{border-bottom-right-radius:3px}.literally .color-well-color-container .color-well-color{position:absolute;top:0;right:0;bottom:0;left:0;border-radius:3px}.literally .color-picker-popup{position:absolute;z-index:1;background-color:white;border:1px solid #555;left:60px;bottom:31px}.literally .color-picker-popup .color-row{clear:both}.literally .color-picker-popup .color-row .color-cell{cursor:pointer;width:20px;height:20px;line-height:20px;float:left}.literally .color-picker-popup .color-row .color-cell:hover,.literally .color-picker-popup .color-row .color-cell.selected{border:1px solid #555;line-height:18px}.literally .color-picker-popup .color-row .color-cell.transparent-cell{width:100%}.literally .horz-toolbar{height:31px;background-color:#e6e6e6}.literally .horz-toolbar .label{line-height:30px;margin:0 0.25em 0 0.25em;font-size:12px}.literally .horz-toolbar span{line-height:30px;margin:0 0.25em 0 0.25em;font-size:12px;float:left}.literally .horz-toolbar .square-toolbar-button{border:2px solid transparent;border-radius:3px;margin:1px;border:1px solid #aaa;width:28px;height:28px;float:left;position:relative}.literally .horz-toolbar .square-toolbar-button{text-decoration:none;cursor:pointer}.literally .horz-toolbar .square-toolbar-button.selected:not(.disabled){background-color:#a1d9fe}.literally .horz-toolbar .square-toolbar-button:hover:not(.disabled){border-color:#a1d9fe}.literally .horz-toolbar .square-toolbar-button.disabled{cursor:default;opacity:0.3}.literally .horz-toolbar .square-toolbar-button img{max-width:100%;max-height:100%}.literally .horz-toolbar .square-toolbar-button label{position:absolute;top:0;right:0;bottom:0;left:0;line-height:26px;margin:auto;float:none;text-align:center}.literally .polygon-toolbar{position:absolute;border-top:1px solid #555;border-bottom:1px solid #555;width:100%}.literally.toolbar-at-bottom .polygon-toolbar{top:-100%}.literally.toolbar-at-top .polygon-toolbar{top:100%}.literally .lc-options{z-index:1;right:0;left:61px}.literally .lc-options .lc-font-settings{height:30px;line-height:31px;padding-left:4px;background-color:#f5f5f5}.literally .lc-options .lc-font-settings input{margin:0 0.5em 0 0}.literally .lc-options .lc-font-settings input[type=checkbox]{margin:0 0.5em 0 0.5em}

    .fs-container {
       @apply w-full;
      }
      .literally {
        width: 100%;
        height: 100%;
      }
      .literally img.background, .literally > canvas {
        position: absolute;
      }
      .toolset {
        margin: 1rem;
      }
      .tool {
        background: hsla(199, 26%, 44%, 0.5);
        padding: 0.25rem;
        margin: 0.25rem;
        border-radius: 0.25rem;
        color: #000;
        text-align: center;
        text-decoration: none;
        position: relative;
      }
      .tool.current {
        color: #fff;
        background: hsla(199, 26%, 44%, 1);
      }
      .tool:hover {
        text-decoration: underline;
        background: hsla(199, 26%, 44%, 0.75);
      }
      .toolLabel {
        font-size: 1.25rem;
      }
      #tools-sizes.disabled {
        pointer-events: none;
      }
      #tools-sizes.disabled .tool:after {
        content: ' ';
        background: hsla(0, 100%, 100%, 0.75);
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        border-radius: 0.25rem;
      }
</style>