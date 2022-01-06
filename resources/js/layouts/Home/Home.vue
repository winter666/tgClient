<template>
    <div id="home">
        <div class="header">
            <h1 @click="redirectTo()" class="pointer">Bot Manager</h1>
        </div>
        <div class="nav">
            <div class="nav-item">
                <router-link class="nav-link" :to="'/home'">My Bots</router-link>
            </div>
            <div class="nav-item">
                <router-link class="nav-link" :to="'/home/prizes'">Prizes</router-link>
            </div>
            <div class="nav-item">
                <router-link class="nav-link" :to="'/home/settings'">Settings</router-link>
            </div>
        </div>
        <transition>
            <router-view></router-view>
        </transition>
        <div class="footer">
            Footer
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: "Home",
    data() {
        return {}
    },
    methods: {
        ...mapActions(['setUser']),

        redirectTo(path = '') {
            window.location = 'http://telegram-bot.manager/' + path;
        }
    },
    created() {
        this.setUser();
    }
}
</script>

<style scoped lang="sass">
.pointer
    cursor: pointer
</style>
