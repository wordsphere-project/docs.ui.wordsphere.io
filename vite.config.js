import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const host = 'wordsphereui-docs.test';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host,
        https: false,
        hmr: false,
        watch: {
            usePolling: false,
        }
    }
});
