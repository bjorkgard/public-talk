require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue';

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(VueMeta, { refreshOnceOnNavigation: true })


const app = document.getElementById('app');

new Vue({
    metaInfo: {
        titleTemplate: (title) => (title ? `Föreläsningar | ${title}` : 'Föreläsningar')
    },
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
            },
        }),
}).$mount(app);
