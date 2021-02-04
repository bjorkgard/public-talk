<template>
    <JetDialogModal :show="show" @close="closeModal">
        <template #title> Föreläsning </template>

        <template #content>
            <div class="grid grid-cols-6 gap-6">
                <!-- Number -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="number" value="Nummer" />
                    <JetInput
                        id="number"
                        v-model="form.number"
                        :error="form.errors.number"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.number" class="mt-2" />
                </div>

                <!-- Theme -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="theme" value="Tema" />
                    <JetInput
                        id="theme"
                        v-model="form.theme"
                        :error="form.errors.theme"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.theme" class="mt-2" />
                </div>

                <!-- Subject -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="subject" value="Ämne" />
                    <JetInput
                        id="subject"
                        v-model="form.subject"
                        :error="form.errors.subject"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.subject" class="mt-2" />
                </div>
            </div>
        </template>

        <template #footer>
            <JetSecondaryButton @click.native="closeModal"> Avbryt </JetSecondaryButton>

            <JetButton
                class="ml-2"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click.native="saveTalk"
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
    props: ['show'],
    data() {
        return {
            form: this.$inertia.form(
                {
                    number: '',
                    theme: '',
                    subject: ''
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    methods: {
        closeModal() {
            this.$emit('close')
        },
        saveTalk() {
            let self = this
            this.form.post('/talks', {
                onSuccess() {
                    self.closeModal()
                    self.form.reset()
                }
            })
        }
    }
}
</script>
