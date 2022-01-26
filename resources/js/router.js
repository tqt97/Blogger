import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

// Backend pages
import home from './components/pages/Home';
import tags from './backend/pages/tags';
import categories from './backend/pages/categories';



const routes = [
    {path: '/', component: home},
    {path: '/tags', component: tags},
    {path: '/categories', component: categories}


];
export default new Router({
    mode: 'history',
    routes
});
