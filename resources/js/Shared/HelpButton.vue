<template>
    <Icons
        name="help"
        title="Visa hjälptext"
        class="w-6 h-6 text-blue-500 cursor-pointer hover:text-blue-900"
        @click.native="showHelp"
    />
</template>

<script>
import Icons from '@Shared/Icons'

export default {
    name: 'HelpButton',
    components: { Icons },
    props: {
        category: {
            type: String,
            default: 'general'
        }
    },
    methods: {
        showHelp() {
            this.$root.$emit('help', this.category)
        }
    }
}
</script>
