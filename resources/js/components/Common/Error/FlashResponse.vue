<template>
        <div class="error" v-if="error.message.length">
            <div v-if="error.status === false" class="alert alert-danger" role="alert">{{ error.message }}</div>
            <div v-else class="alert alert-success" role="alert">{{ error.message }}</div>
        </div>
</template>

<script>
    export default {
        name: "FlashResponse",
        props: ['error']
    }
</script>

<style scoped>

</style>
