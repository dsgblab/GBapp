import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import VueGates from 'vue-gates'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import UserAbilities from "@/Plugins/UserAbilities.js";
import {fas} from '@fortawesome/free-solid-svg-icons';
import {far} from '@fortawesome/free-regular-svg-icons';
import {library} from '@fortawesome/fontawesome-svg-core';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import VueFullscreen from 'vue-fullscreen'
import TomSelect from "@/CustomComponents/TomSelect/Main.vue";

library.add(fas, far);

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'GB App';

createInertiaApp({
    title: (title) => `${title} | ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(UserAbilities)
            .use(VueFullscreen)
            .use(ZiggyVue, Ziggy)
            .use(VueGates, {
                superRole: 'super-administrador',
                persistent: false
            })
            .use(VueSweetalert2, {
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
            })
            .component("font-awesome-icon", FontAwesomeIcon)
            .component("TomSelect", TomSelect)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
