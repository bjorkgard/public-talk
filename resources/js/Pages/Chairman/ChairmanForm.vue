<template>
    <JetDialogModal :show="show" @close="closeModal">
        <template #title> Ordförande </template>

        <template #content>
            <div class="grid grid-cols-6 gap-6">
                <!-- Name -->
                <div class="col-span-6 sm:col-span-6">
                    <JetLabel for="name" value="Namn" />
                    <JetInput
                        id="name"
                        v-model="form.name"
                        :error="form.errors.name"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.name" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="email" value="E-postadress" />
                    <JetInput
                        id="email"
                        v-model="form.email"
                        :error="form.errors.email"
                        type="email"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.email" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="phone" value="Telefon" />
                    <JetInput
                        id="phone"
                        v-model="form.phone"
                        :error="form.errors.phone"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.phone" class="mt-2" />
                </div>
            </div>
        </template>

        <template #footer>
            <JetSecondaryButton @click.native="closeModal"> Avbryt </JetSecondaryButton>

            <JetButton
                class="ml-2"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click.native="saveChairman"
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
        chairman: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            form: this.$inertia.form(
                {
                    id: '',
                    settings_id: this.$page.props.user.settings.id,
                    name: '',
                    email: '',
                    phone: ''
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    watch: {
        chairman: {
            immediate: true,
            handler(val) {
                if (val) {
                    this.form.id = val.id
                    this.form.name = val.name
                    this.form.email = val.email
                    this.form.phone = val.phone
                } else {
                    this.form.id = ''
                    this.form.name = ''
                    this.form.email = ''
                    this.form.phone = ''
                }
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('close')
        },
        saveChairman() {
            let self = this
            if (this.form.id) {
                this.form.put(`/chairmen/${this.form.id}`, {
                    onSuccess() {
                        self.closeModal()
                    }
                })
            } else {
                this.form.post(`/chairmen`, {
                    onSuccess() {
                        self.closeModal()
                        self.form.reset()
                    }
                })
            }
        }
    }
}
</script>
