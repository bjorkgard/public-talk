<template>
    <JetFormSection @submitted="updateMeetingSettings">
        <template #title> Mötestid </template>

        <template #description> Uppdatera mötestiden </template>

        <template #form>
            <!-- Mötesdag -->
            <div class="col-span-6 sm:col-span-3">
                <JetLabel for="day" value="Mötesdag" />
                <select
                    id="day"
                    v-model="form.day"
                    class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-teak-300 sm:text-sm sm:leading-5"
                >
                    <option value="Monday">Måndag</option>
                    <option value="Tuesday">Tisdag</option>
                    <option value="Wednesday">Onsdag</option>
                    <option value="Thursday">Torsdag</option>
                    <option value="Friday">Fredag</option>
                    <option value="Saturday">Lördag</option>
                    <option value="Sunday">Söndag</option>
                </select>
                <JetInputError :message="form.errors.day" class="mt-2" />
            </div>
            <!-- Klockslag -->
            <div class="col-span-6 sm:col-span-3">
                <JetLabel for="time" value="Klockslag" />
                <JetInput
                    id="time"
                    v-model="form.time"
                    :error="form.errors.time"
                    type="time"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.time" class="mt-2" />
            </div>
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
import JetLabel from '@/Jetstream/Label'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'

export default {
    components: {
        JetFormSection,
        JetLabel,
        JetInput,
        JetInputError,
        JetActionMessage,
        JetButton
    },
    props: ['settings'],
    data() {
        return {
            form: this.$inertia.form(
                {
                    _method: 'PUT',
                    day: this.settings.meeting.day,
                    time: this.settings.meeting.time
                },
                {
                    resetOnSuccess: false
                }
            ),

            photoPreview: null
        }
    },
    methods: {
        updateMeetingSettings() {
            this.form.post(`/settings/${this.settings.id}/meeting/true`, {
                preserveScroll: true
            })
        }
    }
}
</script>
