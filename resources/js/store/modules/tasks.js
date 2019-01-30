import {get} from "../../helpers/api";

export default {
    namespaced: true,
    state: {
        tasks: [],
        search: []
    },
    mutations: {
        SET_TASKS(state, tasks) {
            state.tasks = tasks
        },
        SET_SEARCH_TASKS(state, tasks) {
            state.tasks = tasks
        }
    },
    actions: {
        set(context, tasks) {
            return new Promise((rel, rej) => {
                get(`tasks`)
                    .then(res => {
                        if (res.data.status) {
                            context.commit('SET_TASKS', res.data.data)
                            rel(res)
                        } else {
                            rej(res)
                        }
                    })
                    .catch(err => rej(err))
            })
        },
        search(context, keyword) {
            return new Promise((rel, rej) => {
                get(`tasks?q=${keyword}`)
                    .then(res => {
                        if (res.data.status) {
                            context.commit('SET_SEARCH_TASKS', res.data.data)
                            rel(res)
                        } else {
                            rej(res)
                        }
                    })
                    .catch(err => rej(err))
            })
        }
    },
    getters: {
        get: state => state.tasks,
        search: state => state.search
    }
}
