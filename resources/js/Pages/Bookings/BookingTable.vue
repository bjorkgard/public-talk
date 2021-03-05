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
                                Datum
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Sång
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Tema
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Talare
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-50"
                            >
                                Ordförande
                            </th>
                            <th class="px-6 py-3 text-right bg-gray-50">
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Skapa en ny bokning"
                                >
                                    <Icons
                                        name="plus"
                                        class="h-5 text-gray-500 cursor-pointer hover:text-teal-500"
                                        @click.native="addBooking()"
                                    />
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="booking in bookings" :key="booking.id">
                            <td
                                class="px-6 py-4 text-gray-900"
                                :class="{ 'bg-gray-200': booking.no_meeting }"
                            >
                                {{ booking.date }}
                            </td>

                            <td v-if="booking.no_meeting" colspan="4" class="bg-gray-200">
                                {{ booking.comments }}
                            </td>
                            <td
                                v-if="!booking.no_meeting"
                                class="px-6 py-4 text-gray-900"
                            >
                                {{ booking.song || '&nbsp;' }}
                            </td>
                            <td
                                v-if="!booking.no_meeting"
                                class="px-6 py-4 whitespace-no-wrap"
                                :class="{
                                    'line-through':
                                        booking.talk && booking.talk.deleted_at
                                }"
                            >
                                <div class="leading-5 text-gray-900">
                                    {{
                                        booking.talk
                                            ? booking.talk.theme
                                            : booking.exception
                                            ? booking.custom_talk
                                            : '&nbsp;'
                                    }}
                                </div>
                                <div
                                    v-if="!booking.exception"
                                    class="text-sm leading-5 text-gray-500"
                                >
                                    {{
                                        booking.talk
                                            ? `(${booking.talk.number}) ${booking.talk.subject}`
                                            : '&nbsp;'
                                    }}
                                </div>
                            </td>
                            <td
                                v-if="!booking.no_meeting"
                                class="px-6 py-4 whitespace-no-wrap"
                            >
                                <div class="leading-5 text-gray-900">
                                    {{
                                        booking.speaker
                                            ? booking.speaker.full_name
                                            : booking.exception
                                            ? booking.custom_speaker
                                            : '&nbsp;'
                                    }}
                                </div>
                                <div
                                    v-if="!booking.exception"
                                    class="text-sm leading-5 text-gray-500"
                                >
                                    {{
                                        booking.speaker
                                            ? booking.speaker.congregation
                                            : '&nbsp;'
                                    }}
                                </div>
                            </td>
                            <td
                                v-if="!booking.no_meeting"
                                class="px-6 py-4 text-gray-900 whitespace-no-wrap"
                            >
                                {{ booking.chairman ? booking.chairman.name : '&nbsp;' }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap"
                                :class="{ 'bg-gray-200': booking.no_meeting }"
                            >
                                <span
                                    v-if="
                                        booking &&
                                        (booking.exception ||
                                            (booking.speaker && !booking.speaker.email))
                                    "
                                    title="E-postadress saknas så ingen bekräftelse eller påminnelse kan skickas"
                                >
                                    <Icons name="exception" class="w-5 text-orange-500" />
                                </span>
                                <span
                                    v-if="booking.talk && booking.talk.deleted_at"
                                    title="Föreläsningen är raderad på jw.org"
                                >
                                    <Icons name="warning" class="w-5 text-orange-500" />
                                </span>
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        ) &&
                                        booking.id &&
                                        !booking.exception &&
                                        !booking.no_meeting &&
                                        !booking.upcoming &&
                                        !booking.thanked
                                    "
                                    title="Skicka ett tack till talaren"
                                >
                                    <Icons
                                        name="thumb"
                                        class="h-5 text-gray-500 cursor-pointer hover:text-teal-500"
                                        @click.native="thankSpeaker(booking.id)"
                                    />
                                </span>
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        ) &&
                                        booking.id &&
                                        !booking.exception &&
                                        !booking.no_meeting &&
                                        !booking.upcoming &&
                                        (!booking.grade || !booking.comment)
                                    "
                                    title="Interna kommentarer"
                                >
                                    <Icons
                                        name="comment"
                                        class="h-5 text-gray-500 cursor-pointer hover:text-teal-500"
                                        @click.native="commentBooking(booking.id)"
                                    />
                                </span>
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        ) &&
                                        booking.id &&
                                        booking.upcoming
                                    "
                                    title="Uppdatera bokning"
                                >
                                    <Icons
                                        name="edit"
                                        class="h-5 text-gray-500 cursor-pointer hover:text-teal-500"
                                        @click.native="editBooking(booking.id)"
                                    />
                                </span>
                                <span
                                    v-if="
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        ) &&
                                        booking.id &&
                                        booking.upcoming
                                    "
                                    title="Radera bokning"
                                >
                                    <Icons
                                        name="delete"
                                        class="h-5 text-gray-500 cursor-pointer hover:text-teal-500"
                                        @click.native="confirmBookingDeletion(booking.id)"
                                    />
                                </span>
                                <span
                                    v-if="
                                        !booking.id &&
                                        userHelpers.hasAccess(
                                            'booker',
                                            $page.props.user.role
                                        )
                                    "
                                    title="Skapa en ny bokning"
                                >
                                    <Icons
                                        name="plus"
                                        class="h-5 text-gray-500 cursor-pointer hover:text-teal-500"
                                        @click.native="addBooking(booking.date)"
                                    />
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delete Booking Confirmation Modal -->
        <JetConfirmationModal
            :show="confirmingBookingDeletion"
            @close="confirmingBookingDeletion = false"
        >
            <template #title> Radera bokning </template>

            <template #content>
                Är du säker på att du vill radera den här bokningen?<br />
                Om du vill skicka ett medelande till talaren att bokningen är borttagen
                klickar du på <strong>Radera & Meddela</strong> annars bara på
                <strong>Radera</strong>.
            </template>

            <template #footer>
                <JetSecondaryButton @click.native="confirmingBookingDeletion = false">
                    Avbryt
                </JetSecondaryButton>

                <JetDangerButton
                    class="ml-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click.native="deleteBooking(true)"
                >
                    Radera & Meddela
                </JetDangerButton>

                <JetDangerButton
                    class="ml-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click.native="deleteBooking()"
                >
                    Radera
                </JetDangerButton>
            </template>
        </JetConfirmationModal>
    </div>
