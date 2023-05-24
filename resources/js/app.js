require('./bootstrap')

// Import modules...
import Vue from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue2'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import vSelect from 'vue-select'
import helpers from './helpers'

Vue.mixin({ methods: { route } })
Vue.use(PortalVue)
Vue.use(VueMeta, { refreshOnceOnNavigation: true })
Vue.use(helpers)
Vue.component('VSelect', vSelect)

Vue.filter('translateRole', (role) => {
    switch (role) {
        case 'owner':
            return 'Full åtkomst'
        case 'admin':
            return 'Administrator'
        case 'booker':
            return 'Kan boka'
        case 'viewer':
            return 'Kan enbart se'
    }

    return 'Annat'
})

const app = document.getElementById('app')

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        Vue.use(plugin).component('InertiaLink', Link)

        new Vue({
            metaInfo: {
                titleTemplate: (title) =>
                    title ? `Föreläsningar | ${title}` : 'Föreläsningar'
            },
            render: (h) => h(App, props)
        }).$mount(el)
    }
})
