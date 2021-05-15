<template>
    <JetActionSection>
        <template #title> Webbläsarsessioner </template>

        <template #description>
            Hantera och logga ut dina aktiva sessioner i andra webbläsare och enheter.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Om det behövs kan du logga ut från alla andra webbläsarsessioner på alla
                dina enheter. Några av dina senaste sessioner listas nedan; dock kan denna
                lista inte vara uttömmande. Om du tycker att ditt konto har äventyrats bör
                du också uppdatera ditt lösenord.
            </div>

            <!-- Other Browser Sessions -->
            <div v-if="sessions.length > 0" class="mt-5 space-y-6">
                <div v-for="(session, i) in sessions" :key="i" class="flex items-center">
                    <div>
                        <svg
                            v-if="session.agent.is_desktop"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            class="w-8 h-8 text-gray-500"
                        >
                            <path
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            ></path>
                        </svg>

                        <svg
                            v-else
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="w-8 h-8 text-gray-500"
                        >
                            <path d="M0 0h24v24H0z" stroke="none"></path>
                            <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                            <path d="M11 5h2M12 17v.01"></path>
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600">
                            {{ session.agent.platform }} - {{ session.agent.browser }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ session.ip_address }},

                                <span
                                    v-if="session.is_current_device"
                                    class="font-semibold text-green-500"
                                    >Denna enhet</span
                                >
                                <span v-else>Senast aktiv {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <JetButton
                    class="umami--click--logout-sessions"
                    @click.native="confirmLogout"
                >
                    Logga ut andra webbläsarsessioner
                </JetButton>

                <JetActionMessage :on="form.recentlySuccessful" class="ml-3">
                    Klar
                </JetActionMessage>
            </div>

            <!-- Logout Other Devices Confirmation Modal -->
            <JetDialogModal :show="confirmingLogout" @close="closeModal">
                <template #title> Logga ut andra webbläsarsessioner </template>

                <template #content>
                    Ange ditt lösenord för att bekräfta att du vill logga ut från andra
                    webbläsarsessioner på alla dina enheter.

                    <div class="mt-4">
                        <JetInput
                            ref="password"
                            v-model="form.password"
                            type="password"
                            class="block w-3/4 mt-1"
                            placeholder="Password"
                            @keyup.enter.native="logoutOtherBrowserSessions"
                        />

                        <JetInputError :message="form.errors.password" class="mt-2" />
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
                        @click.native="logoutOtherBrowserSessions"
                    >
                        Logga ut andra webbläsarsessioner
                    </JetButton>
                </template>
            </JetDialogModal>
        </template>
    </JetActionSection>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetActionSection from '@/Jetstream/ActionSection'
import JetButton from '@/Jetstream/Button'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    components: {
        JetActionMessage,
        JetActionSection,
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton
    },
    props: ['sessions'],

    data() {
        return {
            confirmingLogout: false,

            form: this.$inertia.form({
                password: ''
            })
        }
    },

    methods: {
        confirmLogout() {
            this.confirmingLogout = true

            setTimeout(() => this.$refs.password.focus(), 250)
        },

        logoutOtherBrowserSessions() {
            this.form.delete(route('other-browser-sessions.destroy'), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.$refs.password.focus(),
                onFinish: () => this.form.reset()
            })
        },

        closeModal() {
            this.confirmingLogout = false

            this.form.reset()
        }
    }
}
</script>
