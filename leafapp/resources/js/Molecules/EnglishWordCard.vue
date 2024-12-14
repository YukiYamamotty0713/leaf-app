<script setup lang="ts">
import { ref,  computed } from "vue";

interface WordData {
  id:number;
  word:string;
  definition:string;
  m_part_of_speech:PartOfSpeech;
}

interface PartOfSpeech{
  id:number;
  name:string;
}

const props = defineProps<{
  data:WordData;
}>();

const showWord = ref<boolean>(false);

// Emitの型定義
const emit = defineEmits<{
  (event: "delete", id: number): void;
}>();

const deleteWord = () => {
  emit("delete", props.data.id);
};

const toggleDescription = () : void => {
  showWord.value = !showWord.value;
};
//discriptionクラスのタグに、toggle_descriptionクラスを付与
const descriptionClasses = computed(() => {
  return {
    'toggle_description': showWord.value,  
    'bg-black text-black': !showWord.value, 
  };
});

const toggleWord = computed(() => {
  return showWord.value ? "Show" : "Hide";
});

</script>

<template>
  <div class="card">
    <div class="word">
      {{ data.word }}
    </div>
    <div class="part-of-speech">
      {{ data?.m_part_of_speech?.name }}
    </div>
    
      <div class="definition"
          :class="descriptionClasses">
        {{ data.definition }}
      </div>
    <button
      type="button"
      @click="toggleDescription"
      class="toggle-description">
      {{ toggleWord }} 
    </button>
    <div 
      class="delete_button" 
      @click="deleteWord"
      >
      ×
    </div>
  </div>
</template>

<style scoped>
.card {
  @apply rounded-lg shadow-md p-4 w-[200px] h-[200px] flex flex-col justify-between bg-secondary text-primary relative overflow-y-scroll scrollbar-none pb-4;
}

.word {
  @apply text-lg font-bold text-light ;
}

.part-of-speech {
  @apply text-sm italic text-white ;
}

.definition {
  @apply text-sm text-black rounded-md transition-all duration-500 w-8/12 h-[130px] py-2 pl-2;
}

.overlay {
  @apply bg-black;
}

.delete_button {
  @apply absolute top-3 right-3;
  @apply text-sm text-light cursor-pointer hover:top-2 transition-all duration-300;
}

.toggle-description {
  @apply text-sm text-light bg-black rounded-md px-2 py-1 mt-2 cursor-pointer hover:bg-primary transition-colors duration-300;
  @apply absolute bottom-3 right-3;
  @apply w-[52px];
}
</style>
