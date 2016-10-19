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
			}
		},
		events:{
			
		}
	}
</script>