<template>
    <div id="home">
        <Sidebar />
        <div class="content" :class="{content__sidebar_opened: getSidebarState}">
            <div v-if="is_loaded">
                <router-view></router-view>
            </div>
            <div v-else>
                <img src="/img/loader.gif" alt="loader .GIF"/>
            </div>
        </div>
        <div class="footer">
            Footer
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import Sidebar from "../../components/Sidebar/Sidebar.vue";

export default {
    name: "Home",
    components: { Sidebar },
    data() {
        return {
            is_loaded: false
        }
    },
    methods: {
        ...mapActions(['setUser']),
    },
    computed: {
        ...mapGetters(['getSidebarState'])
    },
    created() {
        Promise.all([
            this.setUser()
        ]).then(data => {
            setTimeout(() => {
                this.is_loaded = true;
            }, 1300)
        });
    }
}
</script>

<style scoped lang="sass" src="./Home.sass"></style>
