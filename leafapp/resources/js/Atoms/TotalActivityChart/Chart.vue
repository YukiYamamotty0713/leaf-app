<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Chart, Title, Tooltip, Legend,  LineElement, BarElement, BarController, PointElement, LineController, CategoryScale, LinearScale, PieController, ArcElement } from 'chart.js';
import { getData, options } from '@/Atoms/TotalActivityChart/config.ts';
import { PropType } from 'vue';
Chart.register(Title, Tooltip, Legend, LineElement, BarElement, BarController, PointElement, LineController, CategoryScale, LinearScale, PieController, ArcElement);

const props = defineProps({
    counts:{
    type: Array as PropType<number[]>,
        required: true,
    },
});
const sample = ref(null);
onMounted(() => {
    if (sample.value) {
        const ctx = sample.value.getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: getData(props.counts), // props.countsから取得
            options: options
        });
    }
});

</script>
<template>
    <div class="h-[200px] w-[400px] bg-slate-300 flex justify-center items-center rounded-[15px] relative">
        <div class="h-[130px] w-[230px]">
            <canvas ref="sample" class="h-full w-full"/>
        </div>
        <span class="absolute bottom-1 text-sm bg-slate-100 text-black py-1 px-3 rounded-[10px]">
            総アクティビティ数: {{ counts[0] + counts[1] }}
        </span>
    </div>
</template>