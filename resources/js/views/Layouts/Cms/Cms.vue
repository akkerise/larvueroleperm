<template>
    <div class="container">
        <div class="title">
            <h1>{{title}}</h1>
        </div>

        <div class="user-login">
            <div class="username">
                User: {{ $root.user.name }}
            </div>
            <div class="logout">
                <a href="#" @click.prevent="logout">Logout</a>
            </div>
        </div>
        <div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <router-link exact class="nav-link" to="/cms">Tasks</router-link>
                </li>
                <li class="nav-item">
                    <router-link exact class="nav-link" to="/cms/users">Users</router-link>
                </li>
            </ul>
        </div>
        <div class="main-content">
            <div class="error" v-if="error.message">
                <div v-if="error.status === false" class="alert alert-danger" role="alert">{{ error.message }}</div>
                <div v-else class="alert alert-success" role="alert">{{ error.message }}</div>
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script type="text/javascript">
    import {mapState} from 'vuex'
    import Flash from '../../../helpers/flash.js'

    export default {
        created() {
            this.error = Flash.state
        },
        data() {
            return {
                error: {
                    message: '',
                    status: false
                }
            }
        },
        components: {},
        computed: {
            ...mapState(['title'])
        },
        methods: {
            logout() {
                axios.post('logout')
                    .then(res => console.log(res))
                    .catch(err => {
                        if (err.status === 302 || 401) document.location.href = '/login'
                        else throw err
                    })
            },
        },
    }
</script>

<style lang="scss" scoped>
    .container {
        margin-top: 50px;

        .user-login {
            text-align: right;
        }

        .main-content {
            margin-top: 50px;
        }
    }
</style>
