<template>
  <div class="relative rounded-md shadow-sm">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
      <!-- Heroicon name: search -->
      <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
      </svg>
    </div>
    <input class="form-input block w-full pl-10 sm:text-sm sm:leading-5" type="search" placeholder="Sök..." ref="input" :value="value" @input="$emit('input', $event.target.value)">
  </div>
</template>

<script>
    export default {
        props: ['value'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }

</script>
