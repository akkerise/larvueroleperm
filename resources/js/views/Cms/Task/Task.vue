<template>
    <div>
        <div class="row">
            <div class="col-9">
                <input type="text" v-on:keydown.enter="add" v-model="content" class="form-control"
                       placeholder="Enter task...">
                <input type="text" v-on:keyup="search" v-model="keyword" class="form-control"
                       placeholder="Search task...">
            </div>
            <div class="col-3">
                <button class="btn btn-primary" @click="add">Create</button>
            </div>
        </div>
        <div class="list-tasks">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Content</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(task, index) in tasks" :key="'task-' + index">
                    <th scope="row">{{ task.id }}</th>
                    <td>{{ task.content }}</td>
                    <td>
                        <button @click="del(task, index)" class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import {
        get,
        post,
        del
    } from "../../../helpers/api"
    import Flash from '../../../helpers/flash.js'

    export default {
        components: {},
        data() {
            return {
                tasks: [],
                content: '',
                keyword: ''
            }
        },
        computed: {},
        created() {
            this.fetch()
        },
        methods: {
            fetch() {
                this.$store.dispatch('tasks/set')
                    .then(res => {
                        this.tasks = this.$store.getters['tasks/get']
                        Flash.set(res.data.message, res.data.status)
                    })
                    .catch(err => Flash.set(err.data.message, err.data.status))
            },
            add() {
                post(`tasks`, {content: this.content})
                    .then(res => {
                        if (res.data.status) {
                            this.tasks.push(res.data.data)
                            this.$store.dispatch('tasks/set', this.tasks)
                            this.content = ''
                        }
                        Flash.set(res.data.message, res.data.status)
                    })
                    .catch(err => console.log(err));
            },
            del(task, index) {
                if (confirm(`Are you want delete task id : ${task.id} ?`)) {
                    del(`tasks/${task.id}`)
                        .then(res => {
                            if (res.data.status) {
                                this.tasks.splice(index, 1)
                                this.$store.dispatch('tasks/set', this.tasks)
                            }
                            Flash.set(res.data.message, res.data.status)
                        })
                        .catch(err => console.log(err));
                }
            },
            search() {
                if (this.keyword != '' || this.keyword == null) {
                    this.$store.dispatch('tasks/search', this.keyword)
                        .then(res => {
                            if (res.data.status) {
                                this.tasks = this.$store.getters['tasks/search']
                                Flash.set(res.data.message, res.data.status)
                            }
                        })
                        .catch(err => Flash.set(err.data.message, err.data.status))
                } else {
                    this.fetch()
                }
                console.log(this.keyword)
            }
        }
    };
</script>

<style lang="scss" scoped>
    .list-tasks {
        margin-top: 50px;
    }

    .error {
        margin-bottom: 15px;
    }
</style>
