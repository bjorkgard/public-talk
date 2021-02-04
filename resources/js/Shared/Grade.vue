<template>
    <div class="">
        <icons name="star" :fill="grade >= 1 ? 'text-teal-500' : 'text-gray-200'" class="-m-1 w-5" />
        <icons name="star" :fill="grade >= 2 ? 'text-teal-500' : 'text-gray-200'" class="-m-1 w-5" />
        <icons name="star" :fill="grade >= 3 ? 'text-teal-500' : 'text-gray-200'" class="-m-1 w-5" />
        <icons name="star" :fill="grade >= 4 ? 'text-teal-500' : 'text-gray-200'" class="-m-1 w-5" />
        <icons name="star" :fill="grade >= 5 ? 'text-teal-500' : 'text-gray-200'" class="-m-1 w-5" />
    </div>
</template>

<script>
    import Icons from './Icons'

    export default {
        components: {
            Icons
        },
        props: ['grade']
    }

</script>
