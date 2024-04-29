<template>
    <button @click="toggleDark()" type="button">
        <SunIcon class="hidden dark:block text-gray-50 w-6 h-6" />
        <MoonIcon class="text-gray-700 dark:hidden w-6 h-6" />
    </button>
</template>

<script setup>
import { useDark, useToggle } from "@vueuse/core";
import { SunIcon, MoonIcon} from "@heroicons/vue/24/solid/index.js";

const isDark = useDark();
const toggleDark = useToggle(isDark);
</script>
