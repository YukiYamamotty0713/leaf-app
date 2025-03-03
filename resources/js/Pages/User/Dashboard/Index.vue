<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryCard from '@/Atoms/PrimaryCard.vue';
import RegisterBreakdownChart from '@/Atoms/RegisterWordBreakdownChart/Chart.vue';
import TotalActivityChart  from '@/Atoms/TotalActivityChart/Chart.vue';
import WeeklyActivityChart from '@/Atoms/WeeklyActivityChart/Chart.vue';
import { RegisterWordsCounts, WeeklyActivities } from './interface.ts';
import { PropType } from 'vue';

const props = defineProps({
  registerWordsCounts: {
    type: Object as PropType<RegisterWordsCounts>, // 型を明示的に指定
    required: true,
  },
  totalActivity:{
    type: Array as PropType<number[]>,
    required:true,
  },
  weeklyActivity:{
    type:Object as PropType<WeeklyActivities>,
    required:true,
  }
});

</script>

<template>
    <Head title="ダッシュボード" />
    <AuthenticatedLayout>
        
            <primary-card>
                <template #header>
                    📉Dashboard
                </template>
                <div class="flex flex-col space-y-4 md:space-y-0 md:space-x-4 md:flex-row justify-between">
                <register-breakdown-chart
                :counts="props.registerWordsCounts"
                />
                <total-activity-chart
                :counts="props.totalActivity"
                />
              </div>
            </primary-card>
            
            <div class="h-[40px]"/>

            <primary-card>
              <template #header>
                📊Weekly Activity
                </template>
                <weekly-activity-chart
                :weekly-activity="props.weeklyActivity"
                /> 
            </primary-card>
    </AuthenticatedLayout>
</template>
