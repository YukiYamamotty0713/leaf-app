<script setup>
import { ref, computed } from "vue";
const props = defineProps({
  data: {
    type: Object,
    default: () => ({
      word: "りんご",
      definition: "果物の一種で、甘い味が特徴です。",
      part_of_speech: "名詞",
    })
  }
});

const show_word = ref(false);

const emit = defineEmits(["delete"]);
const delete_word = () => {
  emit("delete", props.data.id);
};

const toggleDescription = () => {
  show_word.value = !show_word.value;
};
//discriptionクラスのタグに、toggle_descriptionクラスを付与
const descriptionClasses = computed(() => {
  return {
    'toggle_description': show_word.value,  // show_wordがtrueのとき
    'bg-black text-black': !show_word.value,             // show_wordがfalseのとき
  };
});

</script>

<template>
  <div class="card">
    <div class="word">
      {{ data.word }}
    </div>
    <div class="part-of-speech">
      {{ data?.m_part_of_speech.name }}
    </div>

      <div class="definition"
          :class="descriptionClasses">
        {{ data.definition }}
      </div>

    <button
      type="button"
      @click="toggleDescription"
      class="toggle-description">
      切り替え
    </button>

    <div class="delete" @click="delete_word">×</div>
  </div>
</template>

<style scoped>
.card {
  @apply rounded-lg shadow-md p-4 w-[200px] h-[150px] flex flex-col justify-between bg-secondary text-primary relative overflow-y-scroll scrollbar-none;
}

.word {
  @apply text-lg font-bold text-light;
}

.part-of-speech {
  @apply text-sm italic text-secondary;
}

.definition {
  @apply text-sm text-black rounded-md transition-all duration-500;
}

.overlay {
  @apply bg-black;
}

.delete {
  @apply absolute top-3 right-3;
  @apply text-sm text-light cursor-pointer hover:top-2 transition-all duration-300;
}

.toggle-description {
  @apply text-sm text-light bg-black rounded-md px-2 py-1 mt-2 cursor-pointer hover:bg-primary transition-colors duration-300;
}
</style>
