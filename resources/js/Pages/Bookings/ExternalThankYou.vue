<template>
  <app-layout-external>
    <div class="py-12 pb-24">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <thanks-form :booking="booking" />
      </div>
    </div>
  </app-layout-external>
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