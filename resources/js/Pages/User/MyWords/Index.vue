<script setup lang="ts">
import { ref , Ref , computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EnglishWordCard from '@/Molecules/EnglishWordCard.vue';
import EnglishWordList from '@/Molecules/EnglishWordList.vue';
import axios from 'axios';
import CSVDownload from '@/Icons/CSVDownload.vue';
import ShowTypeToggleButton from '@/Atoms/ShowTypeToggleButton.vue';
import { WordData } from '@/Types/Interface';

const props = defineProps<{ 
            data:WordData[]
            }>();

//コピーを作成
const visible_data = ref<WordData[]>(props.data)

//データが１つでもあるかどうか
const hasAtLeastOneData = computed(() => visible_data.value.length > 0);

const ACCOMPLISH_ENDPOINT = '/api/accomplish/';
const CSV_FILENAME = 'data.csv';


const toastMessage = ref<string | null>(null); // トーストメッセージ
const showToast = (message: string) => {
    toastMessage.value = message;
    setTimeout(() => {
        toastMessage.value = null; // 3秒後にトーストを消す
    }, 3000);
};

/**
 * 削除処理を行い、成功したらupdate_vieible_dataを呼び出す。
 * 失敗したらコンソールにエラーを表示する。
 * @param {number} id
 * @returns void
 */
 const post_delete_word = async (id: number) => {
    try {
        await axios.post(`${ACCOMPLISH_ENDPOINT}${id}`);
        update_visible_data(id);
        showToast('達成した単語はリストから削除されます。'); // トーストを表示
    } catch (error: any) {
        console.error(error);
        showToast('退避に失敗しました'); // トーストを表示
    }
};

const delete_result = ref<string>(''); // 削除結果

function update_visible_data(id:number){
    visible_data.value = visible_data.value.filter((item:WordData) => item.id !== id);
}

/**
 * csvダウンロードを行う
 * @return void
 */
 async function download_csv() {

    try {
        const response = await axios.get('download_csv', {
            responseType: 'blob' // バイナリデータを扱うための設定
        });

        // Blobを生成
        const blob = new Blob([response.data], { type: 'text/csv;charset=utf-8;' });

        // ダウンロード用リンクを作成
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.setAttribute('download', CSV_FILENAME);
        document.body.appendChild(link);
        link.click();

        // リンクを削除してリソースを解放
        document.body.removeChild(link);
        URL.revokeObjectURL(url);

    } catch (error) {
        console.error("ダウンロードに失敗しました");
        console.error(error);
    }
}

const showType:Ref<string> = ref('card');
const toggleShowType = () => {
    showType.value = showType.value === 'card' ? 'list' : 'card'; // 値を代入
};

</script>

<template>
    <authenticated-layout>
        <h2 
        class="py-4 text-lg bg-white p-2 rounded-lg my-3 text-black"
        @click="showToast('📖あなたの登録した単語帳が登録されます。覚えた単語は✅をクリックしてください。')"
        >
            📖あなたの登録した単語帳が登録されます。<br>
            覚えた単語は✅をクリックしてください。
        </h2>
            <p class="text-red-700">
                {{ delete_result }}
            </p>
        <div v-if="hasAtLeastOneData">

        <div class="flex justify-between">
            <show-type-toggle-button 
            @click="toggleShowType"
            />
            <CSVDownload 
              @click="download_csv"/>
        </div>
        <div 
        v-if="showType === 'card'"
        class="my-words-wrapper"
        >
            <transition-group 
                name="fade">
                    <div
                    v-for="item in visible_data"
                    :key="item.id"
                    class="flex justify-center items-center">            
                        <english-word-card 
                            :data="item"
                            @delete="post_delete_word"/>
                    </div>
                </transition-group>
            </div>
        <div
        v-else-if="showType === 'list'"
        class="my-words-list-wrapper"
        >
        <!-- テーブルヘッダー -->
            <div class="flex justify-between items-center border-b-2 bg-gray-100 font-bold h-[40px] px-4 text-slate-800">
                <div class="text-sm text-left w-6/12">単語</div>
                <div class="text-sm text-left w-5/12">説明</div>
                <div class="text-xs text-right w-1/12">達成</div>
            </div>
            <div
            v-for="item in visible_data"
            :key="item.id"> 
                <english-word-list 
                    :data="item"
                    @delete="post_delete_word"/>
            </div>    
        </div>
    </div>
    <div v-else class="p-6 bg-white text-black rounded-md my-3 shadow-lg font-bold mt-6">
        <p class="text-center">まだ単語が登録されていません。</p>
        <p class="text-center">単語を登録して、あなただけの一枚を作成しよう！</p>
        <div class="flex justify-end">
        <a 
            class="text-right text-blue-300 hover:text-blue-500 cursor-pointer mt-6"
            :href="route('register-words.index')">
                    単語を登録する
        </a>
    </div>  
    </div>
    </authenticated-layout>

    <!-- トーストメッセージ -->
    <div v-if="toastMessage" class="toast">
            {{ toastMessage }}
        </div>
</template>

<style scoped>
.my-words-wrapper {
  @apply bg-white rounded-[15px] my-3 px-4 py-8 shadow-lg font-bold 
         grid grid-cols-2 lg:grid-cols-3 gap-4;
}

.my-words-list-wrapper{
    @apply bg-white rounded-[15px] my-3 p-4 shadow-lg font-bold;
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

.toast{
    @apply fixed top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r to-blue-200 from-blue-300 text-slate-800 px-6 py-3 rounded-md z-50 min-w-[0px]
}
</style>