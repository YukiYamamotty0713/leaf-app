<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const isPasswordVisible = ref(false);
const isLoading = ref(false);

const submit = () => {
    isLoading.value = true;
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
            isLoading.value = false;
        },
    });
};

const togglePasswordVisibility = () => {
    isPasswordVisible.value = !isPasswordVisible.value;
};
</script>

<template>
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mb-6">
        <form @submit.prevent="submit">
            <!-- メールアドレス入力 -->
            <div class="mb-6">
                <InputLabel for="email" value="メールアドレス" class="text-gray-700 font-medium" />

                <div class="mt-2 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <TextInput
                        id="email"
                        type="email"
                        class="pl-10 mt-1 block w-full text-black border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent transition duration-150"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="your-email@example.com"
                    />
                </div>

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- パスワード入力 -->
            <div class="mb-6">
                <InputLabel for="password" value="パスワード" class="text-gray-700 font-medium" />

                <div class="mt-2 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <TextInput
                        id="password"
                        :type="isPasswordVisible ? 'text' : 'password'"
                        class="pl-10 pr-10 mt-1 block w-full text-black border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent transition duration-150"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button 
                            type="button" 
                            @click="togglePasswordVisibility" 
                            class="text-gray-400 hover:text-gray-600 focus:outline-none"
                        >
                            <svg v-if="!isPasswordVisible" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- パスワード記憶チェックボックス -->
            <div class="mb-6 flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" id="remember" class="text-accent focus:ring-accent" />
                <label for="remember" class="ml-2 text-sm text-gray-600">ログイン情報を記憶する</label>
            </div>

            <!-- パスワードリセットリンク -->
            <div v-if="canResetPassword" class="mb-6 text-center">
                <Link
                    :href="route('password.request')"
                    class="text-sm text-accent hover:text-accent-dark underline transition duration-150"
                >
                    パスワードをお忘れですか？
                </Link>
            </div>

            <!-- アクション -->
            <div class="flex flex-col space-y-4">
                <PrimaryButton
                    id="login"
                    :class="{ 'opacity-75 cursor-not-allowed': form.processing || isLoading }"
                    :disabled="form.processing || isLoading"
                    class="w-full py-3 bg-accent hover:bg-accent-dark transition duration-150 flex items-center justify-center"
                >
                    <span v-if="isLoading" class="animate-spin mr-2">
                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                    ログイン
                </PrimaryButton>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">または</span>
                    </div>
                </div>

                <Link
                    id="register"
                    href="/register"
                    class="w-full py-3 bg-white text-accent border border-accent rounded-lg shadow-sm hover:bg-gray-50 transition duration-150 flex items-center justify-center font-medium"
                >
                    新規登録
                </Link>
            </div>
        </form>
    </div>
</template>
