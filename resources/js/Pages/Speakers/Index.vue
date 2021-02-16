<template>
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Talare</h2>
            <HelpButton category="speaker" />
        </template>
        <div class="py-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <SpeakerTable :speakers="speakers" :links="links" :search="search" />
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import HelpButton from '@Shared/HelpButton'
import SpeakerTable from './Table'

export default {
    components: {
        AppLayout,
        SpeakerTable,
        HelpButton
    },
    props: ['speakers', 'links', 'search']
}
</script>
