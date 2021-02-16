<template>
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Ordförande</h2>
            <HelpButton category="chairman" />
        </template>
        <div class="py-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <ChairmenTable :chairmen="chairmen" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ChairmenTable from './Table'
import HelpButton from '@Shared/HelpButton'

export default {
    components: {
        AppLayout,
        ChairmenTable,
        HelpButton
    },
    props: {
        chairmen: {
            type: Object,
            default: null
        }
    }
}
</script>
