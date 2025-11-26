import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/webmaster-links.js',
                'resources/js/webmaster-offers.js',
                'resources/js/advertiser-offers.js',
                'resources/js/admin-users.js',
                'resources/js/advertiser-stats.js',
            ],
            refresh: true,
        }),
    ],
});
