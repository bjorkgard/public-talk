<template>
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Inställningar
            </h2>
            <HelpButton category="settings" />
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <CongregationForm :settings="user.settings" />

                <JetSectionBorder />
                <MeetingForm :settings="user.settings" />

                <JetSectionBorder />
                <ExtraForm :settings="user.settings" />

                <JetSectionBorder />
                <ExtraChairmanForm :settings="user.settings" />

                <JetSectionBorder />
                <NotificationsForm :settings="user.settings" />

                <JetSectionBorder />
                <Subscriptions :stripe-key="stripeKey" :session-id="sessionId" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetSectionBorder from '@/Jetstream/SectionBorder'
import CongregationForm from './CongregationForm'
import MeetingForm from './MeetingForm'
import NotificationsForm from './NotificationsForm'
import ExtraForm from './ExtraForm'
import ExtraChairmanForm from './ExtraChairmanForm'
import Subscriptions from './Subscriptions'
import HelpButton from '@Shared/HelpButton'

export default {
    components: {
        AppLayout,
        JetSectionBorder,
        CongregationForm,
        MeetingForm,
        NotificationsForm,
        ExtraForm,
        ExtraChairmanForm,
        Subscriptions,
        HelpButton
    },
    props: {
        user: {
            type: Object,
            required: true
        },
        stripeKey: {
            type: String,
            required: true
        },
        sessionId: {
            type: String,
            required: true
        }
    }
}
</script>
