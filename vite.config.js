import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/login.css',
                'resources/css/signup.css',
                'resources/css/dashboard.css',
                'resources/css/personnel.css',
                'resources/css/add-profile.css',
                'resources/css/viewprofile.css',
                'resources/css/search-profile.css',
                'resources/css/remove-profile.css',
                'resources/css/edit-profile.css',
                'resources/css/personneldashboard.css',
                'resources/js/profile-camera.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
