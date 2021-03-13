<template>
    <JetFormSection>
        <template #title> Prenumeration </template>

        <template #description> Starta, ändra eller avbryt din prenumeration. </template>

        <template #form>
            <fieldset class="col-span-6">
                <div>
                    <div class="flex items-start">
                        <div class="ml-3 text-sm leading-5">
                            <div class="font-medium text-gray-700">
                                Några tilläggsfunktioner (t.ex. skicka SMS) kräver en
                                prenumeration till självkostnadspris.<br />
                                Vi använder Stripe som betalplattform och du kommer att
                                skickas till Stripes webbsida för att hantera din
                                prenumeration.
                            </div>
                            <div v-if="$page.props.auth.user.subscribed" class="mt-6">
                                <a
                                    class="px-6 py-3 text-white bg-teal-500 rounded"
                                    :href="route('stripe.portal')"
                                >
                                    Hantera din prenumeration
                                </a>
                            </div>
                            <div v-else class="mt-6">
                                <div class="mt-4">
                                    <JetButton @click.native="checkout">
                                        Starta prenumeration
                                    </JetButton>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </template>
    </JetFormSection>
</template>

<script>
import JetFormSection from '@/Jetstream/FormSection'
import JetButton from '@/Jetstream/Button'

export default {
    components: {
        JetFormSection,
        JetButton
    },
    props: {
        stripeKey: {
            type: String,
            required: true
        },
        sessionId: {
            type: String,
            required: true
        }
    },
    methods: {
        checkout() {
            window
                .Stripe(this.stripeKey)
                .redirectToCheckout({
                    sessionId: this.sessionId
                })
                .then(function (result) {
                    console.error('result', result)
                })
        }
    }
}
</script>
