<template>
    <div class="root" id="settings">
        <h2>Settings</h2>
        <div v-if="is_loaded" class="wrapper-content">
            <h4 class="d-flex flex-wrap justify-content-between">
                <span>{{ getUser.name }}</span>
                <button class="btn btn-warning" @click="logout">Log out</button>
            </h4>
            <div>
                <form>
                    <label for="user-name">Name</label>
                    <input id="user-name" class="form-control" v-model="user.name" />
                </form>
            </div>
        </div>
        <div v-else class="wrapper-content">
            <Loader :active="!is_loaded" />
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Loader from "../../components/Loader/Loader";
import user from '../../requests/users';

export default {
    name: "Settings",
    components: {Loader},
    data() {
        return {
            user: {
                name: '',
                email: '',
                password_old: '',
                password_new: '',
                password_new_confirm: ''
            },
            is_loaded: false,
        }
    },
    computed: {
        ...mapGetters(['getUser'])
    },
    methods: {
        logout() {
            let confirmation = confirm('Are you sure to logout?');

            if (confirmation) {
                user.logout()
                    .then(() => window.location.redirect = '/')
                    .catch(e => (console.log(e)));

            }
        }
    },
    watch: {
        getUser(val) {
            if (val) {
                this.is_loaded = true;
            }
        },
    },
}
</script>

<style scoped lang="sass">
@import 'resources/js/layouts/Home/PageStyles'

</style>
