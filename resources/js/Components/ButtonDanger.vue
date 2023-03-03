<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="rounded-full bg-red-700 py-2 px-4 text-sm font-semibold text-white hover:bg-red-500 focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-300/50 active:bg-red-500 transition ease-in-out duration-200">
        <slot />
    </button>
</template>
