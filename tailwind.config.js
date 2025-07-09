const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                brew: {
                    amber: '#c58b39',
                    brown: '#5e3a1c',
                    beige: '#f9f7f3',
                    text: '#2d2d2d',
                    subtitle: '#4a3b31',
                    red: '#a3332b',
                    green: '#3a7534',
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
