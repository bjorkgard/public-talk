<template>
    <div
        class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end"
    >
        <transition
            enter-active-class="transition ease-out duration-300 transform"
            enter-class="ranslate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
            leave-active-class="transition ease-in duration-100"
            leave-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-show="show"
                :class="message.type === 'success' ? 'bg-green-100' : 'bg-red-100'"
                class="max-w-sm w-full shadow-lg rounded-lg pointer-events-auto"
            >
                <div class="rounded-lg shadow-xs overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <!-- Heroicon name: check-circle -->
                                <svg
                                    v-if="message.type === 'success'"
                                    class="h-6 w-6 text-green-400"
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

                                <svg
                                    v-else
                                    class="h-6 w-6 text-red-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm leading-5 font-medium text-gray-900">
                                    {{ message.text }}
                                </p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <button
                                    class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
                                    @click.prevent="hideMessage"
                                >
                                    <!-- Heroicon name: x -->
                                    <svg
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </div>
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
            message: null
        }
    },
    watch: {
        '$page.props.flash': {
            handler() {
                console.log('flashing....')
                if (this.$page.props.flash.success) {
                    this.message.type = 'success'
                    this.message.text = this.$page.props.flash.success
                } else {
                    this.message.type = 'fail'
                    this.message.text = this.$page.props.flash.fail
                }
                this.interval = setInterval(() => this.hideMessage(), 5000)
                this.show = true
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
