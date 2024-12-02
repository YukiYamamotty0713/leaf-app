<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EnglishWordCard from '@/Molecules/EnglishWordCard.vue';
import axios from 'axios';
const props = defineProps({
    data:Object
})

//コピーを作成
const visible_data = ref(props.data);

const post_delete_word = async (id) => {
    try {
        await axios.delete(`/api/words/${id}`);
    } catch (error) {
        console.error(error);
    }
}

const delete_word = (id) => {
    visible_data.value = visible_data.value.filter((itemy) => itemy.id !== id);
}
</script>

<template>
    <authenticated-layout>
        <h2 class="py-2">
            ここには自分が登録した単語帳が入ります
        </h2>
        <div class="my-words-wrapper">
            <transition-group name="fade">
                <div v-for="item in visible_data"
                    :key="item.id">            
                    <english-word-card 
                        :data="item"
                        @delete="delete_word"/>
                </div>
            </transition-group>
        </div>
    </authenticated-layout>
</template>

<style scoped>
.my-words-wrapper {
  @apply bg-white rounded-[15px] p-4 shadow-lg font-bold grid grid-cols-3 gap-4;
}

/* 透明化とスライドのアニメーション */
.fade-enter-active, .fade-leave-active {
  @apply transition-all duration-500;
}
.fade-enter-from {
  @apply opacity-0 translate-y-4;
}
.fade-leave-to {
  @apply opacity-0 translate-y-4;
}
</style>