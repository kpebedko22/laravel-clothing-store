/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'light': {
                    DEFAULT: '#FFE4DA',
                    'hover': '#FF875C',
                },
                'dark': '#414151',
            },
        },
    },
    plugins: [],
}

