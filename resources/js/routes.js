import Developers from './components/Developers.vue';
import AddDeveloper from './components/AddDeveloper.vue';
import EditDeveloper from './components/EditDeveloper.vue';
import ViewDeveloper from './components/ViewDeveloper.vue';
import Register from './components/Register';
import Login from './components/Login';
import ForgotPassword from './components/ForgotPassword';
import ResetPasswordForm from './components/ResetPasswordForm';

export const routes = [
    {
        name: 'developer',
        path: '/developer',
        component: Developers,
        meta: {
          auth:true,
          requiresAuth:true
        }
    },
    {
        name: 'addDeveloper',
        path: '/developer/add',
        component: AddDeveloper,
        meta: {
          auth:true,
          requiresAuth:true
        }
    },
    {
        name: 'editDeveloper',
        path: '/developer/edit/:id',
        component: EditDeveloper,
        meta: {
          auth:true,
          requiresAuth:true
        }
    },
    {
        name: 'viewDeveloper',
        path: '/developer/view/:id',
        component: ViewDeveloper,
        meta: {
          auth:true,
          requiresAuth:true
        }
    },
    {
        name: 'home',
        path: '/',
        component: Developers,
        meta: {
          auth:true,
          requiresAuth:true
        }
    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        meta: {
          auth:false,
          requiresAuth:false
        }
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
          auth:false,
          requiresAuth:false
        }
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component: ForgotPassword,
        meta: {
          auth:false,
          requiresAuth:false
        }
    },
    {
        path: '/reset-password/:token',
        name: 'reset-password-form',
        component: ResetPasswordForm,
        meta: {
          auth:false,
          requiresAuth:false
        }
    },
    {
        path: '/direct/reset/password',
        name: 'direct-reset-password',
        component: ResetPasswordForm,
        meta: {
          auth:false,
          requiresAuth:false
        }
    }
];
