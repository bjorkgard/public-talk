<template>
    <JetActionSection>
        <template #title> Tvåfaktorautentisering </template>

        <template #description>
            Lägg till ytterligare säkerhet i ditt konto med tvåfaktorautentisering.
        </template>

        <template #content>
            <h3 v-if="twoFactorEnabled" class="text-lg font-medium text-gray-900">
                Du har aktiverat tvåfaktorautentisering.
            </h3>

            <h3 v-else class="text-lg font-medium text-gray-900">
                Du har inte aktiverat tvåfaktorautentisering.
            </h3>

            <div class="max-w-xl mt-3 text-sm text-gray-600">
                <p>
                    När tvåfaktorautentisering är aktiverad kommer du att uppmanas till en
                    säker, slumpmässig token under autentisering. Du kan hämta den här
                    token från telefonens Google Authenticator-applikation.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="max-w-xl mt-4 text-sm text-gray-600">
                        <p class="font-semibold">
                            Tvåfaktorautentisering är nu aktiverad. Skanna följande QR-kod
                            med din telefons autentiseringsapplikation.
                        </p>
                    </div>

                    <div
                        class="mt-4 dark:p-4 dark:w-56 dark:bg-white"
                        v-html="qrCode"
                    ></div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="max-w-xl mt-4 text-sm text-gray-600">
                        <p class="font-semibold">
                            Lagra dessa återställningskoder i en säker lösenordshanterare.
                            De kan användas för att återställa åtkomst till ditt konto om
                            din tvåfaktorautentiseringsenhet går förlorad.
                        </p>
                    </div>

                    <div
                        class="grid max-w-xl gap-1 px-4 py-4 mt-4 font-mono text-sm bg-gray-100 rounded-lg"
                    >
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="!twoFactorEnabled">
                    <JetConfirmsPassword @confirmed="enableTwoFactorAuthentication">
                        <JetButton
                            type="button"
                            :class="{ 'opacity-25': enabling }"
                            class="umami--click--activate-two-factor"
                            :disabled="enabling"
                        >
                            Aktivera
                        </JetButton>
                    </JetConfirmsPassword>
                </div>

                <div v-else>
                    <JetConfirmsPassword @confirmed="regenerateRecoveryCodes">
                        <JetSecondaryButton v-if="recoveryCodes.length > 0" class="mr-3">
                            Regenerera återställningskoder
                        </JetSecondaryButton>
                    </JetConfirmsPassword>

                    <JetConfirmsPassword @confirmed="showRecoveryCodes">
                        <JetSecondaryButton
                            v-if="recoveryCodes.length === 0"
                            class="mr-3"
                        >
                            Visa återställningskoder
                        </JetSecondaryButton>
                    </JetConfirmsPassword>

                    <JetConfirmsPassword @confirmed="disableTwoFactorAuthentication">
                        <JetDangerButton
                            :class="{ 'opacity-25': disabling }"
                            class="umami--click--disable-two-factor"
                            :disabled="disabling"
                        >
                            Inaktivera
                        </JetDangerButton>
                    </JetConfirmsPassword>
                </div>
            </div>
        </template>
    </JetActionSection>
</template>

<script>
import JetActionSection from '@/Jetstream/ActionSection'
import JetButton from '@/Jetstream/Button'
import JetConfirmsPassword from '@/Jetstream/ConfirmsPassword'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    components: {
        JetActionSection,
        JetButton,
        JetConfirmsPassword,
        JetDangerButton,
        JetSecondaryButton
    },

    data() {
        return {
            enabling: false,
            disabling: false,

            qrCode: null,
            recoveryCodes: []
        }
    },

    computed: {
        twoFactorEnabled() {
            return !this.enabling && this.$page.props.user.two_factor_enabled
        }
    },

    methods: {
        enableTwoFactorAuthentication() {
            this.enabling = true

            this.$inertia.post(
                '/user/two-factor-authentication',
                {},
                {
                    preserveScroll: true,
                    onSuccess: () =>
                        Promise.all([this.showQrCode(), this.showRecoveryCodes()]),
                    onFinish: () => (this.enabling = false)
                }
            )
        },

        showQrCode() {
            return axios.get('/user/two-factor-qr-code').then((response) => {
                this.qrCode = response.data.svg
            })
        },

        showRecoveryCodes() {
            return axios.get('/user/two-factor-recovery-codes').then((response) => {
                this.recoveryCodes = response.data
            })
        },

        regenerateRecoveryCodes() {
            axios.post('/user/two-factor-recovery-codes').then(() => {
                this.showRecoveryCodes()
            })
        },

        disableTwoFactorAuthentication() {
            this.disabling = true

            this.$inertia.delete('/user/two-factor-authentication', {
                preserveScroll: true,
                onSuccess: () => (this.disabling = false)
            })
        }
    }
}
</script>
