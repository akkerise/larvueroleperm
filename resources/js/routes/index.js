import Vue from 'vue'
import VueRouter from 'vue-router'
import {ROLES} from './../helpers/role'
import cli from './modules/cli'
import cms from './modules/cms'

Vue.use(VueRouter)

export const routes = [...cli, ...cms]

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: routes
})

router.beforeEach((to, from, next) => {
    let user = window.__user__
    if (to.meta.requiredRoles.includes(user.slug)) {
        next()
    } else {
        alert("You don't have permission to access this page.")
        next({path: '/'})
    }
})

export default router
