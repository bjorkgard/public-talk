<template>
    <input
        v-model="proxyChecked"
        type="checkbox"
        :value="value"
        class="rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-50"
    />
</template>

<script>
export default {
    model: {
        prop: 'checked',
        event: 'change'
    },

    props: {
        checked: {
            type: [Array, Boolean],
            default: false
        },
        value: {
            default: null
        }
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked
            },
            set(val) {
                this.$emit('change', val)
            }
        }
    }
}
</script>
