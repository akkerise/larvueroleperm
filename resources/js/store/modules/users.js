export default {
    namespaced: true,
    state: {
        users: []
    },
    mutations: {
        SET_USERS(state, users) {
            state.users = users
        }
    },
    actions: {
        set(context, users) {
            context.commit('SET_USERS', users)
        }
    },
    getters: {
        get(state) {
            return state.users
        }
    }
}
