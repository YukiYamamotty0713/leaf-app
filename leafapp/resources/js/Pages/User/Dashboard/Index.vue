<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryCard from '@/Atoms/PrimaryCard.vue';
import RegisterBreakdownChart from '@/Atoms/RegisterWordBreakdownChart/Chart.vue';
import TotalActivityChart  from '@/Atoms/TotalActivityChart/Chart.vue';
import { RegisterWordsCounts } from './interface.ts';
import { PropType } from 'vue';

const props = defineProps({
  registerWordsCounts: {
    type: Object as PropType<RegisterWordsCounts>, // 型を明示的に指定
    required: true,
  },
  totalActivity:{
    type:Array,
    required:true 
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
                <div class="flex flex-row justify-between">
                <register-breakdown-chart
                :counts="registerWordsCounts"
                />
                <total-activity-chart
                :counts="totalActivity"
                />
              </div>
            </primary-card>
    </AuthenticatedLayout>
</template>
