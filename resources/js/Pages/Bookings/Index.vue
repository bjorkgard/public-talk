<template>
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Bokningar</h2>
            <HelpButton category="booking" />
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <BookingTable :bookings="bookings" class="mb-2" />

                <div class="flex justify-between">
                    <span class="relative z-0 inline-flex rounded-md shadow-sm">
                        <JetFlatButton
                            class="rounded-l-md"
                            @click.native="goDate(previousMonth)"
                        >
                            &lt;&lt;
                        </JetFlatButton>
                        <JetFlatButton
                            class="-ml-px rounded-r-md"
                            @click.native="goDate(previousWeek)"
                        >
                            &lt;
                        </JetFlatButton>
                    </span>

                    <span class="inline-flex rounded-md shadow-sm">
                        <JetSecondaryButton @click.native="goToday()">
                            Idag
                        </JetSecondaryButton>
                    </span>

                    <span class="relative z-0 inline-flex rounded-md shadow-sm">
                        <JetFlatButton
                            class="rounded-l-md"
                            @click.native="goDate(nextWeek)"
                        >
                            &gt;
                        </JetFlatButton>
                        <JetFlatButton
                            class="-ml-px rounded-r-md"
                            @click.native="goDate(nextMonth)"
                        >
                            &gt;&gt;
                        </JetFlatButton>
                    </span>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import BookingTable from './BookingTable'
import JetFlatButton from '@/Jetstream/FlatButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import HelpButton from '@Shared/HelpButton'

export default {
    components: {
        AppLayout,
        BookingTable,
        JetFlatButton,
        JetSecondaryButton,
        HelpButton
    },
    props: ['bookings', 'previousWeek', 'previousMonth', 'nextWeek', 'nextMonth'],
    methods: {
        goToday() {
            this.$inertia.visit('/bookings')
        },
        goDate(date) {
            this.$inertia.visit(`/bookings?startDate=${date}`)
        }
    }
}
</script>
