<template>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Namn
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                E-postadress
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Roll
                            </th>
                            <th class="px-6 py-3 text-right bg-gray-50">
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'admin',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Lägg till en ny användare"
                                >
                                    <Icons
                                        name="plus"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--add-user"
                                        @click.native="addUser()"
                                    />
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(row, index) in users"
                            :key="row.id"
                            :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'"
                        >
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                            >
                                {{ row.name }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                            >
                                {{ row.email }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap cursor-default"
                            >
                                <span>
                                    {{ row.role | translateRole }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap"
                            >
                                <span
                                    v-if="!row.email_verified_at"
                                    title="Bjud in användare"
                                >
                                    <Icons
                                        name="link"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--invite-user"
                                        @click.native="inviteUser(row)"
                                    />
                                </span>
                                <span title="Redigera användare">
                                    <Icons
                                        name="edit"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--edit-user"
                                        @click.native="editUser(row)"
                                    />
                                </span>
                                <span
                                    v-if="row.role !== 'owner'"
                                    title="Radera användare"
                                >
                                    <Icons
                                        name="delete"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--delete-user"
                                        @click.native="confirmUserDeletion(row.id)"
                                    />
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delete Speaker Confirmation Modal -->
        <JetConfirmationModal
            :show="confirmingUserDeletion"
            @close="confirmingUserDeletion = false"
        >
            <template #title> Radera användare </template>

            <template #content>
                Är du säker på att du vill radera den här användaren?<br />
                Användaren kommer inte längre att kunna logga in och eventuella API-token
                som användaren har skapat kommer att tas bort.
            </template>

            <template #footer>
                <JetSecondaryButton @click.native="confirmingUserDeletion = false">
                    Avbryt
                </JetSecondaryButton>

                <JetDangerButton
                    class="ml-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click.native="deleteUser"
                >
                    Radera
                </JetDangerButton>
            </template>
        </JetConfirmationModal>

        <UserForm :show="showUserModal" :user="user" @close="showUserModal = false" />
    </div>
</template>

<script>
import Icons from '@Shared/Icons'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'
import UserForm from './UserForm'

export default {
    components: {
        Icons,
        JetConfirmationModal,
        JetSecondaryButton,
        JetDangerButton,
        UserForm
    },
    props: {
        users: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            confirmingUserDeletion: false,
            userId: null,
            user: null,
            showUserModal: false,

            form: this.$inertia.form(
                {
                    user_id: ''
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    methods: {
        editUser(user) {
            this.user = user

            this.showUserModal = true
        },
        addUser() {
            this.user = null
            this.showUserModal = true
        },
        inviteUser(user) {
            this.form.post('/invite-user/' + user.id)
        },
        confirmUserDeletion(userId) {
            this.confirmingUserDeletion = true
            this.form.user_id = userId
        },
        deleteUser() {
            let self = this
            this.form.delete('/users/' + this.form.user_id, {
                onSuccess() {
                    self.confirmingUserDeletion = false
                }
            })
        }
    }
}
</script>
