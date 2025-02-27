<script setup lang="ts">
import TitleText from '@/Atoms/TitleText.vue';

import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

</script>
<template>
    <header class="w-full flex flex-col justify-center items-center bg-black text-white">
        <div class="w-full flex justify-center items-center relative by-primary">


            
            <!-- メイン部分 -->
            <div class="">
                <application-logo/>
                <span class="text-white">
                    <title-text/>
                </span>
            </div>
        </div>

    </header>
</template>