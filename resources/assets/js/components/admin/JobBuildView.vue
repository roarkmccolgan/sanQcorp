<script>
	export default{
		data: function() {
			return {
				sections: laravel.job.sections==undefined?[]:laravel.job.sections,
				systems: laravel.systems,
				laravel: laravel,
				fileUploadFormData: new FormData(),
				lc: false,
				images: {
					main: '',
					one: '',
					two: '',
					three: '',
					four: '',
					five: '',
					six: '',
				}
			};
		},
		components:{
			VueAutocomplete: require('../vue-autocomplete.vue'),
			JobSection: require('./JobSection.vue'),
		},
		computed:{
			can_save: function(){
				return true
			},
			filename: function(){
				return this.laravel.job.name.replace(" ", "-")+'.pdf';
			}
		},
		created(){
			console.log('NewJobBuild Component Loaded');
		},
		methods:{
			loadproposal: function(e){
				e.preventDefault();
				$("input[name='html']").val($( "#propstyle" )[0].outerHTML+$( "#proposal" )[0].outerHTML);
				$("form[name='myform']").submit();
			},
			saveJob: function(){
				for (var key in this.sections) {
					if (this.sections.hasOwnProperty(key)) {
						console.log((key + " -> " + this.sections[key]));
					}
				}
			},
			addSection: function(){
				this.sections.push({
					id: '',
					job_id: laravel.job.id,
					name: '',
					survey: '',
					options: [],
					show: true
				});
			},
			removeSection: function(key){
				this.sections.splice(key);
			},
			getDistance: function(){
				
			},
			bindFile: function (e) { 
				e.preventDefault();
				var theInput = e.target;
				this.fileUploadFormData.append('file', e.target.files[0]);
				this.fileUploadFormData.append('ref', this.laravel.job.order_number);
				if(this.fileUploadFormData.file==undefined)this.fileUploadFormData.append('file', '');
				this.$http.post('/api/uploadproposalimage', this.fileUploadFormData).then(function(result){
					if(result.data.result=='success'){
						this.images.main='http://sanqcorp.app/img/proposal/'+this.laravel.job.order_number+'/'+result.data.filename;
						if(this.lc) LC.teardown();
						$('.literally').remove();
						var imageSize = {width: 640, height: 480};
						var newImage = new Image(640,480);
						newImage.src = 'http://sanqcorp.app/img/proposal/'+this.laravel.job.order_number+'/'+result.data.filename;
						$(theInput).closest( ".form-group" ).after('<div class="literally" style="min-height: 480px"></div>');
						this.lc = LC.init(
							document.getElementsByClassName('literally')[0],
								{
									imageURLPrefix: '/img/vendor/literallycanvas',
									imageSize: imageSize,
									backgroundShapes: [
										LC.createShape(
										  'Image', {x: 0, y: 0, image: newImage, scale: 1}
										)
									]
								}
						);

					}

				}, function(data){
					console.log(data, status, request);
				});
			}
		},
		events:{
			
		},
		ready(){
			if(this.sections.length == 0) this.addSection();
			/*var newImage = new Image(640,480);
			newImage.src = '/test.png';
			var lc = LC.init(
				document.getElementsByClassName('literally')[0],
					{
						imageURLPrefix: '/img/vendor/literallycanvas',
						imageSize: {width: 640, height: 480},
						backgroundShapes: [
							LC.createShape(
							  'Image', {x: 0, y: 0, image: newImage, scale: 2}
							)
						]
					}
			);*/
			//var newImage = document.getElementById('logo');
			//lc.saveShape(LC.createShape('Image', {x: 0, y: 0, image: newImage}));
		}
	}
</script>