<template>
    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            <template v-if="!recovery">
                Bekräfta åtkomst till ditt konto genom att ange autentiseringskoden från
                din autentiseringsapplikation.
            </template>

            <template v-else>
                Bekräfta åtkomst till ditt konto genom att ange en av dina
                nödåterställningskoder.
            </template>
        </div>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div v-if="!recovery">
                <JetLabel for="code" value="Code" />
                <JetInput
                    id="code"
                    ref="code"
                    v-model="form.code"
                    type="text"
                    inputmode="numeric"
                    class="mt-1 block w-full"
                    autofocus
                    autocomplete="one-time-code"
                />
            </div>

            <div v-else>
                <JetLabel for="recovery_code" value="Recovery Code" />
                <JetInput
                    id="recovery_code"
                    ref="recovery_code"
                    v-model="form.recovery_code"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="one-time-code"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button
                    type="button"
                    class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                    @click.prevent="toggleRecovery"
                >
                    <template v-if="!recovery"> Använd en återställningskod </template>

                    <template v-else> Använd en autentiseringskod </template>
                </button>

                <JetButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Logga in
                </JetButton>
            </div>
        </form>
    </JetAuthenticationCard>
</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

export default {
    components: {
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetLabel,
        JetValidationErrors
    },

    data() {
        return {
            recovery: false,
            form: this.$inertia.form({
                code: '',
                recovery_code: ''
            })
        }
    },

    methods: {
        toggleRecovery() {
            this.recovery ^= true

            this.$nextTick(() => {
                if (this.recovery) {
                    this.$refs.recovery_code.focus()
                    this.form.code = ''
                } else {
                    this.$refs.code.focus()
                    this.form.recovery_code = ''
                }
            })
        },

        submit() {
            this.form.post(this.route('two-factor.login'))
        }
    }
}
</script>
