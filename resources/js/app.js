require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router';
import store from './store';
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import Editor from 'vue-editor-js'
// import Editor from 'vue-editor-js/src/index'

Vue.use(ViewUI);
Vue.use(Editor);

import common from './common';
import jsonToHtml from './jsonToHtml';
Vue.mixin(common);
Vue.mixin(jsonToHtml);


Vue.config.productionTip = false;

Vue.component('base-template', require('./components/Base.vue').default);


const app = new Vue({
    el: '#app',
    router,
    store
});
