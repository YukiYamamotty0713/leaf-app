<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Chart, Title, Tooltip, Legend,  LineElement, PointElement, LineController, CategoryScale, LinearScale, PieController, ArcElement } from 'chart.js';
import { getData, options } from '@/Atoms/RegisterWordBreakdownChart/config.ts';
import { RegisterWordsCounts } from '@/Pages/User/Dashboard/interface.ts';
import { PropType } from 'vue';
Chart.register(Title, Tooltip, Legend, LineElement, PointElement, LineController, CategoryScale, LinearScale, PieController, ArcElement);

const props = defineProps({
    counts:{
    type: Object as PropType<RegisterWordsCounts>, // 型を明示的に指定
        required: true,
    },
})

//countsの値をArrayに変換
const countsArray = [
    props.counts.Noun,
    props.counts.Verb,
    props.counts.Adjective,
    props.counts.Adverb,
    props.counts.Pronoun,
    props.counts.Preposition,
    props.counts.Conjunction,
    props.counts.Other,
    props.counts.Idiom,
    props.counts.EnglishStructure
];

// ラベルを作成
const labels = [
    "名詞",
    "動詞",
    "形容詞",
    "副詞",
    "代名詞",
    "前置詞",
    "接続詞",
    "その他",
    "英熟語",
    "英語構文"
];


// モダン風なデザインのカラー10種類
const colors = [
    "#4E9F3D",  // 落ち着いた緑
    "#FF6F61",  // コーラルレッド
    "#6A5ACD",  // スレートブルー
    "#FFD700",  // ゴールド
    "#8A2BE2",  // ブルーバイオレット
    "#FF6347",  // トマトレッド
    "#48C9B0",  // ターコイズ
    "#F39C12",  // アンバー
    "#D35400",  // 焦げたオレンジ
    "#1ABC9C"   // シアン
];

const sample = ref(null);
onMounted(() => {
    if (sample.value) {
        const ctx = sample.value.getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: getData(labels, countsArray, colors),
            options: options
        });
    }
});

</script>
<template>
    <div class="h-[200px] min-w-[200px] w-full bg-slate-300 flex justify-center items-center rounded-[15px] relative">
        <div class="h-[130px] w-[130px]">
            <canvas ref="sample" class="h-full w-full"/>
        </div>
        <span class="absolute bottom-1 text-sm bg-slate-100 text-black py-1 px-3 rounded-[10px]">
            登録単語数: {{ counts.Sum }}
        </span>
    </div>
</template>