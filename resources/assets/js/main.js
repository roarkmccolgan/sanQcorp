var Vue = require('vue');
Vue.use(require('vue-resource'));

//import Greeter from './components/Greeter.vue';

import VueAutocomplete from './components/vue-autocomplete.vue';
import HomeView from './components/HomeView.vue';

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
//Vue.transition('showAll',{});

new Vue({
    el: 'body',

    components: {
    	// Greeter,
    	HomeView,
    	VueAutocomplete
    },

    ready() {
        console.log('Vue and Vueify all set to go!');
    }
});
/*var Vue = require('vue');

import HomeView from './components/HomeView.vue'
import VueAutocomplete from './components/vue-autocomplete.vue'

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

new Vue({
	el: 'body',
	components: {
		HomeView,
		VueAutocomplete
	}
})*/