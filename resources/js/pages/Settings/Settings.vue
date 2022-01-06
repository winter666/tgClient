<template>
    <div id="settings">
        <h2>Settings</h2>
        <h4>{{ getUser.name }}</h4>
        <div>
            <input v-model="user_name" />
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: "Settings",
    data() {
        return {
            user_name: '',
            user_email: '',
            user_email_confirm_code: '',
            user_password_old: '',
            user_password_new: '',
            user_password_new_confirm: ''
        }
    },
    methods: {

    },
    computed: {
        ...mapGetters(['getUser'])
    }
}
</script>

<style scoped>

</style>
