<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EnglishWordCard from '@/Molecules/EnglishWordCard.vue';
const props = defineProps({
    data:Object
})
</script>

<template>
    <authenticated-layout>
        <h2 class="py-2">
            ここには自分が登録した単語帳が入ります
        </h2>
        <div class="my-words-wrapper">
            <div v-for = "item in data">            
                <english-word-card :data="item"/>
            </div>
        </div>
    </authenticated-layout>
</template>
<style scoped>
.my-words-wrapper {
  @apply bg-white rounded-[15px] p-4 shadow-lg font-bold grid grid-cols-3 gap-4;
}
</style>