<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bokningar: Ge en kommentar
            </h2>
        </template>
        <div class="py-12 pb-24">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <jet-form-section @submitted="saveComments">
                    <template #title> Ge en kommentar till föreläsningen </template>

                    <template #description>
                        Allt du fyller i här är enbart interna kommentarer som inte kommer
                        att delas med någon annan.
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
                            <jet-label for="grade" value="Betyg" />
                            <v-select
                                id="grade"
                                :options="options"
                                :reduce="(option) => option.grade"
                                label="label"
                                v-model="form.grade"
                                :searchable="false"
                                placeholder="Sätt ett betyg på föreläsningen"
                            >
                                <template v-slot:option="option">
                                    <div class="flex justify-start">
                                        <grade :grade="option.grade"></grade>
                                        <span class="ml-4">{{ option.label }}</span>
                                    </div>
                                </template>
                            </v-select>
                            <jet-input-error
                                :message="form.error('grade')"
                                class="mt-2"
                            />
                        </div>
                        <div class="col-span-6">
                            <jet-label for="comments" value="Kommentar" />
                            <jet-textarea
                                id="comments"
                                :error="form.error('comments')"
                                rows="5"
                                class="mt-1 block w-full"
                                v-model="form.comments"
                            />
                            <jet-input-error
                                :message="form.error('comments')"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <div class="flex justify-between w-full">
                            <jet-secondary-button @click.native="goBack()" class="mr-4">
                                Tillbaka
                            </jet-secondary-button>

                            <div>
                                <jet-action-message
                                    :on="form.recentlySuccessful"
                                    class="mr-3"
                                >
                                    Sparat
                                </jet-action-message>

                                <jet-button
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Spara
                                </jet-button>
                            </div>
                        </div>
                    </template>
                </jet-form-section>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetFormSection from '@/Jetstream/FormSection'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetLabel from '@/Jetstream/Label'
import JetInput from '@/Jetstream/Input'
import JetTextarea from '@/Jetstream/Textarea'
import JetInputError from '@/Jetstream/InputError'
import Grade from '@/Shared/Grade'

export default {
  components: {
    AppLayout,
    JetFormSection,
    JetActionMessage,
    JetButton, 
    JetLabel, 
    JetInput, 
    JetInputError,
    JetTextarea,
    JetSecondaryButton,
    Grade
  },
  props: ['booking', 'user'],
  data() {
    return {
      options: [
          {grade: 5, label: 'Utmärkt'},
          {grade: 4, label: 'Mycket bra'},
          {grade: 3, label: 'Bra'},
          {grade: 2, label: 'Mindre bra'},
          {grade: 1, label: 'Sådär'},
      ],
      form: this.$inertia.form({
          id: this.booking.id,
          date: this.booking.date,
          speaker: this.booking.speaker.full_name,
          theme: this.booking.talk.theme,
          grade: this.booking.grade,
          comments: this.booking.comments
      }, {
          bag: 'bookingErrorBag',
          resetOnSuccess: true
      })
    }
  },
  methods: {
    saveComments() {
      this.form.post(`/bookings/comments/${this.form.id}`, this.form)
    },
    goBack() {
        this.$inertia.visit('/bookings')
    }
  }
}
</script>