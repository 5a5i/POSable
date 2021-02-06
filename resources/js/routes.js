import Developers from './components/Developers.vue';
import AddDeveloper from './components/AddDeveloper.vue';
import EditDeveloper from './components/EditDeveloper.vue';
import ViewDeveloper from './components/ViewDeveloper.vue';
import Register from './components/Register';
import Login from './components/Login';

export const routes = [
    {
        name: 'developer',
        path: '/developer',
        component: Developers,
            meta: {
                requiresAuth: true
            }
    },
    {
        name: 'addDeveloper',
        path: '/developer/add',
        component: AddDeveloper,
            meta: {
                requiresAuth: true
            }
    },
    {
        name: 'editDeveloper',
        path: '/developer/edit/:id',
        component: EditDeveloper,
            meta: {
                requiresAuth: true
            }
    },
    {
        name: 'viewDeveloper',
        path: '/developer/view/:id',
        component: ViewDeveloper,
            meta: {
                requiresAuth: true
            }
    },
    {
        name: 'home',
        path: '/',
        component: Developers,
            meta: {
                requiresAuth: true
            }
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
];
