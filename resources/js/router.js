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
import registerCuenta from "./views/component/cuentas/registerCuenta";
import updateCuenta from "./views/component/cuentas/updateCuenta";
import Consignaciones from "./views/component/consignaciones/Consignaciones";
import registerConsignaciones from "./views/component/consignaciones/registerConsignaciones";
import updateConsignaciones from "./views/component/consignaciones/updateConsignaciones";
import Retiros from "./views/component/retiros/Retiros";
import registerRetiros from "./views/component/retiros/registerRetiros";
import updateRetiros from "./views/component/retiros/updateRetiros";

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

        {
            path: '/cuenta/register',
            name: 'registerCuenta',
            component: registerCuenta,
            meta: {
                requiresAuth: true,
            }
        },

        {
            path: '/cuenta/editar/:id',
            name: 'updateCuenta',
            component: updateCuenta,
            meta: {
                requiresAuth: true,
            }
        },

        //consignaciones

        {
            path: '/consignaciones',
            name: 'consignaciones',
            component: Consignaciones,
            meta: {
                requiresAuth: true,
            }
        },

        {
            path: '/consignaciones/register',
            name: 'registerConsignaciones',
            component: registerConsignaciones,
            meta: {
                requiresAuth: true,
            }
        },

        {
            path: '/consignaciones/editar/:id',
            name: 'updateConsignaciones',
            component: updateConsignaciones,
            meta: {
                requiresAuth: true,
            }
        },


        //retiros

        {
            path: '/retiros',
            name: 'retiros',
            component: Retiros,
            meta: {
                requiresAuth: true,
            }
        },

        {
            path: '/retiros/register',
            name: 'registerRetiros',
            component: registerRetiros,
            meta: {
                requiresAuth: true,
            }
        },

        {
            path: '/retiros/editar/:id',
            name: 'updateRetiros',
            component: updateRetiros,
            meta: {
                requiresAuth: true,
            }
        },
    ],
});

export default router