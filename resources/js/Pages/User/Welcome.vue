<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});


</script>

<template>
    <Head title="Portal" />
    <div class="flex flex-col justify-center items-center gap-y-4 my-10 text-accent bg-primary">
        <application-logo></application-logo>
        <Link :href="route('login')">log in</Link>
        <Link v-if="canRegister" :href="route('register')">Register</Link>
    </div>
</template>
