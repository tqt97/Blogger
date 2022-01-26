require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router';
import store from './store';
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);

import common from './common';
Vue.mixin(common);


Vue.config.productionTip = false;

Vue.component('base-template', require('./components/Base.vue').default);


const app = new Vue({
    el: '#app',
    router,
    store
});
