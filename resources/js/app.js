require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all.min.js');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
//import Vuex from 'vuex';
import stores from './store/store';
//import { createStore } from 'vuex';




const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'MyintMyat';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(stores)
            .mixin({ methods: { route } })
            .mount(el);
    },
}); 



InertiaProgress.init({ color: '#4B5563' });

// Vue.filters('formatData', function(value){
//         if(value){
//             return moment(value).fromNow()
//         }
// });
