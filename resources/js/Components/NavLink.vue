<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center text-white bg-orange-500 hover:bg-orange-600 focus:ring-1 focus:ring-orange-100 font-medium rounded-lg text-sm px-5 py-2 my-3 focus:outline-none transition duration-150 ease-in-out'
        : 'inline-flex items-center dark:text-white bg-gray-200 dark:bg-gray-600 hover:bg-orange-500 dark:hover:bg-orange-500 focus:ring-1 focus:ring-orange-100 font-medium rounded-lg text-sm px-5 py-2 my-3 hover:text-white focus:outline-none focus:text-white transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

