<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bokningar: Ge en kommentar
            </h2>
        </template>
        <div class="py-12 pb-24">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <JetFormSection @submitted="saveComments">
                    <template #title> Ge en kommentar till föreläsningen </template>

                    <template #description>
                        Allt du fyller i här är enbart interna kommentarer som inte kommer
                        att delas med någon annan.
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
                            <JetLabel for="grade" value="Betyg" />
                            <v-select
                                id="grade"
                                v-model="form.grade"
                                :options="options"
                                :reduce="(option) => option.grade"
                                label="label"
                                :searchable="false"
                                placeholder="Sätt ett betyg på föreläsningen"
                            >
                                <template #option="option">
                                    <div class="flex justify-start">
                                        <Grade :grade="option.grade"></Grade>
                                        <span class="ml-4">{{ option.label }}</span>
                                    </div>
                                </template>
                            </v-select>
                            <JetInputError :message="form.errors.grade" class="mt-2" />
                        </div>
                        <div class="col-span-6">
                            <JetLabel for="comments" value="Kommentar" />
                            <JetTextarea
                                id="comments"
                                v-model="form.comments"
                                :error="form.errors.comments"
                                rows="5"
                                class="mt-1 block w-full"
                            />
                            <JetInputError :message="form.errors.comments" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <div class="flex justify-between w-full">
                            <JetSecondaryButton class="mr-4" @click.native="goBack()">
                                Tillbaka
                            </JetSecondaryButton>

                            <div>
                                <JetActionMessage
                                    :on="form.recentlySuccessful"
                                    class="mr-3"
                                >
                                    Sparat
                                </JetActionMessage>

                                <JetButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Spara
                                </JetButton>
                            </div>
                        </div>
                    </template>
                </JetFormSection>
            </div>
        </div>
    </AppLayout>
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
                { grade: 5, label: 'Utmärkt' },
                { grade: 4, label: 'Mycket bra' },
                { grade: 3, label: 'Bra' },
                { grade: 2, label: 'Mindre bra' },
                { grade: 1, label: 'Sådär' }
            ],
            form: this.$inertia.form(
                {
                    id: this.booking.id,
                    date: this.booking.date,
                    speaker: this.booking.speaker.full_name,
                    theme: this.booking.talk.theme,
                    grade: this.booking.grade,
                    comments: this.booking.comments
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    methods: {
        saveComments() {
            this.form.post(`/bookings/comments/${this.form.id}`)
        },
        goBack() {
            this.$inertia.visit('/bookings')
        }
    }
}
</script>
