<template>
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Användare</h2>
            <HelpButton category="user" />
        </template>
        <div class="py-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <UserTable :users="users" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import UserTable from './Table'
import HelpButton from '@Shared/HelpButton'

export default {
    components: {
        AppLayout,
        UserTable,
        HelpButton
    },
    props: {
        users: {
            type: Array,
            required: true
        }
    }
}
</script>
