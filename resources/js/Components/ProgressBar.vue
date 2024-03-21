<script setup>
defineProps({
    progress: {
        type: Object,
    },
});
</script>

<template>
    <div v-if="progress" class="relative">
        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
            <div
                :style="{ width: progress.percentage + '%' }"
                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"
            ></div>
        </div>
        <div class="flex justify-between text-xs text-gray-600">
            <span>0%</span>
            <span>{{ progress.percentage }}%</span>
            <span>100%</span>
        </div>
    </div>
</template>
