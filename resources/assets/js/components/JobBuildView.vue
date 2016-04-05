<script>
	export default{
		data: function() {
			return {
				'sections': laravel.job.sections==undefined?[]:laravel.job.sections,
				'add_section':'',
				'new_section': {
					name:'',
					survey:''
				},
				systems: laravel.systems
			};
		},
		components:{
			VueAutocomplete: require('./vue-autocomplete.vue'),
			JobSection: require('./JobSection.vue'),
		},
		computed:{
			
		},
		created(){
			console.log('NewJobBuild Component Loaded');
		},
		methods:{
			addSection: function(){
				this.sections.push({
					job_id: laravel.job.id,
					name: this.new_section.name,
					survey: this.new_section.survey,
					tasks: this.new_section.tasks
				});
				this.add_section = '';
				this.new_section.name = '';
				this.new_section.survey = '';
			},
			getDistance: function(){
				
			}
		},
		events:{
			
		}
	}
</script>