<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    as: String,
});
</script>

<template>
    <div>
        <Link :href="href" class="inline-flex px-4 py-2 text-sm leading-5 text-gray-900 dark:text-white hover:text-orange-500 dark:hover:text-orange-500 dark:focus:outline-none focus:text-orange-500 dark:focus:text-orange-500 transition duration-150 ease-in-out">
            <slot />
        </Link>
    </div>
</template>
