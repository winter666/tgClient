<template>
    <div class="root" id="my-bots-index">
        <h2>My Bots</h2>
        <div v-if="is_loaded" class="wrapper-content">
            <div class="new-bot-display">
                <button @click="newBot()" class="btn btn-outline-success">Add</button>
            </div>
            <div class="bot-list d-flex flex-wrap"  v-if="getBotList.length">
                <div class="card shadow-sm col-lg-3 col-md-12 col-sm-12 m-2" v-for="bot in getBotList" :key="bot.id">
                    <div class="card-header">
                        <span>{{ bot.local_name }}</span>
                    </div>
                    <div class="card-body">
                        <div class="m-4">
                            <b>Link</b> <a :href="bot.link" target="_blank">{{ bot.link }}</a>
                        </div>
                        <div class="m-4">
                            <span :class="`text-${statusMapping[bot.status]}`"><b>Status:</b> {{ bot.status }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-success" @click="$router.push({ name: 'bot-settings', params: { id: bot.id} })">Edit</button>
                            <button class="btn btn-danger" @click="deleteBot(bot.id)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
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
import bot from "../../requests/bot";

export default {
    name: "MyBotsIndex",
    components: {Loader},
    data() {
        return {
            is_loaded: false,
            statusMapping: {
                PENDING: 'warning',
                ACTIVE: 'success',
                ERROR: 'danger',
            },
        }
    },
    methods: {
        ...mapActions(['setBotList']),
        newBot() {
            this.$router.push({ name: 'new-bot' });
        },
        deleteBot(id) {
            let confirmation = confirm('Are you sure?');

            if (! confirmation) {
                return false;
            }

            this.is_loaded = false;

            bot.delete(id).then(() => {
                this.fetchList();
            }).catch(e => {
                console.log(e);
            })
        },
        fetchList() {
            this.setBotList().finally(() => {
                setTimeout(() => {
                    this.is_loaded = true;
                }, 1300);
            });
        }
    },
    computed: {
        ...mapGetters(['getBotList'])
    },
    created() {
        this.fetchList();
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
