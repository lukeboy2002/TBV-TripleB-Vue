<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import MainNavigation from "@/Components/MainNavigation.vue";
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
    title: String,
});
</script>

<template>
    <div>
        <Head :title="title" />
        <Banner />
        <Header />
        <MainNavigation />
        <div class="min-h-screen bg-gray-50 dark:bg-gray-700">

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-gray-50 dark:bg-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <div v-if="$slots.side" class="max-w-7xl mx-auto flex flex-wrap py-10 sm:px-6 lg:px-8">
                <main class="w-full md:w-3/4 flex flex-col px-3">
                    <slot />
                </main>
                <aside class="w-full md:w-1/4 flex flex-col px-3">
                    <slot name="side" />
                </aside>
            </div>

            <div v-else class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <slot />
            </div>
        </div>
        <Footer />
    </div>
</template>
