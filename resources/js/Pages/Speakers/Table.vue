<template>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <nav
                    class="bg-white px-4 py-3 flex items-center justify-end border-t border-gray-200 sm:px-6"
                >
                    <SearchInput :value="search" @input="searchSpeakers" />
                </nav>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
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
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
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
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
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
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Seanast
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-right">
                                <span title="Lägg till en ny talare">
                                    <Icons
                                        name="plus"
                                        class="text-gray-500 hover:text-teal-500 cursor-pointer w-5"
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
                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900"
                            >
                                {{ row.lastname }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                            >
                                {{ row.firstname }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                            >
                                {{ row.congregation }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                            >
                                {{ row.last_booking ? row.last_booking.date : '' }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium"
                            >
                                <span title="Boka talaren">
                                    <Icons
                                        name="book"
                                        class="text-gray-500 hover:text-teal-500 cursor-pointer w-5"
                                        @click.native="bookSpeaker(row.id)"
                                    />
                                </span>
                                <span title="visa talarens föreläsningar">
                                    <Icons
                                        name="document"
                                        class="text-gray-500 hover:text-teal-500 cursor-pointer w-5"
                                        @click.native="showTalksForSpeaker(row.id)"
                                    />
                                </span>
                                <span title="Redigera talare">
                                    <Icons
                                        name="edit"
                                        class="text-gray-500 hover:text-teal-500 cursor-pointer w-5"
                                        @click.native="editSpeaker(row)"
                                    />
                                </span>
                                <span title="Radera talare">
                                    <Icons
                                        name="delete"
                                        class="text-gray-500 hover:text-teal-500 cursor-pointer w-5"
                                        @click.native="confirmSpeakerDeletion(row.id)"
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
                    <div class="flex-1 flex justify-between sm:justify-end">
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
