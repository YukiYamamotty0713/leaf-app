<script setup>
import { ref } from "vue";
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

const emit = defineEmits(["delete"]);
const delete_word = () => {
  emit("delete", props.data.id);
};
// トグル関数
const toggleDescription = () => {
  //definitionタグに対してオーバーレイクラスをトグルする
  const definition = document.querySelector(".definition");
  definition.classList.toggle("overlay");
};

</script>

<template>
  <div class="card">
    <div class="word">
      {{ data.word }}
    </div>
    <div class="part-of-speech">
      {{ data.part_of_speech }}
    </div>

      <div class="definition">
        {{ data.definition }}
      </div>

    <button
      type="button"
      @click="toggleDescription"
      class="toggle-description">
      TGL
    </button>

    <div class="delete" @click="delete_word">×</div>
  </div>
</template>

<style scoped>
.card {
  @apply rounded-lg shadow-md p-4 w-[200px] h-[150px] flex flex-col justify-between bg-accent text-primary relative;
}

.word {
  @apply text-lg font-bold text-light;
}

.part-of-speech {
  @apply text-sm italic text-secondary;
}

.definition {
  @apply text-sm text-black rounded-md;
}

.overlay {
  @apply bg-black;
}

.delete {
  @apply absolute top-3 right-3;
  @apply text-sm text-light cursor-pointer hover:top-2 transition-all duration-300;
}

.toggle-description {
  @apply text-sm text-light bg-black rounded-md px-2 py-1 mt-2 cursor-pointer hover:bg-light transition-colors duration-300;
}
</style>
