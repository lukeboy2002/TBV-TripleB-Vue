<template>
    <AppLayout title="Blog">
        <template #header>
                <img :src="post.image" class="h-40 md:h-56 overflow-hidden lg:h-72 w-full object-cover" />
        </template>
        <Article class="mb-4 last-of-type:mb-0">
            <div class="flex justify-between items-center mb-5 text-gray-500">
                <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                    <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                      Tutorial
                </span>
                <span class="text-sm">{{ formattedDate }} ago by {{ post.user.username }}</span>
            </div>
            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ post.title }}</h2>
            <p class="mb-5 font-light text-gray-500 dark:text-gray-400 whitespace-pre-wrap">{{ post.body }}</p>
        </Article>
        <template #side>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                TO BE CONTINUED...
            </h2>
        </template>
    </AppLayout>
</template>

<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import Article from "@/Components/Article.vue";
import {computed} from "vue";
import {formatDistance, parseISO} from "date-fns";

const props = defineProps(['post']);

const formattedDate = computed(() => formatDistance(parseISO(props.post.created_at), new Date()));

</script>
