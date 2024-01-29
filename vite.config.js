import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';
// import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        svelte()
    ],
    // resolve: {
    //     alias: {
    //         '@': path.resolve(__dirname, 'src'),
    //         // '@components': path.resolve(__dirname, 'src'),
    //         // '@layouts': path.resolve(__dirname, 'src/layouts'),
    //     },
    // },
});
