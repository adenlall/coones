import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import viteCompression from 'vite-plugin-compression';
import { unlinkSync, readdirSync } from 'fs';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        viteCompression({
            algorithm: 'brotliCompress',
            ext: '.br', // Only generate Brotli compressed files
        }),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'public/blog/wp-content/themes/coupon-theme/style.css',
            ],
            refresh: true,
        }),
    ],
});
