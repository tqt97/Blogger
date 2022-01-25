require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router'

Vue.config.productionTip = false;

Vue.component('mainapp', require('./components/mainapp.vue').default);


const app = new Vue({
    el: '#app',
    router
});
