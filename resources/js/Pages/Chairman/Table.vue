<template>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="
                                    px-6
                                    py-3
                                    text-xs
                                    font-medium
                                    leading-4
                                    tracking-wider
                                    text-left text-gray-500
                                    uppercase
                                    bg-gray-50
                                "
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
                                class="
                                    px-6
                                    py-3
                                    text-xs
                                    font-medium
                                    leading-4
                                    tracking-wider
                                    text-left text-gray-500
                                    uppercase
                                    bg-gray-50
                                "
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
                                class="
                                    px-6
                                    py-3
                                    text-xs
                                    font-medium
                                    leading-4
                                    tracking-wider
                                    text-left text-gray-500
                                    uppercase
                                    bg-gray-50
                                "
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
                                class="
                                    px-6
                                    py-3
                                    text-xs
                                    font-medium
                                    leading-4
                                    tracking-wider
                                    text-left text-gray-500
                                    uppercase
                                    bg-gray-50
                                "
                            >
                                Senast
                                <inertia-link
                                    :href="`${chairmen.path}?order=asc&sort=date`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${chairmen.path}?order=desc&sort=date`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th class="px-6 py-3 text-right bg-gray-50">
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'admin',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Lägg till en ny ordförande"
                                >
                                    <Icons
                                        name="plus"
                                        class="
                                            w-5
                                            text-gray-500
                                            cursor-pointer
                                            hover:text-teal-500
                                        "
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
                                class="
                                    px-6
                                    py-4
                                    text-sm
                                    font-medium
                                    leading-5
                                    text-gray-900
                                    whitespace-no-wrap
                                "
                            >
                                {{ row.name }}
                            </td>
                            <td
                                class="
                                    px-6
                                    py-4
                                    text-sm
                                    leading-5
                                    text-gray-500
                                    whitespace-no-wrap
                                "
                            >
                                {{ row.email }}
                            </td>
                            <td
                                class="
                                    px-6
                                    py-4
                                    text-sm
                                    leading-5
                                    text-gray-500
                                    whitespace-no-wrap
                                "
                            >
                                {{ row.formated_phone }}
                            </td>
                            <td
                                class="
                                    px-6
                                    py-4
                                    text-sm
                                    leading-5
                                    text-gray-500
                                    whitespace-no-wrap
                                    cursor-default
                                "
                            >
                                <span>
                                    {{ row.date ? row.date : '' }}
                                </span>
                            </td>
                            <td
                                class="
                                    px-6
                                    py-4
                                    text-sm
                                    font-medium
                                    leading-5
                                    text-right
                                    whitespace-no-wrap
                                "
                            >
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Redigera ordförande"
                                >
                                    <Icons
                                        name="edit"
                                        class="
                                            w-5
                                            text-gray-500
                                            cursor-pointer
                                            hover:text-teal-500
                                        "
                                        @click.native="editChairman(row)"
                                    />
                                </span>
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Radera ordförande"
                                >
                                    <Icons
                                        name="delete"
                                        class="
                                            w-5
                                            text-gray-500
                                            cursor-pointer
                                            hover:text-teal-500
                                            umami--click--delete-charirman
                                        "
                                        @click.native="confirmChairmanDeletion(row.id)"
                                    />
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav
                    class="
                        flex
                        items-center
                        justify-between
                        px-4
                        py-3
                        bg-white
                        border-t border-gray-200
                        sm:px-6
                    "
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
                    <div class="flex justify-between flex-1 sm:justify-end">
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
