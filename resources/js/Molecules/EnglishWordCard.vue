<script setup lang="ts">
import { ref, Ref, computed } from "vue";
import ModalWrapper from '@/Molecules/ModalWrapper.vue';
import { PartOfSpeech, WordData, MyWord } from '@/Types/Interface';
import WordDetailsModal from '@/Organisms/WordDetailsModal.vue';
// モーダルロジック
const ModalRef: Ref<any> = ref(null);
const openModal = () => {
    ModalRef.value.open();
};

const props = defineProps<{
    data: WordData;
}>();

console.log(props.data);

const showWord = ref<boolean>(false);

// Emitの型定義
const emit = defineEmits<{
    (event: "delete", id: number): void;
}>();

const deleteWord = () => {
    emit("delete", props.data.id);
};

const toggleDescription = (): void => {
    showWord.value = !showWord.value;
};

const descriptionClasses = computed(() => {
    return {
        'toggle_description': showWord.value,
        'bg-gradient-to-b from-black to-slate-900 text-black shadow-lg': !showWord.value,
    };
});

const toggleWord = computed(() => {
    return showWord.value ? "Hide" : "Show";
});

// モーダルに表示する詳細データ
const modalDetails = ref<MyWord | null>(null);

const showDetailsInModal = (MyWord: MyWord) => {
    modalDetails.value = MyWord;
    openModal();
};

</script>

<template>
    <div class="card">
        <div class="word">
            {{ data.word }}
        </div>

        <div class="definition" :class="descriptionClasses">
            {{ data.definition }}
        </div>
        <div class="flex flex-row justify-between">
            <button type="button" @click="toggleDescription" class="toggle-description">
                {{ toggleWord }}
            </button>
            <button @click="showDetailsInModal(data)" class="toggle-description detail">
                Detail
            </button>
        </div>

        <div class="delete_button" @click="deleteWord">
            ✅
        </div>
    </div>

    <ModalWrapper ref="ModalRef">
        <WordDetailsModal :wordDetails="modalDetails" /> 
  </ModalWrapper>
</template>


<style scoped>
.card {
  @apply rounded-lg shadow-md p-4 w-[200px] h-[200px] flex flex-col justify-between bg-secondary text-primary relative overflow-y-scroll scrollbar-none pb-4;
}

.word {
  @apply text-sm font-bold text-light pb-1;
}

.part-of-speech {
  @apply text-sm italic text-white ;
}

.definition {
  @apply text-sm text-black rounded-md transition-all duration-500 w-full h-[70px] pl-2;
}

.overlay {
  @apply bg-gradient-to-b from-black to-white absolute inset-0 rounded-lg shadow-lg;
}

.delete_button {
  @apply absolute top-3 right-3;
  @apply text-base text-light cursor-pointer hover:top-2 transition-all duration-300;
}

.toggle-description {
  @apply text-sm text-light bg-gradient-to-t from-rose-300 to-rose-400 rounded-md px-2 py-1 mt-2 cursor-pointer hover:bg-accent transition-colors duration-300;
}

.detail{
  @apply bg-gradient-to-r from-teal-300 to-teal-500 text-light rounded-md px-2 py-1 mt-2 cursor-pointer hover:bg-accent transition-colors duration-300;
}
</style>
