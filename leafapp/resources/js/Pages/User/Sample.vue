<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({
    data:String
})
</script>

<template>
    <Head title="Page Title" />
    <AuthenticatedLayout>
        <p>
            {{ props.data }}
        </p>
    </AuthenticatedLayout>
</template>
