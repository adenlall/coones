/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            container: {
                center: true, // To center the container
                padding: '1rem', // Adds padding around the container
            },
            screens: {
                sm: '480px', // Small screens (default is 640px)
                md: '640px', // Medium screens (default is 768px)
                lg: '800px', // Large screens (default is 1024px)
                xl: '960px', // Extra-large screens (default is 1280px)
                '2xl': '1120px', // 2XL screens (default is 1536px)
            },          
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('daisyui')
    ],
    daisyui:{
        themes:[
            {
                cobones: {
                    "primary": "#facc15",
                    "secondary": "#ff5900",
                    "accent": "#13499f",
                    "accent-content": "#ffffff",
                    "neutral": "#0e1103",
                    "base-100": "#ffffff",
                    "info": "#0081fb",
                    "success": "#00ff94",
                    "warning": "#f97316",
                    "error": "#ff7b98"
                },
            }
        ]
    }
}

