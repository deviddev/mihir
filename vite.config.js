import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        hmr: false,
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js", 'resources/css/christopheraseidl/cookie-consent/cookie-consent.css'],
            refresh: false,
        }),
    ],
});
