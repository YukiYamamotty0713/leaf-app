<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryCard from '@/Atoms/PrimaryCard.vue';
import RegisterBreakdownChart from '@/Atoms/RegisterWordBreakdownChart/Chart.vue';
import { RegisterWordsCounts } from './interface.ts'; // 拡張子 .ts を追加
import { PropType } from 'vue';
const props = defineProps({
  registerWordsCounts: {
    type: Object as PropType<RegisterWordsCounts>, // 型を明示的に指定
    required: true,
  }
});
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
            <primary-card>
                <template #header>
                    📉Dashboard
                </template>
                <register-breakdown-chart
                :counts="registerWordsCounts"
                />
            </primary-card>
    </AuthenticatedLayout>
</template>
