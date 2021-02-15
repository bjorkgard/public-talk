<template>
    <JetDialogModal :show="show" max-width="6xl">
        <template #title>
            <h2>
                {{ speaker.full_name }} -
                <span class="text-sm">{{ speaker.congregation }}</span>
            </h2>
            <span class="text-sm">
                {{ speaker.phone ? 'T: ' + speaker.phone + ' ' : '' }}
            </span>
            <span class="text-sm">
                {{ speaker.email ? '@: ' + speaker.email + ' ' : '' }}
            </span>
        </template>
        <template #content>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                        >
                            Nummer
                        </th>
                        <th
                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                        >
                            Tema
                        </th>
                        <th
                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                        >
                            Ämne
                        </th>
                        <th
                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                        >
                            Seanast
                        </th>
                        <th
                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                        >
                            Betyg
                        </th>
                        <th class="px-6 py-3 bg-gray-50"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(row, index) in speaker.talks"
                        :key="row.id"
                        :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'"
                    >
                        <td
                            class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 whitespace-no-wrap"
                            :class="{ 'line-through': row.deleted_at }"
                        >
                            {{ row.number }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                            :class="{ 'line-through': row.deleted_at }"
                        >
                            {{ row.theme }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                            :class="{ 'line-through': row.deleted_at }"
                        >
                            {{ row.subject }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap cursor-default"
                        >
                            {{ row.bookings.length ? row.bookings[0].date : '' }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                            <Grade
                                v-if="row.bookings[0]"
                                :grade="row.bookings.length ? row.bookings[0].grade : 0"
                            />
                        </td>
                        <td
                            class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap"
                        >
                            <span
                                v-if="
                                    !row.deleted_at &&
                                    userHelpers.hasAccess('admin', $page.props.user.role)
                                "
                                title="Boka föreläsning"
                            >
                                <Icons
                                    name="book"
                                    class="w-5 text-gray-500 cursor-pointer hover:text-teal-500"
                                    @click.native="bookTalk(row.id)"
                                />
                            </span>
                            <span
                                v-if="row.deleted_at"
                                title="Föreläsningen är raderad på jw.org"
                            >
                                <Icons name="warning" class="w-5 text-orange-500" />
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
        <template #footer>
            <JetButton class="ml-2" @click.native="closeModal()"> Stäng </JetButton>
        </template>
    </JetDialogModal>
</template>

<script>
import JetDialogModal from '@/Jetstream/DialogModal'
import JetButton from '@/Jetstream/Button'
import Grade from '@Shared/Grade'
import Icons from '@Shared/Icons'

export default {
    components: {
        JetDialogModal,
        JetButton,
        Grade,
        Icons
    },
    props: ['speakerId', 'show'],
    data() {
        return {
            speaker: {
                full_name: null,
                talks: []
            },

            bookingForm: this.$inertia.form(
                {
                    speaker_id: '',
                    talk_id: ''
                },
                {
                    bag: 'bookingErrorBag',
                    resetOnSuccess: true
                }
            )
        }
    },
    watch: {
        show: {
            immediate: true,
            handler(val) {
                if (val) {
                    this.getTalks()
                }
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('close')
        },
        bookTalk(talkId) {
            this.bookingForm.speaker_id = this.speaker.id
            this.bookingForm.talk_id = talkId

            this.bookingForm.post('/bookings/create')
        },
        getTalks() {
            axios.get(`/speakers/${this.speakerId}`).then((response) => {
                this.speaker = response.data
            })
        }
    }
}
</script>
