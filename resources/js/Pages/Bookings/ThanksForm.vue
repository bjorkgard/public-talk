<template>
    <JetFormSection @submitted="sendGreeting">
        <template #title> Skicka en hälsning </template>

        <template #description>
            Fyll i ett personligt meddelande och klicka på skicka
        </template>

        <template #form>
            <div class="col-span-3">
                <JetLabel for="date" value="Datum" />
                <JetInput
                    id="date"
                    v-model="form.date"
                    type="text"
                    class="mt-1 block w-full"
                    readonly
                />
            </div>
            <div class="col-span-3" />
            <div class="col-span-3">
                <JetLabel for="speaker" value="Talare" />
                <JetInput
                    id="speaker"
                    v-model="form.speaker"
                    type="text"
                    class="mt-1 block w-full"
                    readonly
                />
            </div>
            <div class="col-span-3">
                <JetLabel for="theme" value="Föreläsning" />
                <JetInput
                    id="theme"
                    v-model="form.theme"
                    type="text"
                    class="mt-1 block w-full"
                    readonly
                />
            </div>
            <div class="col-span-6">
                <JetLabel for="greeting" value="Hälsning" />
                <JetTextarea
                    id="greeting"
                    v-model="form.greeting"
                    :error="form.errors.greeting"
                    rows="5"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.greeting" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <div class="flex justify-between w-full">
                <JetSecondaryButton v-if="user" class="mr-4" @click.native="goBack()">
                    Tillbaka
                </JetSecondaryButton>

                <div v-else>&nbsp;</div>

                <div>
                    <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                        Skickat
                    </JetActionMessage>

                    <JetButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing || booking.thanked"
                    >
                        Skicka
                    </JetButton>
                </div>
            </div>
        </template>
    </JetFormSection>
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
            form: this.$inertia.form(
                {
                    id: this.booking.id,
                    date: this.booking.date,
                    speaker: this.booking.speaker.full_name,
                    theme: this.booking.talk.theme,
                    greeting: ''
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    methods: {
        sendGreeting() {
            this.form.post(`/bookings/greeting/${this.form.id}`)
        },
        goBack() {
            this.$inertia.visit('/bookings')
        }
    }
}
</script>
