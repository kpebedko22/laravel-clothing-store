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
                'light': '#FFE4DA',
                'dark': '#414151',
            },
        },
    },
    plugins: [],
}

