<script>
	export default{
		data: function() {
			return {
				sections: laravel.sections==undefined?[]:laravel.sections,
				employees: laravel.employees
			};
		},
		components:{
			//VueAutocomplete: require('./vue-autocomplete.vue'),
			JobTask: require('./JobTask.vue'),
		},
		computed:{
			
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