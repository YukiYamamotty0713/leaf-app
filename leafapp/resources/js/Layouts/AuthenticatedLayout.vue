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
    { title: "単語を登録", route: 'register-words.index'},
    { title: "マイ単語帳", route: 'mywords.index' },
]
</script>

<template>
    <Header />
    <div class="flex flex-row justify-center items-center gap-x-4">
        <div v-for="item in routes" class="bg-primary">
            <nav-link 
            :href="route(item.route)"
            class="hover:text-white px-3 py-2 text-sm font-medium"
            >
                {{ item.title }}
            </nav-link>
        </div>
    </div>

    <div class="w-full flex justify-center min-h-screen py-6 font-gothic">
        <main class="w-[780px]">
            <slot />
        </main>
    </div>
    <Footer />
</template>
