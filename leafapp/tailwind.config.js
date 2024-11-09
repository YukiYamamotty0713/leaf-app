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
            backgroundColor: {
                primary: '#B69F7E',
                secondary: '#8C7A63',
                accent: '#566A56',
                light: '#F5F5F5',
                dark: '#2D2D2D',
                muted: '#E5E5E5',
            },
            textColor: {
                primary: '#2D2D2D',
                secondary: '#4A4A4A',
                accent: '#566A56',
                light: '#FFFFFF',
                dark: '#1A1A1A',
                muted: '#6B6B6B',
            },
        },
    },

    plugins: [forms],
};
