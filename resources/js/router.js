import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Pages
import NotFound from './views/component/NotFound'
import Login from './views/component/auth/Login'
import Logout from './views/component/auth/Logout'
import Clientes from './views/component/Clientes'
import Register from './views/component/auth/Register';

// Routes
const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [
        {
            path: '/',
            name: 'login',
            component: Login,
        },

        {
            path: '/registrarse',
            name: 'registrarse',
            component: Register,
            meta: {
                requiresAuth: false,
            }
        },

        {
            path: '/logout',
            name: 'logout',
            component: Logout,
            meta: {
                requiresAuth: true,
            }
        },
     
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Clientes,
            meta: {
                requiresAuth: true,
            }
        },
        { 
            path: '/404', 
            name: '404', 
            component: NotFound,
        },
        { 
            path: '*', 
            redirect: '/404', 
        },
    ],
});

export default router