<template>
    <div class="root" id="my-bots-index">
        <h2>My Bots</h2>
        <div v-if="is_loaded" class="wrapper-content">
            <div class="new-bot-display">
                <button @click="newBot()" class="btn btn-outline-success">Add</button>
            </div>
            <!-- TODO: вместо таблицы сделать блоки с данными -->
            <table class="table" v-if="getBotList.length">
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <tr v-for="bot in getBotList" :key="bot.id">
                        <td>{{ bot.id }}</td>
                        <td>{{ bot.local_name }}</td>
                        <td>{{ bot.link }}</td>
                        <td>{{ bot.status }}</td>
                    </tr>
                </tbody>
            </table>
            <div v-else class="no-one-bot">
                <div class="title-message">No one bots</div>
            </div>
        </div>
        <div v-else class="wrapper-content">
            <Loader :active="!is_loaded" />
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";
import Loader from "../../components/Loader/Loader";

export default {
    name: "MyBotsIndex",
    components: {Loader},
    data() {
        return {
            is_loaded: false
        }
    },
    methods: {
        ...mapActions(['setBotList']),
        newBot() {
            this.$router.push('home/bot/new');
        }
    },
    computed: {
        ...mapGetters(['getBotList'])
    },
    created() {
        this.setBotList().then(list => {
            setTimeout(() => {
                this.is_loaded = true;
            }, 1300);
        });
    }
}
</script>

<style scoped lang="sass">
@import 'resources/js/layouts/Home/PageStyles'

.root
    .wrapper-content
        .new-bot-display
            margin: 20px

        .no-one-bot
            display: flex
            width: 100%
            height: 100%
            justify-content: center
            align-items: center
            .title-message
                color: #3f3f3f
                font-size: 35px
</style>
