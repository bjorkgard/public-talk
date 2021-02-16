<template>
    <div>
        <JetBanner />

        <div class="flex flex-col min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex items-center flex-shrink-0">
                                <inertia-link href="/bookings">
                                    <JetApplicationMark class="block w-auto h-9" />
                                </inertia-link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <JetNavLink
                                    href="/bookings"
                                    :active="$page.url.includes('bookings')"
                                >
                                    Bokningar
                                </JetNavLink>
                                <JetNavLink
                                    href="/speakers"
                                    :active="$page.url.includes('speakers')"
                                >
                                    Talare
                                </JetNavLink>
                                <JetNavLink
                                    href="/talks"
                                    :active="$page.url.includes('talks')"
                                >
                                    Föreläsningar
                                </JetNavLink>
                                <JetNavLink
                                    href="/chairmen"
                                    :active="$page.url.includes('chairmen')"
                                >
                                    Ordförande
                                </JetNavLink>
                                <JetNavLink
                                    v-if="
                                        userHelpers.hasAccess(
                                            'admin',
                                            $page.props.user.role
                                        )
                                    "
                                    href="/users"
                                    :active="$page.url.includes('users')"
                                >
                                    Användare
                                </JetNavLink>
                                <JetNavLink
                                    v-if="
                                        userHelpers.hasAccess(
                                            'admin',
                                            $page.props.user.role
                                        )
                                    "
                                    href="/settings"
                                    :active="$page.url == '/settings'"
                                >
                                    Inställningar
                                </JetNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="relative ml-3">
                                <JetDropdown align="right" width="48">
                                    <template #trigger>
                                        <button
                                            v-if="
                                                $page.props.jetstream.managesProfilePhotos
                                            "
                                            class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300"
                                        >
                                            <img
                                                class="object-cover w-8 h-8 rounded-full"
                                                :src="$page.props.user.profile_photo_url"
                                                :alt="$page.props.user.name"
                                            />
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none"
                                            >
                                                {{ $page.props.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div
                                            class="block px-4 py-2 text-xs text-gray-400"
                                        >
                                            Hantera konto
                                        </div>

                                        <JetDropdownLink :href="route('profile.show')">
                                            Profil
                                        </JetDropdownLink>

                                        <JetDropdownLink
                                            v-if="
                                                $page.props.jetstream.hasApiFeatures &&
                                                userHelpers.hasAccess(
                                                    'booker',
                                                    $page.props.user.role
                                                )
                                            "
                                            :href="route('api-tokens.index')"
                                        >
                                            API-Token
                                        </JetDropdownLink>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <JetDropdownLink as="button">
                                                Logga ut
                                            </JetDropdownLink>
                                        </form>
                                    </template>
                                </JetDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="flex items-center -mr-2 sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500"
                                @click="
                                    showingNavigationDropdown = !showingNavigationDropdown
                                "
                            >
                                <svg
                                    class="w-6 h-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown
                                        }"
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

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <JetResponsiveNavLink
                            href="/bookings"
                            :active="$page.url == '/bookings'"
                        >
                            Bokningar
                        </JetResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div
                                v-if="$page.props.jetstream.managesProfilePhotos"
                                class="flex-shrink-0 mr-3"
                            >
                                <img
                                    class="object-cover w-10 h-10 rounded-full"
                                    :src="$page.props.user.profile_photo_url"
                                    :alt="$page.props.user.name"
                                />
                            </div>

                            <div>
                                <div class="text-base font-medium text-gray-800">
                                    {{ $page.props.user.name }}
                                </div>
                                <div class="text-sm font-medium text-gray-500">
                                    {{ $page.props.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <JetResponsiveNavLink
                                href="/bookings"
                                :active="$page.url.includes('bookings')"
                            >
                                Bokningar
                            </JetResponsiveNavLink>
                            <JetResponsiveNavLink
                                href="/speakers"
                                :active="$page.url.includes('speakers')"
                            >
                                Talare
                            </JetResponsiveNavLink>
                            <JetResponsiveNavLink
                                href="/talks"
                                :active="$page.url.includes('talks')"
                            >
                                Föreläsningar
                            </JetResponsiveNavLink>
                            <JetResponsiveNavLink
                                href="/chairmen"
                                :active="$page.url.includes('chairmen')"
                            >
                                Ordförande
                            </JetResponsiveNavLink>
                            <JetResponsiveNavLink
                                v-if="
                                    userHelpers.hasAccess('admin', $page.props.user.role)
                                "
                                href="/users"
                                :active="$page.url.includes('users')"
                            >
                                Användare
                            </JetResponsiveNavLink>
                            <JetResponsiveNavLink
                                v-if="
                                    userHelpers.hasAccess('admin', $page.props.user.role)
                                "
                                href="/settings"
                                :active="$page.url == '/settings'"
                            >
                                Inställningar
                            </JetResponsiveNavLink>

                            <JetResponsiveNavLink
                                :href="route('profile.show')"
                                :active="route().current('profile.show')"
                            >
                                Profil
                            </JetResponsiveNavLink>

                            <JetResponsiveNavLink
                                v-if="
                                    $page.props.jetstream.hasApiFeatures &&
                                    userHelpers.hasAccess('booker', $page.props.user.role)
                                "
                                :href="route('api-tokens.index')"
                                :active="route().current('api-tokens.index')"
                            >
                                API-Token
                            </JetResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <JetResponsiveNavLink as="button">
                                    Logga ut
                                </JetResponsiveNavLink>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div
                    class="flex justify-between px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8"
                >
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1">
                <slot></slot>
            </main>

            <!-- Modal Portal -->
            <portal-target name="modal" multiple> </portal-target>

            <Help :show="showHelp" :category="category" @hide="showHelp = false" />
            <FlashMessage />
            <NavFooter />
        </div>
    </div>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetBanner from '@/Jetstream/Banner'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import FlashMessage from '@Shared/FlashMessage'
import NavFooter from '@Shared/Footer'
import Help from '@Shared/Help'

export default {
    components: {
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        FlashMessage,
        NavFooter,
        Help
    },

    data() {
        return {
            showingNavigationDropdown: false,
            showHelp: false,
            category: ''
        }
    },
    mounted() {
        this.$root.$on('help', this.activateHelp)
    },

    methods: {
        activateHelp(category) {
            this.showHelp = true
            this.category = category
        },
        logout() {
            this.$inertia.post('/logout')
        }
    }
}
</script>
