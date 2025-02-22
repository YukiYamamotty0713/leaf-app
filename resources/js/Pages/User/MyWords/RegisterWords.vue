<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { WordData, PartOfSpeech } from '@/Types/Interface';
import axios from 'axios';
import LoadingOverlay from '@/Molecules/LoadingOverlay.vue';
import ExampleSentenceModal from '@/Molecules/ExampleSentenceModal.vue';

/**
 * フォームの初期値
 */
const form = useForm<WordData>({
  id: 0,
  word: '', // 英単語
  definition: '', // 説明
  PartOfSpeechId: null, // partOfSpeechId を追加
  PartOfSpeech: {
    id: null,
    name: '選択してください'
  }, // 品詞
  exampleSentence: "",
  note: "",
});


//ローディング状態を管理するref
const isLoading = ref<boolean>(false);

// 例文候補の配列
const exampleSentenceSuggestions = ref<string[]>([]);

// モーダルの表示状態
const isModalOpen = ref<boolean>(false);

/**
 * フォームをリセット
 * @returns void
 */
function resetForm(): void {
  form.word = '';
  form.definition = '';
  form.exampleSentence = '';
}

// propsの型定義
interface Props {
  data: {
    title: string;
    mPartOfSpeech: PartOfSpeech[];
  };
}

// definePropsに型を設定
const props = defineProps<Props>();

const alertMessage = ref<string>(''); // アラートメッセージ
const isAlertVisible = ref<boolean>(false); // アラートの表示状態

/**
 * フォームに入力された値をLaravelに送信する
 * @returns void
 */
const submit = (): void => {
  form.post('/register-words', {
    onSuccess: () => {
      resetForm();
      showAlert('英単語が登録されました');
    }
  });
};

/**
 * アラートを表示する
 * @param message 表示するアラートメッセージ
 * @returns void
 */
function showAlert(message: string): void {
  alertMessage.value = message;
  isAlertVisible.value = true;
  setTimeout(() => {
    isAlertVisible.value = false;
  }, 3000); // 3秒後に非表示
}

/**
 * 例文を提案する
 * @returns void
 */
async function suggestExampleSentence() {
  isLoading.value = true;
  exampleSentenceSuggestions.value = []; // Clear previous suggestions
  try {
    const response = await axios.post(route('register-words.suggest'), {
      word: form.word,
      definition: form.definition,
      partOfSpeech: form.PartOfSpeech.name
    });

    // APIからのレスポンスが配列であることを確認
    if (Array.isArray(response.data)) {
      exampleSentenceSuggestions.value = response.data.map((item: any) => item.example); // 例文だけを抽出
    } else {
      showAlert('例文の提案に失敗しました: 無効なデータ形式');
    }
    isModalOpen.value = true; // モーダルを開く

  } catch (error) {
    showAlert('例文の提案に失敗しました');
    console.error(error); // 開発者向けのエラーログ
  } finally {
    isLoading.value = false;
  }
}

/**
 * 選択された例文をフォームに設定する
 * @param sentence 選択された例文
 * @returns void
 */
function selectExampleSentence(sentence: string) {
  form.exampleSentence = sentence;
  isModalOpen.value = false; // モーダルを閉じる
}

</script>

<template>
  <Head title="RegisterWords" />

  <!-- ローディングオーバーレイ -->
  <LoadingOverlay :isLoading="isLoading" />

  <AuthenticatedLayout>
    <div class="title">
      {{ data.title }}
    </div>

    <!-- アラート -->
    <transition name="fade">
      <div v-if="isAlertVisible" class="alert">
        {{ alertMessage }}
      </div>
    </transition>

    <form class="register-form">
      <label>🍂英単語</label>
      <input v-model="form.word" type="text" placeholder="word" class="rounded-md w-full" />
      <p class="text-red-700">
        {{ form.errors.word }}
      </p>
      <label>📖説明</label>
      <input v-model="form.definition" type="text" placeholder="単語を入力..." class="rounded-md w-full" />
      <p class="text-red-700">
        {{ form.errors.definition }}
      </p>
      <label>
        ✏品詞
      </label>
      <select v-model="form.PartOfSpeech" class="rounded-md w-full">
        <option value="null">選択してください</option>
        <option v-for="partOfSpeech in data.mPartOfSpeech" :key="partOfSpeech.id" :value="partOfSpeech">
          {{ partOfSpeech.name }}
        </option>
      </select>
      <p class="text-red-700">
        {{ form.errors.PartOfSpeech }}
      </p>

      <label>
        📒例文
      </label>
      <div class="inline w-[80px] bg-accent text-white rounded-lg p-1 shadow-lg cursor-pointer"
        @click="suggestExampleSentence">
        Gemi
      </div>
      <textarea v-model="form.exampleSentence" placeholder="例文"
        class="rounded-md w-full min-h-[150px] max-h-[200px]">
            </textarea>

      <label>📒備考</label>
      <textarea v-model="form.note" placeholder="備考"
        class="rounded-md w-full min-h-[150px] max-h-[200px]">
            </textarea>

      <button class="submit-button" type="button" @click="submit">
        送信
      </button>
    </form>

    <!-- 例文選択モーダル -->
    <ExampleSentenceModal :is-open="isModalOpen" :sentences="exampleSentenceSuggestions" @close="isModalOpen = false"
      @select="selectExampleSentence" />

  </AuthenticatedLayout>
</template>
<style scoped>
.title {
  @apply bg-white text-black text-lg rounded-lg p-4
}

.register-form {
  @apply py-4 flex flex-col gap-2
}

.submit-button {
  @apply bg-green-300 rounded-md py-3 mt-4
}

/* アラート用のスタイル */
.alert {
  @apply fixed top-4 left-1/2 transform -translate-x-1/2 bg-blue-300 text-white text-center py-2 px-4 rounded-md shadow-lg min-w-[350px];
  z-index: 50;
  animation: fadeIn 0.5s ease-in-out;
}

/* フェードアウトのトランジション */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* アニメーション */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>