<template>
  <div v-if="wordDetails" class="p-6 bg-slate-50 rounded-lg shadow-md">
    <div class="flex items-center justify-start">
      <button @click="speakWord" :disabled="isSpeakingWord" class="text-slate-500 hover:text-slate-700 text-2xl" v-if="wordDetails">
        🔊
      </button>  
    <h2 class="text-lg font-extrabold text-slate-800 text-3xl">{{ wordDetails.word }}</h2>

    </div>
    <div class="w-full">
      <div class="flex flex-col">
        <div class="flex py-3 border-b border-slate-300">
          <div class="w-1/3 font-semibold text-slate-600 pr-4">意味:</div>
          <div class="w-2/3 text-slate-500">{{ wordDetails.definition }}</div>
        </div>
        <div class="flex py-3 border-b border-slate-300">
          <div class="w-1/3 font-semibold text-slate-600 pr-4">品詞:</div>
          <div class="w-2/3 text-slate-500">{{ wordDetails.m_part_of_speech?.name }}</div>
        </div>
        <div v-if="wordDetails.example_sentence" class="flex py-3 border-b border-slate-300">
          <div class="w-1/3 font-semibold text-slate-600 pr-4 flex items-center">
            例文:
            <button @click="speakExample" :disabled="isSpeakingExample" class="ml-2 text-slate-500 hover:text-slate-700" v-if="wordDetails.example_sentence">
              🔊
            </button>
          </div>
          <div class="w-2/3 text-slate-500 italic">"{{ wordDetails.example_sentence }}"</div>
        </div>
        <div v-if="wordDetails.note" class="flex py-3">
          <div class="w-1/3 font-semibold text-slate-600 pr-4">備考:</div>
          <div class="w-2/3 text-slate-500">{{ wordDetails.note }}</div>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="p-6 bg-slate-50 rounded-lg shadow-md text-center">
    <p class="text-slate-500">単語情報を読み込み中...</p>
  </div>
</template>

<script setup lang="ts">
import { MyWord } from '@/Types/Interface';
import { ref } from 'vue';

const props = defineProps<{
  wordDetails: MyWord | null;
}>();

const isSpeakingWord = ref(false);
const isSpeakingExample = ref(false);

const speakWord = () => {
  if (props.wordDetails) {
    isSpeakingWord.value = true;
    const utterance = new SpeechSynthesisUtterance(props.wordDetails.word);
    utterance.onend = () => {
      isSpeakingWord.value = false;
    };
    speechSynthesis.speak(utterance);
  }
};

const speakExample = () => {
  if (props.wordDetails && props.wordDetails.example_sentence) {
    isSpeakingExample.value = true;
    const utterance = new SpeechSynthesisUtterance(props.wordDetails.example_sentence);
    utterance.onend = () => {
      isSpeakingExample.value = false;
    };
    speechSynthesis.speak(utterance);
  }
};
</script>