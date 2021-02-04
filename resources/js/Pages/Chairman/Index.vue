<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ordförande</h2>
        </template>
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ChairmenTable :chairmen="chairmen" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ChairmenTable from './Table'

export default {
    components: {
        AppLayout,
        ChairmenTable
    },
    props: {
        chairmen: {
            type: Object,
            default: null
        }
    }
}
</script>
