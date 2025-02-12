<script setup lang="ts">
import { ref , Ref , computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EnglishWordCard from '@/Molecules/EnglishWordCard.vue';
import EnglishWordList from '@/Molecules/EnglishWordList.vue';
import axios from 'axios';
import CSVDownload from '@/Icons/CSVDownload.vue';
import { MyWord } from './interface.ts';
import ShowTypeToggleButton from '@/Atoms/ShowTypeToggleButton.vue';

const props = defineProps<{ 
            data:MyWord[]
            }>();

//コピーを作成
const visible_data = ref<MyWord[]>(props.data)

const API_ENDPOINT = '/api/words/';
const CSV_FILENAME = 'data.csv';


/**
 * 削除処理を行い、成功したらupdate_vieible_dataを呼び出す。
 * 失敗したらコンソールにエラーを表示する。
 * @param {number} id
 * @returns void
 */
const post_delete_word = async (id:number) => 
{
    try {
        await axios.delete(`${API_ENDPOINT}${id}`);
        update_visible_data(id);
        delete_result.value = '✅おめでとうございます！リストからスタッシュしました。';
    } catch (error:any) {
        console.error(error);
        delete_result.value = 'スタッシュに失敗しました';
    }
}

const delete_result = ref<string>(''); // 削除結果

function update_visible_data(id:number){
    visible_data.value = visible_data.value.filter((item:MyWord) => item.id !== id);
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

        console.log('ダウンロードしました');
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
        <h2 class="py-4 text-lg bg-white p-2 rounded-lg my-3">
            📖ここには自分が登録した単語帳が入ります 
        </h2>
            <p class="text-red-700">
                {{ delete_result }}
            </p>

        <div class="flex justify-between">
            <show-type-toggle-button 
            @click="toggleShowType"
            />
            <CSVDownload 
              @click="download_csv"/>
        </div>
            <div 
            v-if="showType === 'card'"
            class="my-words-wrapper">
                <transition-group 
                name="fade">
                    <div
                    v-for="item in visible_data"
                    :key="item.id">            
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
                <div
                v-for="item in visible_data"
                :key="item.id"> 
                    <english-word-list 
                        :data="item"
                        @delete="post_delete_word"/>
                </div>    
            </div>
    </authenticated-layout>
</template>

<style scoped>
.my-words-wrapper {
  @apply bg-white rounded-[15px] my-3 p-4 shadow-lg font-bold grid grid-cols-3 gap-4;
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
</style>