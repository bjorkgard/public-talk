<template>
    <JetFormSection @submitted="updateExtraSettings">
        <template #title> Extra information </template>

        <template #description>
            Här kan du lägga till extra fält som kommer med i mailen till föreläsaren.
        </template>

        <template #form>
            <div
                v-for="(field, index) in form.extra"
                :key="index"
                class="col-span-6 grid grid-cols-6 gap-6"
            >
                <div class="col-span-2">
                    <JetInput
                        v-model="form.extra[index].label"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Rubrik"
                    />
                </div>
                <div class="col-span-3">
                    <JetInput
                        v-model="form.extra[index].value"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Text"
                    />
                </div>
                <div class="col-span-1">
                    <JetSecondaryButton @click.native="removeExtraField(index)">
                        Radera
                    </JetSecondaryButton>
                </div>
            </div>
            <JetSecondaryButton @click.native="addExtraField">
                Lägg till
            </JetSecondaryButton>
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
import JetInput from '@/Jetstream/Input'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    components: {
        JetFormSection,
        JetInput,
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
                    extra: this.settings.extra || []
                },
                {
                    bag: 'updateExtraSettings',
                    resetOnSuccess: false
                }
            ),

            photoPreview: null
        }
    },
    methods: {
        addExtraField() {
            this.form.extra.push({
                label: '',
                value: ''
            })
        },
        removeExtraField(index) {
            this.form.extra.splice(index, 1)
        },
        updateExtraSettings() {
            this.form.post(`/settings/${this.settings.id}/extra/true`, {
                preserveScroll: true
            })
        }
    }
}
</script>
