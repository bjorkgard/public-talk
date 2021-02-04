<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bokningar: Tacka
            </h2>
        </template>
        <div class="py-12 pb-24">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <thanks-form :booking="booking" :user="user" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ThanksForm from './ThanksForm'

export default {
  components: {
    AppLayout,
    ThanksForm
  },
  props: ['booking', 'user']
}
</script>