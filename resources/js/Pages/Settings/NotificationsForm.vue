<template>
    <JetFormSection @submitted="updateNotificationsSettings">
        <template #title> Meddelanden </template>

        <template #description>
            Välj om du vill att applikationen skall skicka automatiska mail
        </template>

        <template #form>
            <fieldset class="col-span-6">
                <div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                id="confirmation"
                                v-model="form.confirmation"
                                type="checkbox"
                                class="form-checkbox h-4 w-4 text-teal-600 transition duration-150 ease-in-out"
                            />
                        </div>
                        <div class="ml-3 text-sm leading-5">
                            <label for="confirmation" class="font-medium text-gray-700">
                                Bokningsbekräftelse
                            </label>
                            <p class="text-gray-500">
                                Skicka en bokningsbekräftelse till talaren med datum,
                                tidpunkt, tal m.m.
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input
                                    id="reminder"
                                    v-model="form.reminder"
                                    type="checkbox"
                                    class="form-checkbox h-4 w-4 text-teal-600 transition duration-150 ease-in-out"
                                />
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <label for="reminder" class="font-medium text-gray-700">
                                    Påminnelse
                                </label>
                                <p class="text-gray-500">
                                    Skicka en påminnelse till talaren 7 dagar innan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input
                                    id="thanks"
                                    v-model="form.thanks"
                                    type="checkbox"
                                    class="form-checkbox h-4 w-4 text-teal-600 transition duration-150 ease-in-out"
                                />
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <label for="thanks" class="font-medium text-gray-700">
                                    Tack
                                </label>
                                <p class="text-gray-500">
                                    Skicka ett tack till talaren (du kommer att få ett
                                    meddelande om att skriva en personlig hälsning).
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input
                                    id="chairman"
                                    v-model="form.chairman"
                                    type="checkbox"
                                    class="form-checkbox h-4 w-4 text-teal-600 transition duration-150 ease-in-out"
                                />
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <label for="chairman" class="font-medium text-gray-700">
                                    Ordförande
                                </label>
                                <p class="text-gray-500">
                                    Skicka information till ordförande 7 dagar innan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </template>

        <template #actions>
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Sparad
            </JetActionMessage>

            <JetButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Spara
            </JetButton>
        </template>
    </JetFormSection>
</template>

<script>
import JetFormSection from '@/Jetstream/FormSection'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'

export default {
    components: {
        JetFormSection,
        JetActionMessage,
        JetButton
    },
    props: ['settings'],
    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: 'PUT',
                    confirmation: this.settings.notifications.confirmation,
                    reminder: this.settings.notifications.reminder,
                    thanks: this.settings.notifications.thanks,
                    chairman: this.settings.notifications.chairman
                },
                {
                    bag: 'updateNotificationsSettings',
                    resetOnSuccess: false
                }
            )
        }
    },
    methods: {
        updateNotificationsSettings() {
            this.form.post(`/settings/${this.settings.id}/notifications/true`, {
                preserveScroll: true
            })
        }
    }
}
</script>
