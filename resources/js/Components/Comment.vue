<template>
    <div class="mb-6 ms-10">
        <div class="absolute flex items-center justify-center size-8 rounded-full -start-4 ring-8 ring-white dark:ring-gray-700">
            <img class="rounded-full shadow-lg" :src="comment.user.profile_photo_url" alt="{{ comment.user.username }}" />
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
            <div class="items-center justify-between mb-3 sm:flex">
                <div class="text-sm font-normal text-gray-500 lex dark:text-gray-300">{{ comment.user.username }} commented</div>
                <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{ relativeDate(comment.created_at) }} ago</time>
            </div>
            <div class="p-3 text-xs font-normal text-gray-500 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">
                {{ comment.body }}
            </div>
            <div class="flex justify-end mt-1">
                <form v-if="comment.can?.delete" @submit.prevent="$emit('delete', comment.id)">
                    <DangerButton type="submit">
                        <TrashIcon class="size-4" />
                    </DangerButton>
                </form>
            </div>
        </div>

    </div>
</template>

<script setup>
import DangerButton from "@/Components/DangerButton.vue";

import {relativeDate} from "@/date.js";
import {TrashIcon} from "@heroicons/vue/24/outline";

const props = defineProps(['comment']);
const emit = defineEmits(['delete']);
</script>
