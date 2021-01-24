import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Pages
import NotFound from './views/component/NotFound'
import Login from './views/component/auth/Login'
import Logout from './views/component/auth/Logout'
import Clientes from './views/component/clientes/Clientes'
import registercliente from './views/component/clientes/registercliente'
import updatecliente from './views/component/clientes/updatecliente'
import Register from './views/component/auth/Register';
import Cuentas from "./views/component/cuentas/Cuentas";

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

        //clientes

        {
            path: '/cliente/register',
            name: 'registercliente',
            component: registercliente,
            meta: {
                requiresAuth: true,
            }
        },

        {
            path: '/cliente/editar/:id',
            name: 'updatecliente',
            component: updatecliente,
            meta: {
                requiresAuth: true,
            }
        },

        //cuentas

        {
            path: '/cuentas',
            name: 'cuentas',
            component: Cuentas,
            meta: {
                requiresAuth: true,
            }
        },
    ],
});

export default router