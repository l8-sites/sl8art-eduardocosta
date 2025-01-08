import '../css/app.css';
import '../../node_modules/sweetalert2/dist/sweetalert2.min.css';

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import VueTheMask from 'vue-the-mask';
import VueSweetalert2 from 'vue-sweetalert2';
import VueLazyload from 'vue-lazyload'
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)})
            .use(plugin)
            .use(VueTheMask)
            .use(VueSweetalert2)
            .use(ZiggyVue)
            .use(VueLazyload, {
                preLoad: 0,
                attempt: 0,
            })
        app.config.globalProperties.$title = import.meta.env.VITE_APP_NAME;
        app.config.globalProperties.$id = import.meta.env.VITE_API_CLIENT_ID;
        app.config.globalProperties.$asset = import.meta.env.VITE_ENV === 'local'
            ? '.'
            : import.meta.env.VITE_ASSET + '/' + import.meta.env.VITE_API_CLIENT_ID + '/build/assets';
        app.mount(el);

        delete el.dataset.page
    }
})
