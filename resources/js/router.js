import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

// Backend pages
import home from './components/pages/Home';
import tags from './backend/pages/tags';
import categories from './backend/pages/categories';
import users from './backend/pages/users';
import login from './backend/pages/login';
import roles from './backend/pages/roles';
import permissions from './backend/pages/permissions';
import blogs from './backend/pages/blogs';
import createBlog from './backend/pages/createBlog';
import updateBlog from './backend/pages/updateBlog';
import notfound from './backend/pages/notfound';



const routes = [
    {path: '/', component: home, name: 'home'},
    {path: '/tags', component: tags, name: 'tags'},
    {path: '/categories', component: categories, name: 'categories'},
    {path: '/blogs', component: blogs, name: 'blogs'},
    {path: '/createBlog', component: createBlog, name: 'createBlog'},
    {path: '/updateBlog/:id', component: updateBlog, name: 'updateBlog'},
    {path: '/users', component: users, name: 'users'},
    {path: '/login', component: login, name: 'login'},
    {path: '/roles', component: roles, name: 'roles'},
    {path: '/permissions', component: permissions, name: 'permissions'},
    {path: '*', component: notfound, name: 'notfound'},
];
export default new Router({
    mode: 'history',
    routes
});
