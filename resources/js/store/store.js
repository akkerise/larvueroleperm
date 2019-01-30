import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import state from './state'
import mutations from './mutations'
import actions from './actions'
import getters from './getters'

// Import module
import tasks from './modules/tasks'
import users from './modules/users'

export default new Vuex.Store({
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
    modules: {
        tasks,
        users
    }
})
