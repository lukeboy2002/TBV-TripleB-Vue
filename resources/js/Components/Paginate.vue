<template>
    <div class="flex items-center justify-between border-t border-orange-500/30 py-3">
        <div class="flex flex-1 justify-between sm:hidden">
            <NavLink :href="previousUrl"
                     :only="only">
                Previous
            </NavLink>
            <NavLink :href="nextUrl"
                     :only="only">
                Next
            </NavLink>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-900 dark:text-white">
                    Showing
                    {{ ' ' }}
                    <span class="font-medium font-semibold text-orange-500">{{ meta.from }}</span>
                    {{ ' ' }}
                    to
                    {{ ' ' }}
                    <span class="font-medium font-semibold text-orange-500">{{ meta.to }}</span>
                    {{ ' ' }}
                    of
                    {{ ' ' }}
                    <span class="font-medium font-semibold text-orange-500">{{ meta.total }}</span>
                    {{ ' ' }}
                    results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <Link v-for="link in meta.links"
                          :href="link.url"
                          :only="only"
                          class="relative inline-flex items-center first-of-type:rounded-l-md last-of-type:rounded-r-md px-3 py-2"
                          :class="{
                           'z-10 bg-orange-500 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500': link.active,
                           'text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-300 dark:focus:bg-gray-800': !link.active
                       }"
                          v-html="link.label"
                    >
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {computed} from "vue";
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    meta: {
        type: Object,
        required: true
    },
    only: {
        type: Array,
        default: () => []
    }
});

const previousUrl = computed(() => props.meta.links[0].url);
const nextUrl = computed(() => [...props.meta.links].reverse()[0].url);
</script>
