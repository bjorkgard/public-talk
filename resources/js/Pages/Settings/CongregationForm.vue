<template>
    <JetFormSection @submitted="updateCongregationSettings">
        <template #title> Rikets sal </template>

        <template #description> Uppdatera adressuppgifter </template>

        <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-3">
                <JetLabel for="name" value="Församlingsnamn" />
                <JetInput
                    id="name"
                    v-model="form.name"
                    :error="form.errors.name"
                    type="text"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.name" class="mt-2" />
            </div>
            <!-- Address -->
            <div class="col-span-6 sm:col-span-3">
                <JetLabel for="address" value="Gatuadress" />
                <JetInput
                    id="address"
                    v-model="form.address"
                    :error="form.errors.address"
                    type="text"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.address" class="mt-2" />
            </div>
            <!-- Zip -->
            <div class="col-span-6 sm:col-span-3">
                <JetLabel for="zip" value="Postnummer" />
                <JetInput
                    id="zip"
                    v-model="form.zip"
                    :error="form.errors.zip"
                    type="text"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.zip" class="mt-2" />
            </div>
            <!-- City -->
            <div class="col-span-6 sm:col-span-3">
                <JetLabel for="city" value="Ort" />
                <JetInput
                    id="city"
                    v-model="form.city"
                    :error="form.errors.city"
                    type="text"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.city" class="mt-2" />
            </div>
            <!-- Latitude -->
            <div class="col-span-6 sm:col-span-3">
                <JetLabel for="latitude" value="Latitud" />
                <JetInput
                    id="latitude"
                    v-model="form.latitude"
                    :error="form.errors.latitude"
                    type="text"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.latitude" class="mt-2" />
            </div>
            <!-- Lobgitude -->
            <div class="col-span-6 sm:col-span-3">
                <JetLabel for="longitude" value="Longitud" />
                <JetInput
                    id="longitude"
                    v-model="form.longitude"
                    :error="form.errors.longitude"
                    type="text"
                    class="mt-1 block w-full"
                />
                <JetInputError :message="form.errors.longitude" class="mt-2" />
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
                    name: this.settings.congregation.name,
                    address: this.settings.congregation.address,
                    zip: this.settings.congregation.zip,
                    city: this.settings.congregation.city,
                    latitude: this.settings.congregation.latitude,
                    longitude: this.settings.congregation.longitude
                },
                {
                    resetOnSuccess: false
                }
            ),

            photoPreview: null
        }
    },
    methods: {
        updateCongregationSettings() {
            this.form.post(`/settings/${this.settings.id}/congregation/true`, {
                preserveScroll: true
            })
        }
    }
}
</script>
