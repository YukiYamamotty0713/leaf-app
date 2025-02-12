<script setup lang="ts">
import { ref } from 'vue';
const activeSide = ref<string>("right");
const toggleSide = () => {
    activeSide.value = activeSide.value === "right" ? "left" : "right";
}
</script>
<template>
    <div 
    @click="toggleSide"
    class="toggle-button-wrapper"
    >
        <div 
        class="right"
       :class="{'active': activeSide === 'right'}"
        >
        <span>
            Card
        </span>
        </div>
        <div 
        class="left"
        :class="{'active': activeSide === 'left'}"
        >
        <span>
            List
        </span>
        </div>
    </div>
</template>
<style scoped>
.toggle-button-wrapper{
    @apply w-[100px] h-[50px] bg-slate-700 rounded-[15px] font-bold;
    @apply flex flex-row justify-between items-center;
}

.toggle-button-wrapper:hover{
    @apply cursor-pointer;
}    

.right{
    @apply w-full h-full flex justify-center items-center rounded-l-[15px];
}

.left{
    @apply w-full h-full flex justify-center items-center rounded-r-[15px];
}

.active{
    @apply bg-slate-300;
    @apply transition-all duration-500;
}
</style>