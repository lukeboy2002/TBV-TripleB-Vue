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
        <div class="mt-4">
            <h2 class="text-xl font-semibold text-orange-500 w-full">Comments</h2>
            <div class="border-t border-orange-500 mb-8 w-1/6 sm:w-1/12 "></div>
            <div class="mx-6">
                <div class="mb-6 ms-10">
                    <form v-if="$page.props.auth.user" @submit.prevent="() => commentIdBeingEdited ? updateComment() : addComment()" class="mt-4">
                        <div>
                            <InputLabel for="body" class="sr-only">Comment</InputLabel>
                            <TextArea ref="commentTextAreaRef" id="body" v-model="commentForm.body" rows="4" placeholder="Write your comment here..."/>
                            <InputError :message="commentForm.errors.body" class="mt-1" />
                        </div>
                        <PrimaryButton type="submit" class="mt-3" :disabled="commentForm.processing" v-text="commentIdBeingEdited ? 'Update Comment' : 'Add Comment'"></PrimaryButton>
                        <SecondaryButton v-if="commentIdBeingEdited" @click="cancelEditComment" class="ml-2">Cancel</SecondaryButton>
                    </form>
                    <div v-else class="flex items-center">
                        <div class="flex text-sm text-gray-900 dark:text-white">To add a comment, u must be a member </div>

                        <Link
                            :href="route('login')"
                            class="ml-10 text-sm underline text-gray-900 dark:text-white hover:text-orange-500 dark:hover:text-orange-500 focus:outline-none focus:text-orange-500 dark:focus:text-orange-500 transition"
                        >
                            Log in
                        </Link>
                    </div>
                </div>
            </div>
            <div class="mx-6">
                <ol class="relative border-s border-gray-200 dark:border-gray-500">
                    <li v-for="comment in comments.data" :key="comment.id" >
                        <Comment @edit="editComment" @delete="deleteComment" :comment="comment"/>
                    </li>
                </ol>
            </div>
            <Paginate :meta="comments.meta" :only="['comments']"/>
        </div>
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
import Comment from "@/Components/Comment.vue";
import Paginate from "@/Components/Paginate.vue";
import TextArea from "@/Components/TextArea.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

import {useForm, Link, router} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import {useConfirm} from "@/useConfirm.js";

const props = defineProps(['post', 'comments']);

const commentForm = useForm({
    body: '',
});

const commentTextAreaRef = ref(null);
const commentIdBeingEdited = ref(null);
const commentBeingEdited = computed(() => props.comments.data.find(comment => comment.id === commentIdBeingEdited.value));
const editComment = (commentId) => {
    commentIdBeingEdited.value = commentId;
    commentForm.body = commentBeingEdited.value?.body;
    commentTextAreaRef.value?.focus();
};
const cancelEditComment = () => {
    commentIdBeingEdited.value = null;
    commentForm.reset();
};

const { confirmation } = useConfirm();

const addComment = () => commentForm.post(route('posts.comments.store', props.post.id), {
    preserveScroll: true,
    onSuccess: () => commentForm.reset(),
});

const updateComment = async () => {
    if (! await confirmation('Are you sure you want to update this comment?')) {
        commentTextAreaRef.value?.focus();
        return;
    }
    commentForm.put(route('comments.update', {
        comment: commentIdBeingEdited.value,
        page: props.comments.meta.current_page,
    }), {
        preserveScroll: true,
        onSuccess: cancelEditComment,
    });
};

const deleteComment = async (commentId) => {
    if (! await confirmation('Are you sure you want to delete this comment?')) {
        return;
    }
    router.delete(route('comments.destroy', {comment: commentId, page: props.comments.meta.current_page}), {
        preserveScroll: true,
    });
};
</script>
