<script>
	export default{
		data: function() {
			return {
				jobs: laravel.jobs
			};
		},
		components:{
			ModalJobStatus: require('../ModalJobStatus.vue'),
		},
		created(){
			console.log('Job List View Component Loaded');
		},
		methods:{
			showSections: function(key){
				this.jobs[key].show = !this.jobs[key].show;
			},
			deleteJob: function(name, id,e){
				console.log(name, id); 
				var that=this;
				Swal({
					title: "Delete "+name+"?",
					text: "You will not be able to undo this operation",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, delete it!",
					showLoaderOnConfirm: true,
					closeOnConfirm: false 
				}, function(){
					that.$http.post($(e.target).closest('a').attr('href'), {id: id}).then(function(result){
						if(result.data.result=='success'){
							swal({
								title: "Deleted!",
								text: name+" has been deleted.",
								type: "success",
								timer: 2000,
								showConfirmButton: false

							}, function(){
								swal.close();
								setTimeout(function(){
									$("#job-"+id).css({'background-color':'#D46752',color: 'white'}).fadeTo("slow",0.7, function(){
										$(this).remove();
									});
								}, 500);
							});
						}else{
							swal({
								title: "Error!",
								type: 'error',
								text: "Unable to delete "+name,
								timer: 2000,
								showConfirmButton: false
							});
						}
					}, function(data){
						console.log(data, status, request);
					});
				});
			}
		},
		events:{
			
		}
	}
</script>