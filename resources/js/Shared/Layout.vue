<template>
    <div class="min-h-screen bg-white flex flex-col dark:bg-gray-900">
        <!-- HEADER -->
        <NavHeader />

        <!-- BODY -->
        <div class="flex-grow flex">
            <div class="px-6 py-6 bg-gray-100 flex-grow">
                <main>
                    <slot />
                </main>
            </div>
        </div>

        <!-- FOOTER -->
        <NavFooter />

        <FlashMessage />

        <!-- Modal Portal -->
        <portal-target name="modal" multiple> </portal-target>
    </div>
</template>

<script>
import NavHeader from './Header'
import NavFooter from './Footer'
import FlashMessage from './FlashMessage'

export default {
    name: 'Layout',
    components: {
        NavHeader,
        NavFooter,
        FlashMessage
    }
}
</script>
