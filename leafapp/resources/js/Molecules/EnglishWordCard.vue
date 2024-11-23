<script setup>
const props = defineProps({
  data: {
    type: Object,
    default: () => ({
      word: "りんご",
      definition: "果物の一種で、甘い味が特徴です。",
      part_of_speech: "名詞"
    })
  }
});
</script>

<template>
  <div class="card">
    <div class="word">{{ data.word }}</div>
    <div class="part-of-speech">{{ data.part_of_speech }}</div>
    <div class="definition">{{ data.definition }}</div>
  </div>
</template>

<style scoped>
.card {
  @apply rounded-lg shadow-md p-4 w-[200px] h-[150px] flex flex-col justify-between bg-accent text-primary;
}

.word {
  @apply text-lg font-bold text-light;
}

.part-of-speech {
  @apply text-sm italic text-secondary;
}

.definition {
  @apply text-sm text-primary;
}
</style>
