<template>
    <jet-dialog-modal :show="show" maxWidth="6xl">
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
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Nummer
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Tema
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Ämne
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Seanast
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
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
                            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900"
                            :class="{ 'line-through': row.deleted_at }"
                        >
                            {{ row.number }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                            :class="{ 'line-through': row.deleted_at }"
                        >
                            {{ row.theme }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                            :class="{ 'line-through': row.deleted_at }"
                        >
                            {{ row.subject }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 cursor-default"
                        >
                            {{ row.bookings.length ? row.bookings[0].date : '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                            <grade
                                v-if="row.bookings[0]"
                                :grade="row.bookings.length ? row.bookings[0].grade : 0"
                            />
                        </td>
                        <td
                            class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium"
                        >
                            <span title="Boka föreläsning" v-if="!row.deleted_at">
                                <icons
                                    name="book"
                                    class="w-5 text-gray-500 hover:text-teal-500 cursor-pointer"
                                    @click.native="bookTalk(row.id)"
                                />
                            </span>
                            <span
                                title="Föreläsningen är raderad på jw.org"
                                v-if="row.deleted_at"
                            >
                                <icons name="warning" class="w-5 text-orange-500" />
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
        <template #footer>
            <jet-button class="ml-2" @click.native="closeModal()"> Stäng </jet-button>
        </template>
    </jet-dialog-modal>
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

                bookingForm: this.$inertia.form({
                    speaker_id: '',
                    talk_id: ''
                }, {
                    bag: 'bookingErrorBag',
                    resetOnSuccess: true
                })
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
        },
        watch: {
            show: {
                immediate: true,
                handler(val, oldVal) {
                    if (val) {
                        this.getTalks()
                    }
                }
            }
        }
    }

</script>
