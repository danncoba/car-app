import Vue from 'vue';
import VueRouter from 'vue-router';
import './bootstrap';
import Home from './components/Home';
import Dashboard from './components/Dashboard';
import DashboardMember from './components/DashboardMember';
import Categories from './components/Categories';
import Login from './components/Login';
import NewCategory from './components/admin/NewCategory';
import EditCategory from './components/admin/EditCategory';
import NewCar from './components/member/NewCar';
import EditCar from './components/member/EditCar';
import Auth from './authenticationMiddleware';
import MainNav from './components/shared/MainNav';
import Logout from './components/shared/Logout';

let auth = new Auth();

window.Event = new class {
    constructor() {
        this.vue = new Vue();
    }
}

const routes = [
    { path: '/', component: Home, beforeEnter: auth.notAuthRoute },
    { path: '/dashboard', component: Dashboard, beforeEnter: auth.isCurrentAllowedAdmin },
    { path: '/categories', component: Categories, beforeEnter: auth.isCurrentAllowedAdmin },
    { path: '/categories/:id', component: EditCategory, beforeEnter: auth.isCurrentAllowedAdmin },
    { path: '/new-category', component: NewCategory, beforeEnter: auth.isCurrentAllowedAdmin },
    { path: '/dashboard-member', component: DashboardMember, beforeEnter: auth.isCurrentAllowedMember },
    { path: '/dashboard-member/new-car', component: NewCar, beforeEnter: auth.isCurrentAllowedMember },
    { path: '/cars/:id', component: EditCar, beforeEnter: auth.isCurrentAllowedMember },
    { path: '/login', component: Login, beforeEnter: auth.notAuthRoute },
    { path: '/logout', component: Logout, beforeEnter: auth.notAuthRoute }
]

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

const app = new Vue({
    el: '#root',
    router: router,
    components: {
        'main-nav': MainNav
    }
})