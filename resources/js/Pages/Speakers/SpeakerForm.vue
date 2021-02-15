<template>
    <JetDialogModal :show="show" @close="closeModal">
        <template #title> Talare </template>

        <template #content>
            <div class="grid grid-cols-6 gap-6">
                <!-- Firstname -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="firstname" value="Förnamn" />
                    <JetInput
                        id="firstname"
                        v-model="form.firstname"
                        :error="form.errors.firstname"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.firstname" class="mt-2" />
                </div>

                <!-- Lastname -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="lastname" value="Efternamn" />
                    <JetInput
                        id="lastname"
                        v-model="form.lastname"
                        :error="form.errors.lastname"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.lastname" class="mt-2" />
                </div>

                <!-- Congregation -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="congregation" value="Församling" />
                    <JetInput
                        id="congregation"
                        v-model="form.congregation"
                        :error="form.errors.congregation"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.congregation" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="email" value="E-postadress" />
                    <JetInput
                        id="email"
                        v-model="form.email"
                        :error="form.errors.email"
                        type="email"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.email" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="phone" value="Telefon" />
                    <JetInput
                        id="phone"
                        v-model="form.phone"
                        :error="form.errors.phone"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <JetInputError :message="form.errors.phone" class="mt-2" />
                </div>

                <!-- Comments -->
                <div class="col-span-6 sm:col-span-3">
                    <JetLabel for="comments" value="Kommentar" />
                    <JetInput
                        id="comments"
                        v-model="form.comments"
                        :error="form.errors.comments"
                        type="text"
                        class="mt-1 block w-full style-selector"
                    />
                    <JetInputError :message="form.errors.comments" class="mt-2" />
                </div>

                <!-- Talks -->
                <div class="col-span-6">
                    <JetLabel for="talks" value="Föreläsningar" />
                    <vSelect
                        id="talks"
                        v-model="form.talks"
                        label="full_theme"
                        :options="talks"
                        :reduce="(talk) => talk.id"
                        :close-on-select="false"
                        multiple
                    />
                </div>
            </div>
        </template>

        <template #footer>
            <JetSecondaryButton @click.native="closeModal"> Avbryt </JetSecondaryButton>

            <JetButton
                class="ml-2"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click.native="saveSpeaker"
            >
                Spara
            </JetButton>
        </template>
    </JetDialogModal>
</template>

<script>
import JetButton from '@/Jetstream/Button'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetLabel from '@/Jetstream/Label'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'

export default {
    components: {
        JetButton,
        JetDialogModal,
        JetSecondaryButton,
        JetLabel,
        JetInput,
        JetInputError
    },
    props: {
        show: {
            type: Boolean,
            default: false
        },
        speaker: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            form: this.$inertia.form(
                {
                    id: '',
                    settings_id: this.$page.props.user.settings.id,
                    firstname: '',
                    lastname: '',
                    congregation: '',
                    email: '',
                    phone: '',
                    comments: '',
                    talks: []
                },
                {
                    resetOnSuccess: true
                }
            ),
            talks: []
        }
    },
    watch: {
        speaker: {
            immediate: true,
            handler(val) {
                if (val) {
                    this.form.id = val.id
                    this.form.firstname = val.firstname
                    this.form.lastname = val.lastname
                    this.form.congregation = val.congregation
                    this.form.email = val.email
                    this.form.phone = val.phone
                    this.form.comments = val.comments
                    this.form.talks = val.talks.map((talk) => talk.id)
                } else {
                    this.form.id = ''
                    this.form.firstname = ''
                    this.form.lastname = ''
                    this.form.congregation = ''
                    this.form.email = ''
                    this.form.phone = ''
                    this.form.comments = ''
                    this.form.talks = []
                }
            }
        }
    },
    mounted() {
        this.fetchTalks()
    },
    methods: {
        closeModal() {
            this.$emit('close')
        },
        saveSpeaker() {
            let self = this
            if (this.form.id) {
                this.form.put(`/speakers/${this.form.id}`, {
                    onSuccess() {
                        self.form.reset()
                        self.closeModal()
                    }
                })
            } else {
                this.form.post('/speakers', {
                    onSuccess() {
                        self.form.reset()
                        self.closeModal()
                    }
                })
            }
        },
        fetchTalks() {
            axios.get('/all-talks').then((response) => {
                this.talks = response.data
            })
        }
    }
}
</script>

<style>
.style-selector .vs-selected-bg {
    background: teal;
}
</style>
