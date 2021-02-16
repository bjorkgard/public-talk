<template>
    <transition :duration="700">
        <div v-show="show">
            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <transition
                        enter-active-class="duration-500 ease-in-out"
                        enter-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="duration-500 ease-in-out"
                        leave-class="opacity-100"
                        leave-to-class="opacity-0"
                    >
                        <div
                            v-show="show"
                            class="absolute inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                            aria-hidden="true"
                        />
                    </transition>
                    <section
                        class="absolute inset-y-0 right-0 flex max-w-full pl-10"
                        aria-labelledby="slide-over-heading"
                    >
                        <transition
                            enter-active-class="transition duration-500 ease-in-out transform sm:duration-700"
                            enter-class="translate-x-full"
                            enter-to-class="translate-x-0"
                            leave-active-class="transition duration-500 ease-in-out transform sm:duration-700"
                            leave-class="translate-x-0"
                            leave-to-class="translate-x-full"
                        >
                            <div v-show="show" class="w-screen max-w-md">
                                <div
                                    class="flex flex-col h-full py-6 overflow-y-scroll bg-white shadow-xl"
                                >
                                    <div class="px-4 sm:px-6">
                                        <div class="flex items-start justify-between">
                                            <h2
                                                id="slide-over-heading"
                                                class="text-lg font-medium text-gray-900"
                                            >
                                                Hjälp
                                            </h2>
                                            <div class="flex items-center ml-3 h-7">
                                                <button
                                                    class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    @click="$emit('hide')"
                                                >
                                                    <span class="sr-only">Stäng</span>
                                                    <!-- Heroicon name: outline/x -->
                                                    <svg
                                                        class="w-6 h-6"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12"
                                                        />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative flex-1 px-4 mt-6 sm:px-6">
                                        <!-- Accordion -->
                                        <div>
                                            <!-- General -->
                                            <div
                                                class="flex justify-between p-2 text-gray-700 bg-white border-t border-gray-300 rounded cursor-pointer hover:bg-gray-100"
                                                @click.prevent="
                                                    showGeneral = !showGeneral
                                                "
                                            >
                                                <strong>API-token</strong>
                                                <Icons
                                                    v-show="!showGeneral"
                                                    name="up"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                                <Icons
                                                    v-show="showGeneral"
                                                    name="down"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                            </div>
                                            <div
                                                v-show="showGeneral"
                                                class="p-2 space-y-1 text-sm"
                                            >
                                                <p>
                                                    För att en annan webbapplikationer
                                                    skall kunna hämta information om
                                                    bokningar krävs det en API-token.
                                                </p>
                                                <p>
                                                    Du kan skapa en sådan token genom att
                                                    klicka på din profilbild eller
                                                    initialer högst upp till höger på
                                                    sidan och välja API-token.<br />Skapa
                                                    sedan en token med läsrättigheter och
                                                    spara den kod som du får.
                                                </p>
                                            </div>

                                            <!-- Bookings -->
                                            <div
                                                class="flex justify-between p-2 text-gray-700 bg-white border-t border-gray-300 rounded cursor-pointer hover:bg-gray-100"
                                                @click.prevent="
                                                    showBooking = !showBooking
                                                "
                                            >
                                                <strong>Bokningar</strong>
                                                <Icons
                                                    v-show="!showBooking"
                                                    name="up"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                                <Icons
                                                    v-show="showBooking"
                                                    name="down"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                            </div>
                                            <div
                                                v-show="showBooking"
                                                class="p-2 space-y-1 text-sm"
                                            >
                                                <p>
                                                    För att kunna skapa bokningar måste du
                                                    först ha talare och ordförande sparade
                                                    i applikationen.
                                                </p>
                                                <p>
                                                    För att göra en ny bokning klickar du
                                                    på plus-symbolen antingen högst upp
                                                    till höger i tabellen eller på ett
                                                    ledigt datum. Om du har slagit på
                                                    notifieringar under inställningar
                                                    kommer talaren få ett meddelande via
                                                    e-post med bokningsinformation.
                                                </p>
                                                <p>
                                                    Behöver du redigera en befintlig
                                                    bokning klickar du på symbolen med en
                                                    penna för att komma till
                                                    redigeringsläget.
                                                </p>
                                                <p>
                                                    För att avboka en föreläsning klickar
                                                    du på papperskorgen. Du kommer då att
                                                    få en varning samt en fråga om du vill
                                                    skicka en avbokningsbekräftelse till
                                                    talaren eller inte.
                                                </p>
                                            </div>

                                            <!-- Speakers -->
                                            <div
                                                class="flex justify-between p-2 text-gray-700 bg-white border-t border-gray-300 rounded cursor-pointer hover:bg-gray-100"
                                                @click.prevent="
                                                    showSpeaker = !showSpeaker
                                                "
                                            >
                                                <strong>Talare</strong>
                                                <Icons
                                                    v-show="!showSpeaker"
                                                    name="up"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                                <Icons
                                                    v-show="showSpeaker"
                                                    name="down"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                            </div>
                                            <div
                                                v-show="showSpeaker"
                                                class="p-2 space-y-1 text-sm"
                                            >
                                                <p>
                                                    För att lägga till en talare klickar
                                                    du på plus-symbolen högst upp till
                                                    höger i tabellen.
                                                </p>
                                                <p>
                                                    Om du vill ändra kontaktuppgifter på
                                                    en talare, lägga till eller ta bort
                                                    föreläsningar som talaren har
                                                    utarbetat klickar du på pennan.
                                                </p>
                                                <p>
                                                    Du kan ta bort en talare genom att
                                                    klicka på papperskorgen. Är talaren
                                                    inbokad på en kommande föreläsning
                                                    kommer du att få en varning via
                                                    e-post.
                                                </p>
                                                <p>
                                                    Du kan se vilka föreläsningar en
                                                    talare har genom att klicka på
                                                    <Icons
                                                        name="document"
                                                        class="w-4 h-4 text-gray-500"
                                                    />
                                                    och du kan boka in en talare genom att
                                                    klicka på
                                                    <Icons
                                                        name="book"
                                                        class="w-4 h-4 text-gray-500"
                                                    />.
                                                </p>
                                            </div>

                                            <!-- Talks -->
                                            <div
                                                class="flex justify-between p-2 text-gray-700 bg-white border-t border-gray-300 rounded cursor-pointer hover:bg-gray-100"
                                                @click.prevent="showTalk = !showTalk"
                                            >
                                                <strong>Föreläsningar</strong>
                                                <Icons
                                                    v-show="!showTalk"
                                                    name="up"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                                <Icons
                                                    v-show="showTalk"
                                                    name="down"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                            </div>
                                            <div
                                                v-show="showTalk"
                                                class="p-2 space-y-1 text-sm"
                                            >
                                                <p>
                                                    Du kan se vilka talare som har en
                                                    specifik föreläsning genom att klicka
                                                    på
                                                    <Icons
                                                        name="users"
                                                        class="w-4 h-4 text-gray-500"
                                                    />
                                                    och du kan boka in en föreläsning
                                                    genom att klicka på
                                                    <Icons
                                                        name="book"
                                                        class="w-4 h-4 text-gray-500"
                                                    />.
                                                </p>
                                            </div>

                                            <!-- Chairmen -->
                                            <div
                                                class="flex justify-between p-2 text-gray-700 bg-white border-t border-gray-300 rounded cursor-pointer hover:bg-gray-100"
                                                @click.prevent="
                                                    showChairman = !showChairman
                                                "
                                            >
                                                <strong>Ordförande</strong>
                                                <Icons
                                                    v-show="!showChairman"
                                                    name="up"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                                <Icons
                                                    v-show="showChairman"
                                                    name="down"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                            </div>
                                            <div
                                                v-show="showChairman"
                                                class="p-2 space-y-1 text-sm"
                                            >
                                                <p>
                                                    För att lägga till en ordförande
                                                    klickar du på plus-symbolen högst upp
                                                    till höger i tabellen.
                                                </p>
                                                <p>
                                                    Om du vill ändra kontaktuppgifter på
                                                    en ordförande klickar du på pennan.
                                                </p>
                                                <p>
                                                    Du kan ta bort en ordförande genom att
                                                    klicka på papperskorgen. Är ordförande
                                                    inbokad på en kommande föreläsning
                                                    kommer ordförandeposten att lämnas
                                                    tom.
                                                </p>
                                            </div>

                                            <!-- User -->
                                            <div
                                                class="flex justify-between p-2 text-gray-700 bg-white border-t border-gray-300 rounded cursor-pointer hover:bg-gray-100"
                                                @click.prevent="showUser = !showUser"
                                            >
                                                <strong>Användare</strong>
                                                <Icons
                                                    v-show="!showUser"
                                                    name="up"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                                <Icons
                                                    v-show="showUser"
                                                    name="down"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                            </div>
                                            <div
                                                v-show="showUser"
                                                class="p-2 space-y-1 text-sm"
                                            >
                                                <p>
                                                    För att lägga till en användare
                                                    klickar du på plus-symbolen högst upp
                                                    till höger i tabellen.
                                                </p>
                                                <p>
                                                    När du har skapat en ny användare
                                                    behöver du informera användaren om att
                                                    han behöver acceptera sin inloggning.
                                                    Detta gör du enklast genom att klicka
                                                    på
                                                    <Icons
                                                        name="link"
                                                        class="w-4 h-4 text-gray-500"
                                                    />.
                                                </p>
                                                <p>
                                                    Om du vill ändra kontaktuppgifter
                                                    eller behörighet på en användare
                                                    klickar du på pennan.
                                                </p>
                                                <p>
                                                    Du kan ta bort en användare genom att
                                                    klicka på papperskorgen. Det går inte
                                                    att ta bort en användare som har Full
                                                    behörighet utan du behöver först ändra
                                                    användarens behörighet.<br />Observera
                                                    att du måste ha minst en användare som
                                                    har Full behörighet eller
                                                    Administrator.
                                                </p>
                                            </div>

                                            <!-- Settings -->
                                            <div
                                                class="flex justify-between p-2 text-gray-700 bg-white border-t border-gray-300 rounded cursor-pointer hover:bg-gray-100"
                                                @click.prevent="
                                                    showSettings = !showSettings
                                                "
                                            >
                                                <strong>Inställningar</strong>
                                                <Icons
                                                    v-show="!showSettings"
                                                    name="up"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                                <Icons
                                                    v-show="showSettings"
                                                    name="down"
                                                    class="w-5 h-5 text-gray-500"
                                                />
                                            </div>
                                            <div
                                                v-show="showSettings"
                                                class="p-2 space-y-1 text-sm"
                                            >
                                                <p>
                                                    Här fyller du information om adressen
                                                    till Rikets sal och vilken mötestid ni
                                                    har.
                                                </p>
                                                <p>
                                                    Extra information är information som
                                                    du vill skall skickas med till talaren
                                                    vid en bokning.<br />Det kan handla om
                                                    mötestid och lösenord för Zoom eller
                                                    liknande.
                                                </p>
                                                <p>
                                                    Under meddelanden kan du välja vilka
                                                    notifieringar som applikationen skall
                                                    skicka ut.
                                                </p>
                                            </div>
                                        </div>
                                        <!-- End Accordian -->
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </section>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import Icons from '@Shared/Icons'

export default {
    name: 'Help',
    components: { Icons },
    props: {
        show: {
            type: Boolean,
            default: false
        },
        category: {
            type: String,
            default: 'general'
        }
    },
    data() {
        return {
            showGeneral: false,
            showBooking: false,
            showSpeaker: false,
            showTalk: false,
            showChairman: false,
            showUser: false,
            showSettings: false
        }
    },
    watch: {
        category: {
            immediate: true,
            handler(val) {
                switch (val) {
                    case 'general':
                        this.showGeneral = true
                        break
                    case 'booking':
                        this.showBooking = true
                        break
                    case 'speaker':
                        this.showSpeaker = true
                        break
                    case 'talk':
                        this.showTalk = true
                        break
                    case 'chairman':
                        this.showChairman = true
                        break
                    case 'user':
                        this.showUser = true
                        break
                    case 'settings':
                        this.showSettings = true
                        break
                }
            }
        }
    }
}
</script>
