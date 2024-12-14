<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

/**
 * 品詞
 */
interface partOfSpeech{
    id:number,
    name:string,
}

interface WordForm {
  word: string; // 英単語
  definition: string; // 説明
  partOfSpeech: partOfSpeech; // 品詞
}

/**
 * フォームの初期値
 */
const form = useForm<WordForm>({
  word: '', // 英単語
  definition: '', // 説明
  partOfSpeech: {} as partOfSpeech,
});


/**
 * フォームをリセット
 * @returns void
 */
function resetForm():void{
    form.word = '';
    form.definition = '';
}

// propsの型定義
interface Props {
    data: {
    title: string;
    mPartOfSpeech: partOfSpeech[];
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

</script>

<template>
    <Head title="RegisterWords"/>
    <AuthenticatedLayout>
        <div class="title">
            {{ data.title }}
        </div>

        <!-- アラート -->
        <transition name="fade">
            <div 
              v-if="isAlertVisible" 
              class="alert"
              >
                {{ alertMessage }}
            </div>
        </transition>

        <form class="register-form">
            <label>🍂英単語</label>
            <input 
                v-model="form.word" 
                type="text" 
                placeholder="apple" 
                class="rounded-md w-full" 
            />
            <p class="text-red-700">
                {{ form.errors.word }}
            </p>
            <label>📖説明</label>
            <input 
                v-model="form.definition" 
                type="text" 
                placeholder="りんご" 
                class="rounded-md w-full" 
            />
            <p class="text-red-700">
                {{ form.errors.definition }}
            </p>
            <label>
                品詞
            </label>
            <select 
            v-model="form.partOfSpeech" 
            class="rounded-md w-full">
                <option 
                  v-for="partOfSpeech in data.mPartOfSpeech" 
                  :value="partOfSpeech.id"
                  >
                    {{ partOfSpeech.name }}
                </option>
            </select>
            <p class="text-red-700">
                {{ form.errors.partOfSpeech }}
            </p>
            <button 
              class="submit-button" 
              type="button" 
              @click="submit"
              >
              送信
            </button>
        </form>
    </AuthenticatedLayout>
</template>
<style scoped>
.title{
    @apply bg-white text-black text-lg rounded-lg p-4
}

.register-form{
    @apply py-4 flex flex-col gap-2
}

.submit-button{
    @apply bg-green-300 rounded-md py-3 mt-4
}

/* アラート用のスタイル */
.alert {
    @apply fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-800 text-white text-center py-2 px-4 rounded-md shadow-lg;
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