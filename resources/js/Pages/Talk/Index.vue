<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Föreläsningar
            </h2>
        </template>
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <TalkTable :talks="talks" :search="search" :owner="user.owner" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import TalkTable from './Table'

export default {
    components: {
        AppLayout,
        TalkTable
    },
    props: ['talks', 'search', 'user']
}
</script>
