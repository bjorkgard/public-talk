<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bokningar: {{ form.id ? 'Uppdatera' : 'Skapa' }}
            </h2>
        </template>
        <div class="py-12 pb-24">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <JetFormSection @submitted="saveBooking">
                    <template #title> Standard bokning </template>

                    <template #description> Fyll i uppgifterna om bokningen</template>

                    <template #form>
                        <!-- Date -->
                        <div class="col-span-2">
                            <JetLabel for="date" value="Datum" />
                            <VueTailwindPicker
                                :init="false"
                                :start-from-monday="true"
                                :theme="pickerTheme"
                                @change="(v) => (form.date = v)"
                            >
                                <JetInput
                                    id="date"
                                    v-model="form.date"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                            </VueTailwindPicker>
                            <JetInputError :message="form.errors.date" class="mt-2" />
                        </div>
                        <!-- Time -->
                        <div class="col-span-2">
                            <JetLabel for="time" value="Tid" />
                            <JetInput
                                id="time"
                                v-model="form.time"
                                :error="form.errors.time"
                                type="time"
                                class="mt-1 block w-full"
                            />
                            <JetInputError :message="form.errors.time" class="mt-2" />
                        </div>
                        <!-- Song -->
                        <div class="col-span-2">
                            <JetLabel for="song" value="Sång" />
                            <JetInput
                                id="song"
                                v-model="form.song"
                                :error="form.errors.song"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <JetInputError :message="form.errors.song" class="mt-2" />
                        </div>
                        <!-- Talks -->
                        <div v-if="!form.exception" class="col-span-6">
                            <JetLabel for="talk" value="Föreläsning" />
                            <v-select
                                id="talk"
                                v-model="form.talk_id"
                                label="full_theme"
                                :options="availableTalks"
                                :reduce="(talk) => talk.id"
                                class="style-chooser form-input rounded-md shadow-sm"
                            />
                            <JetInputError :message="form.errors.talk_id" class="mt-2" />
                        </div>
                        <!-- Speakers -->
                        <div v-if="!form.exception" class="col-span-6">
                            <JetLabel for="speaker" value="Talare" />
                            <v-select
                                id="speaker"
                                v-model="form.speaker_id"
                                label="full_name"
                                :options="availableSpeakers"
                                :reduce="(speaker) => speaker.id"
                                class="style-chooser form-input rounded-md shadow-sm"
                            />
                            <JetInputError
                                :message="form.errors.speaker_id"
                                class="mt-2"
                            />
                        </div>

                        <div class="col-span-6 flex items-start">
                            <div class="flex items-center h-5">
                                <input
                                    id="exception"
                                    v-model="form.exception"
                                    type="checkbox"
                                    class="form-checkbox h-4 w-4 text-teal-600 transition duration-150 ease-in-out"
                                />
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <label for="exception" class="font-medium text-gray-700">
                                    Undantagsbokning
                                </label>
                                <p class="text-gray-500">
                                    Klicka i den här rutan om du vill fylla i ett
                                    speciellt namn på föreläsningen eller talaren, tex vid
                                    ett kretsbesök.
                                </p>
                            </div>
                        </div>

                        <!-- Exception talk -->
                        <div v-if="form.exception" class="col-span-6">
                            <JetLabel for="customTalk" value="Föreläsning" />
                            <JetInput
                                id="customTalk"
                                v-model="form.custom_talk"
                                :error="form.errors.custom_talk"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <JetInputError
                                :message="form.errors.custom_talk"
                                class="mt-2"
                            />
                        </div>
                        <!-- Exception speaker -->
                        <div v-if="form.exception" class="col-span-6">
                            <JetLabel for="customSpeaker" value="Talare" />
                            <JetInput
                                id="customSpeaker"
                                v-model="form.custom_speaker"
                                :error="form.errors.custom_speaker"
                                type="text"
                                class="mt-1 block w-full"
                            />
                            <JetInputError
                                :message="form.errors.custom_speaker"
                                class="mt-2"
                            />
                        </div>

                        <!-- Chairmen -->
                        <div class="col-span-6">
                            <JetLabel for="chairman" value="Ordförande" />
                            <v-select
                                id="chairman"
                                v-model="form.chairman_id"
                                label="name"
                                :options="chairmen"
                                :reduce="(chairman) => chairman.id"
                                class="style-chooser form-input rounded-md shadow-sm"
                            />
                            <JetInputError
                                :message="form.errors.chairman_id"
                                class="mt-2"
                            />
                        </div>
                    </template>

                    <template #actions>
                        <div class="flex justify-between w-full">
                            <JetSecondaryButton class="mr-4" @click.native="goBack()">
                                Tillbaka
                            </JetSecondaryButton>

                            <JetButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Spara
                            </JetButton>
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
import JetLabel from '@/Jetstream/Label'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import VueTailwindPicker from 'vue-tailwind-picker'
export default {
    components: {
        AppLayout,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        VueTailwindPicker,
        JetSecondaryButton
    },
    props: ['chairmen', 'speakers', 'talks', 'booking'],
    data() {
        return {
            pickerTheme: {
                background: '#FFFFFF',
                text: 'text-gray-700',
                border: 'border-gray-200',
                currentColor: 'text-gray-200',
                navigation: {
                    background: 'bg-gray-100',
                    hover: 'hover:bg-gray-200',
                    focus: 'bg-gray-200'
                },
                picker: {
                    rounded: 'rounded-md',
                    selected: {
                        background: 'bg-teal-500',
                        border: 'border-teal-500',
                        hover: 'hover:border-teal-500'
                    },
                    holiday: 'text-red-400',
                    weekend: 'text-gray-700',
                    event: 'bg-teal-500'
                },
                event: {
                    border: 'border-gray-200'
                }
            },
            form: this.$inertia.form(
                {
                    id: this.booking.id,
                    user_id: this.$page.props.user.id,
                    settings_id: this.$page.props.user.settings.id,
                    date: this.booking.date,
                    time: this.booking.time,
                    song: this.booking.song,
                    talk_id: this.booking.talk_id,
                    speaker_id: this.booking.speaker_id,
                    chairman_id: this.booking.chairman_id,
                    exception: this.booking.exception,
                    custom_talk: this.booking.custom_talk,
                    custom_speaker: this.booking.custom_speaker
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    computed: {
        availableTalks() {
            if (this.form.speaker_id) {
                return this.speakers.find((s) => s.id === this.form.speaker_id).talks
            }

            return this.talks
        },
        availableSpeakers() {
            if (this.form.talk_id) {
                return this.talks.find((t) => t.id === this.form.talk_id).speakers
            }

            return this.speakers
        }
    },
    methods: {
        goBack() {
            this.$inertia.visit('/bookings')
        },
        saveBooking() {
            if (this.form.id) {
                this.form.put(`/bookings/${this.form.id}`)
            } else {
                this.form.post('/bookings')
            }
        }
    }
}
</script>
