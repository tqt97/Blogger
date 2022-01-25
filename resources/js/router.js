import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);
import firstPage from './components/pages/myFirstVuePage';
import home from './components/pages/Home';
import about from './components/pages/About';
const routes = [
    {path: '/first', component: firstPage},
    {path: '/second', component: home},
    {path: '/third', component: about}
];
export default new Router({
    mode: 'history',
    routes
});
