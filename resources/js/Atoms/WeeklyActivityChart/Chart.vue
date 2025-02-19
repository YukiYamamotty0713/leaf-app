<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Chart, Title, Tooltip, Legend, LineElement, PointElement, LineController, CategoryScale, LinearScale } from 'chart.js';
import { WeeklyActivities, DailyActivities } from '@/Pages/User/Dashboard/interface.ts';
import { PropType } from 'vue';
import { getData, options } from './config.ts';

// Chart.js の登録
Chart.register(Title, Tooltip, Legend, LineElement, PointElement, LineController, CategoryScale, LinearScale);

const props = defineProps({
  weeklyActivity: {
    type: Object as PropType<WeeklyActivities>, // 型を明示的に指定
    required: true,
  },
});

const sample = ref(null);

onMounted(() => {
  if (sample.value) {
    const ctx = sample.value.getContext('2d');
    const labels = props.weeklyActivity.days; // 日付のラベル
    const activities:DailyActivities[]= props.weeklyActivity.activities; // アクティビティのデータ（例: 登録数）
    const registerCounts = activities.map((activity: DailyActivities) => activity.register); // 登録数のデータ
    const deleteCounts = activities.map((activity: DailyActivities) => activity.delete); // 削除数のデータ

    new Chart(ctx, {
      type: 'line',  // 折れ線グラフ
      data: getData(labels, registerCounts, deleteCounts),
      options: options,
    });
  }
});

</script>
<template>
    <div class="h-[400px] max-w-[730px] w-full bg-slate-300 flex justify-center items-center rounded-[15px] relative overflow-x-scroll">
        <div class="h-[336px] max-w-[630px]">
            <canvas ref="sample" class="h-full w-10/12"/>
        </div>
    </div>
</template>