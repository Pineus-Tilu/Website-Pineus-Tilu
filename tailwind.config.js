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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                japanese: ['JapaneseBrush', 'sans-serif'],
                jp_brush: ['JapaneseBrush', 'monospace'],
                typewriter: ['VeteranTypewriter', 'monospace'],
            },
        },
    },

    plugins: [forms],
};

