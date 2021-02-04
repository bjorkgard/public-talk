<template>
    <div>
        <!-- Generate API Token -->
        <JetFormSection @submitted="createApiToken">
            <template #title> Skapa API-Token </template>

            <template #description>
                API-tokens tillåter tredjeparts tjänster att autentisera med applikationen
                för din räkning.
            </template>

            <template #form>
                <!-- Token Name -->
                <div class="col-span-6 sm:col-span-4">
                    <JetLabel for="name" value="Namn" />
                    <JetInput
                        id="name"
                        v-model="createApiTokenForm.name"
                        type="text"
                        class="mt-1 block w-full"
                        autofocus
                    />
                    <JetInputError
                        :message="createApiTokenForm.errors.name"
                        class="mt-2"
                    />
                </div>

                <!-- Token Permissions -->
                <div v-if="availablePermissions.length > 0" class="col-span-6">
                    <JetLabel for="permissions" value="Rättigheter" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="permission in availablePermissions" :key="permission">
                            <label class="flex items-center">
                                <JetCheckbox
                                    v-model="createApiTokenForm.permissions"
                                    :value="permission"
                                />
                                <span class="ml-2 text-sm text-gray-600">
                                    {{ permission }}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </template>

            <template #actions>
                <JetActionMessage
                    :on="createApiTokenForm.recentlySuccessful"
                    class="mr-3"
                >
                    Skapad.
                </JetActionMessage>

                <JetButton
                    :class="{ 'opacity-25': createApiTokenForm.processing }"
                    :disabled="createApiTokenForm.processing"
                >
                    Skapa
                </JetButton>
            </template>
        </JetFormSection>

        <div v-if="tokens.length > 0">
            <JetSectionBorder />

            <!-- Manage API Tokens -->
            <div class="mt-10 sm:mt-0">
                <JetActionSection>
                    <template #title> Hantera API-token </template>

                    <template #description>
                        Du kan radera alla befintliga tokens om de inte längre behövs.
                    </template>

                    <!-- API Token List -->
                    <template #content>
                        <div class="space-y-6">
                            <div
                                v-for="token in tokens"
                                :key="token.id"
                                class="flex items-center justify-between"
                            >
                                <div>
                                    {{ token.name }}
                                </div>

                                <div class="flex items-center">
                                    <div
                                        v-if="token.last_used_ago"
                                        class="text-sm text-gray-400"
                                    >
                                        Senast använd {{ token.last_used_ago }}
                                    </div>

                                    <button
                                        v-if="availablePermissions.length > 0"
                                        class="cursor-pointer ml-6 text-sm text-gray-400 underline"
                                        @click="manageApiTokenPermissions(token)"
                                    >
                                        Rättigheter
                                    </button>

                                    <button
                                        class="cursor-pointer ml-6 text-sm text-red-500"
                                        @click="confirmApiTokenDeletion(token)"
                                    >
                                        Radera
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </JetActionSection>
            </div>
        </div>

        <!-- Token Value Modal -->
        <JetDialogModal :show="displayingToken" @close="displayingToken = false">
            <template #title> API Token </template>

            <template #content>
                <div>
                    Kopiera din nya API-token. För din säkerhet visas den inte igen.
                </div>

                <div
                    v-if="$page.props.jetstream.flash.token"
                    class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500"
                >
                    {{ $page.props.jetstream.flash.token }}
                </div>
            </template>

            <template #footer>
                <JetSecondaryButton @click.native="displayingToken = false">
                    Stäng
                </JetSecondaryButton>
            </template>
        </JetDialogModal>

        <!-- API Token Permissions Modal -->
        <JetDialogModal
            :show="managingPermissionsFor"
            @close="managingPermissionsFor = null"
        >
            <template #title> API-tokenbehörigheter </template>

            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="permission in availablePermissions" :key="permission">
                        <label class="flex items-center">
                            <JetCheckbox
                                v-model="updateApiTokenForm.permissions"
                                :value="permission"
                            />
                            <span class="ml-2 text-sm text-gray-600">{{
                                permission
                            }}</span>
                        </label>
                    </div>
                </div>
            </template>

            <template #footer>
                <JetSecondaryButton @click.native="managingPermissionsFor = null">
                    Avbryt
                </JetSecondaryButton>

                <JetButton
                    class="ml-2"
                    :class="{ 'opacity-25': updateApiTokenForm.processing }"
                    :disabled="updateApiTokenForm.processing"
                    @click.native="updateApiToken"
                >
                    Spara
                </JetButton>
            </template>
        </JetDialogModal>

        <!-- Delete Token Confirmation Modal -->
        <JetConfirmationModal
            :show="apiTokenBeingDeleted"
            @close="apiTokenBeingDeleted = null"
        >
            <template #title> Radera API Token </template>

            <template #content>
                Är du säker på att du vill ta bort denna API-token?
            </template>

            <template #footer>
                <JetSecondaryButton @click.native="apiTokenBeingDeleted = null">
                    Avbryt
                </JetSecondaryButton>

                <JetDangerButton
                    class="ml-2"
                    :class="{ 'opacity-25': deleteApiTokenForm.processing }"
                    :disabled="deleteApiTokenForm.processing"
                    @click.native="deleteApiToken"
                >
                    Radera
                </JetDangerButton>
            </template>
        </JetConfirmationModal>
    </div>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetActionSection from '@/Jetstream/ActionSection'
import JetButton from '@/Jetstream/Button'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetSectionBorder from '@/Jetstream/SectionBorder'

export default {
    components: {
        JetActionMessage,
        JetActionSection,
        JetButton,
        JetConfirmationModal,
        JetDangerButton,
        JetDialogModal,
        JetFormSection,
        JetInput,
        JetCheckbox,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetSectionBorder
    },

    props: ['tokens', 'availablePermissions', 'defaultPermissions'],

    data() {
        return {
            createApiTokenForm: this.$inertia.form({
                name: '',
                permissions: this.defaultPermissions
            }),

            updateApiTokenForm: this.$inertia.form({
                permissions: []
            }),

            deleteApiTokenForm: this.$inertia.form(),

            displayingToken: false,
            managingPermissionsFor: null,
            apiTokenBeingDeleted: null
        }
    },

    methods: {
        createApiToken() {
            this.createApiTokenForm.post(route('api-tokens.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.displayingToken = true
                    this.createApiTokenForm.reset()
                }
            })
        },

        manageApiTokenPermissions(token) {
            this.updateApiTokenForm.permissions = token.abilities

            this.managingPermissionsFor = token
        },

        updateApiToken() {
            this.updateApiTokenForm.put(
                route('api-tokens.update', this.managingPermissionsFor),
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.managingPermissionsFor = null)
                }
            )
        },

        confirmApiTokenDeletion(token) {
            this.apiTokenBeingDeleted = token
        },

        deleteApiToken() {
            this.deleteApiTokenForm.delete(
                route('api-tokens.destroy', this.apiTokenBeingDeleted),
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.apiTokenBeingDeleted = null)
                }
            )
        }
    }
}
</script>
