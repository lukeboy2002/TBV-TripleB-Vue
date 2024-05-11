<template>
    <div v-show="message" class="mt-2">

        <div class="p-4 mb-4 flex text-sm text-red-800 border border-red-800 rounded-lg bg-red-50 dark:bg-gray-600 dark:text-red-400" role="alert">
            <ExclamationTriangleIcon class="size-5 mr-2" />
            <div>{{ message }}</div>
        </div>

<!--        <p class="text-sm text-red-600 inline-flex">-->
<!--            <ExclamationTriangleIcon class="size-5" />{{ message }}-->
<!--        </p>-->
    </div>
</template>

<script setup>
import {ExclamationTriangleIcon} from "@heroicons/vue/24/outline";

defineProps({
    message: String,
});
</script>
