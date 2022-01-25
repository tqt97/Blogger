import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

import home from './components/pages/Home';
import tags from './components/pages/Tags';


const routes = [
    {path: '/', component: home},
    {path: '/tags', component: tags}

];
export default new Router({
    mode: 'history',
    routes
});
