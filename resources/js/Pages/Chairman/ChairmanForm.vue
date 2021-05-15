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
                        class="block w-full mt-1"
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
                        class="block w-full mt-1"
                    />
                    <JetInputError :message="form.errors.email" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="phone" value="Telefon" />
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center">
                            <label for="country" class="sr-only">Land</label>
                            <select
                                id="country"
                                v-model="form.phone_country"
                                name="country"
                                class="h-full py-0 pl-4 pr-8 text-gray-500 bg-transparent border-transparent rounded-md focus:ring-teal-500 focus:border-teal-500"
                            >
                                <option
                                    v-for="(value, index) in $page.props.countries"
                                    :key="index"
                                >
                                    {{ value }}
                                </option>
                            </select>
                        </div>
                        <JetInput
                            id="phone"
                            v-model="form.phone"
                            :error="form.errors.phone"
                            type="text"
                            class="block w-full pl-20 mt-1"
                        />
                    </div>
                    <JetInputError :message="form.errors.phone" class="mt-2" />
                </div>
            </div>
        </template>

        <template #footer>
            <JetSecondaryButton @click.native="closeModal"> Avbryt </JetSecondaryButton>

            <JetButton
                class="ml-2umami--click--store-chairman"
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
                    phone: '',
                    phone_country: 'SE'
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
                    this.form.phone = val.formated_phone
                    this.form.phone_country = val.phone_country
                } else {
                    this.form.id = ''
                    this.form.name = ''
                    this.form.email = ''
                    this.form.phone = ''
                    this.form.phone_country = 'SE'
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
