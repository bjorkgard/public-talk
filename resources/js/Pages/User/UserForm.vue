<template>
    <JetDialogModal :show="show" @close="closeModal">
        <template #title> Användare </template>

        <template #content>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="name" value="Namn" />
                    <JetInput
                        id="name"
                        v-model="form.name"
                        :error="form.errors.name"
                        type="text"
                        class="block w-full mt-1"
                    />
                    <JetInputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="email" value="E-postadress" />
                    <JetInput
                        id="email"
                        v-model="form.email"
                        :error="form.errors.email"
                        type="email"
                        class="block w-full mt-1"
                    />
                    <JetInputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="phone" value="Telefon" />
                    <JetInput
                        id="phone"
                        v-model="form.phone"
                        :error="form.errors.phone"
                        type="text"
                        class="block w-full mt-1"
                    />
                    <JetInputError :message="form.errors.phone" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="role" value="Roll" />
                    <v-select
                        id="role"
                        v-model="form.role"
                        :options="options"
                        :reduce="(option) => option.code"
                        label="label"
                        class="rounded-md shadow-sm style-chooser form-input"
                    />
                    <JetInputError :message="form.errors.role" class="mt-2" />
                </div>
            </div>
        </template>

        <template #footer>
            <JetSecondaryButton @click.native="closeModal"> Avbryt </JetSecondaryButton>

            <JetButton
                class="ml-2"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click.native="saveUser"
            >
                Spara
            </JetButton>
        </template>
    </JetDialogModal>
</template>

<script>
import JetButton from '@/Jetstream/Button'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetLabel from '@/Jetstream/Label'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'

export default {
    components: {
        JetButton,
        JetDialogModal,
        JetSecondaryButton,
        JetLabel,
        JetInput,
        JetInputError
    },
    props: {
        show: {
            type: Boolean,
            default: false
        },
        user: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            options: [
                { label: 'Full åtkomst', code: 'owner' },
                { label: 'Administrator', code: 'admin' },
                { label: 'Kan boka', code: 'booker' },
                { label: 'Kan enbart se', code: 'viewer' }
            ],
            form: this.$inertia.form(
                {
                    settings_id: this.$page.props.user.settings.id,
                    name: '',
                    email: '',
                    phone: '',
                    role: ''
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    watch: {
        user: {
            immediate: true,
            handler(val) {
                if (val) {
                    this.form.id = val.id
                    this.form.name = val.name
                    this.form.email = val.email
                    this.form.phone = val.phone
                    this.form.role = val.role
                } else {
                    this.form.id = ''
                    this.form.name = ''
                    this.form.email = ''
                    this.form.phone = ''
                    this.form.role = ''
                }
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('close')
        },
        saveUser() {
            let self = this
            if (this.form.id) {
                this.form.put(`/users/${this.form.id}`, {
                    onSuccess() {
                        self.form.reset()
                        self.closeModal()
                    }
                })
            } else {
                this.form.post('/users', {
                    onSuccess() {
                        self.form.reset()
                        self.closeModal()
                    }
                })
            }
        }
    }
}
</script>