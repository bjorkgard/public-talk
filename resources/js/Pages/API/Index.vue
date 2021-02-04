<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">API-Token</h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <ApiTokenManager
                    :tokens="tokens"
                    :available-permissions="availablePermissions"
                    :default-permissions="defaultPermissions"
                />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import ApiTokenManager from './ApiTokenManager'
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        ApiTokenManager,
        AppLayout
    },
    props: ['tokens', 'availablePermissions', 'defaultPermissions']
}
</script>
