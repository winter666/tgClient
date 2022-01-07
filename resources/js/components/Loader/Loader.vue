<template>
    <div class="loader" v-if="active">
        <img src="/img/loader.gif" alt="loader .GIF"/>
    </div>
</template>

<script>
export default {
    name: "Loader",
    props: {
        active: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {}
    }
}
</script>

<style scoped lang="sass">
    .loader
        width: 100%
        height: 100%
        display: flex
        justify-content: center
        align-items: center
</style>
