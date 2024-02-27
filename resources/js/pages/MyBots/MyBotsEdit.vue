<template>
    <div class="root" id="bot-edit">
        <h2>Edit Bot</h2>
        <div v-if="is_loaded" class="wrapper-content">
            <div class="data-form">
                <div class="data-block">
                    <CustomValidateInput
                        :id="'local_name_bot'"
                        :name="'local_name'"
                        @onInput="setData"
                        :rules="['not_empty', 'bot_username']"
                        :field_name="'Local Name'"
                        :default-value="local_name"/>
                </div>
                <div class="data-block">
                    <CustomValidateInput
                        :id="'api_key_bot'"
                        :name="'api_key'"
                        @onInput="setData"
                        :rules="['not_empty']"
                        :field_name="'Bot API key'"
                        :default-value="api_key"/>
                </div>
                <div class="data-block mb-4 mt-4">
                    <span class="alert" :class="`alert-${statusMapping[status]}`"><b>Status:</b> {{ status }}</span>
                </div>
                <div class="data-block mb-4 mt-4">
                    <a :href="link" target="_blank">{{ link }}</a>
                </div>
            </div>
            <div>
                <button class="btn btn-outline-success" @click="sendRequest()" :disabled="disabled_btn">Save</button>
            </div>
        </div>
        <div v-else class="wrapper-content">
            <Loader :active="!is_loaded" />
        </div>
    </div>
</template>

<script>
import CustomValidateInput from "../../components/Inputs/CustomValidateInput/CustomValidateInput";
import bot from "../../requests/bot";
import Loader from "../../components/Loader/Loader";
import { mapActions } from "vuex";

export default {
    name: "MyBotsEdit",
    components: { CustomValidateInput, Loader },
    data() {
        return {
            id: null,
            local_name: 'your_telegram_bot',
            api_key: 'API_KEY',
            disabled_btn: false,
            status: null,
            link: null,
            error_checker: {local_name: false, api_key: false},
            is_loaded: false,
            statusMapping: {
                PENDING: 'warning',
                ACTIVE: 'success',
                ERROR: 'danger',
            },
        }
    },
    methods: {
        ...mapActions(['updateBot']),

        setData(payload) {
            if (payload.field === 'local_name') {
                this.error_checker.local_name = payload.validate.is_error;
                if (!payload.validate.is_error) {
                    this.local_name = payload.data;
                }
            }

            if (payload.field === 'api_key') {
                this.error_checker.api_key = payload.validate.is_error;
                if (!payload.validate.is_error) {
                    this.api_key = payload.data;
                }
            }

            this.disabled_btn = !this.errorChecker();
        },
        errorChecker() {
            for (let field_name in this.error_checker) {
                if (this.error_checker[field_name]) {
                    return false;
                }
            }

            return true;
        },
        sendRequest() {
            let data = this.serializeData();
            this.disabled_btn = true;
            this.is_loaded = false;

            this.updateBot({id: this.id, payload: data})
                .then(response => {
                    this.disabled_btn = false;
                    this.$router.push({ name: 'my-bots' });
                })
                .catch(e => {
                    console.log(e);
                });
        },
        serializeData() {
            return {
                local_name: this.local_name,
                api_key: this.api_key
            }
        },
    },
    created() {
        this.id = this.$route.params.id;

        bot.get(this.id).then(({data: response}) => {
            let bot = response.data;

            this.local_name = bot.local_name;
            this.api_key = bot.api_key;
            this.status = bot.status;
            this.link = bot.link;
            // this.config = bot.config;

            this.is_loaded = true;
        }).catch(e => {
            console.log(e);
        })
    },
}
</script>

<style scoped lang="sass">
@import 'resources/js/layouts/Home/PageStyles'

</style>
