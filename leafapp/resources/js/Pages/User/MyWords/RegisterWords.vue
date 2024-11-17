<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    word: '', // 英単語
    definition: '' // 説明
});

const alertMessage = ref(''); // アラートメッセージ
const isAlertVisible = ref(false); // アラートの表示状態

const submit = () => {
    form.post('/register-words', {
        onSuccess: () => {
            showAlert('登録されました');
        }
    });
};

// アラートを表示し、3秒後にフェードアウト
const showAlert = (message) => {
    alertMessage.value = message;
    isAlertVisible.value = true;

    setTimeout(() => {
        isAlertVisible.value = false;
    }, 3000);
};
</script>

<template>
    <Head title="RegisterWords"/>
    <AuthenticatedLayout>
        <div class="title">
            ここでは自分の覚えたい英単語を登録することができます。
        </div>

        <!-- アラート -->
        <transition name="fade">
            <div v-if="isAlertVisible" class="alert">
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

            <label>説明</label>
            <input 
                v-model="form.definition" 
                type="text" 
                placeholder="りんご" 
                class="rounded-md w-full" 
            />
            <button class="submit-button" type="button" @click="submit">送信</button>
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