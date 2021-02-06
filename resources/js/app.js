require('./bootstrap');

window.Vue = require('vue').default;
import App from './App.vue';
import VueRouter from 'vue-router';
import {routes} from './routes';
import axios from 'axios';
import VueAxios from 'vue-axios';
// import VueResource from 'vue-resource';

Vue.use(VueRouter);
// Vue.use(VueResource);
Vue.prototype.axios = axios;
Vue.use(VueAxios, axios);
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
  mode: 'history',
  routes: routes
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth  && !window.Laravel.isLoggedin) next({ name: 'login' })
  else next()
})

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
