<template>
    <inertia-link :href="link ? link : '#'"
        :class="link ? 'border-gray-300 text-gray-700  hover:text-gray-500' : 'border-gray-100 text-gray-400 cursor-not-allowed'"
        class="relative inline-flex items-center px-4 py-2 border text-sm leading-5 font-medium rounded-md bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['link']
    }

</script>
