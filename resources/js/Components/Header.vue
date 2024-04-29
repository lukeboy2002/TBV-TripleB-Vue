<template>
    <div class="bg-gray-50 dark:bg-gray-700 min-h-24 hidden md:block border-b border-orange-500/30">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <ApplicationLogo />
                <div class="flex items-center space-x-20">
                    <ContactUs />
                    <ThemeSwitcher />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ContactUs from "@/Components/ContactUs.vue";
import ThemeSwitcher from '@/Components/ThemeSwitcher.vue';
</script>
