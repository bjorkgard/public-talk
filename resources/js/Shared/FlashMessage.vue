<template>
    <div
        class="z-50 fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end"
    >
        <transition
            enter-active-class="transform ease-out duration-300 transition"
            enter-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
            leave-active-class="transition ease-in duration-100"
            leave-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-show="show"
                class="max-w-sm w-full bg-gray-50 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden border border-transparent dark:bg-black dark:border-gray-700"
            >
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg
                                class="h-6 w-6 text-teal-400"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p
                                class="text-sm font-medium text-gray-900 dark:text-gray-400"
                            >
                                {{ message }}
                            </p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button
                                class="bg-gray-50 rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 dark:bg-black dark:text-gray-400"
                                @click="hideMessage"
                            >
                                <span class="sr-only">Stäng</span>
                                <svg
                                    class="h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
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
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: false,
            message: ''
        }
    },
    watch: {
        '$page.flash': {
            handler() {
                if (this.$page.props.flash.success) {
                    this.message = this.$page.props.flash.success

                    this.show = true

                    this.interval = setInterval(() => this.hideMessage(), 5000)
                }
            },
            deep: true
        }
    },
    methods: {
        hideMessage() {
            this.show = false
            this.message = ''
        }
    }
}
</script>
