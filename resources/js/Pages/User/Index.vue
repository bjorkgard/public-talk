<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Användare</h2>
        </template>
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <UserTable :users="users" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import UserTable from './Table'

export default {
    components: {
        AppLayout,
        UserTable
    },
    props: {
        users: {
            type: Array,
            required: true
        }
    }
}
</script>
