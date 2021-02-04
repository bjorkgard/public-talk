<template>
    <jet-form-section @submitted="sendGreeting">
        <template #title> Skicka en hälsning </template>

        <template #description>
            Fyll i ett personligt meddelande och klicka på skicka
        </template>

        <template #form>
            <div class="col-span-3">
                <jet-label for="date" value="Datum" />
                <jet-input
                    id="date"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.date"
                    readonly
                />
            </div>
            <div class="col-span-3" />
            <div class="col-span-3">
                <jet-label for="speaker" value="Talare" />
                <jet-input
                    id="speaker"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.speaker"
                    readonly
                />
            </div>
            <div class="col-span-3">
                <jet-label for="theme" value="Föreläsning" />
                <jet-input
                    id="theme"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.theme"
                    readonly
                />
            </div>
            <div class="col-span-6">
                <jet-label for="greeting" value="Hälsning" />
                <jet-textarea
                    id="greeting"
                    :error="form.error('greeting')"
                    rows="5"
                    class="mt-1 block w-full"
                    v-model="form.greeting"
                />
                <jet-input-error :message="form.error('greeting')" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <div class="flex justify-between w-full">
                <jet-secondary-button v-if="user" @click.native="goBack()" class="mr-4">
                    Tillbaka
                </jet-secondary-button>

                <div v-else>&nbsp;</div>

                <div>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Skickat
                    </jet-action-message>

                    <jet-button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing || booking.thanked"
                    >
                        Skicka
                    </jet-button>
                </div>
            </div>
        </template>
    </jet-form-section>
</template>

<script>
import JetFormSection from '@/Jetstream/FormSection'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetLabel from '@/Jetstream/Label'
import JetInput from '@/Jetstream/Input'
import JetTextarea from '@/Jetstream/Textarea'
import JetInputError from '@/Jetstream/InputError'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
  components: {
    JetFormSection,
    JetActionMessage,
    JetButton, 
    JetLabel, 
    JetInput, 
    JetInputError,
    JetTextarea,
    JetSecondaryButton
  },
  props: ['booking', 'user'],
  data() {
    return {
      form: this.$inertia.form({
          id: this.booking.id,
          date: this.booking.date,
          speaker: this.booking.speaker.full_name,
          theme: this.booking.talk.theme,
          greeting: ''
      }, {
          bag: 'bookingErrorBag',
          resetOnSuccess: true
      })
    }
  },
  methods: {
    sendGreeting() {
      this.form.post(`/bookings/greeting/${this.form.id}`, this.form)
    },
    goBack() {
      this.$inertia.visit('/bookings')
    }
  }
}
</script>