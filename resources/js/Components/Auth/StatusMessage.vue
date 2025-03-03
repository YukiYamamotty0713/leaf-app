<template>
    <div v-if="status" class="mb-4 px-4 py-2 bg-green-50 border border-green-200 rounded-lg text-sm font-medium text-green-600">
        {{ status }}
    </div>
</template>

<script setup>
defineProps({
    status: {
        type: String,
    },
});
</script>
