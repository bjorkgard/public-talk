<template>
    <AppLayoutExternal>
        <div class="py-12 pb-24">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ThanksForm :booking="booking" />
            </div>
        </div>
    </AppLayoutExternal>
</template>

<script>
import AppLayoutExternal from '@/Layouts/AppLayoutExternal'
import ThanksForm from './ThanksForm'

export default {
    components: {
        AppLayoutExternal,
        ThanksForm
    },
    props: ['booking']
}
</script>
