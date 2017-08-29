<script>
	export default{
		data: function() {
			return {
				vModelLike: laravel.old.company_name ? laravel.old.company_name:'',
				vModelPrivateLike: "",
				is_estate: '',
				selected_company: laravel.old.company_id ? laravel.old.company_id: '',
				new_contacts: laravel.old.new_contact && laravel.old.new_contact.length > 0 ? laravel.old.new_contact: [{ message: 'Me' }],
				contacts: laravel.old.contact && laravel.old.contact.length ? laravel.old.contact:[],
				address: '',
				suburb: '',
				city: '',
				value: '',
				description: '',
				estate: '',
				estate_address: '',
				estate_suburb: '',
				estate_city: '',
				distance: '',
				distance_problem: false,
				old: laravel.old,
				users: laravel.users,
				custom: false,
			};
		},
		computed: {
			contactParam: function(){
				return 'company_id=2&name';
			},
			company_address1: function(){
				return this.old.company_address1 ? this.old.company_address1 : this.address;
			},
			company_address2: function(){
				return this.old.company_address2 ? this.old.company_address2 : this.suburb;
			},
			company_address3: function(){
				return this.old.company_address3 ? this.old.company_address3 : this.city;
			}
		},
		components:{
			VueAutocomplete: require('../vue-autocomplete.vue'),
			CompanyContacts: require('./CompanyContacts.vue')
		},
		created(){
			console.log('HomeView Component Loaded');
			$(function() {
				jQuery('select').select2();
			});
		},
		methods:{
			addContact: function(){
				this.new_contacts.push({ message: 'Baz' });
			},
			removeContact: function(contact){
				console.log(contact);
				this.new_contacts.$remove(contact);
			},
			getDistance: function(event,alertOnError){
				alertOnError = typeof alertOnError !== 'undefined' ? alertOnError : false;
				var vueinst = this;
				var dest1 = !this.is_estate ? this.address : this.estate;
				var dest2 = !this.is_estate ? this.suburb : this.estate_address;
				var dest3 = !this.is_estate ? this.city : this.estate_suburb;
				var dest4 = !this.is_estate ? '' : this.estate_city;

				if(dest1!='' && this.dest3!='') {
					console.log('here', dest1, dest3,alertOnError);
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
				        		if(alertOnError){
					            	swal('Distance Error','Address not found, please add distance from Sanika Offices manually');
					            }
				        	}
				        }
				    });
				}
			}
		},
		events:{
			// Autocomplete on selected
			'autocomplete-company_name:selected': function(data){
				console.log('Company Selected',data);
				this.selected_company = data.id;
				if(data.name!=='Private'){
					console.log('not private');
					this.contacts = data.contacts;
					this.new_contacts = [];
				}else{
					console.log('Private Company');
				}
			},
			'autocomplete-existing_contact[]:selected': function(data){
				console.log('contact selectd',data);
				this.contacts.push(data);
				this.vModelPrivateLike= "";
				this.new_contacts = [];

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