</template>

<script>
import Icons from '@Shared/Icons'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'

export default {
    components: {
        Icons,
        JetConfirmationModal,
        JetSecondaryButton,
        JetDangerButton
    },
    props: ['bookings'],
    data() {
        return {
            confirmingBookingDeletion: false,

            form: this.$inertia.form(
                {
                    _method: 'DELETE',
                    message: false,
                    id: '',
                    date: ''
                },
                {
                    bag: 'bookingErrorBag',
                    resetOnSuccess: true
                }
            )
        }
    },
    methods: {
        thankSpeaker(bookingId) {
            this.$inertia.visit(`/bookings/thanks/${bookingId}`)
        },
        commentBooking(bookingId) {
            this.$inertia.visit(`/bookings/comments/${bookingId}`)
        },
        addBooking(date = null) {
            this.form.date = date
            this.form._method = 'POST'

            this.form.post('/bookings/create')
        },
        confirmBookingDeletion(bookingId) {
            this.confirmingBookingDeletion = true
            this.form.id = bookingId
        },
        editBooking(bookingId) {
            this.$inertia.visit(`/bookings/${bookingId}/edit`)
        },
        deleteBooking(message = false) {
            this.form.message = message

            this.form.post('/bookings/' + this.form.id, {
                preserveScroll: true
            })

            this.confirmingBookingDeletion = false
        }
    }
}
</script>
