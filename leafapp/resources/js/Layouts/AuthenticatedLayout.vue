<script setup lang="ts">
import Header from '@/Templates/Header.vue';
import Footer from '@/Templates/Footer.vue';
import NavLink from '@/Components/NavLink.vue';

/**
 * ルートインターフェースを定義する
 * @parmas title:タイトル
 * @parmas route:ルート定義
 */
interface Route {
    title: string;
    route: string; //route('hogehoge')
}

/**
 */
const routes: Route[] = [
    { title: "ダッシュボード", route: 'dashboard.index'},
    { title: "マイ単語帳", route: 'mywords.index' },
    { title: "単語クイズ", route: 'words-question.index'},
]
</script>

<template>
    <Header />
    <div class="flex flex-row justify-center items-center">
        <div v-for="item in routes" class="bg-primary">
            <nav-link :href="route(item.route)">{{ item.title }}</nav-link>
        </div>
    </div>

    <div class="w-full flex justify-center min-h-screen py-10">
        <main class="w-[780px]">
            <slot />
        </main>
    </div>
    <Footer />
</template>
