<script>
	import config from '../../config/config.js';
	export default{
		data: function() {
			return {
				sections: laravel.job.sections==undefined?[]:laravel.job.sections,
				systems: laravel.systems,
				revisions: laravel.job.revisions==undefined?[]:laravel.job.revisions,
				basicSystems: laravel.basic_systems,
				materials: [],
				laravel: laravel,
				fileUploadFormData: new FormData(),
				lc: config.diagramlc,
				imageNum: 6,
				mainImage: laravel.job.mainPhoto ? laravel.job.mainPhoto : {id: '',photo: ''},
				images: laravel.job.photos ? laravel.job.photos : [],
				proposaltitle1: laravel.job.title1 ? laravel.job.title1 : (laravel.job.type == 'supply' ? 'For the Supply only of' : 'Waterproofing of'),
				proposaltitle2: laravel.job.title2 ? laravel.job.title2 : (laravel.job.type == 'supply' ? 'for the below site address' : 'at the below site address'),
				proposaltitle1options: [
					'Waterproofing of',
					'Crack Repair of',
					'Various repairs of',
					'For the Supply only of',
				],
				proposaltitle2options: [
					'at the below site address',
					'for the below site address',
					'Using Kryton\'s crack repair system'
				],
				customproposal: laravel.job.title ? laravel.job.title : '',
				showpandg: laravel.job.pandg.length > 0 ? true:false,
				jobpsandgs: laravel.job.pandg==undefined?[]:laravel.job.pandg,
				user_id: laravel.job.user ? laravel.job.user.id: 0,
				users: laravel.users,
				revisions: laravel.job.revisions ? laravel.job.revisions:false,
				terms: laravel.job.terms ? laravel.job.terms:[],
				checkedTerms: [],
				showTerms: false,
				includes: laravel.includes,
				checkedIncludes: [],
				checkedExcludes: [],
				showIncludes: false,
				showproposal: false,
			};
		},
		components:{
			JobSection: require('./JobSection_new.vue'),
		},
		computed:{
			areaTerm: function(){
				laravel.job.type == 'supply' ? 'For the Supply only of' : 'Site Areas'
			},
			can_save: function(){
				return true;
			},
			filename: function(){
				return this.laravel.job.name.replace(" ", "-")+'.pdf';
			},
			proposaltitle: function(){
				if(this.customproposal){
					return this.customproposal;
				}else{
					var list = [];
					for(var sectionKey in this.sections){
						list.push(this.sections[sectionKey].name);
					}
					return this.proposaltitle1 + ' ' + list.join(", ") + ' ' + this.proposaltitle2;
				}
			},
			pandgTotal: function(){
				var total=0;
				for (var i = 0; i < this.jobpsandgs.length; i++) {
					total+=this.jobpsandgs[i].rate*this.jobpsandgs[i].qty
				}
				return total;
			},
			existsInChecked: function(){
				var that = this;
				var items;
				items = this.terms.filter(function(item) {
				    return that.checkedTerms.indexOf(item.id)!=-1;
				});
				return items;
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
				Swal({
					title: 'Have you checked the following?',
					type: 'info',
					html:
						'Any P\s &amp; G\'s<br/>' +
						'Double check your measurements<br/>' +
						'Any other items you need for the job<br/>',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, save it!'
				}).then(function () {
					$('body').prepend( '<div class="cssload-container" id="pageLoader"><div class="cssload-whirlpool"></div></div>' );
					$("#saveBuildForm").submit();
				});
			},
			addSection: function(){
				this.sections.push({
					id: '',
					job_id: laravel.job.id,
					name: '',
					survey: '',
					options: [],
					photos: [],
                    images: [],
					show: true
				});
			},
			removeSection: function(key){
				this.sections.splice(key,1);
			},
			addPhoto: function(id,photo,type,key){
				id = typeof id !== 'undefined' ? id : '';
				photo = typeof photo !== 'undefined' ? photo : '';
				type = typeof type !== 'undefined' ? type : 'job';
				key = typeof key !== 'undefined' ? key : false;
				if(type=='job'){
					this.images.push({
						id: id,
						photo: photo
					});
				}else{
					this[type][key].images.push({
						id: id,
						photo: photo
					});
				}
			},
			removePhoto: function(num,type,key){
				type = typeof type !== 'undefined' ? type : 'job';
				key = typeof key !== 'undefined' ? key : false;
				if(type=='job'){
					this.images.splice(num,1);
				}else{
					this[type][key].images.splice(num,1);
				}
			},
            getObjSize: function(obj) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                return size;
            },
			getDistance: function(){
				
			},
            addPandG: function(e){
            	if($('#new-pandg-name').val()!='' && $('#new-pandg-rate').val()!='' && $('#new-pandg-qty').val()!=''){
            		this.jobpsandgs.push({
						id: '',
						name: $('#new-pandg-name').val(),
						rate: $('#new-pandg-rate').val(),
						qty: $('#new-pandg-qty').val()
					});
					$('#new-pandg-name').val('');
					$('#new-pandg-rate').val('');
					$('#new-pandg-qty').val('');

					this.$nextTick(function () {
						this.$broadcast('priceUpdate');
					})
            	}else{
            		alert('Please complete all fields');
            	}
            },
            removePandG: function(key){
            	this.jobpsandgs.splice(key,1);
            },
			bindFile: function (e,image,type) {
				type = typeof type !== 'undefined' ? type : 'job'; 
				e.preventDefault();
				var theInput = e.target;
				var sizex = image=='main' ? 640 : 320;
				var sizey = image=='main' ? 480 : 240;
				this.fileUploadFormData.append('file', e.target.files[0]);
				this.fileUploadFormData.append('ref', this.laravel.job.order_number);
				this.fileUploadFormData.append('sizex', sizex);
				this.fileUploadFormData.append('sizey', sizey);
				if(this.fileUploadFormData.file==undefined)this.fileUploadFormData.append('file', '');
				this.$http.post('/api/uploadproposalimage', this.fileUploadFormData).then(function(result){
					if(result.data.result=='success'){
						if(type=='job'){
							if(image=='main'){
								console.log(result.data.filename);
								this.mainImage.photo=result.data.filename;
								this.mainImage.id='';
								if(this.lc) LC.teardown();
								$('.literally').remove();
								var imageSize = {width: 640, height: 480};
								var imageBounds = {
									x: 0,
									y: 0,
									width: imageSize.width,
									height: imageSize.height
								};
								var newImage = new Image(640,480);
								var hostname = window.location.hostname;
								newImage.src = 'http://'+hostname+'/jobs/'+this.laravel.job.order_number+'/img/'+result.data.filename;
								newImage.setAttribute('crossOrigin', 'anonymous');
								$(theInput).closest( ".row" ).find('.lc').append('<div class="literally" style="min-height: 480px"></div><button class="btn btn-primary savediagram pull-right clearfix" style="margin: 10px;">Save Image</button>');
								this.lc = LC.init(
									document.getElementsByClassName('literally')[0],
										{
											imageURLPrefix: '/img/vendor/literallycanvas',
											imageSize: imageSize,
											backgroundShapes: [
												LC.createShape(
												  'Image', {x: 0, y: 0, image: newImage, scale: 1}
												)
											],
											tools: [LC.tools.Polygon,LC.tools.Pencil,LC.tools.Eraser,LC.tools.Line,LC.tools.Rectangle,LC.tools.Text,LC.tools.Pan,LC.tools.Eyedropper],
											primaryColor: 'rgb(215, 0, 0)',
											secondaryColor: 'rgba(215, 0, 0, 0.5)',
											defaultStrokeWidth: 2,
										}
								);
								var that = this;
								$('.savediagram').click(function(e) {
							    	e.preventDefault();
							    	that.$http.post('/api/saveimage', {
							    		img: that.lc.getImage({rect: imageBounds}).toDataURL(),
							    		ref: that.laravel.job.order_number,
							    		type: 'main'
							    	}).then(function(result){
										if(result.data.result=='success'){
											that.mainImage.photo=result.data.filename+'?ed='+Math.random()*(300-0)+0;
										}
										//$('#fileUploadFile').val(result.data.filename);
									}, function(data){
										console.log(data, status, request);
									});
							    });
							}else{
								this.images[image].photo=result.data.filename;
							}
						}else{ //not job images
							this.sections[type].images[image].photo=result.data.filename;
							console.log(this.sections[type].images);
						}
					}
				}, function(data){
					console.log(data, status, request);
				});
			},
            addTerm: function(termId,term,check){
            	check = typeof check !== 'undefined' ? check : false;
            	var exists = false;
            	for (var i = 0; i < this.terms.length; i++) {
            		if(this.terms[i].id==termId){
            			exists = true;
            		}
            	}
            	if(!exists){
            		this.terms.push({
	        			id: termId,
	        			term: term
	        		});
            	}
            	if(check){
        			this.checkedTerms.push(termId);
        		}
            },
            confirmRevise: function(e){
            	e.preventDefault();
				var that=this;
				swal({
					title: "Are you sure?",
					text: "You will not be able to undo this operation",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, restore it!",
					closeOnConfirm: false 
				}, function(){
					that.$http.get($(e.target).attr('href')).then(function(result){
						if(result.data.result=='success'){
							swal.close();
							/*var revision = result.data.revision;
							revision._token = document.querySelector('#token').getAttribute('value');
							var formRevision = new FormData();
							this.iterate(revision);
							that.$http.post($('#saveBuildForm').attr('action'),formRevision).then(function(result){
								if(result.data.result=='success'){
									console.log(result);
								}
							}, function(data){
								console.log(data, status, request);
							});*/
						}
					}, function(data){
						console.log(data, status, request);
					});
				});
            },
            iterate :function(obj) {
			    for (var property in obj) {
			        if (obj.hasOwnProperty(property)) {
			            if (typeof obj[property] == "object")
			                this.iterate(obj[property]);
			            else
			                console.log(property + "   " + obj[property]);
			        }
			    }
			},
			onSubmit: function(){
				$('#proposal_html').val($( "#propstyle" )[0].outerHTML+$( "#proposal" )[0].outerHTML);
				console.log($( "#propstyle" )[0].outerHTML+$( "#proposal" )[0].outerHTML);

			}
		},
		events:{
			
		},
		ready(){
			if(this.sections.length == 0) this.addSection();
			
			if(this.terms.length > 0){ //editing a job and it has terms
				for (var i = this.terms.length - 1; i >= 0; i--) {
					this.addTerm(this.terms[i].id,this.terms[i].term, true);
				}
				for (var i = this.laravel.job.sections.length - 1; i >= 0; i--) { //add reference to the rest of the terms available
					for (var j = this.laravel.job.sections[i].options.length - 1; j >= 0; j--) {
						for (var k = this.laravel.systems[this.laravel.job.sections[i].options[j].system.id].terms.length - 1; k >= 0; k--) {
							this.addTerm(this.laravel.systems[this.laravel.job.sections[i].options[j].system.id].terms[k].id,this.laravel.systems[this.laravel.job.sections[i].options[j].system.id].terms[k].term, false);
						}
					}
				}
			}
			for (var i = this.laravel.terms.length - 1; i >= 0; i--) { //creating a new job so check all default terms
				this.addTerm(this.laravel.terms[i].id,this.laravel.terms[i].term, true);
			}
			if(this.laravel.job.includes){
				for (var i = this.laravel.job.includes.length - 1; i >= 0; i--) {
					for (var j = this.checkedIncludes - 1; j >= 0; j--) {
						if(this.checkedIncludes[j].id!==this.laravel.job.includes[i].id){
							this.checkedIncludes.push(this.laravel.job.includes[i]);
						}
					}
				}
			} else {
				for (var i = this.includes.length - 1; i >= 0; i--) { //creating a new job so check all default includes
					if(this.includes[i].default==1){
						this.checkedIncludes.push(this.includes[i]);
					}
				}
			}
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