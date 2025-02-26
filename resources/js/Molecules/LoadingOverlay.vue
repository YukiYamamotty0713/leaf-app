<script setup lang="ts">
import { defineProps } from 'vue';

interface Props {
  isLoading: boolean;
}

const props = defineProps<Props>();
</script>

<template>
  <div v-if="props.isLoading" class="loading-overlay">
    <div class="loading-content">
      <div class="loading-spinner">
        <!-- CSS スピナー or 画像スピナー -->
      </div>
      <div class="loading-message">抽出しています...</div>
    </div>
  </div>
</template>

<style scoped>
.loading-overlay {
  @apply fixed top-0 left-0 w-full h-full flex justify-center items-center z-[9999];
  background-color: rgba(0, 0, 0, 0.8);
  /* 黒の半透明背景 */
  pointer-events: none;
  /* オーバーレイをクリックできないようにする */
}

.loading-content {
  @apply flex flex-col items-center bg-black bg-opacity-80 p-5 rounded-lg shadow-lg;
}

.loading-message {
  @apply text-lg text-white mt-4;
}

/* CSS スピナーの例 */
.loading-spinner {
  width: 40px;
  height: 40px;
  border: 4px solid rgba(255, 255, 255, 0.3);
  border-left-color: #3498db;
  /* アクセントカラー */
  border-radius: 50%;
  animation: spin 1.2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}
</style>