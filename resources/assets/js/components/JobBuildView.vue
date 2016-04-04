<script>
	export default{
		data: function() {
			return {
				'sections': laravel.job.sections,
			};
		},
		components:{
			VueAutocomplete: require('./vue-autocomplete.vue'),
			JobSection: require('./JobSection.vue')
		},
		created(){
			console.log('NewJobBuild Component Loaded');
		},
		methods:{
			addContact: function(){
				this.new_contacts.push({ message: 'Baz' });
			},
			removeContact: function(contact){
				console.log(contact);
				this.new_contacts.$remove(contact);
			},
			getDistance: function(){
				var vueinst = this;
				var dest1 = !this.is_estate ? this.address : this.estate;
				var dest2 = !this.is_estate ? this.suburb : this.estate_address;
				var dest3 = !this.is_estate ? this.city : this.estate_suburb;
				var dest4 = !this.is_estate ? '' : this.estate_city;

				if(dest1!='' && this.dest2!='' && this.dest3!='') {
					var destination = dest1+'+'+dest2+'+'+dest3;
					if(dest4!='') destination+='+'+dest4;

					destination = destination.replace(/ /g,"+");

					var distanceService = new google.maps.DistanceMatrixService();
				    distanceService.getDistanceMatrix({
				        origins: ['24+Davidson+Street+Rynfield+Benoni'],
				        destinations: [destination],
				        travelMode: google.maps.TravelMode.DRIVING,
				        unitSystem: google.maps.UnitSystem.METRIC,
				        durationInTraffic: true,
				        avoidHighways: false,
				        avoidTolls: false
				    },
				    function (response, status) {
				        if (status !== google.maps.DistanceMatrixStatus.OK) {
				            console.log('Error:', status);
				        } else {
				        	var status = response.rows[0].elements[0].status;
				        	if(status!='NOT_FOUND' && status!='ZERO_RESULTS' ){
				        		vueinst.distance = response.rows[0].elements[0].distance.text;
				        		vueinst.distance_problem = false;
				        	}else{
				        		vueinst.distance_problem = true;
				        		vueinst.distance ='';
				        	}
				        }
				    });
				}
			}
		},
		events:{
			// Autocomplete on selected
			'autocomplete-company_name:selected': function(data){
				console.log('selected',data);
				if(data.name!=='Private'){
					this.selected_company = data.id;
					this.contacts = data.contacts;
					this.new_contacts = [];
				}else{
					this.selected_company = 'private';
					console.log('Private Company');
				}
			},
			'autocomplete-contact[]:selected': function(data){
				console.log('selected',data);
				this.new_contacts = [];
				this.contacts.push(data);
				this.vModelPrivateLike= "";

				/*if(data.name!=='Private'){
					this.selected_company = data.id;
					this.contacts = data.contacts;
					this.new_contacts = [];
				}else{
					console.log('Private Company');
				}*/
			}
		}
	}
</script>