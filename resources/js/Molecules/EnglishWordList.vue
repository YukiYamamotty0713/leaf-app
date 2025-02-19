<script setup lang="ts">
import { ref, computed } from "vue";

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

const props = defineProps<{
  data: WordData;
}>();

const showDescription = ref<boolean>(false);

const emit = defineEmits<{
  (event: "delete", id: number): void;
}>();

const deleteWord = () => {
  emit("delete", props.data.id);
};

// 音声読み上げ機能
const speakWord = () => {
  if ('speechSynthesis' in window) {
    const utterance = new SpeechSynthesisUtterance(props.data.word);
    window.speechSynthesis.speak(utterance);
  } else {
    alert('Text-to-speech is not supported in this browser.');
  }
};



const toggleDescription = () => {
  showDescription.value = !showDescription.value;
};

</script>

<template>


  <!-- データ行 -->
  <div class="flex justify-between items-center border-b-2 hover:bg-slate-100 h-[40px] px-4">
    <div class="font-bold text-lg text-left w-4/12">{{ props.data.word }}
      <button 
        @click="speakWord"
        class="text-gray-500 hover:text-blue-500 transition-colors"
        title="Pronounce"
      >
        🔈
      </button>
    </div>

    <div class="text-sm flex items-center justify-start w-4/12">
      <span class="mr-2">{{ props.data.definition }}</span>

    </div>
    <div class="w-4/12 flex justify-end">
      <button
        @click="deleteWord"
        class="text-black hover:cursor-pointer hover:text-red-500 transition-colors"
        title="Delete"
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
