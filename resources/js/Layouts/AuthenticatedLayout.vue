<script setup lang="ts">
import Header from '@/Templates/Header.vue';
import Footer from '@/Templates/Footer.vue';
import SidebarMobile from './SidebarMobile.vue';
import SideBar from './SideBar.vue';
import { useSidebar } from '@/Composables/Layout/AuthenticatedLayout/useSidebar';

const { showSidebarMobile, toggleSidebar, sidebarIcon } = useSidebar();


</script>

<template>
<div class="flex min-h-screen w-full bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white">

    <div class="sidebar-wrapper md:block hidden">
        <SideBar />
    </div>

    <div class="container relative">

        <div class="header-wrapper">
            <slot name="header">
                <Header />
            </slot>
            <div 
                class="absolute right-4 text-white text-3xl md:hidden block transition-transform duration-300 ease-in-out cursor-pointer"
                :class="{ 'rotate-90': showSidebarMobile }"
                @click="toggleSidebar"
            >
                {{ sidebarIcon }}
            </div>
        </div>

        <main class="main-wrapper opacity-0 animate-fadeIn">
            <slot />
        </main>

        <!-- SidebarMobile -->
        <SidebarMobile 
            :show="showSidebarMobile" 
            @close="toggleSidebar" 
        />
    </div>

</div>
</template>

<style scoped>
.container {
    @apply flex justify-start items-center min-h-screen gap-y-12 flex-col font-gothic flex-1 min-w-full;
}

.sidebar-wrapper {
    @apply w-64 bg-blue-900;
}

.header-wrapper {
    @apply min-w-full bg-black h-[100px] flex justify-center items-center shadow-lg;
}

.main-wrapper {
    @apply max-w-[780px] w-full mx-auto px-[15px] relative;
}

/* フェードインアニメーション */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
.animate-fadeIn {
    animation: fadeIn 1s ease-out forwards;
}
</style>
