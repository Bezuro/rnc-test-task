<script setup>
defineProps({
    success: {
        default: "",
    },
});
</script>

<template>
    <div
        v-if="success"
        class="bg-green-100 border border-green-400 text-green-700 mt-3 px-4 py-3 rounded relative"
        role="alert"
    >
        <strong class="font-bold">Success! </strong>
        <span class="block sm:inline">{{ success }}</span>
    </div>
</template>
