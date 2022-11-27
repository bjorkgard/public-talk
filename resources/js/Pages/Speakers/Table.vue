<template>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <nav
                    class="flex items-center justify-end px-4 py-3 bg-white border-t border-gray-200 sm:px-6"
                >
                    <SearchInput :value="search" @input="searchSpeakers" />
                </nav>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Efternamn
                                <inertia-link
                                    :href="`${speakers.path}?order=asc&sort=lastname`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${speakers.path}?order=desc&sort=lastname`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Förnamn
                                <inertia-link
                                    :href="`${speakers.path}?order=asc&sort=firstname`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${speakers.path}?order=desc&sort=firstname`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Församling
                                <inertia-link
                                    :href="`${speakers.path}?order=asc&sort=congregation`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${speakers.path}?order=desc&sort=congregation`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Senast
                                <inertia-link
                                    :href="`${speakers.path}?order=asc&sort=date`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${speakers.path}?order=desc&sort=date`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th class="px-6 py-3 text-right bg-gray-50">
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Lägg till en ny talare"
                                >
                                    <Icons
                                        name="plus"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--add-speaker"
                                        @click.native="addSpeaker()"
                                    />
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(row, index) in speakers.data"
                            :key="row.id"
                            :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'"
                        >
                            <td
                                class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 whitespace-no-wrap"
                            >
                                {{ row.lastname }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                            >
                                {{ row.firstname }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                            >
                                {{ row.congregation }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                            >
                                {{ row.date ? row.date : '' }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap"
                            >
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Boka talaren"
                                >
                                    <Icons
                                        name="book"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--book-speaker"
                                        @click.native="bookSpeaker(row.id)"
                                    />
                                </span>
                                <span title="visa talarens föreläsningar">
                                    <Icons
                                        name="document"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--show-speaker-talks"
                                        @click.native="showTalksForSpeaker(row.id)"
                                    />
                                </span>
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Redigera talare"
                                >
                                    <Icons
                                        name="edit"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--edit-speaker"
                                        @click.native="editSpeaker(row)"
                                    />
                                </span>
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Radera talare"
                                >
                                    <Icons
                                        name="delete"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--delete-speaker"
                                        @click.native="confirmSpeakerDeletion(row.id)"
                                    />
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav
                    class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6"
                >
                    <div class="hidden sm:block">
                        <p class="text-sm leading-5 text-gray-700">
                            Visar
                            <span class="font-medium">{{ speakers.from }}</span>
                            till
                            <span class="font-medium">{{ speakers.to }}</span>
                            av
                            <span class="font-medium">{{ speakers.total }}</span>
                            talare
                        </p>
                    </div>
                    <div class="flex justify-between flex-1 sm:justify-end">
                        <ButtonLink :link="speakers.prev_page_url">
                            Föregående
                        </ButtonLink>
                        <ButtonLink :link="speakers.next_page_url" class="ml-3">
                            Nästa
                        </ButtonLink>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Delete Speaker Confirmation Modal -->
        <JetConfirmationModal
            :show="confirmingSpeakerDeletion"
            @close="confirmingSpeakerDeletion = false"
        >
            <template #title> Radera talare </template>

            <template #content>
                Är du säker på att du vill radera den här talaren?<br />
                Om talaren är inbokad på kommande föreläsningar kommer bokningen att
                tömmas och du får ett meddelande via e-post.
            </template>

            <template #footer>
                <JetSecondaryButton @click.native="confirmingSpeakerDeletion = false">
                    Avbryt
                </JetSecondaryButton>

                <JetDangerButton
                    class="ml-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click.native="deleteSpeaker"
                >
                    Radera
                </JetDangerButton>
            </template>
        </JetConfirmationModal>
        <SpeakerForm
            :show="showSpeakerModal"
            :speaker="speaker"
            @close="showSpeakerModal = false"
        />
        <TalkModal
            :speaker-id="speakerId"
            :show="showTalkModal"
            @close="showTalkModal = false"
        />
    </div>
</template>

<script>
import ButtonLink from '@Shared/ButtonLink'
import Icons from '@Shared/Icons'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import SpeakerForm from './SpeakerForm'
import TalkModal from './TalkModal'
import SearchInput from '@Shared/SearchInput'

export default {
    components: {
        ButtonLink,
        Icons,
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton,
        SpeakerForm,
        TalkModal,
        SearchInput
    },
    props: ['speakers', 'links', 'search'],
    data() {
        return {
            confirmingSpeakerDeletion: false,
            deleting: false,
            showSpeakerModal: false,
            speakerId: null,
            showTalkModal: false,
            timer: null,
            speaker: null,

            form: this.$inertia.form(
                {
                    id: ''
                },
                {
                    resetOnSuccess: true
                }
            ),

            bookingForm: this.$inertia.form(
                {
                    _method: 'POST',
                    speaker_id: ''
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    methods: {
        searchSpeakers(value) {
            if (this.timer) {
                clearTimeout(this.timer)
                this.timer = null
            }

            this.timer = setTimeout(() => {
                this.$inertia.get(
                    this.$page.props.speakers.first_page_url,
                    { search: value },
                    { replace: true }
                )
            }, 500)
        },

        editSpeaker(speaker) {
            this.speaker = speaker

            this.showSpeakerModal = true
        },

        addSpeaker() {
            this.showSpeakerModal = true
        },

        confirmSpeakerDeletion(id) {
            this.confirmingSpeakerDeletion = true
            this.form.id = id
        },

        deleteSpeaker() {
            this.form.delete('/speakers/' + this.form.id, {
                preserveScroll: true
            })

            this.confirmingSpeakerDeletion = false
        },

        showTalksForSpeaker(speakerId) {
            this.speakerId = speakerId
            this.showTalkModal = true
        },

        bookSpeaker(speakerId) {
            this.bookingForm.speaker_id = speakerId

            this.bookingForm.post('/bookings/create')
        }
    }
}
</script>
