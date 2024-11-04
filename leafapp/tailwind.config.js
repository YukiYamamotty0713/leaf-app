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
            },
            colors: {
                primary_color: '#B69F7E',     // 任意の色に変更
                secondary_color: '#8C7A63',   // 任意の色に変更
                accent_color: '#566A56',      // 必要に応じて他の色も追加可能
            },
        },
    },

    plugins: [forms],
};
