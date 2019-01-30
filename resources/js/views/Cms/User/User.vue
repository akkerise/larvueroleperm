<template>
    <div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users" :key="'user-' + index">
                        <th scope="row">{{ user.id }}</th>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import {get} from "../../../helpers/api";
    import Flash from '../../../helpers/flash.js'
    export default {
        components: {
        },
        data() {
            return {
                users: []
            }
        },
        created() {
            this.fetch()
        },
        methods: {
            fetch() {
                get(`users`).then(res => {
                        if (res.data.status) {
                            this.$store.dispatch('users/set', res.data.data)
                            this.users = this.$store.getters['users/get']
                        }
                        Flash.set(res.data.message, res.data.status)
                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style>

</style>
