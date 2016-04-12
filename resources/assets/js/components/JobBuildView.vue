<script>
	export default{
		data: function() {
			return {
				sections: laravel.job.sections==undefined?[]:laravel.job.sections,
				systems: laravel.systems
			};
		},
		components:{
			VueAutocomplete: require('./vue-autocomplete.vue'),
			JobSection: require('./JobSection.vue'),
		},
		computed:{
			can_save: function(){
				return true
			}
		},
		created(){
			console.log('NewJobBuild Component Loaded');
		},
		methods:{
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
				
			}
		},
		events:{
			
		}
	}
</script>