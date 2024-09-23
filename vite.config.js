import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',  // Laravel's CSS
                'resources/js/app.js',    // Laravel's JS
                'public/blog/wp-content/themes/coupon-theme/style.css',  // Add WordPress theme CSS
            ],
            refresh: true,  // Optional: to automatically refresh when files change
        }),
    ],
});
