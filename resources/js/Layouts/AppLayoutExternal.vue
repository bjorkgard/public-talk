<template>
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <nav class="bg-white border-b border-gray-100">
            <!-- teal Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/">
                                <JetApplicationMark class="block h-11 w-auto" />
                            </a>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <a href="/login"> Logga in </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            <slot></slot>
        </main>

        <!-- Page footer -->
        <PageFooter />

        <Notification />

        <!-- Modal Portal -->
        <portal-target name="modal" multiple> </portal-target>
    </div>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import Notification from '@Shared/Notification'
import PageFooter from '@Shared/Footer'

export default {
    components: {
        JetApplicationMark,
        Notification,
        PageFooter
    },

    data() {
        return {
            showingNavigationDropdown: false
        }
    },

    computed: {
        path() {
            return window.location.pathname
        }
    },

    methods: {
        logout() {
            axios.post('/logout').then(() => {
                window.location = '/'
            })
        }
    }
}
</script>
