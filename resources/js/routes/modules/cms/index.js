import {ROLES} from '../../../helpers/role'

export default [
    {
        path: '/',
        name: 'tasks',
        component: require('../../../views/Cms/Task/Task.vue').default,
        meta: {requiredRoles: ROLES}
    },
    {
        path: '/cms',
        name: 'tasks',
        component: require('../../../views/Cms/Task/Task.vue').default,
        meta: {requiredRoles: ROLES}
    },
    {
        path: '/cms/tasks',
        name: 'tasks',
        component: require('../../../views/Cms/Task/Task.vue').default,
        meta: {requiredRoles: ROLES}
    },
    {
        path: '/cms/users',
        name: 'users',
        component: require('../../../views/Cms/User/User.vue').default,
        meta: {requiredRoles: ['manager', 'admin']}
    }
]
