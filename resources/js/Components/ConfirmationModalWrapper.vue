<template>
    <ConfirmationModal :show="state.show">
        <template #title>
            {{ state.title }}
        </template>

        <template #content>
            {{ state.message }}
        </template>

        <template #footer>

            <PrimaryButton @click="confirm">Confirm</PrimaryButton>
            <SecondaryButton ref="cancelButtonRef" @click="cancel" class="ml-3">Cancel</SecondaryButton>
        </template>
    </ConfirmationModal>
</template>

<script setup>
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

import {useConfirm} from "@/useConfirm.js";
import {nextTick, ref, watch, watchEffect} from "vue";

const {state, confirm, cancel} = useConfirm();
const cancelButtonRef = ref(null);

watchEffect(async () => {
    if (state.show) {
        await nextTick();
        cancelButtonRef.value?.$el.focus();
    }
})
</script>
