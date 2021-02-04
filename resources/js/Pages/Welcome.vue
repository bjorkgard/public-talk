<template>
    <div>
        <div class="relative bg-white overflow-hidden">
            <div class="max-w-screen-xl mx-auto">
                <div
                    class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32"
                >
                    <svg
                        class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                        fill="currentColor"
                        viewBox="0 0 100 100"
                        preserveAspectRatio="none"
                    >
                        <polygon points="50,0 100,0 50,100 0,100" />
                    </svg>

                    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                        <nav
                            class="relative flex items-center justify-between w-full sm:h-10 lg:justify-start"
                        >
                            <div
                                class="flex items-center flex-grow flex-shrink-0 w-full lg:flex-grow-0"
                            >
                                <div class="flex items-center justify-between w-full">
                                    <a href="/" aria-label="Home">
                                        <img
                                            class="h-14 w-auto sm:h-14"
                                            src="img/logotype.svg"
                                            alt="Logotype"
                                        />
                                    </a>

                                    <div class="hidden sm:block">
                                        <inertia-link
                                            v-if="$page.props.user"
                                            :href="route('bookings.index')"
                                            class="ml-8 font-medium text-teal-700 hover:text-teal-600 transition duration-150 ease-in-out"
                                        >
                                            Bokningar
                                        </inertia-link>

                                        <inertia-link
                                            v-if="!$page.props.user"
                                            :href="route('register')"
                                            class="ml-8 font-medium text-gray-700 hover:text-teal-600 transition duration-150 ease-in-out"
                                        >
                                            Skapa konto
                                        </inertia-link>
                                        <inertia-link
                                            v-if="!$page.props.user"
                                            :href="route('login')"
                                            class="ml-8 font-medium text-teal-700 hover:text-teal-600 transition duration-150 ease-in-out"
                                        >
                                            Logga in
                                        </inertia-link>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <main
                        class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28"
                    >
                        <div class="sm:text-center lg:text-left">
                            <h2
                                class="text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl"
                            >
                                Håll ordning på
                                <br class="xl:hidden" />
                                <span class="text-teal-600"
                                    >församlingens föreläsningar</span
                                >
                            </h2>
                            <p
                                class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0"
                            >
                                Public Talk är en webbapplikation som hjälper
                                föredragsbokaren att hålla ordning på schemat för
                                föreläsningar i församlingen.
                            </p>
                            <div
                                class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start"
                            >
                                <div>
                                    <inertia-link
                                        as="button"
                                        :href="route('register')"
                                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-teal-700 bg-teal-100 hover:text-teal-600 hover:bg-teal-50 focus:outline-none focus:shadow-outline-teal focus:border-teal-300 transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10"
                                    >
                                        Skapa konto
                                    </inertia-link>
                                </div>

                                <div class="rounded-md shadow mt-3 sm:mt-0 sm:ml-3">
                                    <inertia-link
                                        as="button"
                                        :href="route('login')"
                                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-teal-600 hover:bg-teal-500 focus:outline-none focus:border-teal-700 focus:shadow-outline-teal transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10"
                                    >
                                        Logga in
                                    </inertia-link>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <img
                    class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                    src="img/IMG_1436.png"
                    alt=""
                />
            </div>
        </div>

        <!-- Overview -->
        <div class="bg-white flex-grow">
            <div class="max-w-screen-xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl leading-9 font-extrabold text-gray-900">
                        Översikt
                    </h2>
                    <p class="mt-4 text-lg leading-7 text-gray-500">
                        Public Talk gör det enkelt att skapa och underhålla schemat för
                        offentliga föreläsningar i församlingen.
                    </p>
                </div>
                <dl
                    class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-2 sm:col-gap-6 sm:row-gap-12 lg:grid-cols-4 lg:col-gap-8"
                >
                    <div class="flex space-x-3">
                        <!-- Heroicon name: check -->
                        <svg
                            class="flex-shrink-0 h-6 w-6 text-teal-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        <div class="space-y-2">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Talare
                            </dt>
                            <dd class="flex space-x-3 lg:py-0 lg:pb-4">
                                <span class="text-base leading-6 text-gray-500">
                                    Skapa en lista över offentliga talare och deras
                                    kontaktinformation.
                                </span>
                            </dd>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <!-- Heroicon name: check -->
                        <svg
                            class="flex-shrink-0 h-6 w-6 text-teal-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        <div class="space-y-2">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Påminnelser
                            </dt>
                            <dd class="flex space-x-3">
                                <span class="text-base leading-6 text-gray-500">
                                    Skicka automatiska påminnelser till talare och
                                    ordförande.
                                </span>
                            </dd>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <!-- Heroicon name: check -->
                        <svg
                            class="flex-shrink-0 h-6 w-6 text-teal-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        <div class="space-y-2">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Schema
                            </dt>
                            <dd class="flex space-x-3">
                                <span class="text-base leading-6 text-gray-500">
                                    Skapa och underhåll schemat för offentliga
                                    föreläsningar.
                                </span>
                            </dd>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <!-- Heroicon name: check -->
                        <svg
                            class="flex-shrink-0 h-6 w-6 text-teal-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        <div class="space-y-2">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Överskådligt
                            </dt>
                            <dd class="flex space-x-3">
                                <span class="text-base leading-6 text-gray-500">
                                    Se tillgängliga datum för att enkelt bjuda in talare.
                                </span>
                            </dd>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <!-- Heroicon name: check -->
                        <svg
                            class="flex-shrink-0 h-6 w-6 text-teal-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        <div class="space-y-2">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Historik
                            </dt>
                            <dd class="flex space-x-3">
                                <span class="text-base leading-6 text-gray-500">
                                    Se historken över vilka föreläsningar som har hållits
                                    i din församling.
                                </span>
                            </dd>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <!-- Heroicon name: check -->
                        <svg
                            class="flex-shrink-0 h-6 w-6 text-teal-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        <div class="space-y-2">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Exportera
                            </dt>
                            <dd class="flex space-x-3 lg:border-t-0 lg:py-0 lg:pb-4">
                                <span class="text-base leading-6 text-gray-500">
                                    Skriv ut ett schema för att sätta upp på
                                    anslagstavlan.
                                </span>
                            </dd>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <!-- Heroicon name: check -->
                        <svg
                            class="flex-shrink-0 h-6 w-6 text-teal-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        <div class="space-y-2">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Lätttillgänglig
                            </dt>
                            <dd class="flex space-x-3">
                                <span class="text-base leading-6 text-gray-500">
                                    Webbapplikationen fungerar i alla aktuella webbläsare
                                    och på alla digitala enheter.
                                </span>
                            </dd>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <!-- Heroicon name: check -->
                        <svg
                            class="flex-shrink-0 h-6 w-6 text-teal-900"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                        <div class="space-y-2">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Kostnadsfri
                            </dt>
                            <dd class="flex space-x-3">
                                <span class="text-base leading-6 text-gray-500">
                                    Publik Talk kommer alltid att vara gratis och fri från
                                    månatliga kostnader.
                                </span>
                            </dd>
                        </div>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-white bottom-0 min-w-full border-t border-gray-300">
            <div
                class="max-w-screen-xl mx-auto py-6 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8"
            >
                <div class="hidden md:flex justify-center md:order-2 md:visible">
                    <a
                        href="https://twitter.com/jwapp_info"
                        target="_blank"
                        class="ml-6 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
                            />
                        </svg>
                    </a>
                </div>
                <div class="flex items-center mt-0 md:order-1">
                    <img class="h-6 w-6" src="/img/signature.png" />
                    <p class="text-center text-base leading-6 text-gray-400">
                        2021<span v-if="new Date().getFullYear() > 2021"
                            >-{{ new Date().getFullYear() }}</span
                        >
                        | jwapp.info | v{{ $page.props.app.version }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {}
</script>
