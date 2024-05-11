<template>
    <AppLayout title="Blog">
        <template #header>
            <img src="/blog/default.jpg" class="h-40 md:h-56 overflow-hidden lg:h-72 w-full object-cover" />
        </template>

        <Article v-for="post in posts.data" :key="post.id" class="mb-4 last-of-type:mb-0">
            <div class="flex justify-between items-center mb-5 text-gray-500">
                <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                    <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                      Tutorial
                </span>
                <span class="text-sm">{{ formattedDate(post) }} ago</span>
            </div>
            <Link :href="route('posts.show', post.id)" class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-orange-500 dark:hover:text-orange-500 focus:outline-none focus:text-orange-500 dark:focus:text-orange-500 transition duration-150 ease-in-out">
                {{ post.title }}
            </Link>
            <p class="mb-5 font-light text-gray-500 dark:text-gray-400 whitespace-pre-wrap">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img :src="post.user.profile_photo_url" class="w-7 h-7 rounded-full" />
                    <span class="font-medium dark:text-white">{{ post.user.username }}</span>
                </div>
                <DefaultLink
                    :href="route('posts.show', post.id)"
                >
                    Read More
                    <ArrowRightCircleIcon class="ml-2 size-5"/>
                </DefaultLink>
            </div>
        </Article>

        <Paginate :meta="posts.meta" :only="['posts']" />
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Paginate from "@/Components/Paginate.vue";
import Article from "@/Components/Article.vue";
import DefaultLink from "@/Components/DefaultLink.vue";

import {Link} from "@inertiajs/vue3";
import {relativeDate} from "@/date.js";
import {ArrowRightCircleIcon} from "@heroicons/vue/24/outline/index.js";

defineProps(['posts']);

const formattedDate = (post) => relativeDate(post.created_at);

</script>
