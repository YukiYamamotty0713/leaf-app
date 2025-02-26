<script setup lang="ts">
import { defineProps, defineEmits, ref } from 'vue';

interface Props {
  isOpen: boolean;
  sentences: string[];
}

const props = defineProps<Props>();

const emit = defineEmits(['close', 'select']);

// モーダルが閉じられるアニメーションを制御するための ref
const isClosing = ref(false);

function selectSentence(sentence: string) {
  emit('select', sentence);
  closeModal();
}

function closeModal() {
  isClosing.value = true;
  setTimeout(() => {
    emit('close');
    isClosing.value = false;
  }, 300); // アニメーション時間に合わせて調整
}

function doNotSelect() {
  emit('select', ''); // 空文字列を送信して「選択しない」を表現
  closeModal();
}
</script>

<template>
  <Transition name="modal-fade">
    <div v-if="props.isOpen" class="modal" :class="{ 'modal-closing': isClosing }">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">例文を選択してください</h2>
          <button @click="closeModal" class="modal-close-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <ul class="modal-list">
          <li v-for="(sentence, index) in props.sentences" :key="index" @click="selectSentence(sentence)"
            class="modal-list-item">
            <span class="item-number">{{ index + 1 }}.</span>
            {{ sentence }}
          </li>
        </ul>

        <div class="modal-footer">
          <button @click="doNotSelect" class="modal-button modal-button-secondary">選択しない</button>
        </div>
      </div>
    </div>
  </Transition>
</template>

<style scoped>
/* モーダルのスタイル */
.modal {
  @apply fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50 z-50;
  transition: opacity 0.3s ease;
}

.modal-closing {
  opacity: 0;
  pointer-events: none; /* アニメーション中にクリックを無効化 */
}

.modal-content {
  @apply bg-white rounded-lg shadow-xl p-6 max-w-lg w-full;
  /*width: 90%;  レスポンシブに調整*/
  /*max-width: 700px; /* 最大幅を設定 */
  display: flex;
  flex-direction: column;
}

.modal-header {
  @apply flex justify-between items-center mb-4;
  border-bottom: 1px solid #e2e8f0;
  padding-bottom: 1rem;
}

.modal-title {
  @apply text-xl font-semibold text-gray-800;
}

.modal-close-button {
  @apply text-gray-500 hover:text-gray-700 focus:outline-none;
}

.modal-list {
  @apply space-y-2 mb-4;
}

.modal-list-item {
  @apply flex items-center rounded-md py-3 px-4 cursor-pointer hover:bg-gray-100 transition-colors duration-200;
}

.item-number {
  @apply mr-3 text-gray-600 font-medium;
  width: 2em;
  /* 番号の幅を固定して揃える */
  display: inline-block;
}

.modal-footer {
  @apply flex justify-end;
}

.modal-button {
  @apply px-4 py-2 rounded-md font-medium transition-colors duration-200 focus:outline-none;
}

.modal-button-secondary {
  @apply bg-gray-200 hover:bg-gray-300 text-gray-700;
}


/* アニメーション */
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.3s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
}
</style>

<style>
/* グローバルスタイルとして定義（または別のCSSファイル） */
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.3s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
}
</style>