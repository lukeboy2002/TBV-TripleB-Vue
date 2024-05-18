<template>
    <AppLayout title="Blog">
        <template #header>
            <div class="relative">
                <img src="/blog/default.jpg" class="h-40 md:h-56 overflow-hidden lg:h-72 w-full object-cover" />
                <h1 class="absolute top-1/2 w-full text-center text-4xl font-bold text-white">Create a Post</h1>
            </div>
        </template>

        <form @submit.prevent="createPost" class="mt-4">
            <div>
                <InputLabel for="title" class="sr-only">Title</InputLabel>
                <TextInput id="title" class="w-full" v-model="form.title" placeholder="Give it a great title…" />
                <InputError :message="form.errors.title" class="mt-1" />
            </div>

            <div class="mt-3">
                <InputLabel for="body" class="sr-only">Body</InputLabel>
                <TextArea id="body" v-model="form.body" rows="15" />
                <InputError :message="form.errors.body" class="mt-1" />
            </div>

            <div class="mt-3">
                <PrimaryButton type="submit">Create Post</PrimaryButton>
            </div>
        </form>

    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import {useForm} from "@inertiajs/vue3";

const form = useForm({
    title: '',
    body: '',
});

const createPost = () => form.post(route('posts.store'));

</script>
