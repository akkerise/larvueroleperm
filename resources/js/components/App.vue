<template>
    <div class="container">
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
                    <router-link exact class="nav-link" to="/">Tasks</router-link>
                </li>
                <li class="nav-item">
                    <router-link exact class="nav-link" to="/users">Users</router-link>
                </li>
            </ul>
        </div>
        <!--<div class="flash flash__success" v-if="flash.success">{{ flash.success }}</div>-->
        <!--<div class="flash flash__error" v-if="flash.error">{{ flash.error }}</div>-->
        <div class="main-content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script type="text/javascript">
    import {post} from "../helpers/api";

    export default {
        methods: {
            logout() {
                axios.post('logout')
                    .then(response => console.log(response))
                    .catch(error => {
                        if (error.status === 302 || 401) document.location.href = '/login'
                        else throw error
                    })
            },
        }
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
