<script setup lang="ts">
// propsの型定義
interface Props {
  isOpen: boolean;
  definitions: any[];
}

// emitsの型定義
interface Emits {
  (e: 'close'): void;
  (e: 'select', definition: string, partOfSpeechId: number, partOfSpeechName: string): void;
}

const props = defineProps<Props>();
const emit = defineEmits<Emits>();

/**
 * モーダルを閉じる
 * @returns void
 */
function closeModal(): void {
  emit('close');
}

/**
 * 選択された説明を親コンポーネントに通知する
 * @param definition 選択された説明
 * @returns void
 */
function selectDefinition(definition: string, partOfSpeechId: number, partOfSpeechName: string): void {
  emit('select', definition, partOfSpeechId, partOfSpeechName);
}
</script>

<template>
  <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl text-black">
      <h2 class="text-lg font-semibold mb-4">最も適切な説明を選択してください</h2>
      <ul class="space-y-2">
        <li v-for="(definition, index) in definitions" :key="index"
          class="p-2 border rounded cursor-pointer hover:bg-gray-100 flex justify-between items-center"
          @click="selectDefinition(definition.definition, definition.partOfSpeech.id, definition.partOfSpeech.name)">
          <span>{{ definition.definition }}</span>
          <span>({{ definition.partOfSpeech.name }})</span>
        </li>
      </ul>
      <div class="flex justify-end mt-4">
        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded"
          @click="closeModal">
          閉じる
        </button>
      </div>
    </div>
  </div>
</template>