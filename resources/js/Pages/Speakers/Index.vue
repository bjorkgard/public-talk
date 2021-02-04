<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Talare</h2>
        </template>
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SpeakerTable :speakers="speakers" :links="links" :search="search" />
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import SpeakerTable from './Table'

export default {
    components: {
        AppLayout,
        SpeakerTable
    },
    props: ['speakers', 'links', 'search']
}
</script>
