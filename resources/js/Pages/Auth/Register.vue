<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import RegisterForm from '@/Components/Auth/RegisterForm.vue';
</script>

<template>
    <GuestLayout>
        <Head title="登録" />
        <div class="py-4">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🍁アカウント登録</h2>
            <RegisterForm />
        </div>
    </GuestLayout>
</template>
