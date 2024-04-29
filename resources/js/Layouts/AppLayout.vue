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
            <main>
                <slot />
            </main>
        </div>
        <Footer />
    </div>
</template>
