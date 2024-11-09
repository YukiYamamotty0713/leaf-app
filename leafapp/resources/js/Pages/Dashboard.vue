<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryCard from '@/Atoms/PrimaryCard.vue';
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
            <primary-card>
                <template #header>
                    これはDashBoardのテストです
                </template>
                <span>
                    実際にはここにスロットの内容が差し込まれます
                </span>
            </primary-card>
    </AuthenticatedLayout>
</template>
