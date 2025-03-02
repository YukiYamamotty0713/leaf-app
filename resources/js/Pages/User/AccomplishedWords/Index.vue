<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, ref } from 'vue';
import axios from 'axios';

// 型定義を適用
const props = defineProps<{
  words: Word[];
}>();

const words = ref(props.words);


const deleteWord = async (id: number) => {
  console.log(id);
  if (confirm('この単語を削除しますか？')) {
    try {
      await axios.delete(`/api/words/${id}`);
      // 削除されたWordをリストから削除
      words.value = words.value.filter((word) => word.id !== id);
    } catch (error) {
      console.error('削除エラー:', error);
      alert('削除に失敗しました。');
    }
  }
};
</script>

<template>
  <AuthenticatedLayout>
    <div class="p-6">
      <h2 class="text-2xl font-semibold mb-4">既に覚えた単語リスト</h2>
      <ul class="space-y-2">
        <li
          v-for="word in words"
          :key="word.id"
          class="bg-white rounded-lg shadow p-4 text-slate-800"
        >
          <div class="flex justify-between items-center">
            <div>
              <strong class="text-lg font-medium">{{ word.word }}</strong>
              <p class="text-gray-600">{{ word.definition }}</p>
            </div>
            <div class="flex items-center">
              <div v-if="word.m_part_of_speech" class="text-sm text-gray-900 mr-4">
                品詞: {{ word.m_part_of_speech.name }}
              </div>
              <button @click="deleteWord(word.id)" class="text-red-500 hover:text-red-700">
                削除
              </button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </AuthenticatedLayout>
</template>