<template>
    <svg
        v-if="name === 'users'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"
        />
    </svg>
    <svg
        v-else-if="name === 'clock'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'star'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
        />
    </svg>
    <svg
        v-else-if="name === 'plus'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'delete'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'edit'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
        />
    </svg>
    <svg
        v-else-if="name === 'up'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'down'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'book'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
            clip-rule="evenodd"
        />
        <path
            d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"
        />
    </svg>
    <svg
        v-else-if="name === 'document'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'warning'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'thumb'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"
        />
    </svg>
    <svg
        v-else-if="name === 'comment'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'link'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'help'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'exception'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
            clip-rule="evenodd"
        />
    </svg>
    <svg
        v-else-if="name === 'info'"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        class="inline-block fill-current"
        :class="fill"
    >
        <path
            fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
            clip-rule="evenodd"
        />
    </svg>
</template>

<script>
export default {
    props: ['name', 'fill']
}
</script>
