<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    data:String
})
</script>

<template>
    <Head title="Page Title" />
    <AuthenticatedLayout>
        <span class="text-black">
            {{ data }}
        </span>
    </AuthenticatedLayout>
</template>
