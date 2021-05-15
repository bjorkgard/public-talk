<template>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <nav
                    class="flex items-center justify-end px-4 py-3 bg-white border-t border-gray-200 sm:px-6"
                >
                    <SearchInput :value="search" @input="searchTalks" />
                </nav>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Nr
                                <inertia-link
                                    :href="`${talks.path}?order=asc&sort=number`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${talks.path}?order=desc&sort=number`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Titel
                                <inertia-link
                                    :href="`${talks.path}?order=asc&sort=theme`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${talks.path}?order=desc&sort=theme`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Ämne
                                <inertia-link
                                    :href="`${talks.path}?order=asc&sort=subject`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="up" class="w-4" />
                                </inertia-link>
                                <inertia-link
                                    :href="`${talks.path}?order=desc&sort=subject`"
                                    class="text-gray-400 hover:text-teak-500"
                                >
                                    <Icons name="down" class="w-4 -m-2" />
                                </inertia-link>
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Seanast
                            </th>
                            <th class="px-6 py-3 text-right bg-gray-50">
                                <span v-if="owner" title="Lägg till en ny föreläsning">
                                    <Icons
                                        name="plus"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500"
                                        @click.native="addTalk()"
                                    />
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(row, index) in talks.data"
                            :key="row.id"
                            :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'"
                        >
                            <td
                                class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 whitespace-no-wrap"
                            >
                                {{ row.number }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                            >
                                {{ row.theme }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                            >
                                {{ row.subject }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap cursor-default"
                            >
                                <span>
                                    {{ row.last_booking ? row.last_booking.date : '' }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap"
                            >
                                <span title="Visa talare med denna föreläsning">
                                    <Icons
                                        name="users"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--show-talk-speakers"
                                        @click.native="showSpeakersForTalk(row.id)"
                                    />
                                </span>
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Boka föreläsning"
                                >
                                    <Icons
                                        name="book"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--book-talk"
                                        @click.native="bookTalk(row.id)"
                                    />
                                </span>
                                <span v-if="owner" title="Radera föreläsning">
                                    <Icons
                                        name="delete"
                                        class="w-5 text-gray-500 cursor-pointer hover:text-teal-500 umami--click--delete-talk"
                                        @click.native="confirmTalkDeletion(row.id)"
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
                            <span class="font-medium">{{ talks.from }}</span>
                            till
                            <span class="font-medium">{{ talks.to }}</span>
                            av
                            <span class="font-medium">{{ talks.total }}</span>
                            föreläsningar
                        </p>
                    </div>
                    <div class="flex justify-between flex-1 sm:justify-end">
                        <ButtonLink :link="talks.prev_page_url"> Föregående </ButtonLink>
                        <ButtonLink :link="talks.next_page_url" class="ml-3">
                            Nästa
                        </ButtonLink>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Delete Speaker Confirmation Modal -->
        <JetConfirmationModal
            :show="confirmingTalkDeletion"
            @close="confirmingTalkDeletion = false"
        >
            <template #title> Radera föreläsning </template>

            <template #content>
                Är du säker på att du vill radera den här föreläsningen?<br />
                Alla användare med den här föreläsningen inbokad kommer at få en varning
                och alla talare med den här föreläsningen kommer att få den struken.
            </template>

            <template #footer>
                <JetSecondaryButton @click.native="confirmingTalkDeletion = false">
                    Avbryt
                </JetSecondaryButton>

                <JetDangerButton
                    class="ml-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click.native="deleteTalk"
                >
                    Radera
                </JetDangerButton>
            </template>
        </JetConfirmationModal>

        <SpeakerModal
            :talk-id="talkId"
            :show="showSpeakerModal"
            @close="showSpeakerModal = false"
        />
        <TalkForm :show="showTalkModal" @close="showTalkModal = false" />
    </div>
</template>

<script>
import ButtonLink from '@Shared/ButtonLink'
import Icons from '@Shared/Icons'
import SpeakerModal from './SpeakerModal'
import SearchInput from '@Shared/SearchInput'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'
import TalkForm from './TalkForm'

export default {
    components: {
        ButtonLink,
        Icons,
        SpeakerModal,
        SearchInput,
        JetConfirmationModal,
        JetSecondaryButton,
        JetDangerButton,
        TalkForm
    },
    props: ['talks', 'search', 'owner'],
    data() {
        return {
            talkId: null,
            showSpeakerModal: false,
            showTalkModal: false,
            timer: null,
            confirmingTalkDeletion: false,

            form: this.$inertia.form(
                {
                    talk_id: ''
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    methods: {
        addTalk() {
            this.showTalkModal = true
        },
        confirmTalkDeletion(talkId) {
            this.confirmingTalkDeletion = true
            this.form.talk_id = talkId
        },
        deleteTalk() {
            let self = this
            this.form.delete('/talks/' + this.form.talk_id, {
                onSuccess() {
                    self.confirmingTalkDeletion = false
                }
            })
        },
        searchTalks(value) {
            if (this.timer) {
                clearTimeout(this.timer)
                this.timer = null
            }

            this.timer = setTimeout(() => {
                this.$inertia.get(
                    this.$page.props.talks.first_page_url,
                    { search: value },
                    { replace: true }
                )
            }, 800)
        },
        showSpeakersForTalk(talkId) {
            this.talkId = talkId
            this.showSpeakerModal = true
        },
        bookTalk(talkId) {
            this.form.talk_id = talkId

            this.form.post('/bookings/create')
        }
    }
}
</script>
