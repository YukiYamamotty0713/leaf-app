<script setup lang="ts">
import Header from '@/Templates/Header.vue';
import Footer from '@/Templates/Footer.vue';
import NavLink from '@/Components/NavLink.vue';
import { routes } from './menus';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const pageroute:any = page.props.route;
</script>

<template>
    <Header />
    <div class="flex justify-center">
        <p class="text-base　font-bold text-black">
            📚～苦手な単語を、得意な一枚に～🖊
        </p>
    </div>
    <div class="flex flex-row justify-center items-center gap-x-4">
        <div v-for="item in routes" class="bg-primary">
            <nav-link 
            :href="route(item.route)"
            class="hover:text-white px-3 py-2 text-sm font-medium"
            :active="pageroute.name === item.route"
            >
                {{ item.title }}
            </nav-link>
        </div>
    </div>

    <div class="w-full flex justify-center min-h-screen py-6 font-gothic">
        <main class="max-w-[780px] w-full mx-auto px-[15px]">
            <slot />
        </main>
    </div>
    <Footer />
</template>
