<template>
    <div id="home">
        <Sidebar />
        <div class="content" :class="{content__sidebar_opened: getSidebarState}">
            <transition>
                <router-view></router-view>
            </transition>
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
        return {}
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
        ]);
    }
}
</script>

<style scoped lang="sass" src="./Home.sass"></style>
