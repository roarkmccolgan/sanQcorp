<script>
	export default{
		data: function() {
			return {
				sections: laravel.job==undefined?[]:laravel.job.sections,
				employees: laravel.employees
			};
		},
		components:{
			//VueAutocomplete: require('./vue-autocomplete.vue'),
			JobTask: require('./JobTask.vue'),
		},
		created(){
			console.log('JobProgress Component Loaded');
		},
		methods:{
			getDistance: function(){
				
			}
		},
		events:{
			
		}
	}
</script>