<script setup lang="ts">
import TitleText from '@/Atoms/TitleText.vue';

import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

</script>
<template>
    <header class="w-full flex flex-col justify-center items-center bg-primary">
        <div class="w-full flex justify-center items-center relative by-primary">

            <!-- ログアウト（固定位置） -->
             <div class="absolute top-10 right-10">
                <Link
                    :href="route('logout')"
                    method="post"
                    class="text-accent cursor-pointer hover:text-light"
                >
                    ログアウト
                </Link>
            </div>

            <!-- メイン部分 -->
            <div class="">
                <application-logo/>
                <span class="text-primary">
                    <title-text/>
                </span>
            </div>
        </div>

    </header>
</template>