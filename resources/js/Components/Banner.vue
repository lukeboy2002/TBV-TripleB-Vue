<script setup>
import {onUnmounted, ref, watchEffect} from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const show = ref(true);
const style = ref('success');
const message = ref('');
const timeout = ref(null);

watchEffect(async () => {
    style.value = page.props.jetstream.flash?.bannerStyle || 'success';
    message.value = page.props.jetstream.flash?.banner || '';
    show.value = true;

    clearTimeout(timeout.value);

    timeout.value = setTimeout(() => show.value = false, 5000);
});

onUnmounted(() => clearTimeout(timeout.value));
</script>

<template>
    <div class="sticky top-0 z-40">
        <div v-if="show && message"
             class="flex items-center p-4 mb-4 rounded-lg dark:hover:bg-gray-900"
             :class="{ 'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400 focus:ring-green-400 hover:bg-green-200': style == 'success', 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400 focus:ring-red-400 hover:bg-red-200': style == 'danger' }">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">-->
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
               {{ message }}
            </div>
            <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8"
                    aria-label="Dismiss"
                    @click.prevent="show = false">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>






<!--        <div v-if="show && message" :class="{ 'bg-green-500': style == 'success', 'bg-red-700': style == 'danger' }">-->
<!--            <div class="flex justify-end py-2 px-3 sm:px-6 lg:px-8">-->
<!--                <div class="flex items-center justify-between flex-wrap">-->
<!--                    <div class="w-0 flex-1 flex items-center min-w-0">-->
<!--                        <span class="flex p-2 rounded-lg" :class="{ 'bg-indigo-600': style == 'success', 'bg-red-600': style == 'danger' }">-->
<!--                            <svg v-if="style == 'success'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">-->
<!--                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />-->
<!--                            </svg>-->

<!--                            <svg v-if="style == 'danger'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">-->
<!--                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />-->
<!--                            </svg>-->
<!--                        </span>-->

<!--                        <p class="ms-3 font-medium text-sm text-white truncate">-->
<!--                            {{ message }}-->
<!--                        </p>-->
<!--                    </div>-->

<!--                    <div class="shrink-0 sm:ms-3">-->
<!--                        <button-->
<!--                            type="button"-->
<!--                            class="-me-1 flex p-2 rounded-md focus:outline-none sm:-me-2 transition"-->
<!--                            :class="{ 'hover:bg-indigo-600 focus:bg-indigo-600': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger' }"-->
<!--                            aria-label="Dismiss"-->
<!--                            @click.prevent="show = false"-->
<!--                        >-->
<!--                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">-->
<!--                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />-->
<!--                            </svg>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>
