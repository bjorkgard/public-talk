require('./bootstrap')

// Import modules...
import Vue from 'vue'
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import { InertiaProgress } from '@inertiajs/progress'
import vSelect from 'vue-select'
import helpers from './helpers'

InertiaProgress.init()

Vue.mixin({ methods: { route } })
Vue.use(InertiaPlugin)
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

new Vue({
    metaInfo: {
        titleTemplate: (title) => (title ? `Föreläsningar | ${title}` : 'Föreläsningar')
    },
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) =>
                    import(`./Pages/${name}`).then((module) => module.default),
                resolveErrors: (page) => page.props.errors || {} // Customize if needed
            }
        })
}).$mount(app)
