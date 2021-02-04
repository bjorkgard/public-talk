<template>
    <JetActionSection>
        <template #title> Radera konto </template>

        <template #description> Ta bort ditt konto permanent. </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                När ditt konto har raderats raderas alla dess resurser och data permanent.
                Innan du raderar ditt konto, ladda ner all data eller information som du
                vill behålla.
            </div>

            <div class="mt-5">
                <JetDangerButton @click.native="confirmUserDeletion">
                    Radera konto
                </JetDangerButton>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <JetDialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title> Radera konto </template>

                <template #content>
                    Är du säker på att du vill ta bort ditt konto?<br />När ditt konto har
                    raderats raderas alla dess resurser och data permanent. Ange ditt
                    lösenord för att bekräfta att du vill radera ditt konto permanent.

                    <div class="mt-4">
                        <JetInput
                            ref="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="Password"
                            @keyup.enter.native="deleteUser"
                        />

                        <JetInputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <JetSecondaryButton @click.native="closeModal">
                        Avbryt
                    </JetSecondaryButton>

                    <JetDangerButton
                        class="ml-2"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click.native="deleteUser"
                    >
                        Radera konto
                    </JetDangerButton>
                </template>
            </JetDialogModal>
        </template>
    </JetActionSection>
</template>

<script>
import JetActionSection from '@/Jetstream/ActionSection'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    components: {
        JetActionSection,
        JetDangerButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton
    },

    data() {
        return {
            confirmingUserDeletion: false,

            form: this.$inertia.form({
                password: ''
            })
        }
    },

    methods: {
        confirmUserDeletion() {
            this.confirmingUserDeletion = true

            setTimeout(() => this.$refs.password.focus(), 250)
        },

        deleteUser() {
            this.form.delete(route('current-user.destroy'), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.$refs.password.focus(),
                onFinish: () => this.form.reset()
            })
        },

        closeModal() {
            this.confirmingUserDeletion = false

            this.form.reset()
        }
    }
}
</script>
