<template>
    <JetFormSection @submitted="updateChairmanSettings">
        <template #title> Information till ordförande </template>

        <template #description>
            Här kan du fylla i information som skickas till broderns som är ordförande.
        </template>

        <template #form>
            <div class="grid grid-cols-6 col-span-6 gap-6">
                <div class="col-span-6">
                    <JetLabel
                        for="reminder"
                        value="Talaren har fått en automatisk påminnelse"
                    />
                    <JetInput
                        id="reminder"
                        v-model="form.reminder"
                        :error="form.errors.reminder"
                        type="text"
                        class="block w-full mt-1"
                        placeholder="Meddelande om talaren har fått en påminnelse"
                    />
                    <JetInputError :message="form.errors.reminder" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <JetLabel
                        for="noReminder"
                        value="Talaren har inte fått en automatisk påminnelse"
                    />
                    <JetInput
                        id="noReminder"
                        v-model="form.noReminder"
                        :error="form.errors.noReminder"
                        type="text"
                        class="block w-full mt-1"
                        placeholder="Meddelande om talaren inte fått en påminnelse"
                    />
                    <JetInputError :message="form.errors.noReminder" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <JetLabel for="message" value="Allmänt meddelande" />
                    <JetInput
                        id="message"
                        v-model="form.message"
                        :error="form.errors.message"
                        type="text"
                        class="block w-full mt-1"
                        placeholder="Ordförande får alltid detta meddelande"
                    />
                    <JetInputError :message="form.errors.message" class="mt-2" />
                </div>
            </div>
        </template>

        <template #actions>
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                Sparad
            </JetActionMessage>

            <JetButton
                :class="{ 'opacity-25': form.processing }"
                class="umami--click--update-extra"
                :disabled="form.processing"
            >
                Spara
            </JetButton>
        </template>
    </JetFormSection>
</template>

<script>
import JetFormSection from '@/Jetstream/FormSection'
import JetLabel from '@/Jetstream/Label'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    components: {
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetActionMessage,
        JetButton,
        JetSecondaryButton
    },
    props: ['settings'],
    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: 'PUT',
                    reminder: this.settings.chairman.reminder,
                    noReminder: this.settings.chairman.noReminder,
                    message: this.settings.chairman.message,
                },
                {
                    bag: 'updateChairmanSettings',
                    resetOnSuccess: false
                }
            ),
        }
    },
    methods: {
        updateChairmanSettings() {
            this.form.post(`/settings/${this.settings.id}/chairman/true`, {
                preserveScroll: true
            })
        }
    }
}
</script>
