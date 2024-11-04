<script setup>
import TitleText from '@/Atoms/TitleText.vue';
import NavLink from '@/Components/NavLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

</script>

<template>
    <div class="p-6 w-full justify-center items-center">
        <header class="h-[50px] w-full flex justify-center items-center p-6">
            <application-logo/>

            <span class="text-white">
                <title-text/>
            </span>
        </header>
        <main>
            <slot />
        </main>
    </div>
    <footer>

    </footer>
</template>
