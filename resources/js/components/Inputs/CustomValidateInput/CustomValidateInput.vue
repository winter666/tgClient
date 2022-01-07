<template>
    <div class="custom-input__validate">
        <label :for="id" v-if="field_name">{{ field_name }}</label>
        <input :id="id"
               :name="name"
               v-model="input_data"
               :class="{with_errors: validate_data.is_error}"
               :required="required"
               @input="returnData()"/>
        <span class="text-danger">{{ this.validate_data.error }}</span>
    </div>
</template>

<script>
export default {
    name: "CustomValidateInput",
    props: {
        id: {
            type: String
        },
        name: {
            type: String
        },
        field_name: {
            type: String
        },
        rules: {
            type: Array
        },
        defaultValue: {
            type: String,
            default: ""
        },
        required: {
            type: Boolean,
            default: false
        }

    },
    data() {
        return {
            input_data: 'Input',
            validate_data: {is_error: false, error: ''},
            allow_validation_values: {
                not_empty: 'not_empty',
                bot_username: 'bot_username'
            }
        }
    },
    methods : {
        returnData() {
            this.validate(this.rules, this.field_name);
            this.$emit('onInput', {field: this.name, data: this.input_data, validate: this.validate_data});
        },
        setError(errorText, field_name = "") {
            this.validate_data.is_error = true;
            let errorField = (field_name.trim().length) ? field_name : 'Field'
            this.validate_data.error = errorField + " " + errorText;
        },
        removeError(rulesValidationArray, key) {
            if (rulesValidationArray.length === 1) {
                this.validate_data.is_error = false;
                this.validate_data.error = ``;
            } else {
                rulesValidationArray.forEach((val, r_key) => {
                    if (!val && r_key !== key) {
                        this.validate_data.is_error = false;
                        this.validate_data.error = ``;
                    }
                });
            }
        },
        prepareValidationArray(rules) {
            let ruleArr = [];
            rules.forEach(rule => {
                if (Object.keys(this.allow_validation_values).includes(rule)) {
                    ruleArr.push(rule);
                }
            });

            if (this.required && !ruleArr.includes(this.allow_validation_values.not_empty)) {
                ruleArr.push(this.allow_validation_values.not_empty);
            }

            return ruleArr;
        },
        validate(rules, field_name = "") {
            let rulesValidation = this.prepareValidationArray(rules);
            rules.forEach((item, key) => {
                switch (item) {
                    case this.allow_validation_values.not_empty:
                        if (!this.input_data.trim().length) {
                            rulesValidation[key] = true;
                            this.setError(`must not be empty`, field_name);
                        } else {
                            rulesValidation[key] = false;
                            this.removeError(rulesValidation, key);
                        }
                        break;
                    case this.allow_validation_values.bot_username:
                        if (this.input_data.trim().length) {
                            let pattern = /^@[a-z_]+_bot$/i;
                            if (!pattern.test(this.input_data.trim())) {
                                rulesValidation[key] = true;
                                this.setError(`must start with @ and ended on postfix _bot`, field_name);
                            } else {
                                rulesValidation[key] = false;
                                this.removeError(rulesValidation, key);
                            }
                        }
                        break;
                }
            });
        }
    },
    created() {
        this.input_data = this.defaultValue;
    }
}
</script>

<style scoped lang="sass">
.custom-input__validate
    display: flex
    flex-direction: column
    input:focus
        outline: none
    input
        outline: none
        border: 1px solid #3f3f3f
        width: 400px
        height: 35px
        padding: 0 10px
        &.with_errors
            border-color: red
</style>
