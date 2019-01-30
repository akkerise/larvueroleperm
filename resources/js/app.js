require('./bootstrap');


window.Vue = require('vue')
window.Vuex = require('vuex')
window.VueRouter = require('vue-router').default
window.VueAxios = require('vue-axios').default
window.Axios = require('axios').default
window.ElementUI = require('element-ui')
import 'element-ui/lib/theme-chalk/index.css'

import router from './routes'
import store from './store/store'

Vue.use(router, VueRouter, VueAxios, Axios, ElementUI, Vuex)

Vue.component('app', require('./views/Layouts/Cms/Cms.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        user: window.__user__
    },
    router,
    store,
    components: {}
});
