<template>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Namn
                                <inertia-link
                                    :href="`${chairmen.path}?order=asc&sort=name`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${chairmen.path}?order=desc&sort=name`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                E-postadress
                                <inertia-link
                                    :href="`${chairmen.path}?order=asc&sort=email`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${chairmen.path}?order=desc&sort=email`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Telefon
                                <inertia-link
                                    :href="`${chairmen.path}?order=asc&sort=phone`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${chairmen.path}?order=desc&sort=phone`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Seanast
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right">
                                <span title="Lägg till en ny ordförande">
                                    <Icons
                                        name="plus"
                                        class="text-gray-500 hover:text-teal-500 cursor-pointer w-5"
                                        @click.native="addChairman()"
                                    />
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(row, index) in chairmen.data"
                            :key="row.id"
                            :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'"
                        >
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900"
                            >
                                {{ row.name }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                            >
                                {{ row.email }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                            >
                                {{ row.phone }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 cursor-default"
                            >
                                <span>
                                    {{ row.last_booking ? row.last_booking.date : '' }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium"
                            >
                                <span title="Redigera ordförande">
                                    <Icons
                                        name="edit"
                                        class="text-gray-500 hover:text-teal-500 cursor-pointer w-5"
                                        @click.native="editChairman(row)"
                                    />
                                </span>
                                <span title="Radera ordförande">
                                    <Icons
                                        name="delete"
                                        class="text-gray-500 hover:text-teal-500 cursor-pointer w-5"
                                        @click.native="confirmChairmanDeletion(row.id)"
                                    />
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav
                    class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                >
                    <div class="hidden sm:block">
                        <p
                            v-if="chairmen.data.length"
                            class="text-sm leading-5 text-gray-700"
                        >
                            Visar
                            <span class="font-medium">{{ chairmen.from }}</span>
                            till
                            <span class="font-medium">{{ chairmen.to }}</span>
                            av
                            <span class="font-medium">{{ chairmen.total }}</span>
                            ordförande
                        </p>
                    </div>
                    <div class="flex-1 flex justify-between sm:justify-end">
                        <ButtonLink :link="chairmen.prev_page_url">
                            Föregående
                        </ButtonLink>
                        <ButtonLink :link="chairmen.next_page_url" class="ml-3">
                            Nästa
                        </ButtonLink>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Delete Chairman Confirmation Modal -->
        <JetConfirmationModal
            :show="confirmingChairmanDeletion"
            @close="confirmingChairmanDeletion = false"
        >
            <template #title> Radera ordförande </template>

            <template #content>
                Är du säker på att du vill radera den här ordföranden?<br />
                Du kommer att få välja en ny ordförande på kommande bokningar om han redan
                har planerats in.
            </template>

            <template #footer>
                <JetSecondaryButton @click.native="confirmingChairmanDeletion = false">
                    Avbryt
                </JetSecondaryButton>

                <JetDangerButton
                    class="ml-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click.native="deleteChairman"
                >
                    Radera
                </JetDangerButton>
            </template>
        </JetConfirmationModal>
        <ChairmanForm
            :show="showChairmanModal"
            :chairman="chairman"
            @close="showChairmanModal = false"
        />
    </div>
</template>

<script>
import ButtonLink from '@Shared/ButtonLink'
import Icons from '@Shared/Icons'
import ChairmanForm from './ChairmanForm'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    components: {
        ButtonLink,
        Icons,
        ChairmanForm,
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton
    },
    props: ['chairmen'],
    data() {
        return {
            showChairmanModal: false,
            confirmingChairmanDeletion: false,
            deleting: false,
            chairman: null,

            form: this.$inertia.form(
                {
                    id: '',
                    user_id: this.$page.props.user.id
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    methods: {
        addChairman() {
            this.chairman = null
            this.showChairmanModal = true
        },

        editChairman(chairman) {
            this.chairman = chairman
            this.showChairmanModal = true
        },

        confirmChairmanDeletion(id) {
            this.confirmingChairmanDeletion = true
            this.form.id = id
        },

        deleteChairman() {
            this.form.delete('/chairmen/' + this.form.id, {
                preserveScroll: true
            })
            this.confirmingChairmanDeletion = false
        }
    }
}
</script>
