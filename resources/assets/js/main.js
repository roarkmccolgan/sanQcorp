var Vue = require('vue');
window.Swal = require('sweetalert2');
//window.CKEDITOR_BASEPATH = '/js/vendor/ckeditor/';
//var ckeditor = require('ckeditor');
//var summernote = require('summernote');

Vue.use(require('vue-resource'));
Vue.use(require('vue-moment'));

Vue.config.debug = true;
//import Greeter from './components/Greeter.vue';

import NewJobView from './components/admin/NewJobView.vue';
import JobBuildView from './components/admin/JobBuildView.vue';
import JobProgressView from './components/JobProgressView.vue';
import JobListView from './components/admin/JobListView.vue';

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

Vue.directive('select', {
    twoWay: true,
    priority: 1000,

    params: ['placeholder'],

    bind: function () {
        var self = this;
        $(this.el)
            .select2({
            placeholder: this.params.placeholder
        })
        .on("change", function (evt) { //select2:select
            self.set($(self.el).val());
            self.vm.$dispatch('selectFilter', $(self.el).val());
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
        var self = this;
        //console.log(self.expression);
        //console.log(self.vm.$data);
        $(this.el)
            .bootstrapSwitch()
        .on('switchChange.bootstrapSwitch', function (event,state) {
            //if(typeof self.expression.split(".").reduce(function(o, x) { return o[x] }, self.vm.$data) !== "undefined"){
                self.set(state);
                if(self.arg) self.vm.$dispatch('switchFilter', self.arg, state, self.el);
            //}
        })
    },
    update: function (value) {
        $(this.el).bootstrapSwitch('state', value, true);
    }
})
//Vue.transition('showAll',{});

new Vue({
    el: 'body',

    components: {
    	// Greeter,
    	NewJobView,
        JobBuildView,
        JobProgressView,
        JobListView
    },

    ready() {
        console.log('Vue and Vueify all set to go!');
        jQuery(document).on("keydown", function (e) {
            if (e.which === 8 && !$(e.target).is("input, textarea")) {
                e.preventDefault();
            }
        });
        var elem = document.getElementById("pageLoader");
        if(elem){
            elem.parentNode.removeChild(elem);
        }
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