<template>
    <JetDialogModal :show="show" max-width="6xl">
        <template #title>{{ talk.number }} – {{ talk.theme }}</template>
        <template #content>
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
                            Församling
                        </th>
                        <th
                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                        >
                            Telefon
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
                        v-for="(row, index) in talk.speakers"
                        :key="row.id"
                        :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'"
                    >
                        <td
                            class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 whitespace-no-wrap"
                        >
                            {{ row.full_name }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                        >
                            {{ row.congregation }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap"
                        >
                            {{ row.phone }}
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
                                    userHelpers.hasAccess('admin', $page.props.user.role)
                                "
                                title="Boka föreläsning"
                            >
                                <Icons
                                    name="book"
                                    class="w-5 text-gray-500 cursor-pointer hover:text-teal-500"
                                    @click.native="book(row.id)"
                                />
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
    props: ['talkId', 'show'],
    data() {
        return {
            talk: {
                number: null,
                theme: null,
                speakers: []
            },

            bookingForm: this.$inertia.form(
                {
                    speaker_id: '',
                    talk_id: ''
                },
                {
                    resetOnSuccess: true
                }
            )
        }
    },
    watch: {
        show: {
            immediate: true,
            handler(val, oldVal) {
                if (val) {
                    this.getSpeakers()
                }
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('close')
        },
        book(speakerId) {
            this.bookingForm.speaker_id = speakerId
            this.bookingForm.talk_id = this.talk.id

            this.bookingForm.post('/bookings/create')
        },
        getSpeakers() {
            axios.get(`/talks/${this.talkId}`).then((response) => {
                this.talk = response.data
            })
        }
    }
}
</script>
