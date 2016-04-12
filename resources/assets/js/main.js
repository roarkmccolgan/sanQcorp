var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.config.debug = true;
//import Greeter from './components/Greeter.vue';
import VueAutocomplete from './components/vue-autocomplete.vue';
import NewJobView from './components/NewJobView.vue';
import JobBuildView from './components/JobBuildView.vue';

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
Vue.directive('select', {
    twoWay: true,
    priority: 1000,

    params: ['options','placeholder'],

    bind: function () {
        var self = this
        $(this.el)
            .select2({
            data: this.params.options,
            placeholder: this.params.placeholder
        })
        .on('change', function () {
            console.log(typeof this.value)
            self.set(this.value);
        })
    },
    update: function (value) {
        $(this.el).val(value).trigger('change')
    },
    unbind: function () {
        $(this.el).off().select2('destroy')
    }
})

Vue.directive('switch', {
    twoWay: true,
    priority: 1000,

    bind: function () {
        var self = this
        $(this.el)
            .bootstrapSwitch()
        .on('switchChange.bootstrapSwitch', function () {
            self.set(this.checked);
        })
    },
    update: function (value) {
        $(this.el).val(value).trigger('switchChange.bootstrapSwitch')
    },
    unbind: function () {
        $(this.el).off().bootstrapSwitch('destroy')
    }
})
//Vue.transition('showAll',{});

new Vue({
    el: 'body',

    components: {
    	// Greeter,
    	NewJobView,
        JobBuildView
    },

    ready() {
        console.log('Vue and Vueify all set to go!');
        jQuery(document).on("keydown", function (e) {
            if (e.which === 8 && !$(e.target).is("input, textarea")) {
                e.preventDefault();
            }
        });

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