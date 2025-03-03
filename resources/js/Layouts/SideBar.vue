<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { routes } from './menus';
import NavLink from '@/Components/NavLink.vue';
const page = usePage();
const pageroute:any = page.props.route;

</script>
<template>
<div class="flex flex-col items-center justify-between py-12 gap-y-4 w-64 border-l-4 border-l-black">
    <div 
    v-for="item in routes" 
    :key="item.route"
    class="flex justify-start w-full pl-6"
    >
        <nav-link 
        :href="route(item.route)"
        class="hover:text-white px-2 py-2 text-lg font-medium"
        :active="pageroute.name === item.route"
        >
            {{ item.title }}
        </nav-link>
    </div>
    <div class="flex justify-start w-full pl-6">
        <nav-link 
        href="/logout"
        class="hover:text-white px-2 py-2 text-lg font-medium"
        >
            ログアウト
        </nav-link>
    </div>
</div>
</template>