<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6">
        <div class="space-y-2">
            <InputLabel for="name" value="名前" class="text-gray-700 font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <TextInput
                    id="name"
                    type="text"
                    class="pl-10 pr-4 py-3 mt-1 block w-full text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="山田 太郎"
                />
            </div>
            <InputError class="mt-1 text-sm" :message="form.errors.name" />
        </div>

        <div class="space-y-2">
            <InputLabel for="email" value="メールアドレス" class="text-gray-700 font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <TextInput
                    id="email"
                    type="email"
                    class="pl-10 pr-4 py-3 mt-1 block w-full text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    placeholder="example@mail.com"
                />
            </div>
            <InputError class="mt-1 text-sm" :message="form.errors.email" />
        </div>

        <div class="space-y-2">
            <InputLabel for="password" value="パスワード" class="text-gray-700 font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <TextInput
                    id="password"
                    type="password"
                    class="pl-10 pr-4 py-3 mt-1 block w-full text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
            </div>
            <InputError class="mt-1 text-sm" :message="form.errors.password" />
        </div>

        <div class="space-y-2">
            <InputLabel
                for="password_confirmation"
                value="パスワード確認"
                class="text-gray-700 font-medium"
            />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="pl-10 pr-4 py-3 mt-1 block w-full text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
            </div>
            <InputError
                class="mt-1 text-sm"
                :message="form.errors.password_confirmation"
            />
        </div>

        <div class="pt-2">
            <PrimaryButton
                class="w-full py-3 bg-blue-300 hover:bg-blue-400 text-white font-bold rounded-lg transition duration-200 flex items-center justify-center"
                :class="{ 'opacity-75 cursor-not-allowed': form.processing }"
                :disabled="form.processing"
            >
                <span>登録</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </PrimaryButton>
        </div>

        <div class="text-center pt-2">
            <Link
                :href="route('login')"
                class="text-sm font-medium transition duration-200 text-blue-500 hover:text-blue-600 hover:underline"
            >
                既に登録済みですか？ログイン
            </Link>
        </div>
    </form>
</template>
