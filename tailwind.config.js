/** @type {import('tailwindcss').Config} */
export default {
    mode: 'jit',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./public/blog/**/*.php"
    ],
    theme: {
        extend: {
            container: {
                center: true, // To center the container
                padding: '1rem', // Adds padding around the container
            }       
        },
    },
    cssnano: { preset: 'default' },
    variants: {
        extend: {
            backgroundColor: ['hover', 'focus'],
            textColor: ['group-hover'],
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

