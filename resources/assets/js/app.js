require('./bootstrap');
// Require Froala Editor assets
require('../../../vendor/manaferra/library/src/resources/views/components/vendor/froala-assets');

import VueRouter from 'vue-router';
import { store } from '../../../vendor/manaferra/library/src/resources/assets/js/store'
import { routes } from '../../../vendor/manaferra/library/src/resources/assets/js/routes'

// require base components
require('../../../vendor/manaferra/library/src/resources/assets/js/base-components');

// plugins panels
require('./plugins-panels');

// Router
Vue.use(VueRouter);

// TODO titulli per cdo komponent me ndreq
// router.beforeEach((to, from, next) => {
//     document.title = to.meta.title;
//     next();
// });

const router = new VueRouter({
    routes,
    mode: 'history' // remove # tag from link
});

const app = new Vue({
    el: '#app',
    router,
    store,
});
