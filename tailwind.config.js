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
                'secondary':{
                    DEFAULT: '#98E2C6',
                },
                // 'dark': '#414151',
                'dark': '#27233A',
            },
        },
        fontFamily: {
            sans: ['"PT Sans Caption"', 'sans-serif']
        }
    },
    darkMode: 'class',
    plugins: [],
}

