<template>
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Föreläsningar
            </h2>
            <HelpButton category="talk" />
        </template>
        <div class="py-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <TalkTable :talks="talks" :search="search" :owner="user.owner" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import TalkTable from './Table'
import HelpButton from '@Shared/HelpButton'

export default {
    components: {
        AppLayout,
        TalkTable,
        HelpButton
    },
    props: ['talks', 'search', 'user']
}
</script>
