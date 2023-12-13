<template>
    <div class="root" id="bot-new">
        <h2>New Bot</h2>
        <div class="wrapper-content">
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
            </div>
            <div>
                <button class="btn btn-outline-success" @click="sendRequest()" :disabled="disabled_btn">Create</button>
            </div>
        </div>
    </div>
</template>

<script>
import CustomValidateInput from "../../components/Inputs/CustomValidateInput/CustomValidateInput";
import {mapActions} from "vuex";

export default {
    name: "MyBotsNew",
    components: { CustomValidateInput },
    data() {
        return {
            local_name: '@your_telegram_bot',
            api_key: 'API_KEY',
            disabled_btn: false,
            error_checker: {local_name: false, api_key: false}
        }
    },
    methods: {
        ...mapActions(['createBot']),

        setData(payload) {
            if (payload.field === 'local_name') {
                this.error_checker.local_name = payload.validate.is_error;
                if (!payload.validate.is_error) {
                    this.local_name = payload.data;
                }
            }

            if (payload.field === 'api_key') {
                this.error_checker.api_key = payload.validate.is_error;
                if (payload.validate.is_error) {
                    this.api_key = payload.data;
                }
            }

            this.disabled_btn = !this.errorChecker();
        },
        errorChecker() {
            console.log(this.error_checker);
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
            this.createBot(data).then(response => {
                this.disabled_btn = false;
                this.$router.push('/');
            });
        },
        serializeData() {
            return {
                local_name: this.local_name,
                api_key: this.api_key
            }
        },
    }
}
</script>

<style scoped lang="sass">
@import 'resources/js/layouts/Home/PageStyles'

.data-form
    margin: 20px 0
    .data-block
        margin-bottom: 20px
</style>
