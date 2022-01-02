<template>
    <div id="home">
        <div class="header">
            <h1>Bot Manager</h1>
            <div class="nav">
                <div class="nav-item">
                    <router-link class="nav-link" :to="'/home/my-bots'">My Bots</router-link>
                </div>
                <div class="nav-item">
                    <router-link class="nav-link" :to="'/home/prizes'">Prizes</router-link>
                </div>
                <div class="nav-item">
                    <router-link class="nav-link" :to="'/home/settings'">Settings</router-link>
                </div>
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
export default {
    name: "Home"
}
</script>

<style scoped>

</style>
