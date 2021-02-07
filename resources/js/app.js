require('./bootstrap');

window.Vue = require('vue').default;
import App from './App.vue';
import VueRouter from 'vue-router';
import {routes} from './routes';
import axios from 'axios';
import VueAxios from 'vue-axios';
import moment from 'moment';

Vue.use(VueRouter);
Vue.prototype.axios = axios;
Vue.use(VueAxios, axios);

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY hh:mm')
  }
});

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
