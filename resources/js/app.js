require('./bootstrap')
import Vue from 'vue'
import VueMeta from 'vue-meta'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { ChevronRightIcon, ChevronDownIcon, ChevronUpIcon, EditIcon, PlusIcon, MinusIcon, Trash2Icon, ImageIcon } from 'vue-feather-icons'

Vue.mixin({ methods: { route: window.route } })
Vue.use(VueMeta)
Vue.use(InertiaApp)

Vue.component('chevron-right-icon', ChevronRightIcon)
Vue.component('chevron-down-icon', ChevronDownIcon)
Vue.component('chevron-up-icon', ChevronUpIcon)
Vue.component('edit-icon', EditIcon)
Vue.component('plus-icon', PlusIcon)
Vue.component('minus-icon', MinusIcon)
Vue.component('trash-2-icon', Trash2Icon)
Vue.component('image-icon', ImageIcon)

Vue.filter('toCurrency', function (value) {
    if (typeof value !== "number") {
        return value;
    }
    var formatter = new Intl.NumberFormat('en-ZA', {
        style: 'currency',
        currency: 'ZAR',
        minimumFractionDigits: 2
    });
    return formatter.format(value);
});

Vue.prototype.$http = window.axios;

let app = document.getElementById('app')

new Vue({
  metaInfo: {
    title: 'Loading…',
    titleTemplate: '%s | sanQcorp',
  },
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(app)
