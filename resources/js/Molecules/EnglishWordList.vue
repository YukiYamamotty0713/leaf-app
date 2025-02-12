<script setup lang="ts">
import { ref, computed } from "vue";

// 型定義
interface PartOfSpeech {
  id: number;
  name: string;
}

interface WordData {
  id: number;
  word: string;
  definition: string;
  part_of_speech: PartOfSpeech;
}

// Propsの定義
const props = defineProps<{
  data: WordData;
}>();

// 状態管理
const showDescription = ref<boolean>(false);

// イベントの型定義
const emit = defineEmits<{
  (event: "delete", id: number): void;
}>();

// 削除機能
const deleteWord = () => {
  emit("delete", props.data.id);
};

// 説明の表示切替
const toggleDescription = () => {
  showDescription.value = !showDescription.value;
};

// 説明エリアのクラスを動的に変更
const descriptionClasses = computed(() => ({
  'toggle-description': showDescription.value,
  'bg-black text-black': !showDescription.value,
}));

// 説明の表示/非表示テキストを切り替え
const toggleWordText = computed(() => (showDescription.value ? "Hide" : "Show"));
</script>

<template>
  <div class="flex justify-between items-center border-b-2 hover:bg-slate-100 h-[40px]">
    <div class="font-bold text-lg text-left w-4/12">{{ props.data.word }}</div>
    <div class="text-sm flex justify-start w-4/12">{{ props.data.definition }}</div>
    <div class="w-4/12 flex justify-end">
      <button
        @click="deleteWord"
        class="text-black hover:cursor-pointer hover:cursorpointer"
      >
        ✅
    </button>
    </div>
  </div>
</template>

<style scoped>
/* 基本的なスタイル */
.card {
  @apply rounded-lg shadow-md p-4 w-[200px] h-[200px] flex flex-col justify-between bg-secondary text-primary relative overflow-y-scroll scrollbar-none pb-4;
}

.word {
  @apply text-lg font-bold text-light ;
}

.part-of-speech {
  @apply text-sm italic text-white text-left;
}

.definition {
  @apply text-sm text-black rounded-md transition-all duration-500 w-8/12 h-[130px] py-2 pl-2;
}

.delete_button {
  @apply absolute top-3 right-3 text-2xl text-light cursor-pointer hover:top-2 transition-all duration-300;
}

.toggle-description {
  @apply text-sm text-light bg-black rounded-md px-2 py-1 mt-2 cursor-pointer hover:bg-primary transition-colors duration-300;
  @apply absolute bottom-3 right-3 w-[52px];
}
</style>
