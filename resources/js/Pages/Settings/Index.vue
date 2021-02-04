<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inställningar
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <CongregationForm :settings="user.settings" />

                <JetSectionBorder />
                <MeetingForm :settings="user.settings" />

                <JetSectionBorder />
                <ExtraForm :settings="user.settings" />

                <JetSectionBorder />
                <NotificationsForm :settings="user.settings" />
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

export default {
    components: {
        AppLayout,
        JetSectionBorder,
        CongregationForm,
        MeetingForm,
        NotificationsForm,
        ExtraForm
    },
    props: {
        user: {
            type: Object,
            required: true
        }
    }
}
</script>
