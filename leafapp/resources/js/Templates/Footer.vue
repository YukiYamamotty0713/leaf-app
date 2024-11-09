<script setup>
import { footerData } from '@/Texts/common.js';
</script>
<template>
    <footer class="w-full bg-secondary text-accent h-20 p-4">
        <span class="text-light">
            {{ footerData.text }}
        </span>
    </footer>
</template>