<script setup>
import Header from '@/Templates/Header.vue';
import Footer from '@/Templates/Footer.vue';
</script>
<template>
    <Header/>
    <div class="w-full flex justify-center min-h-screen py-10">
        <main class="w-[780px]">
            <slot />
        </main>
    </div>
    <Footer/>
</template>
