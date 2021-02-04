<template>
    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Tack för att du registrerade dig!<br />Innan du kommer igång behöver du
            verifiera din e-postadress genom att klicka på länken som vi just skickade
            till dig. Om du inte fick e-postmeddelandet skickar vi gärna ett nytt till
            dig.
        </div>

        <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">
            En ny verifieringslänk har skickats till den e-postadress du angav under
            registreringen.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <JetButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Skicka verifieringsemail igen
                </JetButton>

                <inertia-link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    >Logga ut</inertia-link
                >
            </div>
        </form>
    </JetAuthenticationCard>
</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'

export default {
    components: {
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton
    },

    props: {
        status: String
    },

    data() {
        return {
            form: this.$inertia.form()
        }
    },

    computed: {
        verificationLinkSent() {
            return this.status === 'verification-link-sent'
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('verification.send'))
        }
    }
}
</script>
