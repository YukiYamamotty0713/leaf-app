<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryCard from '@/Atoms/PrimaryCard.vue';
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <primary-card>
            これはDashBoardのテストです
        </primary-card>
    </AuthenticatedLayout>
</template>
