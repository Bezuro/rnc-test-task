<script setup>
defineProps({
    errors: {
        default: [],
    },
});
</script>

<template>
    <div v-if="errors.length > 0">
        <div
            v-for="(errorMessage, index) in errors"
            :key="index"
            class="bg-red-100 border border-red-400 text-red-700 mt-3 px-4 py-3 rounded relative"
            role="alert"
        >
            <strong class="font-bold">Error! </strong>
            <span class="block sm:inline">{{ errorMessage }}</span>
        </div>
    </div>
</template>
