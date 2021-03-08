<template>
    <JetFormSection>
        <template #title> Prenumeration </template>

        <template #description> Starta, ändra eller avbryt din prenumeration </template>

        <template #form>
            <fieldset class="col-span-6">
                <div>
                    <div class="flex items-start">
                        <div class="ml-3 text-sm leading-5">
                            <div class="font-medium text-gray-700">
                                Public Talk använder sig av Stripe som betalplattform.<br />Du
                                kommer att skickas till Stripes webbsida för att hantera
                                din prenumeration.
                            </div>
                            <div v-if="$page.props.user.subscribed" class="mt-6">
                                <a
                                    class="px-6 py-3 text-white bg-teal-500 rounded"
                                    :href="route('stripe.portal')"
                                >
                                    Hantera din prenumeration
                                </a>
                            </div>
                            <div v-else class="mt-6">
                                <div
                                    id="error-message"
                                    class="hidden p-2 mt-4 bg-pink-100"
                                />

                                <div class="mt-4">
                                    <div
                                        v-for="(plan, index) in subscriptions"
                                        :key="index"
                                    >
                                        plan
                                        {{ plan }}
                                    </div>
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

export default {
    components: {
        JetFormSection
    },
    props: {
        subscriptions: {
            type: Array,
            default: () => []
        }
    },
    methods: {}
}
</script>
