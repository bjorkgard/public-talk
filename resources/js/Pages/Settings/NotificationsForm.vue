<template>
    <JetFormSection @submitted="updateNotificationsSettings">
        <template #title> Meddelanden </template>

        <template #description>
            Välj om du vill att applikationen skall skicka automatiska mail eller SMS.
        </template>

        <template #form>
            <fieldset class="col-span-6">
                <div>
                    <div class="flex items-start">
                        <div class="flex-1 text-sm leading-5">
                            <div class="font-medium text-gray-700">
                                Bokningsbekräftelse
                            </div>
                            <p class="text-gray-500">
                                Skicka en bokningsbekräftelse till talaren med datum,
                                tidpunkt, tal m.m.
                            </p>
                        </div>
                        <div class="flex justify-end">
                            <div class="flex items-center h-5">
                                <input
                                    id="confirmation_mail"
                                    v-model="form.confirmation_mail"
                                    type="checkbox"
                                    class="w-4 h-4 text-teal-600 transition duration-150 ease-in-out form-checkbox"
                                />
                                <label
                                    for="confirmation_mail"
                                    class="ml-2 font-medium text-gray-700"
                                >
                                    Mail
                                </label>
                            </div>
                            <div class="flex items-center h-5 ml-3">
                                <input
                                    id="confirmation_sms"
                                    v-model="form.confirmation_sms"
                                    type="checkbox"
                                    :class="`${
                                        !activeSubscription
                                            ? 'opacity-50 cursor-not-allowed'
                                            : ''
                                    } w-4 h-4 text-teal-600 transition duration-150 ease-in-out form-checkbox`"
                                />
                                <label
                                    for="confirmation_sms"
                                    :class="`${
                                        !activeSubscription
                                            ? 'opacity-50 cursor-not-allowed'
                                            : ''
                                    } ml-2 font-medium text-gray-700`"
                                >
                                    SMS
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start w-full">
                            <div class="flex-1 text-sm leading-5">
                                <div class="font-medium text-gray-700">Påminnelse</div>
                                <p class="text-gray-500">
                                    Skicka en påminnelse till talaren 7 dagar innan.
                                </p>
                            </div>
                            <div class="flex justify-end">
                                <div class="flex items-center h-5">
                                    <input
                                        id="reminder_mail"
                                        v-model="form.reminder_mail"
                                        type="checkbox"
                                        class="w-4 h-4 text-teal-600 transition duration-150 ease-in-out form-checkbox"
                                    />
                                    <label
                                        for="reminder_mail"
                                        class="ml-2 font-medium text-gray-700"
                                    >
                                        Mail
                                    </label>
                                </div>
                                <div class="flex items-center h-5 ml-3">
                                    <input
                                        id="reminder_sms"
                                        v-model="form.reminder_sms"
                                        type="checkbox"
                                        :class="`${
                                            !activeSubscription
                                                ? 'opacity-50 cursor-not-allowed'
                                                : ''
                                        } w-4 h-4 text-teal-600 transition duration-150 ease-in-out form-checkbox`"
                                    />
                                    <label
                                        for="reminder_sms"
                                        :class="`${
                                            !activeSubscription
                                                ? 'opacity-50 cursor-not-allowed'
                                                : ''
                                        } ml-2 font-medium text-gray-700`"
                                    >
                                        SMS
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="flex-1 text-sm leading-5">
                                <div class="font-medium text-gray-700">Tack</div>
                                <p class="text-gray-500">
                                    Skicka ett tack till talaren (användaren som bokade in
                                    föreläsningen kommer först att få ett meddelande om
                                    att skriva en personlig hälsning).
                                </p>
                            </div>
                            <div class="flex justify-end">
                                <div class="flex items-center h-5">
                                    <input
                                        id="thanks_mail"
                                        v-model="form.thanks_mail"
                                        type="checkbox"
                                        class="w-4 h-4 text-teal-600 transition duration-150 ease-in-out form-checkbox"
                                    />
                                    <label
                                        for="thanks_mail"
                                        class="ml-2 font-medium text-gray-700"
                                    >
                                        Mail
                                    </label>
                                </div>
                                <div class="flex items-center h-5 ml-3">
                                    <input
                                        id="thanks_sms"
                                        v-model="form.thanks_sms"
                                        type="checkbox"
                                        :class="`${
                                            !activeSubscription
                                                ? 'opacity-50 cursor-not-allowed'
                                                : ''
                                        } w-4 h-4 text-teal-600 transition duration-150 ease-in-out form-checkbox`"
                                        :disabled="!activeSubscription"
                                    />
                                    <label
                                        for="thanks_sms"
                                        :class="`${
                                            !activeSubscription
                                                ? 'opacity-50 cursor-not-allowed'
                                                : ''
                                        } ml-2 font-medium text-gray-700`"
                                    >
                                        SMS
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="flex-1 text-sm leading-5">
                                <div class="font-medium text-gray-700">Ordförande</div>
                                <p class="text-gray-500">
                                    Skicka information till ordförande 7 dagar innan.
                                </p>
                            </div>
                            <div class="flex justify-end">
                                <div class="flex items-center h-5">
                                    <input
                                        id="chairman_mail"
                                        v-model="form.chairman_mail"
                                        type="checkbox"
                                        class="w-4 h-4 text-teal-600 transition duration-150 ease-in-out form-checkbox"
                                    />
                                    <label
                                        for="chairman_mail"
                                        class="ml-2 font-medium text-gray-700"
                                    >
                                        Mail
                                    </label>
                                </div>
                                <div class="flex items-center h-5 ml-3">
                                    <input
                                        id="chairman_sms"
                                        v-model="form.chairman_sms"
                                        type="checkbox"
                                        :class="`${
                                            !activeSubscription
                                                ? 'opacity-50 cursor-not-allowed'
                                                : ''
                                        } w-4 h-4 text-teal-600 transition duration-150 ease-in-out form-checkbox`"
                                    />
                                    <label
                                        for="chairman_sms"
                                        :class="`${
                                            !activeSubscription
                                                ? 'opacity-50 cursor-not-allowed'
                                                : ''
                                        } ml-2 font-medium text-gray-700`"
                                    >
                                        SMS
                                    </label>
                                </div>
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
                class="umami--click--update-notification"
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
                    confirmation_mail: this.settings.notifications.confirmation_mail,
                    confirmation_sms: this.settings.notifications.confirmation_sms,
                    reminder_mail: this.settings.notifications.reminder_mail,
                    reminder_sms: this.settings.notifications.reminder_sms,
                    thanks_mail: this.settings.notifications.thanks_mail,
                    thanks_sms: this.settings.notifications.thanks_sms,
                    chairman_mail: this.settings.notifications.chairman_mail,
                    chairman_sms: this.settings.notifications.chairman_sms
                },
                {
                    bag: 'updateNotificationsSettings',
                    resetOnSuccess: false
                }
            )
        }
    },
    computed: {
        activeSubscription() {
            return this.$page.props.auth.user.subscribed
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
