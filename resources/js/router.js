import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

// Backend pages
import home from './components/pages/Home';
import tags from './backend/pages/tags';
import categories from './backend/pages/categories';
import users from './backend/pages/users';
import login from './backend/pages/login';


const routes = [
    {path: '/', component: home},
    {path: '/tags', component: tags},
    {path: '/categories', component: categories},
    {path: '/users', component: users},
    {path: '/login', component: login},
];
export default new Router({
    mode: 'history',
    routes
});
