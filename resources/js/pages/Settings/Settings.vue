<template>
    <div class="root" id="settings">
        <h2>Settings</h2>
        <div v-if="is_loaded" class="wrapper-content">
            <h4 class="d-flex flex-wrap justify-content-between">
                <span>{{ getUser.name }}</span>
                <button class="btn btn-warning" @click="logout">Log out</button>
            </h4>
            <div>
                <form @submit="saveForm">
                    <div class="form-group mb-2">
                        <label for="user-name">Name</label>
                        <input id="user-name" class="form-control" v-model="user.name"/>
                    </div>
                    <div class="form-group mb-2">
                        <label for="user-email">Email</label>
                        <input id="user-email" class="form-control" v-model="user.email"/>
                    </div>

                    <button class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <div v-else class="wrapper-content">
            <Loader :active="!is_loaded" />
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
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
        ...mapActions(['saveUser']),
        logout() {
            let confirmation = confirm('Are you sure to logout?');

            if (confirmation) {
                user.logout()
                    .then(() => window.location = '/')
                    .catch(e => (console.log(e)));

            }
        },
        userMapping(user) {
            if (! user) {
                return false;
            }

            this.user.name = user.name;
            this.user.email = user.email;

            this.is_loaded = true;
        },
        saveForm(e) {
            e.preventDefault();

            this.is_loaded = false;

            const userId = this.getUser.id;

            user.update(userId, {...this.user})
                .then(({data: response}) => {
                    this.saveUser(response.data);

                    setTimeout(() => {
                        this.is_loaded = true;
                    }, 3000)
                }).catch((e) => {
                    console.log(e);
                    this.is_loaded = true;
                });
        }
    },
    watch: {
        getUser(val) {
            this.userMapping(val);
        },
    },
    mounted() {
        this.userMapping(this.getUser);
    }
}
</script>

<style scoped lang="sass">
@import 'resources/js/layouts/Home/PageStyles'

</style>
