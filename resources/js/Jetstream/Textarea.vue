<template>
    <textarea
        ref="input"
        :class="error ? 'border-red-700 bg-red-100' : ''"
        class="form-input rounded-md shadow-sm"
        :value="value"
        :rows="rows"
        autocomplete="off"
        @input="$emit('input', $event.target.value)"
    >
    </textarea>
</template>

<script>
export default {
    props: ['value', 'error', 'rows'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>
