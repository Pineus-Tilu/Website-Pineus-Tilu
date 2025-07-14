import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Segoe UI', 'Roboto', 'Arial', ...defaultTheme.fontFamily.sans],
                mono: ['Roboto Mono', 'Consolas', 'Monaco', ...defaultTheme.fontFamily.mono],
                japanese: ['JapaneseBrush', 'sans-serif'],
                jp_brush: ['JapaneseBrush', 'monospace'],
                typewriter: ['VeteranTypewriter', 'monospace'],
                heading: ['Segoe UI', 'Roboto', 'Arial', 'sans-serif'],
                body: ['Roboto Mono', 'Consolas', 'monospace'],
            },
            fontWeight: {
                'extra-bold': '700',
            }
        },
    },

    plugins: [forms],
};

