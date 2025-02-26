import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                gothic: ['Noto Sans JP', 'sans-serif'], // ゴシック体
                mincho: ['Noto Serif JP', 'serif'],    // 明朝体
            },
            backgroundColor: {
                primary: '#1E415E',     // Pythonロゴの濃い青
                secondary: '#4B8BBE',   // Pythonロゴの明るい青
                accent: '#306998',      // Pythonロゴの中間青
                light: '#EFF8FF',       // 薄い青白色
                dark: '#172B3A',        // 非常に暗い青
                muted: '#CFDEE9',       // 淡い青グレー
            },
            textColor: {
                primary: '#F8F8F2',     // 明るいテキスト（エディタ風）
                secondary: '#4B8BBE',   // Pythonロゴの明るい青
                accent: '#72A0C1',      // 水色がかった青
                light: '#FFFFFF',       // 白
                dark: '#172B3A',        // 非常に暗い青
                muted: '#8BA9BF',       // くすんだ青
            },
        },
    },

    plugins: [
        forms,
        function ({ addUtilities }) {
            addUtilities({
              '.scrollbar-none': {
                '-ms-overflow-style': 'none', /* IE/Edge */
                'scrollbar-width': 'none',   /* Firefox */
              },
              '.scrollbar-none::-webkit-scrollbar': {
                display: 'none', /* Chrome/Safari */
              },
            });
          },
        ],
};
