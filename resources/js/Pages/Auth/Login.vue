<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import StatusMessage from '@/Components/Auth/StatusMessage.vue';
import LoginHeader from '@/Components/Auth/LoginHeader.vue';
import LoginForm from '@/Components/Auth/LoginForm.vue';
import LoginFooter from '@/Components/Auth/LoginFooter.vue';
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <StatusMessage :status="status" />

        <LoginHeader />

        <LoginForm :can-reset-password="canResetPassword" />

        <LoginFooter />
    </GuestLayout>
</template>

<style scoped>
/* 必要に応じてカスタムスタイルを追加 */
/* accentカラーの定義（実際の使用に合わせて調整してください） */
:root {
  --color-accent: #4f46e5;
  --color-accent-dark: #4338ca;
}
</style>
