<template>
    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="name" value="Namn" />
                <JetInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="block w-full mt-1"
                    required
                    autofocus
                    autocomplete="name"
                />
            </div>

            <div class="mt-4">
                <JetLabel for="email" value="E-postadress" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="block w-full mt-1"
                    required
                />
            </div>

            <div class="mt-4">
                <JetLabel for="phone" value="Telefon" />
                <JetInput
                    id="phone"
                    v-model="form.phone"
                    type="text"
                    class="block w-full mt-1"
                    required
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password" value="Lösenord" />
                <JetInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="block w-full mt-1"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password_confirmation" value="Bekräfta lösenord" />
                <JetInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="block w-full mt-1"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div
                v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                class="mt-4"
            >
                <JetLabel for="terms">
                    <div class="flex items-center">
                        <JetCheckbox id="terms" v-model="form.terms" name="terms" />

                        <div class="ml-2">
                            I agree to the
                            <a
                                target="_blank"
                                :href="route('terms.show')"
                                class="text-sm text-gray-600 underline hover:text-gray-900"
                                >Terms of Service</a
                            >
                            and
                            <a
                                target="_blank"
                                :href="route('policy.show')"
                                class="text-sm text-gray-600 underline hover:text-gray-900"
                                >Privacy Policy</a
                            >
                        </div>
                    </div>
                </JetLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link
                    :href="route('login')"
                    class="text-sm text-gray-600 underline hover:text-gray-900"
                >
                    Redan registrerad?
                </inertia-link>

                <JetButton
                    class="ml-4 umami--click--store-account"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Skapa konto
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
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

export default {
    components: {
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                phone: '',
                phone_country: 'SE',
                password: '',
                password_confirmation: '',
                terms: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation')
            })
        }
    }
}
</script>
