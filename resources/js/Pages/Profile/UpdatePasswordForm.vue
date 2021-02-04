<template>
    <JetFormSection @submitted="updatePassword">
        <template #title> Uppdatera lösenord </template>

        <template #description>
            Se till att ditt konto använder ett långt, slumpmässigt lösenord för att vara
            säker.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="current_password" value="Nuvarande lösenord" />
                <JetInput
                    id="current_password"
                    ref="current_password"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="current-password"
                />
                <JetInputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="password" value="Nytt lösenord" />
                <JetInput
                    id="password"
                    ref="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />
                <JetInputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="password_confirmation" value="Bekräfta lösenord" />
                <JetInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />
                <JetInputError
                    :message="form.errors.password_confirmation"
                    class="mt-2"
                />
            </div>
        </template>

        <template #actions>
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Sparat.
            </JetActionMessage>

            <JetButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Spara
            </JetButton>
        </template>
    </JetFormSection>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel
    },

    data() {
        return {
            form: this.$inertia.form({
                current_password: '',
                password: '',
                password_confirmation: ''
            })
        }
    },

    methods: {
        updatePassword() {
            this.form.put(route('user-password.update'), {
                errorBag: 'updatePassword',
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.password) {
                        this.form.reset('password', 'password_confirmation')
                        this.$refs.password.focus()
                    }

                    if (this.form.errors.current_password) {
                        this.form.reset('current_password')
                        this.$refs.current_password.focus()
                    }
                }
            })
        }
    }
}
</script>
