<script setup lang="ts">
import Header from '@/Templates/Header.vue';
import Footer from '@/Templates/Footer.vue';
import SidebarMobile from './SidebarMobile.vue';
import SideBar from './SideBar.vue';

import { ref, Ref } from 'vue';
    
const showSidebarMobile: Ref<boolean> = ref<boolean>(false);

const toggleSidebar = () => {
    showSidebarMobile.value = !showSidebarMobile.value;
};

</script>

<template>
<div class="flex min-h-screen w-full">

    <div class="sidebar-wrapper md:block hidden">
        <SideBar/>
    </div>

    <div class="container">

        <div class="header-wrapper">
            <slot name="header">
            <Header />
            </slot>
            <div 
            class="absolute right-0 mr-4 text-white text-2xl md:hidden block"
            @click="toggleSidebar"
            >
            {{ showSidebarMobile ? '×' : '≡' }}
            </div>
        </div>


        <main class="main-wrapper">
            <slot />
        </main>

       <!-- SidebarMobile コンポーネントをここに追加 -->
       <SidebarMobile :show="showSidebarMobile" @close="toggleSidebar" />
    </div>

</div>
</template>
<style scoped>

.container{
    @apply flex justify-start items-center min-h-screen gap-y-12 flex-col font-gothic flex-1 min-w-full;
}

.sidebar-wrapper{
    @apply w-64 bg-secondary;
}

.header-wrapper{

    @apply min-w-full bg-black h-[100px] justify-center items-center flex;
}

.main-wrapper{
    @apply max-w-[780px] w-full mx-auto px-[15px] relative;
}
</style>