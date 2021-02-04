<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot />
        </span>

        <JetDialogModal :show="confirmingPassword" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                {{ content }}

                <div class="mt-4">
                    <JetInput
                        ref="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter.native="confirmPassword"
                    />

                    <JetInputError :message="form.error" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <JetSecondaryButton @click.native="closeModal">
                    Avbryt
                </JetSecondaryButton>

                <JetButton
                    class="ml-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click.native="confirmPassword"
                >
                    {{ button }}
                </JetButton>
            </template>
        </JetDialogModal>
    </span>
</template>

<script>
import JetButton from './Button'
import JetDialogModal from './DialogModal'
import JetInput from './Input'
import JetInputError from './InputError'
import JetSecondaryButton from './SecondaryButton'

export default {
    components: {
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton
    },
    props: {
        title: {
            type: String,
            default: 'Bekräfta lösenord'
        },
        content: {
            type: String,
            default: 'För din säkerhet måste du bekräfta ditt lösenord för att fortsätta.'
        },
        button: {
            type: String,
            default: 'Bekräfta'
        }
    },

    data() {
        return {
            confirmingPassword: false,
            form: {
                password: '',
                error: ''
            }
        }
    },

    methods: {
        startConfirmingPassword() {
            axios.get(route('password.confirmation')).then((response) => {
                if (response.data.confirmed) {
                    this.$emit('confirmed')
                } else {
                    this.confirmingPassword = true

                    setTimeout(() => this.$refs.password.focus(), 250)
                }
            })
        },

        confirmPassword() {
            this.form.processing = true

            axios
                .post(route('password.confirm'), {
                    password: this.form.password
                })
                .then(() => {
                    this.form.processing = false
                    this.closeModal()
                    this.$nextTick(() => this.$emit('confirmed'))
                })
                .catch((error) => {
                    this.form.processing = false
                    this.form.error = error.response.data.errors.password[0]
                    this.$refs.password.focus()
                })
        },

        closeModal() {
            this.confirmingPassword = false
            this.form.password = ''
            this.form.error = ''
        }
    }
}
</script>
